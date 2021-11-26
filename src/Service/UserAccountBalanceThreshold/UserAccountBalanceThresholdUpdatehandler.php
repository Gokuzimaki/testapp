<?php

namespace App\Service\UserAccountBalanceThreshold;

use App\Entity\UserAccountBalanceThreshold;
use App\Service\User\UserService;
use Symfony\Component\HttpFoundation\Response;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdUpdateDto;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdResponseDto;
use DateTime;

class UserAccountBalanceThresholdUpdatehandler
{

    private UserService $userService;
    private UserAccountBalanceThresholdService $userAccountBalanceThresholdService;

    public function __construct(
        UserService $userService,
        UserAccountBalanceThresholdService $userAccountBalanceThresholdService
    ) {
        $this->userService = $userService;
        $this->userAccountBalanceThresholdService = $userAccountBalanceThresholdService;
    }

    public function initThresholdUpdate(ThresholdUpdateDto $thresholdUpdateDto): ThresholdResponseDto
    {

        if ($thresholdUpdateDto->getAmount() && $thresholdUpdateDto->getAmount() > 0) {

            $user = $this->userService->getOneByOpenBankingId($thresholdUpdateDto->getOpenBankingId());
            $userAccountBalanceThreshold = $this->userAccountBalanceThresholdService->getOneByUser($user);
            if ($userAccountBalanceThreshold) {

                $userAccountBalanceThreshold->setCreatedAt(new DateTime())
                    ->setUser($user)
                    ->setThresholdBalance($thresholdUpdateDto->getAmount());
                $this->userAccountBalanceThresholdService->update($userAccountBalanceThreshold);

                return (new ThresholdResponseDto())
                    ->setSuccess(true)
                    ->setMessage('User threshold balance updated')
                    ->setStatusCode(Response::HTTP_OK);
            }

            $userAccountBalanceThreshold = (new UserAccountBalanceThreshold())
                ->setCreatedAt(new DateTime())
                ->setUser($user)
                ->setThresholdBalance($thresholdUpdateDto->getAmount());
            $this->userAccountBalanceThresholdService->create($userAccountBalanceThreshold);

            return (new ThresholdResponseDto())
                ->setSuccess(true)
                ->setMessage('User threshold balance created.')
                ->setStatusCode(Response::HTTP_OK);
        }

        return (new ThresholdResponseDto())
            ->setSuccess(false)
            ->setMessage($errorMessage ?? 'No update done, invalid amount provided')
            ->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
