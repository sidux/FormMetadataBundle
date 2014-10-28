<?php

namespace Corleonis\FormMetadataBundle\Configuration;

use Corleonis\FormMetadataBundle\Configuration\FieldOptionPreparer\AbstractOptionPreparer;
use InvalidArgumentException;

class FieldOptionPreparerFactory {

    const BASE_CLASS_PATH = "\\Corleonis\\FormMetadataBundle\\Configuration\\FieldOptionPreparer\\";

    private function __construct() {}

    /**
     * Return the matching FieldOptionPreparer based on field type or null if there is none matching
     * @param string $type
     * @throws InvalidArgumentException
     * @return AbstractOptionPreparer|null
     */
    public static function get($type) {
        if (!is_string($type)) {
            throw new InvalidArgumentException("Option preparer type must be a string representation of the field type.");
        }

        $class = static::BASE_CLASS_PATH . ucfirst($type);
        if (class_exists($class) && $class instanceof AbstractOptionPreparer) {
            return $class;
        }

        return null;
    }
}