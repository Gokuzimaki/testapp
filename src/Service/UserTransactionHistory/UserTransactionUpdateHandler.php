<?php

namespace App\Service\UserTransactionHistory;

use App\Entity\User;
use App\Entity\UserAccountBalanceThreshold;
use App\Entity\UserTransactionHistory;
use App\Enum\Status\StatusEnum;
use App\Service\User\UserService;
use App\Enum\TransactionType\TransactionTypeEnum;
use App\Service\UserAccountBalance\UserAccountBalanceService;
use App\Service\UserAccountBalanceThreshold\UserAccountBalanceThresholdService;
use App\Service\UserTransactionHistory\Support\Dto\TransactionUpdateDto;
use App\Service\UserTransactionHistory\Support\Dto\TransactionResponseDto;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class UserTransactionUpdateHandler
{
    private UserService $userService;
    private UserAccountBalanceService $userAccountBalanceService;
    private UserTransactionHistoryService $userTransactionHistoryService;
    private UserAccountBalanceThresholdService $userAccountBalanceThresholdService;

    public function __construct(
        UserService $userService,
        UserAccountBalanceService $userAccountBalanceService,
        UserTransactionHistoryService $userTransactionHistoryService,
        UserAccountBalanceThresholdService $userAccountBalanceThresholdService
    ) {
        $this->userService = $userService;
        $this->userAccountBalanceService = $userAccountBalanceService;
        $this->userTransactionHistoryService = $userTransactionHistoryService;
        $this->userAccountBalanceThresholdService = $userAccountBalanceThresholdService;
    }

    public function initTransaction(TransactionUpdateDto $transactionUpdateDto): TransactionResponseDto
    {

        if ($transactionUpdateDto->getAmount() && $transactionUpdateDto->getAmount() > 0) {

            $user = $this->userService->getOneByOpenBankingId($transactionUpdateDto->getOpenBankingId());


            switch ($transactionUpdateDto->getTransactionType()) {
                case TransactionTypeEnum::CREDIT:
                    return $this->creditUserAccount($user, $transactionUpdateDto->getAmount());
                    break;

                case TransactionTypeEnum::DEBIT:
                    return $this->debitUserAccount($user, $transactionUpdateDto->getAmount());
                    break;
                default:
                    $errorMessage = 'Invalid transaction type detected';
                    break;
            }
        }


        return (new TransactionResponseDto())
            ->setSuccess(false)
            ->setMessage($errorMessage ?? 'No transaction processed, invalid amount provided')
            ->setStatusCode(Response::HTTP_PRECONDITION_FAILED);
    }


    private function creditUserAccount(User $user, float $amount)
    {
        $userAccount = $this->userAccountBalanceService->getOneByUser($user);
        $newBalance = $userAccount->getCashBalance() + $amount;
        $previousCashBalance = $userAccount->getCashBalance();

        $userAccount = $userAccount->setCashBalance($newBalance)
            ->setPreviousCashBalance($previousCashBalance)
            ->setUpdatedAt(new DateTime());
        $this->userAccountBalanceService->update($userAccount);

        $transaction = (new UserTransactionHistory())
            ->setType(TransactionTypeEnum::CREDIT)
            ->setCashBalance($newBalance)
            ->setUserAccountBalance($userAccount)
            ->setPreviousCashBalance($previousCashBalance)
            ->setStatus(StatusEnum::ACTIVE)
            ->setCreatedAt(new DateTime());

        $this->userTransactionHistoryService->create($transaction);

        return (new TransactionResponseDto)->setSuccess(true)->setMessage('Credit successful.')
            ->setStatusCode(Response::HTTP_OK);
    }

    private function debitUserAccount(User $user, float $amount)
    {
        $userAccount = $this->userAccountBalanceService->getOneByUser($user);

        if ($amount > $userAccount->getCashBalance()) {
            return (new TransactionResponseDto())->setSuccess(false)
                ->setMessage('Balance too low for debit')
                ->setStatusCode(Response::HTTP_PRECONDITION_FAILED);
        }

        $newBalance = $userAccount->getCashBalance() - $amount;
        $previousCashBalance = $userAccount->getCashBalance();

        $transaction = (new UserTransactionHistory())
            ->setType(TransactionTypeEnum::DEBIT)
            ->setCashBalance($newBalance)
            ->setUserAccountBalance($userAccount)
            ->setPreviousCashBalance($previousCashBalance)
            ->setCreatedAt(new DateTime());
        $this->userTransactionHistoryService->create($transaction);

        $userAccount = $userAccount->setCashBalance($newBalance)
            ->setPreviousCashBalance($previousCashBalance)
            ->setUpdatedAt(new DateTime());
        $userAccount = $this->userAccountBalanceService->update($userAccount);

        $transactionUpdateDto = (new TransactionResponseDto())
            ->setSuccess(true)
            ->setUserId($user->getOpenBankingUserId())
            ->setMessage('Debit transaction successful.')
            ->setStatusCode(Response::HTTP_OK);


        $userThreshold = $this->userAccountBalanceThresholdService->getOneByUser($user);

        if ($userThreshold) {

            $isPastThresholdBalance =  $userThreshold->getThresholdBalance() > $newBalance;

            if ($isPastThresholdBalance) {
                $transactionUpdateDto->setThreshold($userThreshold->getFormattedThreshold())
                    ->setTotalSpendings($userAccount->getTotalSpendAmount())
                    ->setHasThreshold(true);
            }
        }

        return $transactionUpdateDto;
    }
}
