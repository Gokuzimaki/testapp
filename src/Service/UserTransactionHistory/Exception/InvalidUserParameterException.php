<?php

namespace App\Service\UserTransactionHistory\Exception;


class InvalidUserParameterException extends \Exception implements InvalidParameterExceptionInterface
{
    public function getErrorMessage(): string
    {
        return 'User Id not found, send "(string) user_id"  and "(float) amount" parameter with your request.';
    }
}
