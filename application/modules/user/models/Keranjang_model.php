<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
	private $_table = "products";

	public function get_produk_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function get_produk_kategori($kategori)
	{
		if ($kategori != null) {
			$this->db->select('*');
			$this->db->where('category', $kategori);
		}
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function get_kategori_all()
	{
		$query = $this->db->get('category');
		return $query->result_array();
	}

	public  function get_produk_id($id)
	{
		return $this->db->get_where($this->_table, ["product_id" => $id])->row();
	}

	/*public function tambah_pelanggan($data)
	{
		$this->db->insert('tbl_pelanggan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function tambah_order($data)
	{
		$this->db->insert('tbl_order', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function tambah_detail_order($data)
	{
		$this->db->insert('tbl_detail_order', $data);
	}*/
	function get_produk_list($limit, $start, $keyword = 'null')
	{
		if ($keyword) {
			$this->db->like('name', $keyword);
		}
		$query = $this->db->get($this->_table, $limit, $start);
		return $query;
	}
}
