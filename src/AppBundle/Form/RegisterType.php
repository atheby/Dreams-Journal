<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', 'text',     array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'Username', 'autofocus' => true),'label' => 'label.username',))
            ->add('password', 'password', array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'Password'), 'label' => 'label.password',))
            ->add('repass',   'password', array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'Repeat password'), 'label' => 'label.repass',))
            ->add('email',    'text',     array('required' => false, 'attr' => array('class' => 'form-control input-field', 'placeholder' => 'E-mail'), 'label' => 'label.email'));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\User'));
    }

    public function getName() {
        return 'dre_register';
    }
}
