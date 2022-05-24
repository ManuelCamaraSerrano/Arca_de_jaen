<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FieldTextField::new('Dni')->setColumns("col-4"),
            EmailField::new('email')->setColumns("col-4 offset-1"),
            FieldTextField::new('Name')->setLabel("Nombre")->setColumns("col-4"),
            FieldTextField::new('Ap1')->setLabel("1º Apellido")->setColumns("col-4 offset-1"),
            FieldTextField::new('Ap2')->setLabel("2º Apellido")->setColumns("col-4"),
            FieldTextField::new('Phone')->setLabel("Telefono")->setColumns("col-4 offset-1"),
            ImageField::new('photo')->setBasePath('estilos/assets/images/users')->setUploadDir("public/estilos/assets/images/users")->setLabel("Foto")->setColumns("col-4"),
            
        ];
    }
    

}
