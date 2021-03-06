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

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FileAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'name',
    ];

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('mimeType', null, [
                'label' => 'label.mime_type',
            ])
            ->add('scanStatus', null, [
                'label' => 'label.scan_status',
            ])
            ->add('size', null, [
                'label' => 'label.size',
            ])
            ->add('createdFromIp', null, [
                'label' => 'label.created_from_ip',
            ])
            ->add('createdAt', null, [
                'label' => 'label.created_at',
            ])
            ->add('owner', null, [
                'label' => 'label.owner',
            ])
            ->add('folder', null, [
                'label' => 'label.folder',
            ])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, [
                'label' => 'label.name',
            ])
            ->add('mimeType', null, [
                'label' => 'label.mime_type',
            ])
            ->add('scanStatus', null, [
                'label' => 'label.scan_status',
                'template' => 'SonataAdminBundle:CRUD:list_scan_status.html.twig',
            ])
            ->add('size', null, [
                'label' => 'label.size',
            ])
            ->add('createdFromIp', null, [
                'label' => 'label.created_from_ip',
            ])
            ->add('createdAt', null, [
                'label' => 'label.created_at',
            ])
            ->add('owner', null, [
                'label' => 'label.owner',
            ])
            ->add('folder', null, [
                'label' => 'label.folder',
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('plainPassword', 'repeated', [
                    'type' => 'password',
                    'options' => ['translation_domain' => 'FOSUserBundle'],
                    'first_options' => ['label' => 'form.new_password'],
                    'second_options' => ['label' => 'form.new_password_confirmation'],
                    'invalid_message' => 'fos_user.password.mismatch',
                    'required' => false,
                ]
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('mimeType', null, [
                'label' => 'label.mime_type',
            ])
            ->add('scanStatus', null, [
                'label' => 'label.scan_status',
            ])
            ->add('size', null, [
                'label' => 'label.size',
            ])
            ->add('createdFromIp', null, [
                'label' => 'label.created_from_ip',
            ])
            ->add('createdAt', null, [
                'label' => 'label.created_at',
            ])
            ->add('owner', null, [
                'label' => 'label.owner',
            ])
            ->add('folder', null, [
                'label' => 'label.folder',
            ])
        ;
    }

    /**
     * Returns the name of the parent related field, so the field can be use to set the default
     * value (ie the parent object) or to filter the object.
     *
     * @return string the name of the parent related field
     */
    public function getParentAssociationMapping()
    {
        return 'folder';
    }
}
