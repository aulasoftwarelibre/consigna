<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Interfaces\UserInterface;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class FileCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'label.file',
                'attr' => [
                    'class' => 'filestyle',
                    'data-buttonBefore' => 'true',
                    'data-buttonText' => 'label.choose_file',
                ],
            ])
            ->add('tag', TextType::class, [
                'label' => 'label.tags',
                'required' => false,
                'attr' => [
                    'field_help' => 'help.tags',
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'help.password_mismatch',
                'first_options' => ['label' => 'label.password'],
                'second_options' => ['label' => 'label.repeat_password'],
            ]);

        if (is_null($options['user'])) {
            $builder
                ->add('captcha', EWZRecaptchaType::class, [
                    'label' => 'label.captcha',
                    'attr' => [
                        'options' => [
                            'size' => 'normal',
                            'theme' => 'light',
                            'type' => 'image',
                        ],
                    ],
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue(),
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => '\AppBundle\Entity\File',
                'user' => null,
                'validation_groups' => ['Default', 'File'],
            ])
            ->addAllowedTypes('user', [UserInterface::class, 'null']);
    }

    public function getBlockPrefix()
    {
        return 'consigna_upload_file';
    }
}
