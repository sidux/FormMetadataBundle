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

use Malwarebytes\FormMetadataBundle\Form\Type\GenericFormMapperFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory,
    Malwarebytes\FormMetadataBundle\Driver\MetadataDriverInterface;
/**
 * Obtains any metadata from the entity and adds it's configuration
 * to the form
 * @author camm (camm@flintinteractive.com.au), european(info@nils-werner.com)
 */
class FormMapper
{
    public static $MAX_FORM_EMBEDDED_DEPTH=50;

    /**
     * Variable to count the depth of embedded forms to prevent infinite recursive functions
     *
     * @var int
     */
    static private $embedDepth=0;

    /**
     * Drivers that will be used to obtaining metadata
     * @var MetadataDriverInterface[]
     */
    private $drivers = array();

    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $factory;

    /**
     * @param \Symfony\Component\Form\FormFactory $factory
     */
    public function __construct(FormFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Obtains any form metadata from the entity and adds itself to the form
     * @param $data entity that should be mapped
     * @return
     */
    public function createFormBuilder($data = null, array $options = array())
    {
        // Build the $form
        $formBuilder = $this->factory->createBuilder('form', $data, $options);

        return $this->mapMetadataToFormBuilder($data,$formBuilder,$options);
    }

    /**
     * Maps an Entity's metadata to a FormBuilder
     *
     * @param $metadataEntity
     * @param FormBuilderInterface $formBuilder
     * @return FormBuilderInterface
     */
    public function mapMetadataToFormBuilder($metadataEntity, FormBuilderInterface $formBuilder)
    {
        // Read the entity meta data and add to the form
        if(empty($this->drivers)) return $formBuilder;

        // Look to the readers to find metadata
        foreach ($this->drivers as $driver) {
            $metadata = $driver->getMetadata($metadataEntity);
            if(!empty($metadata)) break;
        }

        if(empty($metadata)) return $formBuilder;

        // Configure the form

        // fields
        $fields = $metadata->getFields();
        foreach($fields as $field) {
            // TODO: Detect "new x()" in field value or type option for AbstractType creation
            // TODO: Detect references to "%service.id%" for service constructor dependency
            $formBuilder->add($field->name, $field->value, $field->options);
        }

        // groups
        $groups = $metadata->getGroups();
        foreach($groups as $groupName => $fields) {
            $builder = $formBuilder->create($groupName, 'form', array('virtual' => true));


            foreach($fields as $field) {
                $builder->add($field->name, $field->value, $field->options);
            }

            $formBuilder->add($builder);
        }

        // types
        $formTypes = $metadata->getFormTypes();
        foreach($formTypes as $formType) {
            $formTypeInstance = new $formType->value;
            $formBuilder->add($formType->name,$formTypeInstance);
        }

        // embedded forms
        $embeddedForms = $metadata->getEmbeddedForms();
        if (!empty($embeddedForms)) {
            self::$embedDepth++;
            if (self::$embedDepth >= self::$MAX_FORM_EMBEDDED_DEPTH) {
                throw new \Exception("\$MAX_FORM_EMBEDDED_DEPTH '".self::$MAX_FORM_EMBEDDED_DEPTH."' reached for embedded forms - do you have two forms linked to each other?");
            }
        }
        foreach($embeddedForms as $embeddedForm) {
            $genericFormMapperFormType = new GenericFormMapperFormType($embeddedForm->name,$embeddedForm->value,$this);
            $formBuilder->add($embeddedForm->name,$genericFormMapperFormType);
        }

        return $formBuilder;
    }

    /**
     * Add an entity metadata reader to the readers
     * @param EntityMetadataReaderInterface $reader
     * @return void
     */
    public function addDriver(MetadataDriverInterface $driver)
    {
        $this->drivers[] = $driver;
    }
}
