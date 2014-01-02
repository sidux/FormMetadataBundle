<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:30 PM
 */

namespace Malwarebytes\FormMetadataBundle\Tests\Configuration;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Malwarebytes\FormMetadataBundle\Configuration\Field;
use Malwarebytes\FormMetadataBundle\Driver\AnnotationsDriver;
use Malwarebytes\FormMetadataBundle\Tests\Fixtures\TestEntity;

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
        $this->assertEquals('Malwarebytes\FormMetadataBundle\Tests\Fixtures\TestChildEntityFormType',$formType[0]->value);
    }
} 