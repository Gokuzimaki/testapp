<?php

namespace App\Tests\Unit\Service;

use DateTime;
use App\Entity\User;
use App\Tests\BaseTestCase;
use App\Enum\Status\StatusEnum;
use App\Service\User\UserService;
use App\Entity\UserAccountBalanceThreshold;
use App\Service\UserAccountBalanceThreshold\UserAccountBalanceThresholdService;

class UserAccountBalanceThresholdServiceTest extends BaseTestCase
{
    protected bool $purge = true;

    /** @var EntityManagerInterface  */
    private $entityManager;

    /**
     * @var UserAccountBalanceThresholdService
     */
    private UserAccountBalanceThresholdService $userAccountBalanceThresholdService;

    /**
     * @var UserService
     */
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->userAccountBalanceThresholdService = new UserAccountBalanceThresholdService(
            $this->entityManager
        );

        $this->userService = new UserService(
            $this->entityManager
        );
    }

    public function testThresholdBalanceIsCreatedCorrectly()
    {

        $createdUser = $this->userService->create(
            (new User())
                ->setOpenBankingUserId('1adfe3-56bcae-367dde-446aed')
                ->setStatus(StatusEnum::ACTIVE)
                ->setCreatedAt(new DateTime())
        );

        $userAccountBalanceThreshold = (new UserAccountBalanceThreshold())
            ->setCreatedAt(new DateTime())
            ->setUser($createdUser)
            ->setThresholdBalance(4500);

        $createdUserAccountBalanceThreshold = $this->userAccountBalanceThresholdService
            ->create($userAccountBalanceThreshold);

        $this->assertInstanceOf(UserAccountBalanceThreshold::class, $userAccountBalanceThreshold);
        $this->assertEquals($createdUserAccountBalanceThreshold, $userAccountBalanceThreshold);
    }
}
