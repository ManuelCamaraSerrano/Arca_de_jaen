<?php

namespace App\Controller\Admin;

use App\Entity\LostAnimal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LostAnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LostAnimal::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
