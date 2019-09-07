<?php
	
	class Product_model extends CI_Model{
		public function __construct()
		{
			parent::__construct();
		}

		public function getSearchParameter($search)
		{
			$where = "productName LIKE '%$search%' OR productType LIKE '%$search%'";
			$this->db->select('*');
	        $this->db->from('tb_product');
	        $this->db->where($where);
	        return $this->db->get();
		}

		public function getAllParameter($table,$where)
		{
			return $this->db->get_where($table,$where);
		}

		public function getAllParameterLimit($table,$where)
		{
			$this->db->order_by('id_product', 'RANDOM');
			return $this->db->get_where($table,$where,5, 0);
		}

		public function getSort($sortir,$urut,$where)
		{
			$this->db->select('*');
			$this->db->from('tb_product');
			$this->db->where($where);
	        $this->db->order_by($sortir, $urut);
	        return $this->db->get();
		}

		public function getSortAll($sortir,$urut)
		{
			$this->db->select('*');
			$this->db->from('tb_product');
	        $this->db->order_by($sortir, $urut);
	        return $this->db->get();
		}

		public function getAll($table)
		{
			return $this->db->get($table);
		}
	}

?>