<?php

namespace Corleonis\FormMetadataBundle\Configuration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Corleonis\FormMetadataBundle\Configuration\Field;

/**
 * Class FieldEntityType
 * @package Corleonis\FormMetadataBundle\Configuration
 */
class FieldEntityType extends AbstractType {

    /**
     * Unique name of the rendered field entity
     * @var string
     */
    private $fieldName;

    /**
     * List of child fields that need to be rendered as part of the entity
     * @var Field[]
     */
    private $childFields;

    /**
     * Data class to be used when rendering the posted data from the form
     * @var string
     */
    private $dataClass;

    /**
     * @param string $dataClass data class the will hold the data submitted through the form
     * @param string $fieldName unique name for the rendered field type
     * @param array $childFields list of nested field elements
     */
    public function __construct($dataClass, $fieldName, array $childFields) {
        $this->dataClass = $dataClass;
        $this->fieldName = $fieldName;
        $this->childFields = $childFields;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        foreach ($this->childFields as $field) {
            $builder->add($field->name, $field->value, $field->options);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->dataClass,
        ));
    }

    /**
     * Gets the unique name of the form
     * @return string
     */
    public function getName() {
        return $this->fieldName;
    }
}