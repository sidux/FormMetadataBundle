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
 * Class EmbeddedForm
 *
 * Form Metadata Mapper implementation of embedded forms.
 * http://symfony.com/doc/current/book/forms.html#embedded-forms
 *
 * e.g. @Form\FormType("Acme\TaskBundle\Entity\Category")

 *
 * @package Malwarebytes\FormMetadataBundle\Configuration
 * @author Jonathan Chan (jchan@malwarebytes.org)
 * @Annotation
 */
class EmbeddedForm {
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