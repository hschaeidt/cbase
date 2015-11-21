<?php

namespace Letscode\Bundle\MagicBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EffectAdmin extends Admin
{
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')
        ->add('manaCosts', 'sonata_type_model', array(
            'class' => 'Letscode\Bundle\MagicBundle\Entity\ManaCost',
            'expanded' => false,
            'by_reference' => false,
            'multiple' => true,
            'required' => false
        ))
        ->add('attributes', 'sonata_type_model', array(
            'class' => 'Letscode\Bundle\MagicBundle\Entity\Attribute',
            'expanded' => false,
            'by_reference' => false,
            'multiple' => true
        ))
        ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('attributes');
    }
}