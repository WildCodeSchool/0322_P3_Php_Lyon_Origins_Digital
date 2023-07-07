<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Video;
use App\Repository\TagRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DateTimeImmutable;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre:',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description:',
                'required' => true
            ])
            ->add('postDate', DateTimeType::class, [
                 'widget' => 'single_text',
                'label' => 'Date de publication:',
                'input' => 'datetime_immutable',
                'view_timezone' => 'Europe/Paris',
                'data' => new DateTimeImmutable(),
                'required' => true
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'query_builder' => function (TagRepository $tagRepository) {
                    return $tagRepository->createQueryBuilder('u')->orderBy('u.name', 'ASC');
                },
                'label' => 'Tags (choix multiples):',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
