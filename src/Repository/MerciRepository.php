<?php

namespace App\Repository;

use App\Entity\Merci;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Merci>
 *
 * @method Merci|null find($id, $lockMode = null, $lockVersion = null)
 * @method Merci|null findOneBy(array $criteria, array $orderBy = null)
 * @method Merci[]    findAll()
 * @method Merci[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerciRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Merci::class);
    }

    public function findByAuthorName(string $authorName)
    {
        return $this->createQueryBuilder('m')
            ->join('m.author', 'a')
            ->where('a.name LIKE :authorName')
            ->setParameter('authorName', '%' . $authorName . '%')
            ->getQuery()
            ->getResult();
    }


}
