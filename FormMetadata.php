<?php
/*
 * This file is part of the Form Metadata library
 *
 * (c) Cameron Manderson <camm@flintinteractive.com.au>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Malwarebytes\FormMetadataBundle;
use Malwarebytes\FormMetadataBundle\Configuration\EmbeddedForm;
use Malwarebytes\FormMetadataBundle\Configuration\Field;
use Malwarebytes\FormMetadataBundle\Configuration\FieldGroup;
use Malwarebytes\FormMetadataBundle\Configuration\FormType;

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
    protected $embeddedForms = array();

    /**
     * @param array $formTypes
     */
    public function addFormType(FormType $formType)
    {
        $this->formTypes[] = $formType;
    }

    /**
     * @return FormType[]
     */
    public function getFormTypes()
    {
        return $this->formTypes;
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
     * @param $embeddedForm
     */
    public function addEmbeddedForm(EmbeddedForm $embeddedForm)
    {
        $this->embeddedForms[] = $embeddedForm;
    }

    /**
     * @return EmbeddedForm[]
     */
    public function getEmbeddedForms()
    {
        return $this->embeddedForms;
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
     * 
     * @return FieldGroup[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

}
