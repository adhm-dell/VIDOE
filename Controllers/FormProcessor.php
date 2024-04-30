<?php
class FormProcessor
{

    private $validator;


    public function __construct()
    {
        $this->validator = new Validator;
    }

    public function handleFormSubmission($data, $requireFields): bool | array
    {
        $this->validator->validateRequiredFields($data, $requireFields);

        // Add validation calls for other fields

        if ($this->validator->isValid()) {
            // Process valid form data (e.g., save to database)
            return true;
        } else {
            return $this->validator->getErrors();
        }
    }
    public function getErrors(): array
    {
        return $this->validator->getErrors();
    }
    public function isValid(): bool
    {
        return $this->validator->isValid();
    }
}
