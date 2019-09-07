<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Contact_model");
        $this->load->model('Cart_model');
		error_reporting(E_ERROR|E_PARSE);
	}
	
	public function index()
	{
        $where = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($where)->result();
        
        $data["nav"]=5;
        $this->load->view("v_header");
        $this->load->view("v_contact",$data);
        $this->load->view("v_footer");
    }
    
    public function insert()
    {
        $first = $this->input->post("c_firstname");
        $last = $this->input->post("c_lastname");
        $subject = $this->input->post("c_subject");
        $message = $this->input->post("c_message");

        $whereContact = array(
            'firstName' => $first,
            'lastName' => $last,
            'subject' => $subject,
            'message' => $message
        );
        
        $this->session->set_flashdata('contact', "1");
        $this->Contact_model->insert($whereContact);
        redirect(base_url()."contact");
    }
}
