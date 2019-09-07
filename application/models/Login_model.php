<?php
	
	class Login_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		/* FUNGSI SECURITY GENERATE HASH AGAR TIDAK BISA CHANGE PASSWORD TERUS MENERUS*/

		public function changeHash($hashh,$email)
		{
			$hash2 = md5(uniqid(rand(), true));
			$where = "userEmail = '$email' AND hashh = '$hashh'";
			$this->db->set('hashh', $hash2);
			$this->db->where($where);
			$this->db->update('tb_users');
		}

		public function getAddress($table,$where){
            return $this->db->get_where($table,$where);
        }

		/* FUNGSI UBAH PASSWORD */

		public function changeMyPass($table,$where)
		{
			return $this->db->get_where($table,$where);
		}

		public function changePass($hashh,$email,$pass)
		{
			$where = "userEmail = '$email' AND hashh = '$hashh'";
			$this->db->set('pass', $pass);
			$this->db->where($where);
			$this->db->update('tb_users');
		}

		/* FUNGSI FORGOT PASSWORD */

		public function forgotPassword($table,$where)
		{
			return $this->db->get_where($table,$where);
		}

		/* FUNGSI LOGIN */

		public function loginCheck($table,$where){		
			return $this->db->get_where($table,$where);
		}	

		public function loginCheckSecond($table,$where){		
			return $this->db->get_where($table,$where);
		}	

		/* FUNGSI REGISTER */
		
		public function registerInsert($save){
			return $this->db->insert("tb_users",$save);
		}
		public function registerCheck($email,$hp)
		{
			$where = "userEmail = '$email' OR userPhoneNumber = '$hp'";
			$this->db->where($where);
			$this->db->from("tb_users");
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			}else{
				return $query->result();
			}
		}

		/* FUNGSI VERIFICATION */

		public function verifyCheckOne($hashh,$email)
		{
			$where = "userEmail = '$email' AND hashh = '$hashh' AND active = 0";
			$this->db->where($where);
			$this->db->from("tb_users");
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			}else{
				return $query->result();
			}
		}
		public function verifyCheckTwo($hashh,$email)
		{
			$where = "userEmail = '$email' AND hashh = '$hashh'";
			$this->db->where($where);
			$this->db->from("tb_users");
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			}else{
				return $query->result();
			}
		}
		public function verify($hashh,$email)
		{
			$where = "userEmail = '$email' AND hashh = '$hashh' AND active = 0";
			$this->db->set('active', 1);
			$this->db->where($where);
			$this->db->update('tb_users');
		}
	}

?>