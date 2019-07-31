<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriaRepository;
use App\Repository\ProductoRepository;
use App\Entity\Categoria;

class AjaxController extends AbstractController
{

    /**
     *
     * @Route("/ajax/{id?}", name="ajax", methods={"GET", "POST"})
     */
    public function index($id, Request $request, ProductoRepository $productoRepository, CategoriaRepository $categoriaRepository)
    {
        if (! $request->isXmlHttpRequest()) {
            $categorias = $categoriaRepository->findAll();
            $productos = $productoRepository->findAll();
            return $this->render('ajax/index.html.twig', [
                'categorias' => $categorias,
                'productos' => $productos,
            ]);
        }
        
        $categoria = $categoriaRepository->find($id);
        $productos = ($categoria == null) ? $productoRepository->findAll() : $categoria->getProductos();
        
        
        /** @var \Twig_Environment $twig */
        $twig = $this->get('twig');
        /** @var \Twig_Template $template */
        $template = $twig->loadTemplate('ajax/index.html.twig');
        $data = $template->renderBlock('resultado', ['productos'=>$productos]);
        return $this->json(['data'=> $data], 200);
    }

    /**
     * @Route("/agregar_categoria/{id}", name="agregar_categoria", methods={"POST"})
     */
    public function agregarCategoria($id, Request $request): Response
    {
        if ( $request->isXmlHttpRequest()) {
            $categoria = new Categoria();
            $categoria->setNombre($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            
            return $this->json(['data'=>['id'=>$categoria->getId(), 'value'=>$categoria->getNombre()]]);
        }
    }
}