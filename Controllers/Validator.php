<?php

class Validator
{

    protected $errors = array();

    function validateRequiredFields($data, $requiredFields)
    {
        // print_r($data);
        // Loop through required fields
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $this->errors[$field] = "The $field field is required.";
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        return empty($this->errors);
    }
}
