<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CommentType extends AbstractType
{
    public function __construct(
        private UrlGeneratorInterface $router,
        private Video $video,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('save', SubmitType::class, [
                'label' => 'Commenter',
                'attr' => ['class' => 'btn-primary', 'href' => $this->router->generate('video_add_comment', ['id' => $video->getId()])],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
