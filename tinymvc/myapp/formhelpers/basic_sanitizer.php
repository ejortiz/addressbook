<?php

/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/25/16
 * Time: 10:57 AM
 */
class Basic_Sanitizer implements Data_Sanitizer
{
    public function sanitizeInput($input)
    {
        // TODO: Implement sanitizeInput() method.
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }
}