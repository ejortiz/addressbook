<?php


require_once(dirname(__FILE__).DS.'..'.DS.'formhelpers'.DS.'basic_sanitizer.php');
/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/22/16
 * Time: 2:15 PM
 */
class Addresses_Controller extends TinyMVC_Controller
{
    private $data_sanitizer;



    public function index()
    {
        //parent::index(); // TODO: Change the autogenerated stub

        // create a sub view
        $sub_view = new TinyMVC_View();
        // assign the $view_model variable for that sub view containing data pulled from the database
        $sub_view->assign('view_model', $this->load->database()->query_all('select * from addresses'));
        // generate the sub view into a var that we will pass on when we render the main view
        $main_content = $sub_view->fetch('indexaddress_view');
        $this->view->assign('main_content',$main_content);
        $this->view->display('site_template');
    }

    // displays address form to edit or add a new address
    public function addressForm($id=null)
    {
        $view_model = null;

        // get address details if the address is not null
        if($id!=null)
        {
            $view_model = $this->load->database()->query_one('select * from addresses where id=?',array($id));
        }

        $sub_view =  new TinyMVC_View();
        if($view_model!=null)
            $sub_view->assign('view_model', $view_model);

        $main_content = $sub_view->fetch('addressform_view');

        $this->view->assign('main_content', $main_content);
        $this->view->display('site_template');
    }





    public function newAddress()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {

            // save the new address
            $address = $this->getAddressFromPost();
            $this->save($address);

            // display a success message and return the view
            $success_message = 'Address \''.$address->addressLine1.'\' saved.';
            $sub_view = new TinyMVC_View();
            $sub_view->assign('message', $success_message);

            $main_content = $sub_view->fetch('addressform_view');

            $this->view->assign('main_content', $main_content);
            $this->view->display('site_template');
        }
        else
        {
            $sub_view =  new TinyMVC_View();
            $main_content = $sub_view->fetch('addressform_view');

            $this->view->assign('main_content', $main_content);
            $this->view->display('site_template');
        }
    }

    public function editAddress($id)
    {
        if ($_SERVER['REQUEST_METHOD']== 'POST' )
        {

            // save the new address
            $address = $this->getAddressFromPost();
            $this->save($address);

            // display a success message and return the view
            $success_message = 'Address \''.$address->addressLine1.'\' saved.';


            $sub_view = new TinyMVC_View();
            $sub_view->assign('success_message', $success_message);
            $sub_view->assign('address',$address);

            $main_content = $sub_view->fetch('addressform_view');

            $this->view->assign('main_content', $main_content);
            $this->view->display('site_template');
        }
        else
        {
            // get the address from the DB using the ID, then convert to an address model
            $address_query = $this->load->database()->query_one('select * from addresses where id=?',array($id));
            $address = $this->queryArrayToAddressModel($address_query);

            $sub_view = new TinyMVC_View();
            $sub_view->assign('address',$address);

            $main_content = $sub_view->fetch('addressform_view');

            $this->view->assign('main_content', $main_content);
            $this->view->display('site_template');
        }
    }

    /**
     * @param $id: the id of the address that you want to delete
     */
    public function deleteAddress($id){
        $this->load->database()->where('id = ?',$id); // setup query conditions ()
        $this->load->database()->delete('addresses');
        header( 'Location: /addresses/' ) ;
    }

    // TODO: prevent access of method outside of form use

    /**
     * @param $address: Address that you would like to save
     */
    public function save($address)
    {
        // check if the request was POST method;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // map data to an address_model
            if (!empty($_POST)) {


                //TODO: add model validation within the model itself

                // check if we will insert a new record of update an old record

                // if the return string of the id is empty, the entry is a new entry
                if (empty($address->id)) {
                    $this->load->database()->insert('addresses',
                        array('AddressLine1' => $address->addressLine1,
                            'AddressLine2' => $address->addressLine2,
                            'City' => $address->city,
                            'Region' => $address->region,
                            'Zipcode' => $address->zipcode,
                            'Country' => $address->country
                        )
                    );

                    //after inserting database go back to new
                }

                // if the id is not empty, try to update the table with the id
                if (!empty($address->id)) {

                    $this->load->database()->where('Id', $address->id); // where Id = $address->id
                    $this->load->database()->update('addresses',
                        array('AddressLine1' => $address->addressLine1,
                            'AddressLine2' => $address->addressLine2,
                            'City' => $address->city,
                            'Region' => $address->region,
                            'Zipcode' => $address->zipcode,
                            'Country' => $address->country
                        )
                    );

                }

            }
        }
    }




    // TODO: move these funcitons to a mapper: maps vars from query's and arrays into a model object
    private function getAddressFromPost()
    {
        $address = new Address_Model();
        if(!empty($_POST))
        {
            // TODO: handle case of vars not showing up
            $data_sanitizer = new Basic_Sanitizer();
            $address->id = $data_sanitizer->sanitizeInput($_POST["Id"]);
            $address->addressLine1 = $data_sanitizer->sanitizeInput($_POST["AddressLine1"]);
            $address->addressLine2 = $data_sanitizer->sanitizeInput($_POST["AddressLine2"]);
            $address->city = $data_sanitizer->sanitizeInput($_POST["City"]);
            $address->region = $data_sanitizer->sanitizeInput($_POST["Region"]);
            $address->zipcode = $data_sanitizer->sanitizeInput($_POST["Zipcode"]);
            $address->country = $data_sanitizer->sanitizeInput($_POST["Country"]);
        }
        return $address;
    }

    /**
     * @param $query_array-- Contains the array returned from the query
     */
    private function queryArrayToAddressModel($query_array)
    {
        $address = new Address_Model();

        $address->id = $query_array["Id"];
        $address->addressLine1 = $query_array["AddressLine1"];
        $address->addressLine2 = $query_array["AddressLine2"];
        $address->city = $query_array["City"];
        $address->region = $query_array["Region"];
        $address->zipcode = $query_array["Zipcode"];
        $address->country = $query_array["Country"];

        return $address;
    }



}