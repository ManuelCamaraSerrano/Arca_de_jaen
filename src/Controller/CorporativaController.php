<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CorporativaController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
      {
          return $this->render('index1.html.twig', [

            
          ]);
      }
}