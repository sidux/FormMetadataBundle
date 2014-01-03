<?php
/**
 * User: Jonathan Chan <jchan@malwarebytes.org>
 * Date: 1/3/14
 * Time: 4:06 PM
 */


namespace Malwarebytes\FormMetadataBundle\Tests\Fixtures;

use Malwarebytes\FormMetadataBundle\Configuration as Form;

class ErroneousRecursiveEntity {
    /**
     * @var
     * @Form\Field("text")
     */
    public $name;


    /**
     * @var
     * @Form\EmbeddedForm("Malwarebytes\FormMetadataBundle\Tests\Fixtures\ErroneousRecursiveEntity2")
     */
    public $recursed;

} 