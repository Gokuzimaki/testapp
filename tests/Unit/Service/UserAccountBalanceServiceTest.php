<?php

namespace App\Tests\Unit\Service;

use DateTime;
use App\Entity\User;
use App\Entity\UserAccountBalance;
use App\Tests\BaseTestCase;
use App\Enum\Status\StatusEnum;
use App\Service\User\UserService;
use App\Service\UserAccountBalance\UserAccountBalanceService;

class UserAccountBalanceServiceTest extends BaseTestCase
{
    /**
     * @var UserService
     */
    private UserService $userService;

    private UserAccountBalanceService $userAccountBalanceService;

    public function setUp(): void
    {
        parent::setUp();

        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->userAccountBalanceService = new UserAccountBalanceService(
            $this->entityManager
        );

        $this->userService = new UserService(
            $this->entityManager
        );
    }

    public function testUserAccountBalanceIsCreatedCorrectly()
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

        $this->assertInstanceOf(UserAccountBalance::class, $userAccountBalance);
        $this->assertEquals($createdUserAccountBalance, $userAccountBalance);
    }
}
