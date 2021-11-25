<?php

namespace App\Controller;

use App\Enum\TransactionType\TransactionTypeEnum;
use App\Service\UserTransactionHistory\Support\Dto\TransactionUpdateDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\UserTransactionHistory\Support\Dto\TransactionResponseDto;
use App\Service\UserTransactionHistory\UserTransactionUpdateHandler;
use App\Trait\ValidateParametersTrait;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends AbstractController
{
    use ValidateParametersTrait;

    /**
     * @Route("/credit", name="taskapp_credit", methods={"POST"})
     */
    public function creditUser(
        Request $request,
        UserTransactionUpdateHandler $userTransactionUpdateHandler
    ): JsonResponse {

        $validateParameters = ValidateParametersTrait::validateParameters($request, new TransactionResponseDto());
        if ($validateParameters instanceof JsonResponse) {
            return $validateParameters;
        }

        $user_id = $request->get('user_id');
        $amount = $request->get('amount');

        $transactionUpdateDto = (new TransactionUpdateDto())
            ->setOpenBankingId($user_id)
            ->setAmount($amount)
            ->setTransactionType(TransactionTypeEnum::CREDIT);

        $transactionResponse = $userTransactionUpdateHandler->initTransaction($transactionUpdateDto);
        $statusCode = $transactionResponse->getStatusCode();

        return new JsonResponse($transactionResponse->jsonSerialize(), $statusCode);
    }


    /**
     * @Route("/debit", name="taskapp_debit", methods={"POST"})
     */
    public function debitUser(
        Request $request,
        UserTransactionUpdateHandler $userTransactionUpdateHandler
    ): JsonResponse {
        $validateParameters = ValidateParametersTrait::validateParameters($request, new TransactionResponseDto());
        if ($validateParameters instanceof JsonResponse) {
            return $validateParameters;
        }

        $user_id = $request->get('user_id');
        $amount = $request->get('amount');

        $transactionUpdateDto = (new TransactionUpdateDto())
            ->setOpenBankingId($user_id)
            ->setAmount($amount)
            ->setTransactionType(TransactionTypeEnum::DEBIT);

        $transactionResponse = $userTransactionUpdateHandler->initTransaction($transactionUpdateDto);
        $statusCode = $transactionResponse->getStatusCode();


        return new JsonResponse($transactionResponse, $statusCode);
    }
}
