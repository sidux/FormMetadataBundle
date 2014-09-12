<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:22 PM
 */

namespace Corleonis\FormMetadataBundle\Tests\Fixtures;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestChildEntityFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('age');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Corleonis\FormMetadataBundle\Tests\Fixtures\TestChildEntity',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'TestChildEntity';
    }
}