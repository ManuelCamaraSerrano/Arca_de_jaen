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
            AssociationField::new("type")->setLabel("Tipo")->setColumns("col-4"),

            AssociationField::new("race")->setLabel("Raza")->setColumns("col-4"),

            AssociationField::new("usuario")->setLabel("Usuario")->setColumns("col-4"),

            FieldTextField::new('Name')->setLabel("Nombre")->setColumns("col-4"),

            FieldTextField::new('colour')->setLabel("Color")->setColumns("col-4"),    

            NumberField::new("lat")->setLabel("Latitud")->setColumns("col-4"),

            NumberField::new("lng")->setLabel("Longitud")->setColumns("col-4"),

            TextareaField::new("description")->setLabel("Descripción")->setColumns("col-7"),
            
            ImageField::new('photo')->setBasePath('estilos/assets/images/animals')->setUploadDir("public/estilos/assets/images/animals")->setLabel("Foto")->setColumns("col-5"),


        ];
    }
    
}
