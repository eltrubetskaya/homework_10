<?php

namespace Veta\HomeworkBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Veta\HomeworkBundle\Entity\Post;
use Veta\HomeworkBundle\Entity\Tag;
use Veta\HomeworkBundle\Entity\Theme;
use Veta\HomeworkBundle\Entity\UserAdmin;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('discription', TextareaType::class, ['label' => 'Discription'])
            ->add('text', TextareaType::class, ['label' => 'Text'])
            ->add('dateCreate', DateTimeType::class, ['label' => 'Date'])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Active' => true,
                    'No Active' => false,
                ]
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('userAdmin', EntityType::class, [
                'class' => UserAdmin::class,
                'choice_label' => 'nickName',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'veta_homeworkbundle_post';
    }
}
