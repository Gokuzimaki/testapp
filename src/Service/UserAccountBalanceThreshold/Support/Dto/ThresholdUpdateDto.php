<?php

namespace App\Service\UserAccountBalanceThreshold\Support\Dto;

class ThresholdUpdateDto
{
    private ?string $openBankingId;
    private ?float $amount;

    public function __construct()
    {
        $this->openBankingId = null;
        $this->amount = null;
    }

    public function jsonSerialize(): array
    {
        return [
            'openBankingId' => $this->openBankingId,
            'amount' => $this->amount,
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
    public function setOpenBankingId(?string $openBankingId): ThresholdUpdateDto
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
    public function setAmount(?float $amount): ThresholdUpdateDto
    {
        $this->amount = $amount;

        return $this;
    }
}
