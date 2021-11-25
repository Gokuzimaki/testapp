<?php

namespace App\Support\Dto;

interface RequestResponseDtoInterface
{

    /**
     * Get the value of success
     */
    public function getSuccess(): ?bool;

    /**
     * Set the value of success
     *
     * @return  self
     */
    public function setSuccess(bool $success): self;


    /**
     * Get the value of message
     */
    public function getMessage(): ?string;

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage(?string $message): self;


    /**
     * Get the value of data
     */
    public function getData(): ?array;


    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData(?array $data): self;

    /**
     * Get the value of statusCode
     */
    public function getStatusCode(): ?int;


    /**
     * Set the value of statusCode
     *
     * @return  self
     */
    public function setStatusCode(?int $statusCode): self;
}
