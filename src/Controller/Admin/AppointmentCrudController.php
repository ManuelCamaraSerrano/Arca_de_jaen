<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Entity\Usuario;
use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class AppointmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appointment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            AssociationField::new("request")->setLabel("Solicitud"),

            DateTimeField::new("date")->setLabel("Fecha"),

        ];
    }
    
}
