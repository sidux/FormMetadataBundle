<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 3:26 PM
 */

namespace Corleonis\FormMetadataBundle\Tests;


use Corleonis\FormMetadataBundle\Driver\AnnotationsDriver;
use Corleonis\FormMetadataBundle\FormMapper;
use Corleonis\FormMetadataBundle\Tests\Fixtures\TestEntity;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Test\TypeTestCase;

class FormMapperTest extends TypeTestCase {
    public function testAddFormType()
    {
        $testEntity = new TestEntity();
        $annotationDriver = new AnnotationsDriver();
        $formMapper = new FormMapper($this->factory);
        $formMapper->addDriver($annotationDriver);
        $form=$formMapper->createFormBuilder($testEntity)->getForm();
        $view=$form->createView();


        $this->assertEquals(2,$view->count());
        $this->assertArrayHasKey('ParentName',$view->children);
        $this->assertArrayHasKey('name',$view->children['Child']->children);
        $this->assertArrayHasKey('age',$view->children['Child']->children);
    }
} 