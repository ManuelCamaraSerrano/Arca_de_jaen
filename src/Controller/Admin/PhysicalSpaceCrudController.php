<?php

namespace App\Controller\Admin;

use App\Entity\PhysicalSpace;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;

class PhysicalSpaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhysicalSpace::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FieldTextField::new('description')->setLabel("Descripcion"),
        ];
    }
    
}
