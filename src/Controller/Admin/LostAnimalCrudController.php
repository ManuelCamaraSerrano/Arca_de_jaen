<?php

namespace App\Controller\Admin;

use App\Entity\LostAnimal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;

class LostAnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LostAnimal::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new("type")->setLabel("Tipo"),

            AssociationField::new("race")->setLabel("Raza"),

            AssociationField::new("usuario")->setLabel("Usuario"),

            FieldTextField::new('Name')->setLabel("Nombre"),

            FieldTextField::new('colour')->setLabel("Color"),

            TextareaField::new("description")->setLabel("Descripción"),      

        ];
    }
    
}
