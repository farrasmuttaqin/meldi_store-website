<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Profile_model");
		$this->load->model("Checkout_model");
		$this->load->model('Cart_model');
		error_reporting(E_ERROR|E_PARSE);
		if ($this->session->userdata('email')==""){
            header("Location: ".base_url());
        }
	}
	
	public function index()
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
   		$data['provinsi'] = $get_prov->result();
		$data['path'] = base_url('assets');   
		   
		$id_user = $this->session->userdata('id_user');
		
		$where = array(
			'id_user' => $id_user
		);


		$whereCart = array(
			'id_user' => $this->session->userdata('id_user'),
			'nomor_invoice' => 101
		);
		$data["cart"]=$this->Cart_model->getCart($whereCart)->result();
		
		$data["nav"]=1;

		$data["getAll"]=$this->Profile_model->getAll($where)->result();
		$data["invoice"]=$this->Profile_model->getInvoice($where)->result();
		$this->load->view('v_header');
        $this->load->view('v_profile',$data);
        $this->load->view('v_footer');
	}

	function add_ajax_kab($id_prov)
	{
    	$query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
    	$data = "<option value=''>- Select Kabupaten -</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_kec($id_kab)
	{
    	$query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
    	$data = "<option value=''> - Pilih Kecamatan - </option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_des($id_kec)
	{
    	$query = $this->db->get_where('wilayah_desa',array('kecamatan_id'=>$id_kec));
    	$data = "<option value=''> - Pilih Desa - </option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}

	public function changeAddress(){
		$id_user = $this->session->userdata('id_user');

		$provinsi = $this->input->post('prov');
		$whereProvinsi = array(
			'id' => $provinsi
		);
		$getProvinsi=$this->Profile_model->getAddress("wilayah_provinsi",$whereProvinsi)->result();
		foreach ($getProvinsi as $prov){
			$provinsiS = $prov->nama;
		}

		
		$kabupaten = $this->input->post('kab');
		$whereKabupaten = array(
			'id' => $kabupaten
		);
		$getKabupaten=$this->Profile_model->getAddress("wilayah_kabupaten",$whereKabupaten)->result();
		foreach ($getKabupaten as $kab){
			$kabupatenS = $kab->nama;
		}


		$kecamatan = $this->input->post('kec');
		$whereKecamatan = array(
			'id' => $kecamatan
		);
		$getKecamatan=$this->Profile_model->getAddress("wilayah_kecamatan",$whereKecamatan)->result();
		foreach ($getKecamatan as $kec){
			$kecamatanS = $kec->nama;
		}


		$desa = $this->input->post('des');
		$whereDesa = array(
			'id' => $desa
		);
		$getDesa=$this->Profile_model->getAddress("wilayah_desa",$whereDesa)->result();
		foreach ($getDesa as $des){
			$desaS = $des->nama;
		}


		$detailAlamat = $this->input->post('detailAlamat');
		$whereUpdate = array(
			'userProvinsi' => $provinsiS,
			'userKabupaten' => $kabupatenS,
			'userKecamatan' => $kecamatanS,
			'userDesa' => $desaS,
			'userDetailAlamat' => $detailAlamat
		);
		$this->Profile_model->updateAddress($whereUpdate,$id_user);
		$this->session->set_flashdata('lol', "99");
		redirect(base_url()."profile");
	}

	public function changePassword(){
		$id_user = $this->session->userdata('id_user');
		$passwordLama = $this->input->post('p1');
		$passwordBaru = $this->input->post('p2');

		$old = md5($passwordLama);
		$new = md5($passwordBaru);

		$where = array(
			'id_user' => $id_user,
			'pass' => $old
		);

		$cek = $this->Profile_model->cariPass($where)->num_rows();

		if ($cek > 0)
		{
			$this->Profile_model->change($id_user,$new);
			$this->session->set_flashdata('lolwut', "1");
			redirect(base_url()."profile");
		}else{
			$this->session->set_flashdata('lolwut', "2");
			redirect(base_url()."profile");
		}
	}

	public function invoice(){
		$nomor_invoice = $this->uri->segment(3);
		$data["getInvoice"]=$this->Checkout_model->getInvoice($nomor_invoice)->result();

		$this->load->view('v_header');
        $this->load->view('v_checkout',$data);
        $this->load->view('v_footer');

	}

}