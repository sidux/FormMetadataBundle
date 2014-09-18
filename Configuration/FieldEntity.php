<?php

namespace Corleonis\FormMetadataBundle\Configuration;

use \Doctrine\Common\Annotations\Annotation;
use Corleonis\FormMetadataBundle\Configuration\Field;

/**
 * Contains the configuration elements for the field
 *
 * e.g. @Form\FieldEntity(class="\Acme\Foo\Bar", list="false")
 *
 * @author Alex (alex.rashkov@moo.com)
 * @Annotation
 */
class FieldEntity extends Annotation {
    /**
     * Default for when a type is not specified
     * @var string
     */
    public $value;

    /**
     * The parameter name
     * @var string
     */
    private $name;

    /**
     * Form entity class, used for nested fields
     * @var mixed
     */
    private $class;

    /**
     * If the entity is list of entities.
     * @var bool
     */
    private $list = false;

    /**
     * The options to pass through
     * @var array
     */
    private $options = array();

    /**
     * List of all annotated fields in the child entity
     * @var Field[]
     */
    private $fields = array();

    /**
     * Magic method for passing options through the annotation that are undefined
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        switch($name) {
            case 'list':
                $this->setList($value);
                return;
            case 'class':
                $this->setClass($value);
                return;
            case 'name':
                $this->setName($value);
                return;
            default:
                // if the property is unknown add it to options
                $this->options[$name] = $value;
        }
    }

    /**
     * Denotes if the entity is a list of entities itself.
     * @param boolean $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }

    /**
     * Denotes if the entity is a list of entities itself.
     * @return boolean
     */
    public function isList()
    {
        return $this->list;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Field[] $fields
     */
    public function setFields(array $fields) {
        $this->fields = $fields;
    }

    /**
     * @return Field[] $fields
     */
    public function getFields() {
        return $this->fields;
    }
}