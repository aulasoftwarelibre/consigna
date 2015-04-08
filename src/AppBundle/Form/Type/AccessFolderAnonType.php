<?php
/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Folder;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AccessFolderAnonType extends AbstractType
{
    private $encoderFactory;

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('password', 'password', array(
                'mapped' => false,
                'constraints' => new Assert\Callback(array(
                    'callback' => array($this, 'validate'),
                ))))
            ->add('captcha', 'ewz_recaptcha', array(
                'attr' => array(
                    'options' => array(
                        'theme' => 'light',
                        'type'  => 'image'
                    )
                ),
                'mapped'      => false,
                'constraints' => array(
                    new True()
                )
            ))
            ->add('submit', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'folder';
    }

    public function validate ($plainPassword, ExecutionContextInterface $context)
    {
        /** @var Folder $folder */
        $folder = $context->getRoot()->getData();

        if ( false === $this->encoderFactory->getEncoder($folder)->isPasswordValid( $folder->getPassword(), $plainPassword, $folder->getSalt())) {
            $context->buildViolation('Password is not valid.')
                ->atPath('password')
                ->addViolation();
        }
    }

    public function __construct(EncoderFactoryInterface $encoderFactory){
        $this->encoderFactory=$encoderFactory;
    }
}