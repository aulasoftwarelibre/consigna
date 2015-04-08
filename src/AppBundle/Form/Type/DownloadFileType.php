<?php
/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;


class DownloadFileType extends AbstractType
{
    private $encoderFactory;


    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('password', 'password', array(
                'mapped' => false,
                'constraints' => new Assert\Callback(array(
                    'callback' => array($this, 'validate'),
                ))))
            ->add('submit', 'submit')
            ->getForm();
    }


    public function getName(){
        return 'file';
    }

    public function validate ($plainPassword, ExecutionContextInterface $context)
    {
        /** @var File $file */
        $file = $context->getRoot()->getData();

        if ( false === $this->encoderFactory->getEncoder($file)->isPasswordValid( $file->getPassword(), $plainPassword, $file->getSalt())) {
            $context->buildViolation('Password is not valid.')
                ->atPath('password')
                ->addViolation();
        }
    }

    public function __construct(EncoderFactoryInterface $encoderFactory){
        $this->encoderFactory=$encoderFactory;
    }

}