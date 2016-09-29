<?php
require_once(dirname(__FILE__).DS.'..'.DS.'models'.DS.'address_model.php');
/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/27/16
 * Time: 1:47 PM
 */
class Address_Validator extends Model_Validator
{
    var $load;

    /**
     * address_validator constructor.
     * @param $load
     */
    public function __construct()
    {
        $this->load = new TinyMVC_Load();
        $this->errors = array();
    }


    public function is_valid($model)
    {

    }

    /**
     * @param $model: find if an address is unique in the database
     */
    public function is_unique($model)
    {

        // if not an address model, throw an exception
        if(!is_a($model, 'Address_Model'))
        {
            $exception = new Exception();
            throw new Exception('Object passed in Address_Validator is not of type Address_Model');
        }


        // find if any entry exists within the
       $result = $this->load->database()->query_one(
            '
              select * from addresses
              where
                Id!=?
                and AddressLine1=?
                and AddressLine2=?
                and City=?
                and Region=?
                and Zipcode=?
                and Country=?

            ',
            array(
                $model->id,
                $model->addressLine1,
                $model->addressLine2,
                $model->city,
                $model->region,
                $model->zipcode,
                $model->country,

            )
        );

        // if the result is more than one, return that uniqueness is false
        if($result)
        {
            array_push($this->errors, 'Address \''.$model->addressLine1.'\' already exists.');
            return false;
        }
        else
        {
            return true;
        }
    }
}