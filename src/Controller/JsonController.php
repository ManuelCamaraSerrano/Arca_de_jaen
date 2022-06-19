<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Gallery;
use App\Entity\Job;
use App\Entity\LostAnimal;
use App\Entity\Photo;
use App\Entity\Race;
use App\Entity\Stretch;
use App\Entity\Type;
use App\Entity\Usuario;
use App\Repository\LostAnimalRepository;
use App\Repository\AnimalRepository;
use App\Repository\RaceRepository;
use App\Repository\GalleryRepository;
use App\Repository\RequestRepository;
use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

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


    }


    /**
     * @Route("/insertAnimal", name="insertAnimal")
     */
    public function insertAnimal(EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {

       $animal = [$_POST["nombre"],$_POST["color"],$_POST["tipo"],$_POST["raza"],$_POST["descripcion"],$_POST["usuario"],$_POST["lat"],$_POST["lng"],$_FILES['file-1']['name']];

       move_uploaded_file($_FILES['file-1']['tmp_name'],"estilos/assets/images/animals/".$_FILES['file-1']['name']);

        $tipo = $doctrine->getRepository(Type::class)->find($animal[2]);
        $raza = $doctrine->getRepository(Race::class)->find($animal[3]);
        $usuario = $doctrine->getRepository(Usuario::class)->find($animal[5]);

        $animal[2] = $tipo;
        $animal[3] = $raza;
        $animal[5] = $usuario;

        $lostAnimalRepo = new LostAnimalRepository($doctrine);
        $insert = $lostAnimalRepo->insertLostAnimal($animal,$entityManager);

        return $this->redirectToRoute('index');;

    }


    /**
     * @Route("/updateUser", name="updateUser")
     */
    public function updateUser(EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {

        $usuario = $doctrine->getRepository(Usuario::class)->find($_POST["id"]);

        if($_FILES['file-1']['name'] != ""){
            move_uploaded_file($_FILES['file-1']['tmp_name'],"estilos/assets/images/users/".$_FILES['file-1']['name']);
            $usuario->setPhoto($_FILES['file-1']['name']);
        }

        $usuario->setName($_POST["name"]);
        $usuario->setAp1($_POST["ap1"]);
        $usuario->setAp2($_POST["ap2"]);
        $usuario->setPhone($_POST["phone"]);
        $usuario->setEmail($_POST["email"]);

        $entityManager->persist($usuario);
        $entityManager->flush();

        return $this->redirectToRoute('editUser');;

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


    }


    /**
     * @Route("/nPageAnimal", name="nPageAnimal")
     */
    public function nPageAnimal(ManagerRegistry $doctrine): Response
    {
        
        $animales = $doctrine->getRepository(Animal::class)->findAll();

        $page = (count($animales)/8) % 1;

        if(!is_int($page)){

            return new Response(json_encode(intval(count($animales)/8)));
        }
        else{

            return new Response(json_encode(intval(count($animales)/8)+1));
        }
        
    }


    /**
     * @Route("/nPageGallery", name="nPageGallery")
     */
    public function nPageGallery(ManagerRegistry $doctrine): Response
    {
        
        $gallery = $doctrine->getRepository(Gallery::class)->findAll();

        $page = (count($gallery)/9) % 1;

        if(!is_int($page)){

            return new Response(json_encode(intval(count($gallery)/9)));
        }
        else{

            return new Response(json_encode(intval(count($gallery)/9)+1));
        }
        
    }


    /**
     * @Route("/galleryList/{page}", name="galleryList")
     */
    public function galleryList(ManagerRegistry $doctrine, int $page): Response
    {
        $galleryRepository= new GalleryRepository($doctrine);

        $gallery = $galleryRepository->galeriaPaginado(intval($page));

        $galleries = [];

        for($i = 0; $i < count($gallery); $i++){

            $galleries[$i] = [$gallery[$i]->getPhoto()];        
        }
        
                
        return new Response(json_encode($galleries));


    }


    /**
     * @Route("/getAnimal/{animal}", name="getAnimal")
     */
    public function getAnimal(ManagerRegistry $doctrine, int $animal): Response
    {

        $animal = $doctrine->getRepository(Animal::class)->find($animal);  // Leemos el animal en concreto
        
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $jsonContent = $serializer->serialize($animal, 'json');
        return new Response($jsonContent);

    }


    /**
     * @Route("/insertSolicitud/{solicitud}", name="insertSolicitud")
     */
    public function insertSolicitud(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, $solicitud): Response
    {

        $array = json_decode($solicitud);

        $array[3] = date("20y-m-d"); // Cogemos la fecha actual

        $usuario = $doctrine->getRepository(Usuario::class)->find($array[0]);  // Leemos el usuario
        $animal = $doctrine->getRepository(Animal::class)->find($array[1]);  // Leemos el animal

        $array[0] = $usuario;  // Modificamos el array
        $array[1] = $animal;

        $request = new RequestRepository($doctrine);
        $insert = $request->insertRequest($array, $entityManager);  // Insertamos la solicitud

        return new Response("ok");  // Devolvemos un ok si todo ha funcionado correctamente

    }


    /**
     * @Route("/animalsRandom", name="animalsRandom")
     */
    public function animalsRandom(EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {

        $animalRepo = new AnimalRepository($doctrine);

        $animals = $animalRepo->getAnimalsRandom();

        $jsonAnimal = [];

        for( $i = 0; $i < count($animals); $i++){
            array_push($jsonAnimal,[$animals[$i]->getId(),$animals[$i]->getName(),$animals[$i]->getPhotos()[0]->getPhoto()]);
        }


        return new Response(json_encode($jsonAnimal));

    }

    /**
     * @Route("/lostAnimalsForType/{type}", name="lostAnimalfortype")
     */
    public function lostAnimalForType(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, $type): Response
    {

        $animalRepo = new LostAnimalRepository($doctrine);

        $animals = $animalRepo->animalesPorEspecie(intval($type));

        $animalesPerdidos = [];

        for($i = 0; $i < count($animals); $i++){

            $animalesPerdidos[$i] = [$animals[$i]->getLat(),$animals[$i]->getLng(),$animals[$i]->getName(), $animals[$i]->getPhoto(), $animals[$i]->getColour(), $animals[$i]->getDescription(), $animals[$i]->getType()->getName(), $animals[$i]->getRace()->getName(), $animals[$i]->getUsuario()->getEmail(), $animals[$i]->getUsuario()->getPhone()];
        }
        
        
        return new Response(json_encode($animalesPerdidos));

    }



    /**
     * @Route("/insertReserva/{reserva}", name="insertReserva")
     */
    public function insertReserva(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, $reserva): Response
    {

        $array = json_decode($reserva);

        $usuario = $doctrine->getRepository(Usuario::class)->find($array[0]);  // Leemos el usuario
        $tramo = $doctrine->getRepository(Stretch::class)->find($array[1]);  // Leemos el tramo
        $tarea = $doctrine->getRepository(Job::class)->find($array[2]);  // Leemos la tarea

        $reservaFinal = [$usuario, $tramo, $tarea, $array[3]];

        $request = new ReserveRepository($doctrine);
        $insert = $request->insertReserva($reservaFinal, $entityManager);  // Insertamos la reserva

        return new Response("ok");  // Devolvemos un ok si todo ha funcionado correctamente

    }


    /**
     * @Route("/getReservedDay/{date}", name="getReservedDay")
     */
    public function getReservedDay(ManagerRegistry $doctrine, string $date): Response
    {

        $reserveRepo = new ReserveRepository($doctrine);

        $reserves = $reserveRepo->reservasPordía($date);  // Está función nos devuelve las reservas que hay realizadas dicho día
        
        $array = [];

        for($i = 0; $i < count($reserves); $i++){

            // Rellenamos array con el id del tramo y de la tarea
            array_push($array,[$reserves[$i]->getJob()->getId(),$reserves[$i]->getStretch()->getId()]); 
        }


        return new Response(json_encode($array));

    }
    

}
