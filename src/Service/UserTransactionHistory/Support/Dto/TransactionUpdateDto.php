<?php

namespace App\Service\UserTransactionHistory\Support\Dto;

use JsonSerializable;

class TransactionUpdateDto implements JsonSerializable
{
    private ?string $openBankingId;
    private ?float $amount;
    private ?string $transactionType;

    public function __construct()
    {
        $this->openBankingId = null;
        $this->amount = null;
        $this->transactionType = null;
    }

    public function jsonSerialize(): array
    {
        return [
            'openBankingId' => $this->openBankingId,
            'amount' => $this->amount,
            'transactionType' => $this->transactionType,
        ];
    }



    /**
     * Get the value of openBankingId
     */
    public function getOpenBankingId()
    {
        return $this->openBankingId;
    }

    /**
     * Set the value of openBankingId
     *
     * @return  self
     */
    public function setOpenBankingId(?string $openBankingId): TransactionUpdateDto
    {
        $this->openBankingId = $openBankingId;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount(?float $amount): TransactionUpdateDto
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of transactionType
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set the value of transactionType
     *
     * @return  self
     */
    public function setTransactionType(?string $transactionType): TransactionUpdateDto
    {
        $this->transactionType = $transactionType;

        return $this;
    }
}
