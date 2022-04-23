<?php

namespace App\Controller\Admin;

use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\Appointment;
use App\Entity\Job;
use App\Entity\LostAnimal;
use App\Entity\Photo;
use App\Entity\PhysicalSpace;
use App\Entity\Race;
use App\Entity\Request;
use App\Entity\Reserve;
use App\Entity\Stretch;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;


class DashboardController extends AbstractDashboardController
{
   /**
     * @Route("/adminn")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UsuarioCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Entidades'),
            MenuItem::linkToCrud('Usuario', 'fa fa-user', Usuario::class),

            MenuItem::subMenu('Animal', 'fa fa-crow')->setSubItems([
               
                MenuItem::linkToCrud('Animal', 'fa fa-dog', Animal::class),
                MenuItem::linkToCrud('Tipo Animal', 'public/img/about.jpg', Type::class),
                MenuItem::linkToCrud('Raza', 'fa fa-hand-heart', Race::class),
                MenuItem::linkToCrud('Espacios Físicos', 'fas fa-house', PhysicalSpace::class),
                MenuItem::linkToCrud('Fotos', 'fa fa-images', Photo::class),
                MenuItem::linkToCrud('Animales Perdidos', 'fa fa-cat', LostAnimal::class),


            ]),

            MenuItem::subMenu('Adopcion', 'fas fa-hand-holding-heart')->setSubItems([
               
                MenuItem::linkToCrud('Adopción', 'fa fa-hand-heart', Adoption::class),
                MenuItem::linkToCrud('Cita', 'fa fa-envelope', Appointment::class),
                MenuItem::linkToCrud('Solicitud', 'fa fa-message', Request::class),


            ]),


            MenuItem::subMenu('Reserva', 'fa fa-calendar')->setSubItems([
               
                MenuItem::linkToCrud('Reserva', 'fa fa-calendar-day', Reserve::class),
                MenuItem::linkToCrud('Tramo', 'fa fa-clock', Stretch::class),
                MenuItem::linkToCrud('Tarea', 'fa fa-book', Job::class),

            ]),
           
        ];
    }
}
