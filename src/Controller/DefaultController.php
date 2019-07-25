<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $form = $this
            ->createFormBuilder()
            // ->add('nombre')
            // ->add('password')
            // ->add('entrar', SubmitType::class)
            ->getForm();

        return $this->render('default/index.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}
