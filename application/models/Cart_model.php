<?php
	
	class Cart_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		public function insert($save){
			return $this->db->insert("tb_cart",$save);
		}

		
		public function cartCheck($id_user,$id_product,$ukuran)
		{
			$where = "id_user = $id_user AND id_product = $id_product AND nomor_invoice = 101 AND size = '$ukuran' ";
			$this->db->where($where);
			$this->db->from("tb_cart");
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			}else{
				return $query->result();
			}
		}
		public function updateSame($id_user,$id_product,$quantityNew,$ukuran)
		{
			$where = "id_user = $id_user AND id_product = $id_product AND nomor_invoice = 101 AND size='$ukuran' ";
			$this->db->set('quantity', 'quantity+'.$quantityNew,FALSE);
			$this->db->where($where);
			$this->db->update('tb_cart');
        }
        
        public function updateCart($where,$data)
		{
            $this->db->where($where);
			$this->db->update('tb_cart',$data);
		}

		public function hapus($where)
		{
			$this->db->where($where);
			$this->db->delete('tb_cart');
		}

        public function getCartCart($where){
            $this->db->select('*');
            $this->db->from('tb_cart a'); 
            $this->db->join('tb_product b', 'b.id_product=a.id_product', 'left');
            $this->db->where($where);  
            $query = $this->db->get(); 
            return $query->result();
        }
		public function getCart($where){
			return $this->db->get_where('tb_cart',$where);		
		}
		
		public function getPengguna($where){
			return $this->db->get_where('tb_users',$where);		
		}
	}

?>