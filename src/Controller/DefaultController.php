<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('default/test.html.twig', []);
    }

    /**
     * @Route("/testform", name="test_form", methods={"GET","POST"})
     */
    public function testForm(Request $request)
    {
        $form = $this
            ->createFormBuilder()
            ->add('name')
            ->add('password')
            ->add('login', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->IsValid())
        {
            return $this->redirectToRoute('test');
        }
        return $this->render('default/test_form.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}
