<?php

namespace Veta\HomeworkBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Veta\HomeworkBundle\Entity\Privilege;
use Veta\HomeworkBundle\Entity\UserAdmin;
use Veta\HomeworkBundle\Repository\PrivilegeRepository;

class UserAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     * @var Privilege $privilege
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, ['label' => 'Login'])
            ->add('pass', PasswordType::class, ['label' => 'Password'])
            ->add('nickName', TextType::class, ['label' => 'Nick Name'])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Active' => true,
                    'No Active' => false,
                ]
            ])
            ->add('privilege', EntityType::class, [
                'class' => Privilege::class,
                'choice_label' => 'title',
                'multiple' => false,
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
            'data_class' => UserAdmin::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'veta_homeworkbundle_useradmin';
    }
}
