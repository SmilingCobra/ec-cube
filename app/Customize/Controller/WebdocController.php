<?php
namespace Customize\Controller;

use Customize\Entity\WebdocNews;
use Customize\Entity\WebdocNewsType;
use Customize\Repository\WebdocNewsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebdocController extends AbstractController
{
    private WebdocNewsRepository $repo;

    public function __construct(WebdocNewsRepository $repo)
    {
        $this->repo = $repo;
    }

    /** @Route("/webdoc/webdoc", name="webdoc_list") 
     * @Template("Webdoc/webdoc.twig") 
     */
    public function index(): array
    {
        $news = $this->repo->findAllNews();
        return [
            'mode' => 'list',
            'news' => $news,
        ];
    }

    /** @Route("/webdoc/new", name="webdoc_new", methods={"GET", "POST"}) 
     *  @Template("Webdoc/new.twig")
     */
    public function new(Request $request)
    {
     
        $news = new WebdocNews();
        $builder = $this->formFactory->createBuilder( WebdocNewsType::class,$news);
        $form = $builder->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($news);
             return $this->redirectToRoute('webdoc_list');
            
        }
        return $this->render('Webdoc/new.twig', [
            'WebdocNewForm' => $form->createView(),
        ]);
       
    }


   

    /** @Route("/webdoc/delete/{id}", name="webdoc_delete") 
     *  
     */
    public function delete(Request $request, int $id)
    {
        $news = $this->repo->findById($id);
        if (!$news) throw $this->createNotFoundException();

       $this->repo->delete($news);
        return $this->redirectToRoute('webdoc_list');
    }
}
