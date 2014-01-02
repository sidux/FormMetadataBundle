# Form Metadata reader for Symfony2

Facilitates the basic configuration of form fields from metadata that is defined elsewhere, such as through annotations
in the entity. Allows for more generic handling of form types through controllers,
making them able to deal with dynamic entity/forms (such as for use with CMS sites).

This project was forked from [FlintLabs/FormMetadataBundle](https://github.com/FlintLabs/FormMetadataBundle) which appears to be abandoned.

See the form fields [Annotations Reference](https://github.com/FlintLabs/FormMetadataBundle/wiki/Annotations-reference)

Note: People may want to consider the use of Symfony2 Abstract Forms to configure their forms external to the controller
as a best practice.

## Annotations Example

**Standard form builder**

    ->add('dueDate', 'date', array('widget' => 'single_text'))

**Using annotations in your entity**

    /**
     * @Form\Field("date", widget="single_text")
     */

**Group Example**

    /**
     * @Form\Field("date", widget="single_text")
     * @Form\FieldGroup("example")
     */

**Embedded Entity Example**

    /**
     * Refer to http://symfony.com/doc/current/book/forms.html#embedded-forms
     *
     * You have to generate your own FormType in current implementation
     *
     * @Form\FormType("Acme\TaskBundle\Form\Type\CategoryType")
     */



### Entity with some basic form annotations

    use Malwarebytes\FormMetadataBundle\Configuration as Form;
    use Symfony\Bundle\Validator\Constraints as Assert;

    class Contact
    {
        /**
         * @Form\Field("text")
         * @Assert\NotBlank()
         */
        public $name;

        /**
         * @Form\Field("textarea")
         */
        public $message;
    }

### Simple controller

    class MyController
    {
        public function contactAction()
        {
            $contact = new Contact();
            $form = $this->get('form_metadata.mapper')->createFormBuilder($contact)->getForm();

            if ($request->getMethod() == 'POST') {
                $form->bindRequest($request);

                if ($form->isValid()) {
                    // perform some action, such as saving the task to the database
                    return $this->redirect($this->generateUrl('task_success'));
                }
            }
        }
    }

## Installation

### Composer Installation

    php composer.phar require malwarebytes/form-metadata-bundle


### Register the bundle references

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Malwarebytes\FormMetadataBundle\FlintLabsFormMetadataBundle(),
            // ...
        );
    }
