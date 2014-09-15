<?php
/*
 * This file is part of the Form Metadata library
 *
 * (c) Cameron Manderson <camm@flintinteractive.com.au>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Corleonis\FormMetadataBundle\Driver;

use Corleonis\FormMetadataBundle\FormMetadata;

/**
 *
 * @author camm (camm@flintinteractive.com.au), european(info@nils-werner.com)
 */
class AnnotationsDriver implements MetadataDriverInterface
{
    /**
     * Read the entity and create an associated metadata
     * @param $entity
     * @return null|FormMetadata
     */
    public function getMetadata($entity)
    {
        $metadata = new FormMetadata();
        $metadataTop = new FormMetadata();
        $metadataChildren = new FormMetadata();

        /** @var @var ReflectionClass $reflectionClass */
        $reflectionClass = new \ReflectionClass(get_class($entity));

        // retrieve all form fields for the main entity class and it's parents

        while (is_object($reflectionClass)) {
            $metadataTop = $this->getClassFormFields($reflectionClass);

            $reflectionClass = $reflectionClass->getParentClass();
            $metadata->merge($metadataTop);
        }

        // retrieve all subsequent nested classes' form fields and their parents
        $fieldEntities = $metadata->getFieldEntities();
        if(!empty($fieldEntities)) {
            foreach($fieldEntities as $key => $fieldEntity) {
                $class = $fieldEntity->getClass();
                $reflectionClass = new \ReflectionClass($class);
                while (is_object($reflectionClass)) {
                    $fieldEntityFields = $this->getClassFormFields($reflectionClass);
                    $fieldEntity->setFields($fieldEntityFields->getFields());
                    //$reflectionClass = $reflectionClass->getParentClass();
                    $reflectionClass = null;
                }
                //$metadata->merge($metadataChildren);
            }
        }

        return $metadata;
    }

    /**
     * @param \ReflectionClass $class
     * @return FormMetadata
     */
    private function getClassFormFields(\ReflectionClass $class) {

        $metadata = new FormMetadata();
        $reader = new \Doctrine\Common\Annotations\AnnotationReader();

        /** @var \ReflectionProperty[] $properties */
        $properties = $class->getProperties();

        foreach($properties as $property) {
            $field = $reader->getPropertyAnnotation($property, 'Corleonis\FormMetadataBundle\Configuration\Field');
            $fieldGroup = $reader->getPropertyAnnotation($property, 'Corleonis\FormMetadataBundle\Configuration\FieldGroup');
            $formType = $reader->getPropertyAnnotation($property, 'Corleonis\FormMetadataBundle\Configuration\FormType');
            $fieldEntity = $reader->getPropertyAnnotation($property, 'Corleonis\FormMetadataBundle\Configuration\FieldEntity');
            if (!empty($fieldGroup) && !empty($field)) {
                if (empty($field->name)) {
                    $field->name = $property->getName();
                }
                $metadata->addGroup($fieldGroup, $field);
            } elseif(!empty($field)) {
                if(empty($field->name)) {
                    $field->name = $property->getName();
                }
                $metadata->addField($field);
            }
            if (!empty($formType)) {
                if(empty($field->name)) {
                    $formType->name = $property->getName();
                }
                $metadata->addFormType($formType);
            }
            if (!empty($fieldEntity)) {
                if(empty($field->name)) {
                    $fieldEntity->name = $property->getName();
                }
                $metadata->addFieldEntity($fieldEntity);
            }
        }

        return $metadata;
    }
}
