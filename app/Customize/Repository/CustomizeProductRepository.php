<?php
namespace Customize\Repository;
use Eccube\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Eccube\Repository\AbstractRepository;

class CustomizeProductRepository extends AbstractRepository{

    public function __construct(ManagerRegistry $registry){
        parent::__construct($registry, Product::class);
    }


    public function customFindAll(){
        $qb = $this->createQueryBuilder("p")->orderBy("p.id","DESC");
        $Products = $qb->getQuery()->getResult();
        return $Products;
    }


    public function customFindByName($name){
        $qb = $this->createQueryBuilder("p")->where("p.name = :name")->setParameter("name", $name)->orderBy("p.id","DESC");
        $Product = $qb->getQuery()->getSingleResult();
        return $Product;
    }   

    public function customUpdateProductionArea($productId, $productionArea){
        $id = intval($productId);
        $Product = $this->find($id);
        $area = (!empty($productionArea)) ? $productionArea : null;
        $Product->setProductionArea($area);
        $em = $this->getEntityManager();
        $em->persist($Product);
        $em->flush();
    }

}

