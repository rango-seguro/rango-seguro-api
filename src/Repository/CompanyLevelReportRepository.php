<?php

namespace App\Repository;

use App\Entity\CompanyLevelReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyLevelReport|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyLevelReport|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyLevelReport[]    findAll()
 * @method CompanyLevelReport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class CompanyLevelReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyLevelReport::class);
    }
}
