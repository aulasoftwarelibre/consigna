<?php

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FolderAdmin extends AbstractAdmin
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
            ->add('permanent', null, [
                'label' => 'label.is_permanent',
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
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('permanent', null, [
                'label' => 'label.is_permanent',
                'editable' => true,
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
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'list' => array(),
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
            ->add('permanent', null, [
                'label' => 'label.is_permanent',
            ])
            ->add('owner', null, [
                'label' => 'label.owner',
            ])
            ->add('sharedWith', null, [
                'label' => 'label.shared_with',
            ])
            ->setHelps([
                'permanent' => 'help.folder.is_permanent',
            ])
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
            ->add('permanent', null, [
                'label' => 'label.is_permanent',
                'editable' => true,
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
            ->add('sharedWith', null, [
                'label' => 'label.shared_with',
            ])
            ->add('files', null, [
                'label' => 'label.files',
            ])
        ;
    }

    /**
     * Configures the tab menu in your admin.
     *
     * @param MenuItemInterface $menu
     * @param string            $action
     * @param AdminInterface    $childAdmin
     *
     * @return mixed
     */
    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit', 'show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        $menu->addChild('label.files', array('attributes' => array('dropdown' => true)));
        $menu['label.files']->addChild('label.list_files', array('uri' => $admin->generateUrl('consigna.admin.folder|consigna.admin.file.list', array('id' => $id))))->setAttribute('icon', 'fa fa-list');
        $menu['label.files']->addChild('label.create_file', array('uri' => $admin->generateUrl('consigna.admin.folder|consigna.admin.file.create', array('id' => $id))))->setAttribute('icon', 'fa fa-plus-circle');
    }
}
