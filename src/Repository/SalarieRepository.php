<?php

namespace App\Repository;

use App\Entity\Salarie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Salarie>
 *
 * @method Salarie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salarie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salarie[]    findAll()
 * @method Salarie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalarieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salarie::class);
    }
}
