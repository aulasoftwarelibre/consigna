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

namespace Component\Folder\Form\Type;

use Component\Folder\Model\Interfaces\FolderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class FolderAccessType extends AbstractType
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
    }

    public function validate($plainPassword, ExecutionContextInterface $context)
    {
        /** @var FolderInterface $folder */
        $folder = $context->getRoot()->getData();
        $encoder = $this->encoderFactory->getEncoder($folder);

        if (false === $encoder->isPasswordValid($folder->getPassword(), $plainPassword, $folder->getSalt())) {
            $context->buildViolation('alert.invalid_password')
                ->atPath('password')
                ->addViolation();
        }
    }

    public function getBlockPrefix()
    {
        return 'consigna_folder_access';
    }
}