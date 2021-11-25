<?php

namespace App\Service\UserAccountBalanceThreshold\Support\Dto;

use App\Support\Dto\RequestResponseDtoInterface;
use JsonSerializable;

class ThresholdResponseDto implements RequestResponseDtoInterface, JsonSerializable
{

    private bool $success;
    private ?string $message;
    private ?array $data;
    private ?int $statusCode;

    public function __construct()
    {
        $this->success = false;
        $this->message = null;
        $this->statusCode = null;
        $this->data = null;
    }

    public function jsonSerialize(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    /**
     * Get the value of success
     */
    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    /**
     * Set the value of success
     *
     * @return  self
     */
    public function setSuccess(bool $success): ThresholdResponseDto
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage(?string $message): ThresholdResponseDto
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData(?array $data): ThresholdResponseDto
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of statusCode
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * Set the value of statusCode
     *
     * @return  self
     */
    public function setStatusCode(?int $statusCode): ThresholdResponseDto
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
