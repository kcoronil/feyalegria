<?php

namespace RosaMolas\usuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class PerfilUsuarioType extends AbstractType
{
    public function __construct ($titulo, $tipo_panel = null)
    {
        $this->titulo = $titulo;
        if($tipo_panel){
            $this->tipo_panel = $tipo_panel;
        }
        else{
            $this->tipo_panel = null;
        }
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario')
            ->add('nombreUsuario')
            ->add('email')
            ->add('lugarNacimiento')
            ->add('preguntaSecreta')
            ->add('respuesta')
            ->add('rol')
            ->add('guardar', 'submit', array('attr'=>array('class'=>'data-first-button btn-default')))
            ->add('guardar_crear', 'submit', array('attr'=>array('label'=>'Guardar y Crear Otro', 'class'=>'data-last-button btn-default')))
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['titulo'] = $this->titulo;
        if($this->tipo_panel){
            $view->vars['tipo_panel'] = $this->tipo_panel;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RosaMolas\usuariosBundle\Entity\PerfilUsuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'test_inicialbundle_perfilusuario';
    }
}
