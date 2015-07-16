<?php

namespace Test\inicialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UsuariosTypeCollection extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoUsuario', 'entity', array('required' => true,
                'class' => 'inicialBundle:TipoUsuario','empty_value' => 'Seleccione Tipo', 'multiple'=>false,
            'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->where('u.id!=1')->andWhere('u.id!=5');},))
            ->add('principal', 'checkbox', array('required'=>false))
            ->add('cedula')
            ->add('apellidos')
            ->add('nombres')
            ->add('fechaNacimiento','date', array('widget'=>'single_text',
                'format'=>'y-M-d', 'attr'=>array('class'=>'datepick')))
            ->add('direccion')
            ->add('sexo', 'entity', array('required' => true,'class' => 'inicialBundle:Sexo','empty_data' => 'hola', 'multiple'=>false, 'expanded'=>true))
            ->add('activo', 'checkbox', array('required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Test\inicialBundle\Entity\Usuarios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'test_inicialbundle_usuarios';
    }
}