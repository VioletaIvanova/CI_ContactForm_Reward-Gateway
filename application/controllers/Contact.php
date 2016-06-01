<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->model('Contact_model');
        $this->load->library('form_validation');
        $this->load->library('Recaptcha');
        $this->load->library('email');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');

    }

    // Display contact form view
    public function index() {
        $this->load->view('common/header');
        $this->load->view('contact_form/display_contact_form');
        $this->load->view('common/footer');
    }

    /* contactForm()- first fetch data submitted by the form in the view 'display_contact_form'
    * then filter the data , validate it , check for reCaptcha success response and finally insert into
    * table contact_form
    */

    //Send an email
//    public function sendEmail($name,$email,$phone,$message,$dateTime) {
//        $this->email->from('a.k.shtarbev93@gmail.com','Angel');
//        $this->email->to('a.k.shtarbev93@gmail.com');
//        $this->email->cc('a.k.shtarbev93@gmail.com');
//        $this->email->subject('New contact message');
//        $this->email->message('New message from '.$dateTime.'
//                              sent by '.$name.'<br/>'.'
//                              - email '.$email.'<br/>'.'
//                              - phone '.$phone.'<br/>'.'
//                              - message '.$message.'<br/>'.' ');
//        if ($this->email->send()) {
//            return true;
//        }
//        else {
//            return false;
//        }
//    }

    public function contactForm() {

        $this->form_validation->set_rules('name','name','trim|htmlentities|stripslashes|required',
               array('required' => 'Please enter a name'));

        $this->form_validation->set_rules('email','email','trim|htmlentities|stripslashes|required|valid_email',
              array('required' => 'Please enter an email address'));
        $this->form_validation->set_message('valid_email','Please enter a valid email address');

        $this->form_validation->set_rules('phone','phone','trim|htmlentities|stripslashes|required|integer',
              array('required' => 'Please enter a phone number'));
        $this->form_validation->set_message('integer','Please enter a valid phone number');


       $this->form_validation->set_rules('message','message','trim|htmlentities|stripslashes|required',
             array('required' => 'Please enter your message'));


       $captcha_answer = $this->input->post('g-recaptcha-response');

       $response = $this->recaptcha->verifyResponse($captcha_answer);

        //Return FALSE if all validation rules failed
        if($this->form_validation->run() == FALSE || (!$response['success'])) {
            $data = array();
            if(!$response['success']) {
                $data['error'] = 'Verify recaptcha';
            }
            $this->load->view('common/header');
            $this->load->view('contact_form/display_contact_form',$data);
            $this->load->view('common/footer');
        }
        else {

            $form_data = array(
                'name' => stripslashes(htmlentities(trim($this->input->post('name')))),
                'email' => stripslashes(htmlentities(trim($this->input->post('email')))),
                'phone_number'=> stripslashes(htmlentities(trim($this->input->post('phone')))),
                'message' => stripslashes(htmlentities(trim($this->input->post('message'))))
            );

            $this->Contact_model->save_contact_form_data($form_data);
            //$this->sendEmail($form_data['name'],$form_data['email'],$form_data['phone_number'],$form_data['message'],date("Y-m-d H:i:s"));
            $this->load->view('common/header');
            $this->load->view('contact_form/success_contact_form');
            $this->load->view('common/footer');
        }
    }
}