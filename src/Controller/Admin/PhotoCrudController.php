<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            ImageField::new('photo')->setBasePath('estilos/assets/images/animals')->setUploadDir("public/estilos/assets/images/animals")->setLabel("Foto"),
            AssociationField::new("animal"),

        ];
    }

}
