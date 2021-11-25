<?php

namespace App\Service\UserTransactionHistory\Exception;

class InvalidAmountParameterException
{
    public function getErrorMessage(): string
    {
        return 'Send "(float) amount" parameter with your request.';
    }
}
