<?php

/**
 * default.php
 *
 * default application controller
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class Default_Controller extends TinyMVC_Controller
{
  function index()
  {

    // set up subview of $index controller
    $sub_view = new TinyMVC_View();
    $main_content = $sub_view->fetch('index_view');

    // assign the main_content to the controller's view
    $this->view->assign('main_content', $main_content);
    $this->view->display('site_template');
  }
}

?>
