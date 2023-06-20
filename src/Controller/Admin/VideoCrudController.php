<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class VideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('title');
        yield DateTimeField::new('postDate');
        yield TextField::new('videoUrl');
        yield TextField::new('posterUrl');
        yield AssociationField::new('tag');
    }

    public function configureActions(Actions $actions): Actions
    {
        $uploadVideo = Action::new('videoUpload', 'Upload Video', 'fa-solid fa-upload')
            ->displayAsButton()
            ->setCssClass('btn btn-primary')
            ->linkToRoute('/upload')
            ;

        return $actions
            // ->remove(Crud::PAGE_INDEX, Action::NEW)
            // ->add(Crud::PAGE_INDEX, $uploadVideo)
            ;
    }
}
