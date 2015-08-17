<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class CreateFileType extends AbstractType
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * CreateFileType constructor.
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', [
                'label' => 'label.file',
                'attr' => [
                    'class' => 'filestyle',
                    'data-buttonBefore' => 'true',
                    'data-buttonText' => $this->translator->trans('label.choose_file'),
                ],
            ])
            ->add('tags', 'tags_text', [
                'label' => 'label.tags',
            ])
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'invalid_message' => $this->translator->trans('help.password_mismatch'),
                'first_options' => ['label' => 'label.password'],
                'second_options' => ['label' => 'label.repeat_password'],
            ]);
    }

    public function getName()
    {
        return 'consigna_upload_file';
    }
}
