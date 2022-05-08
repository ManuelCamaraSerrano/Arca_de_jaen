<?php

namespace App\Controller\Admin;

use App\Entity\LostAnimal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
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

            NumberField::new("lat")->setLabel("Latitud"),

            NumberField::new("lng")->setLabel("Longitud"),
            
            ImageField::new('photo')->setBasePath('public/estilos/assets/images/animals')->setUploadDir("public/estilos/assets/images/animals")->setLabel("Foto"),


        ];
    }
    
}
