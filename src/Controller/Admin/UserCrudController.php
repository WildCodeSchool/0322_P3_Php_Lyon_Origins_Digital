<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('email');
        yield TextField::new('username');
        yield BooleanField::new('isVerified');
        yield BooleanField::new('isAdmin');
        yield NumberField::new('id');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        $deleteAction = Action::new('deleteUser', 'Delete')->linkToRoute('delete_user', ['idUser' => '366']);
        // Remplacez "delete_user" par le nom de votre route pour supprimer un utilisateur
        return $actions->add(Crud::PAGE_INDEX, $deleteAction);
    }
}
