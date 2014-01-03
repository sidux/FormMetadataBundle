<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/1/14
 * Time: 2:11 AM
 */

namespace Malwarebytes\FormMetadataBundle\Configuration;

use \Doctrine\Common\Annotations\Annotation;


/**
 * Class FormType
 *
 * Contains the configuration elements to embed a model entity within a parent model via an embedded FormType.
 * Requires the embedded model to have implemented an \Symfony\Component\Form\AbstractType or
 * \Symfony\Component\Form\FormTypeInterface. Please refer to
 * http://symfony.com/doc/current/book/forms.html#embedded-forms for more information.
 *
 * e.g. @Form\FormType("Acme\TaskBundle\Form\Type\Category")
 *
 * @package Malwarebytes\FormMetadataBundle\Configuration
 * @author Jonathan Chan (jchan@malwarebytes.org)
 * @Annotation
 */
class FormType {
    /**
     * Default for when a type is not specified
     * @var string
     */
    public $value;


    /**
     * The parameter name
     * @var string
     */
    public $name;
}