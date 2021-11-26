<?php

namespace App\Service\User;

use DateTime;
use App\Entity\User;
use App\Enum\Status\StatusEnum;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;

        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * @param User $user
     * @return User
     */
    public function create(User $user): User
    {
        return $this->persist($user);
    }

    /**
     * @param User $user
     * @return User
     */
    private function persist(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user): User
    {
        return $this->persist($user);
    }


    public function getOneByOpenBankingId(?string $openBankingUserId): ?User
    {
        if (!$openBankingUserId) {
            return null;
        }

        $user =  $this->userRepository->findOneBy(["openBankingUserId" => $openBankingUserId]);
        if (!$user) {
            $user = $this->create(
                (new User())->setOpenBankingUserId($openBankingUserId)
                    ->setCreatedAt(new DateTime())
                    ->setStatus(StatusEnum::ACTIVE)
            );
        }

        return $user;
    }
}
