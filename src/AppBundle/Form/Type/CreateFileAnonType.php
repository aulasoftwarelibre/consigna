<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */
namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;

class CreateFileAnonType extends CreateFileType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('captcha', 'ewz_recaptcha', array(
                'label' => 'label.captcha',
                'attr' => array(
                    'options' => array(
                        'theme' => 'light',
                        'type' => 'image',
                    ),
                ),
                'mapped' => false,
                'constraints' => array(
                    new IsTrue(),
                ),
            ))
        ;
    }

    public function getName()
    {
        return 'consigna_upload_file_anon';
    }
}
