<?php
namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Eccube\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class Newpage2Controller extends AbstractController
{
    /**
     * 
     * 
     * @var ProductRepository 
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;

    }
    /**
     * @Route("/new/page2", name="new_page2", methods={"GET"})
     * @Template("New/page2.twig")
     */
    public function index(Request $request)
    {
        //$Products = $this->productRepository->findBy(['name' => 'バナナ']);
        //$Products = $this->productRepository->findBy([],['id' => 'DESC']);
        $Products = $this->productRepository->findBy([],['id' => 'DESC'], 2);
       return ['Products' => $Products];
    }
}