<?php

if(! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    //Insert data in table contact_form
    public function save_contact_form_data($data) {
        if($this->db->insert('contact_form',$data)) {
            return true;
        }
        else {
            return false;
        }
    }
}