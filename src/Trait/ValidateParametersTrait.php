<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Support\Dto\RequestResponseDtoInterface;

trait ValidateParametersTrait
{
    public static function validateParameters(Request $request, RequestResponseDtoInterface $responseObject): ?JsonResponse
    {
        $user_id = $request->get('user_id');

        if (!$user_id) {
            $response = new JsonResponse($responseObject
                ->setSuccess(false)
                ->setMessage('User Id not found, send "(string) user_id"  and "(float) amount" parameter with your request.'));

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);

            return $response;
        }

        $amount = $request->get('amount');

        if (!is_numeric($amount)) {
            $response = new JsonResponse($responseObject
                ->setSuccess(false)
                ->setMessage('Send "(float) amount" parameter with your request.'));

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);

            return $response;
        }

        return null;
    }
}
