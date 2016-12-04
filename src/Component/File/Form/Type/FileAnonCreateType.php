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

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;

class FileAnonCreateType extends FileCreateType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
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
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return 'consigna_upload_file_anon';
    }
}
