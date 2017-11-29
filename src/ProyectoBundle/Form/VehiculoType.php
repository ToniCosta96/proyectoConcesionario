<?php

namespace ProyectoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VehiculoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre')
        ->add('descripcionCorta')
        ->add('descripcion')
        ->add('imagen')
        ->add('precio')
        ->add('fechaAdquisicion')
        ->add('detalles')
        ->add('kilometros')
        ->add('enVenta')
        ->add('Guardar vehiculo', SubmitType::class);
        //->add('usuarioId');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProyectoBundle\Entity\Vehiculo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proyectobundle_vehiculo';
    }


}
