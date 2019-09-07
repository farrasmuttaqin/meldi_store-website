<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrival extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Product_model");
		$this->load->model('Cart_model');
		error_reporting(E_ERROR|E_PARSE);
	}
	
	public function index()
	{
		$where = array(
            "productStatus" => "new"
        );
        
		$data["arrival"] = $this->Product_model->getAllParameter("tb_product",$where)->result();

		$where = array(
			'id_user' => $this->session->userdata('id_user'),
			'nomor_invoice' => 101
		);
		$data["cart"]=$this->Cart_model->getCart($where)->result();
		
		$data["nav"]=3;
		
        $this->load->view("v_header");
        $this->load->view("v_arrival",$data);
        $this->load->view("v_footer");
    }
}
