<?php

namespace Iag\SwitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SwitchsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('switchCommon', null, array('label' => 'Pilha'))
            ->add('pilha', null, array('label' => 'Identificação da Pilha'))
            ->add('identificacao', null, array('label' => 'Identificação'))
            ->add('numPortas', 'choice', array(
                                               'choices' => array('12'=>'12', '24'=>'24', '48'=>'48'),
                                               'required'=> 'true',
                                               'label' => 'Número de portas',
                                              )
                 )
            ->add('isGiga', null, array('label' => 'É Giga'))
            ->add('marca')
            ->add('patrimonio')
            ->add('posicaoPilha', null, array('label' => 'Posição na pilha'))
           ;
    }
    
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\SwitchBundle\Entity\Switchs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_switchbundle_switchs';
    }   
}
