<?php

/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/25/16
 * Time: 10:29 AM
 */
interface Data_Sanitizer
{
    /**
     * Sanitize input data
     * @param $input
     * @return mixed
     */
    public function sanitizeInput($input);
}