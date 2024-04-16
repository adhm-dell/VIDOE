<?php
class FormProcessor
{

    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function handleFormSubmission($data, $requireFields)
    {
        $this->validator->validateRequiredFields($data, $requireFields);

        // Add validation calls for other fields

        if ($this->validator->isValid()) {
            // Process valid form data (e.g., save to database)
            echo "Form submitted successfully!";
        } else {
            // Display error messages
            $errors = $this->validator->getErrors();
            echo "Please fix the following errors:";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
        }
    }
}
