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

namespace AppBundle\Form\Type;

use AppBundle\Entity\File;
use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class FileDownloadType extends AbstractType
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
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

        if (is_null($options['user'])) {
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
                        new Assert\IsTrue(),
                    ],
                ])
            ;
        }
    }

    public function validate($plainPassword, ExecutionContextInterface $context)
    {
        /** @var File $file */
        $file = $context->getRoot()->getData();
        $encoder = $this->encoderFactory->getEncoder($file);

        if (!$encoder->isPasswordValid($file->getPassword(), $plainPassword, $file->getSalt())) {
            $context->buildViolation('alert.invalid_password')
                ->atPath('password')
                ->addViolation();
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => FileInterface::class,
                'user' => null,
                'validation_groups' => ['Default', 'File'],
            ])
            ->addAllowedTypes('user', [UserInterface::class, 'null']);
    }


    public function getBlockPrefix()
    {
        return 'consigna_download_file';
    }
}
