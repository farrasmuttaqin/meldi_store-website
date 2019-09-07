<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Product_model");
        $this->load->model('Cart_model');
		error_reporting(E_ERROR|E_PARSE);
	}
	
	public function index()
	{
        redirect(base_url());
    }

    public function mencari()
	{
        $productName = $_GET["productName"];

        $data["data_search"] = $this->Product_model->getSearchParameter($productName)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["productNameSearch"] = $productName;

        $this->load->view("v_header");
        $this->load->view("v_search",$data);
        $this->load->view("v_footer");
    }

    public function price()
	{
        $productName = $this->input->get('searching');
        $data["productNameSearch"] = $productName;

        $min = $this->input->GET("amount2");

        if ($min == 0 ){ $min = 1;}
        $max = $this->input->GET("amount3");
        
        if($min == ""||$max ==""){ redirect(base_url()."shop");}
        


        $whereFilter = "productName LIKE '%$productName%' OR productType LIKE '%$productName%' AND productPrice BETWEEN $min AND $max ";

        $data["searchFilter"] = $this->Product_model->getAllParameter("tb_product",$whereFilter)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_search",$data);
        $this->load->view("v_footer");
    }
}
