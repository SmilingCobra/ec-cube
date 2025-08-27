<?php
namespace Customize\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Customize\Repository\CustomizeProductRepository;

class CustomizeProductNameType extends AbstractType{


     /**
     * Summary of productRepositoryRepository
     * @var CustomizeProductRepository
     */
    protected $customizeProductRepository;

    public function __construct(CustomizeProductRepository $customizeProductRepository){
        $this->customizeProductRepository = $customizeProductRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
       $CustomizeProducts = $this->customizeProductRepository->customFindAll();
       $choices = [];
       foreach($CustomizeProducts as $CustomizeProduct){
        $choices[$CustomizeProduct->getName()] = $CustomizeProduct->getName();
       }
       $builder->add('product_name', ChoiceType::class, ['choices' => $choices]);
       $builder->add('submit', SubmitType::class, ['label'=> '表示する']);
    }

}