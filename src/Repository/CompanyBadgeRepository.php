<?php

namespace App\Repository;

use App\Entity\CompanyBadge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyBadge|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyBadge|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyBadge[]    findAll()
 * @method CompanyBadge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class CompanyBadgeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyBadge::class);
    }
}
