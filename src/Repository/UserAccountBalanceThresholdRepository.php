<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\UserAccountBalanceThreshold;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UserAccountBalanceThresholdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAccountBalanceThreshold::class);
    }
}
