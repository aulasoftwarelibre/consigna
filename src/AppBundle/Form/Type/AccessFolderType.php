<?php

/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Folder;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AccessFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', 'password', array(
                'mapped' => false,
                'constraints' => new Assert\Callback(array(
                    'callback' => array($this, 'validate'),
                )),
                'label'=> 'password.access.folder'))
            ->add('submit', 'submit',array(
                'label' => 'submit.access.folder'))
            ->getForm();
    }

    public function getName()
    {
        return 'folder';
    }

    public function validate($plainPassword, ExecutionContextInterface $context)
    {
        /** @var Folder $folder */
        $folder = $context->getRoot()->getData();

        if (false === $this->encoderFactory->getEncoder($folder)->isPasswordValid($folder->getPassword(), $plainPassword, $folder->getSalt())) {
            $context->buildViolation('Password is not valid.')
                ->atPath('password')
                ->addViolation();
        }
    }

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }
}
