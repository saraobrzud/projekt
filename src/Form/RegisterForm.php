<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 03.08.18
 * Time: 12:55
 */

namespace Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;


class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder->add(
            'login',
            'text',
            array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('min' => 5, 'max' => 16))
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Login'
                )
            )
        )
            ->add(
                'password',
                'repeated',
                array(
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'options' => array(),
                    'required' => true,
                    'constraints' => array(
                        new Assert\NotBlank(),
                        new Assert\Length(array('min' => 8))
                    ),
                    'first_options'  => array(
                        'label' => 'Password',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'Password'
                        )
                    ),
                    'second_options' => array(
                        'label' => 'Repeat',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'Repeat Password'
                        )
                    ),
                )
            );
    }

    /**
     * Gets form name.
     *
     * @access public
     *
     * @return string
     */
    public function getName()
    {
        return 'register';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }
}