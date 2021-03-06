<?php

namespace RosaMolas\facturacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class TipoFacturaType extends AbstractType
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
            ->add('nombre' ,'text',  array('attr'=>array('class'=>'campo_unico')))
            ->add('conceptosFactura', 'collection', array('type'=>new ConceptosFacturaColectionType('Crear Concepto de Factura'), 'allow_add' => true, 'allow_delete' => true,
                'by_reference' => false,'prototype' => true, 'label' => false, 'cascade_validation'=>true, 'error_bubbling'=>false))
            ->add('guardar', 'submit', array('label'=>'Guardar', 'attr'=>array('class'=>'btn-default data-first-button data-last-button')))
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
            'data_class' => 'RosaMolas\facturacionBundle\Entity\TipoFactura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'test_inicialbundle_tipofactura';
    }
}
