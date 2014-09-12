<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:30 PM
 */

namespace Corleonis\FormMetadataBundle\Tests\Configuration;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Corleonis\FormMetadataBundle\Configuration\Field;
use Corleonis\FormMetadataBundle\Driver\AnnotationsDriver;
use Corleonis\FormMetadataBundle\Tests\Fixtures\TestEntity;

class FormTypeTest extends \PHPUnit_Framework_TestCase {
    function setUp()
    {

    }

    function testFormType()
    {
        $data = new TestEntity();

        $driver = new AnnotationsDriver();
        $metadata = $driver->getMetadata($data);

        $formType = $metadata->getFormTypes();

        $this->assertEquals("Child",$formType[0]->name);
        $this->assertEquals('Corleonis\FormMetadataBundle\Tests\Fixtures\TestChildEntityFormType',$formType[0]->value);
    }
} 