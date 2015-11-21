<?php

namespace Letscode\Bundle\MagicBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CardAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with("General")
        ->add('name', 'text')
        ->add('convertedManaCost', 'integer')
        ->add(
            'manaCosts', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\ManaCost',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true
        ))
        ->add(
            'colors', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Color',
                'property' => 'name',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true
            )
        )->add(
            'editions', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Edition',
                'property' => 'name',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true
            )
        )->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
        ->addIdentifier('colors')
        ->addIdentifier('editions');
    }
}