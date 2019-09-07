<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        error_reporting(E_ERROR|E_PARSE);
        $this->load->model('Cart_model');
	}
	
	public function index()
	{
        $where = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($where)->result();
        
        $data["nav"]=4;
        $this->load->view("v_header");
        $this->load->view("v_education",$data);
        $this->load->view("v_footer");
    }

    public function mencuci_sepatu()
    {
        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("education/1",$data);
        $this->load->view("v_footer");
    }
}
