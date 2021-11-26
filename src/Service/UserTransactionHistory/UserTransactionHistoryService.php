<?php

namespace App\Service\UserTransactionHistory;

use App\Entity\UserTransactionHistory;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserTransactionHistoryRepository;

class UserTransactionHistoryService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserRepository
     */
    private UserTransactionHistoryRepository $userTransactionHistoryRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;

        $this->userTransactionHistoryRepository = $this->entityManager->getRepository(UserTransactionHistory::class);
    }

    /**
     * @param UserTransactionHistory $userTransactionHistory
     * @return UserTransactionHistory
     */
    public function create(UserTransactionHistory $userTransactionHistory): UserTransactionHistory
    {
        return $this->persist($userTransactionHistory);
    }

    /**
     * @param UserTransactionHistory $userTransactionHistory
     * @return UserTransactionHistory
     */
    private function persist(UserTransactionHistory $userTransactionHistory): UserTransactionHistory
    {
        $this->entityManager->persist($userTransactionHistory);
        $this->entityManager->flush();

        return $userTransactionHistory;
    }

    /**
     * @param UserTransactionHistory $userTransactionHistory
     * @return UserTransactionHistory
     */
    public function update(UserTransactionHistory $userTransactionHistory): UserTransactionHistory
    {
        return $this->persist($userTransactionHistory);
    }
}
