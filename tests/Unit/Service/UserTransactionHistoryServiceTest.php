<?php

namespace App\Tests\Unit\Service;

use DateTime;
use App\Entity\User;
use App\Tests\BaseTestCase;
use App\Enum\Status\StatusEnum;
use App\Service\User\UserService;
use App\Entity\UserAccountBalance;
use App\Entity\UserTransactionHistory;
use App\Enum\TransactionType\TransactionTypeEnum;
use App\Service\UserAccountBalance\UserAccountBalanceService;
use App\Service\UserTransactionHistory\UserTransactionHistoryService;

class UserTransactionHistoryServiceTest extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->UserTransactionHistoryService = new UserTransactionHistoryService(
            $this->entityManager
        );
        $this->userAccountBalanceService = new UserAccountBalanceService(
            $this->entityManager
        );
        $this->userService = new UserService(
            $this->entityManager
        );
    }

    public function testTransactionHistoryIsCorrectlyCreated()
    {
        $createdUser = $this->userService->create(
            (new User())
                ->setOpenBankingUserId('1adfe3-56bcae-367dde-446aed')
                ->setStatus(StatusEnum::ACTIVE)
                ->setCreatedAt(new DateTime())
        );

        $userAccountBalance = (new UserAccountBalance())
            ->setUser($createdUser)
            ->setCashBalance(0)
            ->setPreviousCashBalance(0)
            ->setStatus(StatusEnum::ACTIVE)
            ->setCreatedAt(new DateTime());

        $createdUserAccountBalance = $this->userAccountBalanceService->create($userAccountBalance);

        $userTransactionHistory = (new UserTransactionHistory())
            ->setUserAccountBalance($createdUserAccountBalance)
            ->setCashBalance(1000)
            ->setPreviousCashBalance(0)
            ->setCreatedAt(new DateTime())
            ->setStatus(StatusEnum::ACTIVE)
            ->setType(TransactionTypeEnum::CREDIT)
            ->setStatus(StatusEnum::ACTIVE);

        $createdUserTransactionHistory = $this->UserTransactionHistoryService->create($userTransactionHistory);

        $this->assertInstanceOf(UserTransactionHistory::class, $userTransactionHistory);
        $this->assertEquals($createdUserTransactionHistory, $userTransactionHistory);
    }
}
