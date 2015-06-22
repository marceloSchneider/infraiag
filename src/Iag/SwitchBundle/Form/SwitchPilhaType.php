<?php

namespace Iag\SwitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SwitchPilhaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hostname')
            ->add('numPortas', null, array(
                'label'=> 'Número de portas'
            ))
            ->add('marca')
            ->add('patrimonio')
            ->add('pilhaFisica', null, array(
                'label' => 'Posição na pilha fisica'
            ))
            ->add('posicaoPilhaLogica', null, array(
                'label' => 'Posição na pilha lógica',
            ))
            ->add('pilhaLogica', 'hidden', array(
                'label'=> 'Pilha lógica',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\SwitchBundle\Entity\SwitchPilha'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_switchbundle_switchpilha';
    }
}
