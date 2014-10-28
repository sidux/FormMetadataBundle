<?php
namespace Corleonis\FormMetadataBundle\Configuration\FieldOptionPreparer;
 
use Corleonis\FormMetadataBundle\Configuration\Field;

class ChoiceFieldOptionPreparer implements AbstractOptionPreparer {

    public function prepare(Field $field)
    {
        if ($field->value != 'choice') {
            throw new \InvalidArgumentException("Invalid field of type: " . $field->value . " when expecting 'choice'");
        }

        if(!empty($field->options['choice_list']) && class_exists($field->options['choice_list'])) {
            $choiceClass = $field->options['choice_list'];
            $field->options['choice_list'] = new $choiceClass;
        }

        return $field;
    }
}
