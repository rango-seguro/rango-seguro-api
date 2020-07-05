<?php

namespace App\Repository;

use App\Entity\OwnershipRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnershipRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnershipRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnershipRequest[]    findAll()
 * @method OwnershipRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class OwnershipRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnershipRequest::class);
    }
}
