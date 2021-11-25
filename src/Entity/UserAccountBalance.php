<?php

namespace App\Entity;

use DateTime;

use App\Enum\Status\StatusEnum;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Enum\TransactionType\TransactionTypeEnum;

/**
 * UserAccountBalance
 *
 * @ORM\Table(name="user_account_balances")
 * @ORM\Entity(repositoryClass="App\Repository\UserAccountBalanceRepository")
 *
 */
class UserAccountBalance
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private User $user;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cash_balance", type="decimal")
     */
    private ?float $cashBalance;

    /**
     * @var float|null
     *
     * @ORM\Column(name="previous_cash_balance", type="decimal")
     */
    private ?float $previousCashBalance;


    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum(StatusEnum::ACTIVE, StatusEnum::INACTIVE)", options={"default"="ACTIVE"})
     */
    private ?string $status = StatusEnum::ACTIVE;

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
     * @ORM\OneToMany(targetEntity="UserTransactionHistory", mappedBy="userAccountBalance")
     */
    private Collection $transactionHistories;

    public function __construct()
    {
        $this->transactionHistories = new ArrayCollection();
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
    public function setCreatedAt(DateTime $createdAt): UserAccountBalance
    {
        $this->createdAt = $createdAt;

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
    public function setUpdatedAt(?DateTime $updatedAt): UserAccountBalance
    {
        $this->updatedAt = $updatedAt;

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
    public function setStatus(?string $status): UserAccountBalance
    {
        $this->status = $status;

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
    public function setPreviousCashBalance(?float $previousCashBalance): UserAccountBalance
    {
        $this->previousCashBalance = $previousCashBalance;

        return $this;
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
    public function setCashBalance(?float $cashBalance): UserAccountBalance
    {
        $this->cashBalance = $cashBalance;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */
    public function setUser(User $user): UserAccountBalance
    {
        $this->user = $user;

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

    public function getFormattedBalance()
    {
        return number_format($this->cashBalance ?? 0);
    }

    /**
     * Get the value of transactionHistories
     */
    public function getTransactionHistories(): Collection
    {
        return $this->transactionHistories;
    }

    /**
     * Set the value of transactionHistories
     *
     * @return  self
     */
    public function setTransactionHistories(Collection $transactionHistories): UserAccountBalance
    {
        $this->transactionHistories = $transactionHistories;

        return $this;
    }

    public function getTotalSpendAmount()
    {
        $totalAmount = 0;
        foreach ($this->transactionHistories as $transactionHistory) {
            if ($transactionHistory->getType() && $transactionHistory->getType() === TransactionTypeEnum::DEBIT) {
                $totalAmount += $transactionHistory->getPreviousCashBalance() > 0 ?
                    $transactionHistory->getPreviousCashBalance() - $transactionHistory->getCashBalance() : 0;
            }
        }

        return number_format($totalAmount);
    }
}
