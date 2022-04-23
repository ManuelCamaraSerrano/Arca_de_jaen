<?php

namespace App\Controller\Admin;

use App\Entity\Stretch;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;

class StretchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stretch::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            FieldTextField::new("stretch")->setLabel("Tramo"),

        ];
    }
    
}
