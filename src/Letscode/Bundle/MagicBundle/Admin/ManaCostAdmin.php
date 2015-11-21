<?php
/**
 * Created by PhpStorm.
 * User: hschaeidt
 * Date: 20.11.15
 * Time: 20:01
 */

namespace Letscode\Bundle\MagicBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ManaCostAdmin extends Admin
{
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with("Mana Costs");
        $formMapper->add('sum', 'integer')
        ->add('color', 'entity', array(
            'class' => 'Letscode\Bundle\MagicBundle\Entity\Color',
            'property' => 'name'
        ))
        ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('color')
            ->addIdentifier('sum');
    }
}