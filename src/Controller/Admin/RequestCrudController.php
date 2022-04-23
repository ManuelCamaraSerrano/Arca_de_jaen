<?php

namespace App\Controller\Admin;

use App\Entity\Request;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class RequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Request::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            AssociationField::new("usuario"),

            AssociationField::new("animal"),

            Datefield::new("date")->setLabel("Fecha"),
        
            TextareaField::new("description")->setLabel("Descripción"),

        ];
    }
    
}
