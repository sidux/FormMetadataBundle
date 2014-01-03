<?php
/**
 * User: Jonathan Chan <jchan@malwarebytes.org>
 * Date: 1/3/14
 * Time: 2:25 PM
 */


namespace Malwarebytes\FormMetadataBundle\Form\Type;


use Malwarebytes\FormMetadataBundle\FormMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenericFormMapperFormType extends AbstractType {

    private $name;

    /** @var  FormMapper */
    protected $formMapper;

    /** @var  Mapped Entity */
    protected $entity;

    function __construct($name,$entity, $formMapper)
    {
        $this->entity = $entity;
        $this->formMapper = $formMapper;
        $this->name = $name;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->formMapper->mapMetadataToFormBuilder(new $this->entity(),$builder);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->entity,
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


} 