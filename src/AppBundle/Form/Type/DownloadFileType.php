<?php

/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58.
 */
namespace AppBundle\Form\Type;

use AppBundle\Entity\File;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class DownloadFileType extends AbstractType
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
            ->add(
                'password',
                'password',
                [
                    'mapped' => false,
                    'constraints' => new Assert\Callback(
                        [
                            'callback' => [$this, 'validate'],
                        ]
                    ),
                    'label' => 'label.password',
                ]
            );
    }

    public function getName()
    {
        return 'consigna_download_file';
    }

    public function validate($plainPassword, ExecutionContextInterface $context)
    {
        /** @var File $file */
        $file = $context->getRoot()->getData();

        if (false === $this->encoderFactory->getEncoder($file)->isPasswordValid(
                $file->getPassword(),
                $plainPassword,
                $file->getSalt()
            )
        ) {
            $context->buildViolation($this->translator->trans('alert.invalid_password'))
                ->atPath('password')
                ->addViolation();
        }
    }
}
