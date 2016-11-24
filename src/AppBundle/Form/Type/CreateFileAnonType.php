<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */
namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;

class CreateFileAnonType extends CreateFileType
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
