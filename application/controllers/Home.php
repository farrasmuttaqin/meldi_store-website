<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

        public function __construct()
	{
		parent::__construct();
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
                
                $data["nav"]=1;
                $this->load->view('v_header');
                $this->load->view('v_home',$data);
                $this->load->view('v_footer');
	}
}