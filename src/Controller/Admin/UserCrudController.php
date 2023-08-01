<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class UserCrudController extends AbstractCrudController
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('email', 'E-mail');
        yield TextField::new('username', 'nom d\'utilisateur');
        yield BooleanField::new('isVerified', 'est vérifié');
        yield BooleanField::new('isAdmin', 'est admin');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Gérer les utilisateurs')
        ->setDefaultSort(['id' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        $deleteAction = Action::new('deleteUser', 'Supprimer')
            ->linkToUrl(function (User $user) {
                $url = $this->urlGenerator->generate('delete_user', ['idUser' => $user->getId()]);
                return $url;
            })
            ->addCssClass('text-danger');

        return $actions->add(Crud::PAGE_INDEX, $deleteAction)
        ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ->remove(Crud::PAGE_INDEX, Action::NEW)
        ->remove(Crud::PAGE_DETAIL, Action::DELETE);
    }
}
