<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DreamType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title',       'text',     array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'Title', 'autofocus' => true),'label' => 'label.title'))
            ->add('date',        'text',     array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'YYYY-MM-DD', 'maxlength' => '10'), 'label' => 'label.date'))
            ->add('description', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control input-field', 'rows' => 10), 'label' => 'label.description'));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Dream'));
    }

    public function getName() {
        return 'dre_dream';
    }
}
