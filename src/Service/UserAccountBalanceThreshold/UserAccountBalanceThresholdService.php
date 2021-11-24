<?php

namespace App\Service\UserAccountBalanceThreshold;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\UserAccountBalanceThreshold;
use App\Repository\UserAccountBalanceThresholdRepository;

class UserAccountBalanceThresholdService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserRepository
     */
    private UserAccountBalanceThresholdRepository $userAccountBalanceThresholdRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserAccountBalanceThresholdRepository $userAccountBalanceThresholdRepository
    ) {
        $this->entityManager = $entityManager;

        $this->userAccountBalanceThresholdRepository = $userAccountBalanceThresholdRepository;
    }

    /**
     * @param UserAccountBalanceThreshold $userAccountBalanceThreshold
     * @return UserAccountBalanceThreshold
     */
    public function create(UserAccountBalanceThreshold $userAccountBalanceThreshold): UserAccountBalanceThreshold
    {
        return $this->persist($userAccountBalanceThreshold);
    }

    /**
     * @param UserAccountBalanceThreshold $userAccountBalanceThreshold
     * @return UserAccountBalanceThreshold
     */
    private function persist(UserAccountBalanceThreshold $userAccountBalanceThreshold): UserAccountBalanceThreshold
    {
        $this->entityManager->persist($userAccountBalanceThreshold);
        $this->entityManager->flush();

        return $userAccountBalanceThreshold;
    }

    /**
     * @param UserAccountBalanceThreshold $userAccountBalanceThreshold
     * @return UserAccountBalanceThreshold
     */
    public function update(UserAccountBalanceThreshold $userAccountBalanceThreshold): UserAccountBalanceThreshold
    {
        return $this->persist($userAccountBalanceThreshold);
    }

    public function getOneByUser(User $user): ?UserAccountBalanceThreshold
    {
        return $this->userAccountBalanceThresholdRepository->findOneBy(['user' => $user]);
    }
}
