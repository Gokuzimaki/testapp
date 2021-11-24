<?php

namespace App\Service\UserTransactionHistory\Support\Dto;

use JsonSerializable;

class TransactionResponseDto implements JsonSerializable
{
    private bool $success;
    private ?string $message;
    private ?array $data;
    private ?int $statusCode;
    private ?string $userId;
    private ?string $threshold;
    private ?string $totalSpendings;
    private ?bool $hasThreshold;

    public function __construct()
    {
        $this->success = false;
        $this->message = null;
        $this->statusCode = null;
        $this->data = null;
        $this->userId = null;
        $this->threshold = null;
        $this->hasThreshold = null;
        $this->totalSpendings = null;
    }

    public function jsonSerialize(): array
    {

        $returnedData = [
            'success' => $this->success,
            'message' => $this->message,
        ];

        if ($this->getHasThreshold()) {
            $returnedData['userId'] = $this->userId;
            $returnedData['threshold'] = $this->threshold;
            $returnedData['totalSpendings'] = $this->totalSpendings;
        }

        return $returnedData;
    }

    /**
     * Get the value of success
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set the value of success
     *
     * @return  self
     */
    public function setSuccess(bool $success): TransactionResponseDto
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage(?string $message): TransactionResponseDto
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData(?array $data): TransactionResponseDto
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of statusCode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the value of statusCode
     *
     * @return  self
     */
    public function setStatusCode(?int $statusCode): TransactionResponseDto
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId(?string $userId): TransactionResponseDto
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of threshold
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Set the value of threshold
     *
     * @return  self
     */
    public function setThreshold(?string $threshold): TransactionResponseDto
    {
        $this->threshold = $threshold;

        return $this;
    }

    /**
     * Get the value of totalSpendings
     */
    public function getTotalSpendings()
    {
        return $this->totalSpendings;
    }

    /**
     * Set the value of totalSpendings
     *
     * @return  self
     */
    public function setTotalSpendings(?string $totalSpendings): TransactionResponseDto
    {
        $this->totalSpendings = $totalSpendings;

        return $this;
    }

    /**
     * Get the value of hasThreshold
     */
    public function getHasThreshold()
    {
        return $this->hasThreshold;
    }

    /**
     * Set the value of hasThreshold
     *
     * @return  self
     */
    public function setHasThreshold(?bool $hasThreshold): TransactionResponseDto
    {
        $this->hasThreshold = $hasThreshold;

        return $this;
    }
}
