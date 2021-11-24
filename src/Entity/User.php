<?php

namespace App\Entity;

use App\Enum\Status\StatusEnum;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="open_banking_user_id", type="string", nullable=true, options={"default"="NULL"})
     */
    private string $openBankingUserId;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private DateTime $createdAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum(StatusEnum::ACTIVE, StatusEnum::INACTIVE)", options={"default"="ACTIVE"})
     */
    private ?string $status = StatusEnum::ACTIVE;

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of openBankingUserId
     *
     * @return  string|null
     */
    public function getOpenBankingUserId()
    {
        return $this->openBankingUserId;
    }

    /**
     * Set the value of openBankingUserId
     *
     * @param  string|null  $openBankingUserId
     *
     * @return  self
     */
    public function setOpenBankingUserId(?string $openBankingUserId): User
    {
        $this->openBankingUserId = $openBankingUserId;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return  DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  DateTime  $createdAt
     *
     * @return  self
     */
    public function setCreatedAt(DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */
    public function setStatus(string $status): User
    {
        $this->status = $status;

        return $this;
    }
}
