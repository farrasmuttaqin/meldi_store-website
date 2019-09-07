<?php
	
	class LoginAdmin_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		/* FUNGSI LOGIN */

		public function loginCheck($table,$where){		
			return $this->db->get_where($table,$where);
		}	
	}

?>