<?php

/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58.
 */
namespace AppBundle\Form\Type;

use AppBundle\Entity\Folder;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AccessFolderType extends AbstractType
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     * @param TranslatorInterface     $translator
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, TranslatorInterface $translator)
    {
        $this->encoderFactory = $encoderFactory;
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, [
                    'mapped' => false,
                    'constraints' => new Assert\Callback([
                        'callback' => [$this, 'validate'],
                    ]),
                    'label' => 'label.password',
                ])
            ;
    }

    public function validate($plainPassword, ExecutionContextInterface $context)
    {
        /** @var Folder $folder */
        $folder = $context->getRoot()->getData();
        $encoder = $this->encoderFactory->getEncoder($folder);

        if (false === $encoder->isPasswordValid($folder->getPassword(), $plainPassword, $folder->getSalt())) {
            $context->buildViolation($this->translator->trans('alert.invalid_password'))
                ->atPath('password')
                ->addViolation();
        }
    }

    public function getBlockPrefix()
    {
        return 'consigna_folder';
    }
}
