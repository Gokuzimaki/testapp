<?php

namespace App\Service\UserAccountBalance;

use App\Entity\User;
use App\Entity\UserAccountBalance;
use App\Enum\Status\StatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserAccountBalanceRepository;
use DateTime;

class UserAccountBalanceService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserRepository
     */
    private UserAccountBalanceRepository $userAccountBalanceRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;

        $this->userAccountBalanceRepository = $this->entityManager->getRepository(UserAccountBalance::class);
    }

    /**
     * @param UserAccountBalance $userAccountBalance
     * @return UserAccountBalance
     */
    public function create(UserAccountBalance $userAccountBalance): UserAccountBalance
    {
        return $this->persist($userAccountBalance);
    }

    /**
     * @param UserAccountBalance $userAccountBalance
     * @return UserAccountBalance
     */
    private function persist(UserAccountBalance $userAccountBalance): UserAccountBalance
    {
        $this->entityManager->persist($userAccountBalance);
        $this->entityManager->flush();

        return $userAccountBalance;
    }

    /**
     * @param UserAccountBalance $userAccountBalance
     * @return UserAccountBalance
     */
    public function update(UserAccountBalance $userAccountBalance): UserAccountBalance
    {
        return $this->persist($userAccountBalance);
    }

    public function getOneByUser(?User $user): ?UserAccountBalance
    {
        if (!$user) {
            return null;
        }

        $account =  $this->userAccountBalanceRepository->findOneBy(["user" => $user]);

        if (!$account) {
            $account = $this->create(
                (new UserAccountBalance())->setStatus(StatusEnum::ACTIVE)
                    ->setUser($user)
                    ->setCashBalance(0)
                    ->setPreviousCashBalance(0)
                    ->setStatus(StatusEnum::ACTIVE)
                    ->setCreatedAt(new DateTime())
            );
        }

        return $account;
    }
}
