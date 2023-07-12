<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class VideoCrudController extends AbstractCrudController
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
        return Video::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'titre');
        yield DateTimeField::new('postDate', 'date de publication');
        yield TextField::new('videoUrl', 'fichier vidéo');
        yield TextField::new('posterUrl', 'fichier image');
        yield BooleanField::new('isPremium', 'vidéo premium');
        yield BooleanField::new('isHeader', 'vidéo en Entête');
        yield AssociationField::new('tag');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Gérer les vidéos')
        ->setDefaultSort(['postDate' => 'DESC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        $deleteAction = Action::new('deleteVideo', 'Supprimer')
            ->linkToUrl(function (Video $video) {
                $url = $this->urlGenerator->generate('delete_video', ['idVideo' => $video->getId()]);
                return $url;
            })
            ->addCssClass('text-danger');

        return $actions->add(Crud::PAGE_INDEX, $deleteAction)
        ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ->remove(Crud::PAGE_DETAIL, Action::DELETE);
    }
}
