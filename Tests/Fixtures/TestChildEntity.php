<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 1/2/14
 * Time: 2:22 PM
 */

namespace Malwarebytes\FormMetadataBundle\Tests\Fixtures;

use Malwarebytes\FormMetadataBundle\Configuration as Form;

class TestChildEntity {
    /**
     * @Form\Field("text")
     * @var
     */
    public $name;


    /**
     * @Form\Field("text")
     * @var
     */
    public $age;
} 