<?php

namespace Iag\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FielterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $buider
                ->add('sala')
                ->add('bloco')
                ;
    }


    public function getName() {
        return 'fielter';
    }
}

