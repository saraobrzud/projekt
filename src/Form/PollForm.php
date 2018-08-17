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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PollForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'label.name',
                'required' => true,
                'attr' => [
                    'max_length' => 100,

                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ]
        );
    }

        /**
         * {@inheritdoc}
         */
        public function getBlockPrefix()
    {
        return 'poll_type';
    }
}