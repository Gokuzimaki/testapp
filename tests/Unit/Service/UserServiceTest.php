<?php

namespace App\Tests\Unit\Service;

use DateTime;
use App\Entity\User;
use App\Tests\BaseTestCase;
use App\Enum\Status\StatusEnum;
use App\Service\User\UserService;

class UserServiceTest extends BaseTestCase
{

    protected bool $purge = true;

    /** @var EntityManagerInterface  */
    private $entityManager;

    /**
     * @var UserService
     */
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->userService = new UserService(
            $this->entityManager
        );
    }

    public function testUserIsCorrectlyCreated()
    {
        $user = (new User())
            ->setOpenBankingUserId('1adfe3-56bcae-367dde-446aed')
            ->setStatus(StatusEnum::ACTIVE)
            ->setCreatedAt(new DateTime());


        $createdUser = $this->userService->create($user);
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($createdUser, $user);
    }
}
