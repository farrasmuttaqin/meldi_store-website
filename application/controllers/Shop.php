<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Product_model");
        $this->load->model('Cart_model');
		error_reporting(E_ERROR|E_PARSE);
	}
	
	public function index()
	{
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();

        $data["all"] = $this->Product_model->getAll("tb_product")->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;
        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }

    public function price()
	{
        $min = $this->input->GET("amount2");

        if ($min == 0 ){ $min = 1;}
        $max = $this->input->GET("amount3");
        
        if($min == ""||$max ==""){ redirect(base_url()."shop");}
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();

        $whereFilter = "productPrice BETWEEN $min AND $max ";

        $data["allFilter"] = $this->Product_model->getAllParameter("tb_product",$whereFilter)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }

    public function detail()
    {
        $this->session->set_flashdata('loglog', "1");
        if ($this->session->userdata('email')==""){
            header("Location: ".base_url("login"));
        }

        $id_product = $this->uri->segment(3);

        $where = array(
            "id_product" => $id_product
        );
        $result = $this->Product_model->getAllParameter("tb_product",$where)->result();

        foreach($result as $hasil){
            $jenis = $hasil->productType;
        }

        $whereType = array(
            "productType" => $jenis
        );

        
        
        $data["product"] = $this->Product_model->getAllParameter("tb_product",$where)->result();

        $data["men"] = $this->Product_model->getAllParameterLimit("tb_product",$whereType)->result();
        
        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_detail_product",$data);
        $this->load->view("v_footer");
    }

    public function men()
	{
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }

    public function woman()
	{
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }

    public function mprice()
    {
        $min = $this->input->GET("amount2");

        if ($min == 0 ){ $min = 1;}
        $max = $this->input->GET("amount3");
        
        if($min == ""||$max ==""){ redirect(base_url()."shop/men");}
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $whereMenFilter = "productType = 'Sepatu Pria' AND productPrice BETWEEN $min AND $max ";
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        $data["menFilter"] = $this->Product_model->getAllParameter("tb_product",$whereMenFilter)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }

    public function wprice()
    {
        $min = $this->input->GET("amount2");

        if ($min == 0 ){ $min = 1;}
        $max = $this->input->GET("amount3");
        
        if($min == ""||$max ==""){ redirect(base_url()."shop/woman");}
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $whereWomanFilter = " productType = 'Sepatu Wanita' AND productPrice BETWEEN $min AND $max ";
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        $data["womanFilter"] = $this->Product_model->getAllParameter("tb_product",$whereWomanFilter)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }

    public function maz()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $sortir="productName";
        $urut = "ASC";

        $where = "productType = 'Sepatu Pria' ";
        $data["men"] = $this->Product_model->getSort($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["maz"]=1;
        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }

    public function az()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        
        $sortir="productName";
        $urut = "ASC";

        
        $data["allFilter"] = $this->Product_model->getSortAll($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["az"]=1;
        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }

    public function za()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        
        $sortir="productName";
        $urut = "DESC";

        
        $data["allFilter"] = $this->Product_model->getSortAll($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["za"]=1;
        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }

    public function lowhigh()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        
        $sortir="productPrice";
        $urut = "ASC";

        
        $data["allFilter"] = $this->Product_model->getSortAll($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["lh"]=1;
        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }
    public function highlow()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        
        $sortir="productPrice";
        $urut = "DESC";

        
        $data["allFilter"] = $this->Product_model->getSortAll($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["hl"]=1;
        $this->load->view("v_header");
        $this->load->view("v_all",$data);
        $this->load->view("v_footer");
    }

    public function waz()
    {
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );

        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        $sortir="productName";
        $urut = "ASC";
        
        $where = "productType = 'Sepatu Wanita' ";
        $data["woman"] = $this->Product_model->getSort($sortir,$urut,$where)->result();

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $data["waz"]=1;
        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }

    public function mza()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $sortir="productName";
        $urut = "DESC";

        $where = "productType = 'Sepatu Pria' ";
        $data["men"] = $this->Product_model->getSort($sortir,$urut,$where)->result();
        $data["mza"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }
    public function wza()
    {
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
       
        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        $sortir="productName";
        $urut = "DESC";
        
        $where = "productType = 'Sepatu Wanita' ";
        $data["woman"] = $this->Product_model->getSort($sortir,$urut,$where)->result();

        $data["wza"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;


        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }

    public function mlowhigh()
    {
       
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $sortir="productPrice";
        $urut = "ASC";
        
        $where = "productType = 'Sepatu Pria' ";
        $data["men"] = $this->Product_model->getSort($sortir,$urut,$where)->result();
        $data["mlh"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }
    public function wlowhigh()
    {
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );

        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        $sortir="productPrice";
        $urut = "ASC";
        
        $where = "productType = 'Sepatu Wanita' ";
        $data["woman"] = $this->Product_model->getSort($sortir,$urut,$where)->result();
        $data["wlh"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }

    public function mhighlow()
    {
        
        $whereWoman = array(
            "productType" => "Sepatu Wanita"
        );
        
        $data["woman"] = $this->Product_model->getAllParameter("tb_product",$whereWoman)->result();
        
        $sortir="productPrice";
        $urut = "DESC";

        $where = "productType = 'Sepatu Pria' ";
        $data["men"] = $this->Product_model->getSort($sortir,$urut,$where)->result();
        $data["mhl"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;

        $this->load->view("v_header");
        $this->load->view("v_men",$data);
        $this->load->view("v_footer");
    }
    public function whighlow()
    {
        $whereMen = array(
            "productType" => "Sepatu Pria"
        );
       
        
        $data["men"] = $this->Product_model->getAllParameter("tb_product",$whereMen)->result();
        
        $sortir="productPrice";
        $urut = "DESC";

        $where = "productType = 'Sepatu Wanita' ";
        $data["woman"] = $this->Product_model->getSort($sortir,$urut,$where)->result();
        $data["whl"]=1;

        $whereCart = array(
            'id_user' => $this->session->userdata('id_user'),
            'nomor_invoice' => 101
        );
        $data["cart"]=$this->Cart_model->getCart($whereCart)->result();
        
        $data["nav"]=2;
        
        $this->load->view("v_header");
        $this->load->view("v_woman",$data);
        $this->load->view("v_footer");
    }
}
