<?php
namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Eccube\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Customize\Repository\CustomizeProductRepository;
use Customize\Entity\CustomizeProductNameType;
class ProductLayoutController extends AbstractController
{
    /**
     * 
     * 
     * @var ProductRepository 
     */
    private $productRepository;

    /**
     * Summary of productRepositoryRepository
     * @var CustomizeProductRepository
     */
    protected $customizeProductRepository;

    public function __construct(ProductRepository $productRepository, CustomizeProductRepository $customizeProductRepository){
        $this->productRepository = $productRepository;
        $this->customizeProductRepository = $customizeProductRepository;

    }
    /**
     * @Route("/product/page", name="product_page", methods={"GET","POST"})
     * @Template("Product/page.twig")
     */
    public function index(Request $request)
    {
        //$Products = $this->productRepository->findBy(['name' => 'バナナ']);
        //$Products = $this->productRepository->findBy([],['id' => 'DESC']);
       // $Products = $this->productRepository->findBy([],['id' => 'DESC'], 100);
    //http://localhost:8080/product/page?name=バナナ
      // $name = $_GET["name"] ;
        $name = $request->query->get('name');
        if(isset($_GET['name'])){
            $name = $_GET["name"] ;
            $Product = $this->customizeProductRepository->customFindByName($name);
        }else{
            $Product =  null;
        }
       $Products = $this->customizeProductRepository->customFindAll();

        $productName = $request->request->get("product_name");

        if (!empty($productName)){
            $Product = $this->customizeProductRepository->customFindByName($productName);
        }else{
             $Product =  null;
        }

        
    //     //form
    //    $builder = $this->formFactory->createNamedBuilder('', CustomizeProductNameType::class);
    //     $nameForm = $builder->getForm();
    //     $nameForm->handleRequest($request);
    //     if ($nameForm->isSubmitted() && $nameForm->isValid()) {
    //         $status = 'success';
    //     }
    
       return ['Products' => $Products,'SingleProduct'=> $Product];
    }
}