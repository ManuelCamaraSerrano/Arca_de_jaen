<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            AssociationField::new("type")->setLabel("Tipo"),

            AssociationField::new("race")->setLabel("Raza"),

            AssociationField::new("physicalSpace")->setLabel("Espacio Físico"),

            FieldTextField::new('Name')->setLabel("Nombre"),

            Datefield::new("birth_date")->setLabel("Fecha nacimiento"),

            Datefield::new("entry_date")->setLabel("Fecha entrada"),

            NumberField::new('weigth')->setLabel("Peso"),

            NumberField::new('height')->setLabel("Altura"),

            FieldTextField::new('colour')->setLabel("Color"),

            FieldTextField::new('chip'),

            TextareaField::new("description")->setLabel("Descripción"),


            ChoiceField::new('sex')->setChoices([
                'Macho' => 'Macho',
                'Hembra' => 'Hembra',
            ])->setLabel("Sexo"),            


            
            
        ];
    }
    
}
