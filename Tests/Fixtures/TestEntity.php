<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:21 PM
 */

namespace Corleonis\FormMetadataBundle\Tests\Fixtures;

use Corleonis\FormMetadataBundle\Configuration as Form;

class TestEntity {
    /**
     * @Form\Field("text",label="Parent Name")
     * @var
     */
    public $ParentName;


    /**
     * @Form\FormType("Corleonis\FormMetadataBundle\Tests\Fixtures\TestChildEntityFormType")
     * @var
     */
    public $Child;
} 