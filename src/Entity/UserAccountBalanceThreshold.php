<?php

namespace App\Entity;

use DateTime;
use NumberFormatter;
use App\Utility\NumberFormat;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserAccountBalanceThreshold
 *
 * @ORM\Table(name="user_account_balance_thresholds")
 * @ORM\Entity(repositoryClass="App\Repository\UserAccountBalanceThresholdRepository")
 *
 */
class UserAccountBalanceThreshold
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
     * @ORM\Column(name="threshold_balance", type="decimal")
     */
    private ?float $thresholdBalance;


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
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
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
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of thresholdBalance
     *
     * @return  float|null
     */
    public function getThresholdBalance()
    {
        return $this->thresholdBalance;
    }

    /**
     * Set the value of thresholdBalance
     *
     * @param  float|null  $thresholdBalance
     *
     * @return  self
     */
    public function setThresholdBalance(?float $thresholdBalance): UserAccountBalanceThreshold
    {
        $this->thresholdBalance = $thresholdBalance;

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
    public function setUpdatedAt(?DateTime $updatedAt): UserAccountBalanceThreshold
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
    public function setCreatedAt(DateTime $createdAt): UserAccountBalanceThreshold
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFormattedThreshold()
    {
        return number_format($this->getThresholdBalance());
    }
}
