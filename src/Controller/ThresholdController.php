<?php

namespace App\Controller;

use App\Trait\ValidateParametersTrait;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdResponseDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\UserAccountBalanceThreshold\Support\Dto\ThresholdUpdateDto;
use App\Service\UserAccountBalanceThreshold\UserAccountBalanceThresholdUpdatehandler;

class ThresholdController extends AbstractController
{
    use ValidateParametersTrait;

    /**
     * @Route("/threshold", name="taskapp_threshold", methods={"POST","GET"})
     */
    public function setThreshold(
        Request $request,
        UserAccountBalanceThresholdUpdatehandler $userAccountBalanceThresholdUpdatehandler
    ): JsonResponse {
        $validateParameters = ValidateParametersTrait::validateParameters($request, new ThresholdResponseDto());
        if ($validateParameters instanceof JsonResponse) {
            return $validateParameters;
        }

        $user_id = $request->get('user_id');
        $amount = $request->get('amount');

        $thresholdUpdateDto = (new ThresholdUpdateDto())
            ->setOpenBankingId($user_id)
            ->setAmount($amount);

        $response = $userAccountBalanceThresholdUpdatehandler->initThresholdUpdate($thresholdUpdateDto);
        return new JsonResponse($response->jsonSerialize(), $response->getStatusCode());
    }
}
