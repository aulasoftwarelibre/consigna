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

namespace Component\File\Form\Type;

use Bundle\TagBundle\Form\Type\TagsTextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('tags', TagsTextType::class, [
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => '\Component\File\Model\File',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'consigna_upload_file';
    }
}
