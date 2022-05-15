<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\LostAnimal;
use App\Entity\Photo;
use App\Entity\Race;
use App\Entity\Type;
use App\Entity\Usuario;
use App\Repository\LostAnimalRepository;
use App\Repository\AnimalRepository;
use App\Repository\RaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class JsonController extends AbstractController
{


    /**
     * @Route("/race/{type}", name="race")
     */
    public function race(ManagerRegistry $doctrine, string $type): Response
    {

        ini_set('memory_limit', '1024M');

        $raceRepo = new RaceRepository($doctrine);

        $razas = $raceRepo->raceForType($type);
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($razas, 'json');
        return new Response($jsonContent);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/type", name="type")
     */
    public function type(ManagerRegistry $doctrine): Response
    {
        ini_set('memory_limit', '1024M');

        $razas = $doctrine->getRepository(Type::class)->findAll();
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($razas, 'json');
        return new Response($jsonContent);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/insertAnimal/{animal}", name="insertAnimal")
     */
    public function insertAnimal(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, $animal): Response
    {

        $array = json_decode($animal);

       // $foto = "img/".$_FILES['fichero']['name'];

       move_uploaded_file($_FILES['fichero']['tmp_name'],"public/images/animals/".$_FILES['fichero']['name']);

        $tipo = $doctrine->getRepository(Type::class)->find($array[6]);
        $raza = $doctrine->getRepository(Race::class)->find($array[7]);
        $usuario = $doctrine->getRepository(Usuario::class)->find($array[8]);

        $array[6] = $tipo;
        $array[7] = $raza;
        $array[8] = $usuario;

        $lostAnimalRepo = new LostAnimalRepository($doctrine);
        $insert = $lostAnimalRepo->insertLostAnimal($array,$entityManager);

        return new Response("ok");

    }


    /**
     * @Route("/lostAnimal", name="lostAnimal")
     */
    public function getLostAnimals(ManagerRegistry $doctrine): Response
    {
        ini_set('memory_limit', '1024M');
        
        $razas = $doctrine->getRepository(LostAnimal::class)->findAll();

        $animalesPerdidos = [];

        for($i = 0; $i < count($razas); $i++){

            $animalesPerdidos[$i] = [$razas[$i]->getLat(),$razas[$i]->getLng(),$razas[$i]->getName(), $razas[$i]->getPhoto(), $razas[$i]->getColour(), $razas[$i]->getDescription(), $razas[$i]->getType()->getName(), $razas[$i]->getRace()->getName(), $razas[$i]->getUsuario()->getEmail(), $razas[$i]->getUsuario()->getPhone()];
        }
        
        
        return new Response(json_encode($animalesPerdidos));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/animalList/{page}", name="animalList")
     */
    public function animalList(ManagerRegistry $doctrine, int $page): Response
    {
        $animalRepository= new AnimalRepository($doctrine);

        $animal = $animalRepository->animalPaginado(intval($page));

        $animales = [];

        for($i = 0; $i < count($animal); $i++){

            if(count($animal[$i]->getPhotos()) == 0){

                $animales[$i] = [$animal[$i]->getId(),$animal[$i]->getName(),"null",$animal[$i]->getSex()];

            }
            else{

                $animales[$i] = [$animal[$i]->getId(),$animal[$i]->getName(),$animal[$i]->getPhotos()[0]->getPhoto(),$animal[$i]->getSex()];
            }
            
        }
        
                
        return new Response(json_encode($animales));


        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/nPageAnimal", name="nPageAnimal")
     */
    public function nPageAnimal(ManagerRegistry $doctrine): Response
    {
        
        $animales = $doctrine->getRepository(Animal::class)->findAll();

        $page = round(count($animales)/12)+1;
        
        return new Response(json_encode($page));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);

    }
        


}
