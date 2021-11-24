<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdUpdateDto;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdResponseDto;
use App\Service\UserAccountBalanceThreshold\UserAccountBalanceThresholdUpdatehandler;

class ThresholdController extends AbstractController
{

    /**
     * @Route("/threshold", name="taskapp_threshold", methods={"POST","GET"})
     */
    public function setThreshold(
        Request $request,
        UserAccountBalanceThresholdUpdatehandler $userAccountBalanceThresholdUpdatehandler
    ): JsonResponse {
        $user_id = $request->get('user_id');

        if (!$user_id) {
            $errorMessage = 'User Id not found, send "(string) user_id"  and "(float) amount" parameter with your request.';
            $response = new JsonResponse((new ThresholdResponseDto())
                ->setSuccess(false)
                ->setMessage($errorMessage));

            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

            return $response;
        }

        $amount = $request->get('amount');

        $thresholdUpdateDto = (new ThresholdUpdateDto())
            ->setOpenBankingId($user_id)
            ->setAmount($amount);

        $response = $userAccountBalanceThresholdUpdatehandler->initThresholdUpdate($thresholdUpdateDto);
        return new JsonResponse($response->jsonSerialize(), $response->getStatusCode());
    }
}
