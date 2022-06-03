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

            AssociationField::new("type")->setLabel("Tipo")->setColumns("col-4"),

            AssociationField::new("race")->setLabel("Raza")->setColumns("col-4"),

            AssociationField::new("physicalSpace")->setLabel("Espacio Físico")->setColumns("col-4"),

            FieldTextField::new('Name')->setLabel("Nombre")->setColumns("col-4"),

            NumberField::new('weigth')->setLabel("Peso")->setColumns("col-4"),

            NumberField::new('height')->setLabel("Altura")->setColumns("col-4"),

            FieldTextField::new('colour')->setLabel("Color")->setColumns("col-4"),

            FieldTextField::new('chip')->setColumns("col-4"),

            ChoiceField::new('sex')->setChoices([
                'Macho' => 'Macho',
                'Hembra' => 'Hembra',
            ])->setLabel("Sexo")->setColumns("col-4"),       
            
            Datefield::new("birth_date")->setLabel("Fecha nacimiento")->setColumns("col-4"),

            Datefield::new("entry_date")->setLabel("Fecha entrada")->setColumns("col-4"),

            ChoiceField::new('adopted')->setChoices([
                'Si' => 'Si',
                'No' => 'No',
            ])->setLabel("Adoptado")->setColumns("col-4"),

            TextareaField::new("description")->setLabel("Descripción")->setColumns("col-12 col-md-5"),



            
            
        ];
    }
    
}
