<?php

namespace App\Entity;

use DateTime;
use App\Enum\Status\StatusEnum;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\UserAccountBalance;

/**
 * UserTransactionHistory
 *
 * @ORM\Table(name="user_transaction_histories")
 * @ORM\Entity(repositoryClass="App\Repository\UserTransactionHistoryRepository")
 *
 */
class UserTransactionHistory
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
     * @var UserAccountBalance
     *
     * @ORM\ManyToOne(targetEntity="UserAccountBalance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_account_balance_id", referencedColumnName="id")
     * })
     */
    private UserAccountBalance $userAccountBalance;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cash_balance", type="decimal")
     */
    private float $cashBalance;

    /**
     * @var float|null
     *
     * @ORM\Column(name="previous_cash_balance", type="decimal")
     */
    private float $previousCashBalance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum(StatusEnum::ACTIVE, StatusEnum::INACTIVE)", options={"default"="ACTIVE"})
     */
    private ?string $status = StatusEnum::ACTIVE;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", columnDefinition="enum(TransactionTypeEnum::CREDIT, TransactionTypeEnum::DEBIT)", options={"default"="NULL"})
     */
    private ?string $type = null;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt = null;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private DateTime $createdAt;

    /**
     * Get the value of user
     *
     * @return  UserAccountBalance
     */
    public function getUser()
    {
        return $this->userAccountBalance;
    }

    /**
     * Set the value of user
     *
     * @param  UserAccountBalance  $user
     *
     * @return  self
     */
    public function setUserAccountBalance(UserAccountBalance $userAccountBalance)
    {
        $this->userAccountBalance = $userAccountBalance;

        return $this;
    }

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
     * Get the value of cashBalance
     *
     * @return  float|null
     */
    public function getCashBalance()
    {
        return $this->cashBalance;
    }

    /**
     * Set the value of cashBalance
     *
     * @param  float|null  $cashBalance
     *
     * @return  self
     */
    public function setCashBalance(?float $cashBalance): UserTransactionHistory
    {
        $this->cashBalance = $cashBalance;

        return $this;
    }

    /**
     * Get the value of previousCashBalance
     *
     * @return  float|null
     */
    public function getPreviousCashBalance()
    {
        return $this->previousCashBalance;
    }

    /**
     * Set the value of previousCashBalance
     *
     * @param  float|null  $previousCashBalance
     *
     * @return  self
     */
    public function setPreviousCashBalance(?float $previousCashBalance): UserTransactionHistory
    {
        $this->previousCashBalance = $previousCashBalance;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string|null  $status
     *
     * @return  self
     */
    public function setStatus(?string $status): UserTransactionHistory
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string|null  $type
     *
     * @return  self
     */
    public function setType(?string $type): UserTransactionHistory
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  DateTime|null  $updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt(?DateTime $updatedAt): UserTransactionHistory
    {
        $this->updatedAt = $updatedAt;

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
    public function setCreatedAt(DateTime $createdAt): UserTransactionHistory
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
