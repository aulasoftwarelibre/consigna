<?php

/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58.
 */
namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;

class DownloadFileAnonType extends DownloadFileType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add(
                'captcha',
                'ewz_recaptcha',
                [
                    'label' => 'label.captcha',
                    'attr' => [
                        'options' => [
                            'theme' => 'light',
                            'type' => 'image',
                        ],
                    ],
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue(),
                    ],
                ]
            );
    }

    public function getName()
    {
        return 'consigna_download_file_anon';
    }
}
