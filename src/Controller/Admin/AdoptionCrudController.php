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

            AssociationField::new("usuario"),

            AssociationField::new("animal"),

            Datefield::new("adoptionDate")->setLabel("Fecha adopción"),

            ImageField::new('contract')->setBasePath('public/img')->setUploadDir("public/img")->setLabel("Contrato"),

            ChoiceField::new('state')->setChoices([
                'Finalizada' => 'Finalizada',
                'En curso' => 'En curso',
            ]),

        ];
    }
    
}
