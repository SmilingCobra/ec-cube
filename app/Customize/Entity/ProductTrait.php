<?php

namespace Customize\Entity;
use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

//EC-CUBEの拡張機能を利用して、Productエンティティに侵入せず「産地」カラムを追加できる仕組みです。利用方法 use Customize\Entity\ProductTrait
trait ProductTrait
{
    /**
     * Summary of production_area
     * @ORM\Column(name = "production_area", type = "string", length = 255, nullable = true)
     */
    private $production_area = null;

    public function setProductionArea($production_area = null){
        $this->production_area = $production_area;
        return $this;
    }

    public function getProductionArea(){
        return $this->production_area;
    }

}