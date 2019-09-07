<?php
	
	class Admin_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		/* FUNGSI SECURITY GENERATE HASH AGAR TIDAK BISA CHANGE PASSWORD TERUS MENERUS*/

		public function getInvoice(){
            return $this->db->get("tb_order");
        }

        public function getDetail($nomor_invoice)
		{
            $this->db->select('*');
            $this->db->from('tb_order a'); 
            $this->db->join('tb_users d', 'd.id_user=a.id_user', 'left');
			$this->db->join('tb_cart b', 'b.nomor_invoice=a.nomor_invoice', 'left');
            $this->db->join('tb_product c', 'c.id_product=b.id_product', 'left');
            $this->db->where('a.nomor_invoice',$nomor_invoice);   
			return $this->db->get();
		}

		public function konfirmasi($invoice,$status,$status2)
		{
			$where = "nomor_invoice = '$invoice'";
			$this->db->set('status_pembayaran', $status);
			$this->db->set('status_pengiriman_barang', $status2);
			$this->db->where($where);
			$this->db->update('tb_order');
		}

		public function getUser()
		{
			return $this->db->get("tb_users");
		}

		public function getContact()
		{
			return $this->db->get("tb_contact");
		}

	}

?>