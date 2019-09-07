<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginAdmin_model');
		error_reporting(E_ERROR|E_PARSE);
		if (!$_SESSION["nama_lengkap_admin"]==""){
            $tampung = base_url()."administrator";
            header("Location: $tampung");
        }
	}
	
	public function index()
	{
        $this->load->view("admin/v_header");
        $this->load->view("admin/v_login");
        $this->load->view("admin/v_footer");
    }
    
    public function loginAction()
	{
		$email = $this->input->post('username');
		$password = $this->input->post('pass');

		$where = array(
			'username' => $email,
			'pass' => md5($password)
        );
        
		$cek = $this->LoginAdmin_model->loginCheck("tb_admin",$where)->num_rows();

		if($cek > 0) {
            $data["data_userTrue"] = $this->LoginAdmin_model->loginCheck("tb_admin",$where)->result();
            $this->load->view('admin/v_inputSession', $data);
		} else {
			$this->session->set_flashdata("error","1");
			redirect(base_url()."backend");
		}
    }
    
}
