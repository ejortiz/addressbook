<?php

/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/27/16
 * Time: 1:39 PM
 */
abstract class Model_Validator
{
    var $errors;

    abstract public function is_valid($model);

    abstract public  function is_unique($model);
}

