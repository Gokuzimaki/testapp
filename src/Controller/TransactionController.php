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
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends AbstractController
{
    /**
     * @Route("/credit", name="taskapp_credit", methods={"POST","GET"})
     */
    public function creditUser(
        Request $request,
        UserTransactionUpdateHandler $userTransactionUpdateHandler
    ): JsonResponse {
        $user_id = $request->get('user_id');

        if (!$user_id) {
            $errorMessage = 'User Id not found, send "(string) user_id"  and "(float) amount" parameter with your request.';
            $response = new JsonResponse((new TransactionResponseDto())
                ->setSuccess(false)
                ->setMessage($errorMessage));

            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

            return $response;
        }

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
     * @Route("/debit", name="taskapp_debit", methods={"GET"})
     */
    public function debitUser(
        Request $request,
        UserTransactionUpdateHandler $userTransactionUpdateHandler
    ): JsonResponse {
        $user_id = $request->get('user_id');

        if (!$user_id) {
            $errorMessage = 'User Id not found, send "(string) user_id"  and "(float) amount" parameter with your request.';
            $response = new JsonResponse((new TransactionResponseDto())
                ->setSuccess(false)
                ->setMessage($errorMessage));

            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

            return $response;
        }

        $amount = $request->get('amount');

        $transactionUpdateDto = (new TransactionUpdateDto())
            ->setOpenBankingId($user_id)
            ->setAmount($amount)
            ->setTransactionType(TransactionTypeEnum::DEBIT);

        $transactionResponse = $userTransactionUpdateHandler->initTransaction($transactionUpdateDto);
        $statusCode = $transactionResponse->getStatusCode();

        // dd($transactionResponse, $transactionResponse->jsonSerialize());

        return new JsonResponse($transactionResponse, $statusCode);
    }
}
