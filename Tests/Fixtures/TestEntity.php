<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:21 PM
 */

namespace Malwarebytes\FormMetadataBundle\Tests\Fixtures;

use Malwarebytes\FormMetadataBundle\Configuration as Form;

class TestEntity {
    /**
     * @Form\Field("text",label="Parent Name")
     * @var
     */
    public $ParentName;


    /**
     * @Form\FormType("Malwarebytes\FormMetadataBundle\Tests\Fixtures\TestChildEntityFormType")
     * @var
     */
    public $Child;


    /**
     * @Form\EmbeddedForm("Malwarebytes\FormMetadataBundle\Tests\Fixtures\TestChildEntity")
     * @var
     */
    public $EmbeddedChild;



} 