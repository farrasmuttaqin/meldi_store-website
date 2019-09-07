<?php
	
	class Contact_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		/* FUNGSI SECURITY GENERATE HASH AGAR TIDAK BISA CHANGE PASSWORD TERUS MENERUS*/

		public function insert($where){
			return $this->db->insert("tb_contact",$where);
		}
	}

?>