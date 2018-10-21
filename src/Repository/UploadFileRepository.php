<?php

namespace App\Repository;

use App\Entity\UploadFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Upload|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upload|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upload[]    findAll()
 * @method Upload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UploadFile::class);
    }

    public function affichageUploadByUser($iduser){
        $query=$this->createQueryBuilder('u')
            ->select('u')
            ->Where('u.iduser =:iduser')
            ->setParameter('iduser',$iduser);
        return $query->getQuery()->getResult();

    }
}
