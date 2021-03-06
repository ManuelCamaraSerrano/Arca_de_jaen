<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\Appointment;
use App\Entity\Gallery;
use App\Entity\Job;
use App\Entity\LostAnimal;
use App\Entity\Photo;
use App\Entity\PhysicalSpace;
use App\Entity\Race;
use App\Entity\Request;
use App\Entity\Reserve;
use App\Entity\Stretch;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/adminn", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UsuarioCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Dashboard', 'fa fa-home', 'index'),

            MenuItem::section('Entidades'),
            MenuItem::linkToCrud('Usuario', 'fa fa-user', Usuario::class),

            MenuItem::subMenu('Animal', 'fa fa-crow')->setSubItems([
               
                MenuItem::linkToCrud('Animal', 'fa fa-dog', Animal::class),
                MenuItem::linkToCrud('Tipo Animal', 'fas fa-t', Type::class),
                MenuItem::linkToCrud('Raza', 'fa fa-r-project', Race::class),
                MenuItem::linkToCrud('Espacios F??sicos', 'fas fa-warehouse', PhysicalSpace::class),
                MenuItem::linkToCrud('Fotos', 'fa fa-images', Photo::class),
                MenuItem::linkToCrud('Animales Perdidos', 'fa fa-cat', LostAnimal::class),


            ]),

            MenuItem::subMenu('Adopcion', 'fas fa-hand-holding-heart')->setSubItems([
               
                MenuItem::linkToCrud('Adopci??n', 'fa fa-hand-holding-heart', Adoption::class),
                MenuItem::linkToCrud('Cita', 'fa fa-user-clock', Appointment::class),
                MenuItem::linkToCrud('Solicitud', 'fa fa-envelope', Request::class),


            ]),


            MenuItem::subMenu('Reserva', 'fa fa-calendar')->setSubItems([
               
                MenuItem::linkToCrud('Reserva', 'fa fa-calendar-day', Reserve::class),
                MenuItem::linkToCrud('Tramo', 'fa fa-clock', Stretch::class),
                MenuItem::linkToCrud('Tarea', 'fa fa-book', Job::class),

            ]),

            MenuItem::linkToCrud('Galer??a', 'fa fa-images', Gallery::class),
           
        ];
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Arca de Ja??n')
            // you can include HTML contents too (e.g. to link to an image)
            
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


    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('estilos/assets/css/easyAdmin.css');
    }

    

    
    
}
