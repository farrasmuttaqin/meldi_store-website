<?php
	
	class Profile_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
        }
        
        public function updateAddress($whereUpdate,$id_user){
            $this->db->where('id_user', $id_user); 
            $this->db->update('tb_users', $whereUpdate);
        }
        
        public function getAll($where){
            return $this->db->get_where("tb_users",$where);
        }
		
		public function getInvoice($where){
            return $this->db->get_where("tb_order",$where);
        }


        public function getAddress($table,$where){
            return $this->db->get_where($table,$where);
        }

		public function change($id_user,$new)
		{
			$where = "id_user = '$id_user'";
			$this->db->set('pass', $new);
			$this->db->where($where);
			$this->db->update('tb_users');
		}

		public function subscribeCheck($email)
		{
			$where = "email = '$email'";
			$this->db->where($where);
			$this->db->from("tb_subscribe");
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			}else{
				return $query->result();
			}
		}

		public function changeHP($nohp,$email)
		{
			$where = "email = '$email'";
			$this->db->set('nomor_hp', $nohp);
			$this->db->where($where);
			$this->db->update('tb_users');
		}

		public function cariHP($where){		
			return $this->db->get_where("tb_users",$where);
		}	

		public function cariPass($where){		
			return $this->db->get_where("tb_users",$where);
		}	

		public function input($table,$save){
			return $this->db->insert($table,$save);
		}
	}
?>