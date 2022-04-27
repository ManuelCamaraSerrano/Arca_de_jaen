<?php

namespace App\Controller\Admin;

use App\Entity\Reserve;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ReserveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserve::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            AssociationField::new("usuario")->setLabel("Usuario"),

            AssociationField::new("job")->setLabel("Tarea"),

            AssociationField::new("stretch")->setLabel("Tramo"),

            Datefield::new("date")->setLabel("Fecha"),


        ];
    }
    
}
