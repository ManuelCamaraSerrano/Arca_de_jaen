<?php

namespace App\Controller;

use App\Entity\LostAnimal;
use App\Entity\Race;
use App\Entity\Type;
use App\Entity\Usuario;
use App\Repository\LostAnimalRepository;
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
        
        $razas = $doctrine->getRepository(LostAnimal::class)->findAll();
        
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

   
}
