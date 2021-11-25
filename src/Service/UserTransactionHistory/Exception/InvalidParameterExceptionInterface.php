<?php

namespace App\Service\UserTransactionHistory\Exception;

interface InvalidParameterExceptionInterface
{

    public function getErrorMessage(): string;
}
