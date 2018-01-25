<?php

namespace ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
      ->add('username', TextType::class, array('label' => 'Nombre de usuario: '))
      ->add('email', EmailType::class, array('label' => 'Correo electrónico: '))
      ->add('plainPassword', RepeatedType::class, array(
              'type' => PasswordType::class,
              'first_options'  => array('label' => 'Contraseña: '),
              'second_options' => array('label' => 'Repite la contraseña: '),
          ))
      ->add('guardar', SubmitType::class, array('label' => 'Registrarse'))
      ->add('borrar', ResetType::class, array('label' => 'Resetear valores'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClienteBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clientebundle_user';
    }


}
