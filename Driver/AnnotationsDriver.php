<?php
/*
 * This file is part of the Form Metadata library
 *
 * (c) Cameron Manderson <camm@flintinteractive.com.au>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Malwarebytes\FormMetadataBundle\Driver;
use Malwarebytes\FormMetadataBundle\FormMetadata;
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

        $reader = new \Doctrine\Common\Annotations\AnnotationReader();

        $reflectionClass = new \ReflectionClass(get_class($entity));

        while (is_object($reflectionClass)) {
            $properties = $reflectionClass->getProperties();
            foreach($properties as $property) {
                $field = $reader->getPropertyAnnotation($property, 'Malwarebytes\FormMetadataBundle\Configuration\Field');
				$fieldGroup = $reader->getPropertyAnnotation($property, 'Malwarebytes\FormMetadataBundle\Configuration\FieldGroup');
                $formType = $reader->getPropertyAnnotation($property, 'Malwarebytes\FormMetadataBundle\Configuration\FormType');
                $embeddedForm = $reader->getPropertyAnnotation($property, 'Malwarebytes\FormMetadataBundle\Configuration\EmbeddedForm');
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

                if (!empty($embeddedForm)) {
                    if(empty($field->name)) {
                        $embeddedForm->name =  $property->getName();
                    }
                    $metadata->addEmbeddedForm($embeddedForm);
                }
            }
            $reflectionClass = $reflectionClass->getParentClass();
        }

        return $metadata;
    }
}
