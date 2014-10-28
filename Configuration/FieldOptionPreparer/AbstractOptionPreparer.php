<?php
namespace Corleonis\FormMetadataBundle\Configuration\FieldOptionPreparer;

use Corleonis\FormMetadataBundle\Configuration\Field;
use InvalidArgumentException;

/**
 * Class AbstractOptionPreparer
 * @package Corleonis\FormMetadataBundle\Configuration\FieldOptionPreparer
 */
interface AbstractOptionPreparer {

    /**
     * @param Field $field the field which options need to be modified
     * @return Field the modified field
     * @throws InvalidArgumentException if the field type doesn't match the option preparer type
     */
    public function prepare(Field $field);
}
