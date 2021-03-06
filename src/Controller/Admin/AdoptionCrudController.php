<?php

namespace App\Controller\Admin;

use App\Entity\Adoption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class AdoptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adoption::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            AssociationField::new("usuario")->setColumns("col-5"),

            AssociationField::new("animal")->setColumns("col-5"),

            ImageField::new('contract')->setBasePath('estilos/assets/pdf')->setUploadDir("public/estilos/assets/pdf")->setLabel("Contrato")->setColumns("col-5"),

            ChoiceField::new('state')->setChoices([
                'Finalizada' => 'Finalizada',
                'En curso' => 'En curso',
            ])->setColumns("col-5"),

            Datefield::new("adoptionDate")->setLabel("Fecha adopción"),

        ];
    }
    
}
