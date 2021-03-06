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


    /**
     * @Route("/addLostAnimal", name="addLostAnimal")
     */
    public function addLostAnimal(): Response
    {
        return $this->render('addLostAnimal.html.twig', [

          
        ]);
    }


    /**
     * @Route("/viewLostAnimal", name="viewLostAnimal")
     */
    public function viewLostAnimal(): Response
    {
        return $this->render('viewLostAnimal.html.twig', [

          
        ]);
    }


    /**
     * @Route("/adoptionList", name="adoptionList")
     */
    public function adoptionList(): Response
    {
        return $this->render('adoptionList.html.twig', [

          
        ]);
    }

     /**
     * @Route("/infoAnimal", name="infoAnimal")
     */
    public function infoAnimal(): Response
    {
        return $this->render('infoAnimal.html.twig', [

          
        ]);
    }


    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about.html.twig', [

          
        ]);
    }

    
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig', [

          
        ]);
    }


    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery(): Response
    {
        return $this->render('gallery.html.twig', [

          
        ]);
    }


    /**
     * @Route("/reserve", name="reserve")
     */
    public function reserve(): Response
    {
        return $this->render('reserve.html.twig', [

        ]);
    }


    /**
     * @Route("/editUser", name="editUser")
     */
    public function editUser(): Response
    {
        return $this->render('editUser.html.twig', [

        ]);
    }
    
}