<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FieldTextField::new('Dni'),
            EmailField::new('email'),
            FieldTextField::new('Name')->setLabel("Nombre"),
            FieldTextField::new('Ap1')->setLabel("1º Apellido"),
            FieldTextField::new('Ap2')->setLabel("2º Apellido"),
            FieldTextField::new('Phone')->setLabel("Telefono"),
            ImageField::new('Photo')->setBasePath('public/img')->setUploadDir("public/img")->setLabel("Foto"),
            
        ];
    }


}
