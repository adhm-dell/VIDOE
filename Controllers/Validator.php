<?php

class Validator
{

    protected $errors = array();

    function validateRequiredFields($data, $requiredFields): void
    {
        // Loop through required fields
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $this->errors[$field] = "The $field field is required.";
            }
        }
    }
    // function validateWrongFields($data, $fields): void
    // {
    //     // handling selection from database and assign it to values
    //     $values = [];
    //     $this->errors = [];
    //     foreach ($fields as $field => $fieldName) { // Use key => value for field name
    //         $value = $values[$field]; // Access corresponding value from $values

    //         if ($data[$fieldName] != $value) {
    //             $this->errors[$fieldName] = "The $fieldName is wrong.";
    //         }
    //     }
    // }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}
