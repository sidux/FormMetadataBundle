<?php
/*
 * This file is part of the Form Metadata library
 *
 * (c) Cameron Manderson <camm@flintinteractive.com.au>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Corleonis\FormMetadataBundle;

use Corleonis\FormMetadataBundle\Configuration\Field;
use Corleonis\FormMetadataBundle\Configuration\FormType;
use Corleonis\FormMetadataBundle\Configuration\FieldEntity;
use Corleonis\FormMetadataBundle\Configuration\FieldGroup;

/**
 * The meta data containing the configuration of the form
 * @author camm (camm@flintinteractive.com.au), european(info@nils-werner.com)
 */
class FormMetadata
{
    /**
     * @var array
     */
    protected $fields = array();

    /**
     * @var array
     */
    protected $groups = array();


    /**
     * @var array
     */
    protected $formTypes = array();

    /**
     * @var array
     */
    protected $fieldEntities = array();

    /**
     * @param array $formTypes
     */
    public function addFormType($formTypes)
    {
        $this->formTypes[] = $formTypes;
    }

    /**
     * @return FormType[]
     */
    public function getFormTypes()
    {
        return $this->formTypes;
    }

    /**
     * @param array $fieldEntities
     */
    public function addFieldEntity($fieldEntities)
    {
        $this->fieldEntities[] = $fieldEntities;
    }

    /**
     * @return FieldEntity[]
     */
    public function getFieldEntities()
    {
        return $this->fieldEntities;
    }

    /**
     * Add a field configuration
     * @param Field $field
     * @return void
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }
	
	/**
     * 
     * @param FieldGroup $fieldGroup
	 * @param Field $field
     */
    public function addGroup(FieldGroup $fieldGroup, Field $field)
    {
        if(!empty($this->groups[$fieldGroup->value])) {
            $this->groups[$fieldGroup->value][] = $field;
        } else {
            $this->groups[$fieldGroup->value][] = $field;
        }
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param FormMetadata $refObject
     * @return void
     */
    public function merge(FormMetadata $refObject) {
        $this->fields = array_merge($this->fields, $refObject->getFields());
        $this->groups = array_merge($this->groups, $refObject->getGroups());
        $this->formTypes = array_merge($this->formTypes, $refObject->getFormTypes());
        $this->fieldEntities = array_merge($this->fieldEntities, $refObject->getFieldEntities());
    }

}
