<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('keranjang_model');
	}
	public function index()
	{
		$config['base_url'] = site_url('user/user/index'); //site url
		$config["uri_segment"] = 4;  // uri parameter

		//Style pagination
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		// ambil data keyword
		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}
		$this->db->like('name', $data['keyword']);
		$this->db->from('products');
		$config['total_rows'] = $this->db->count_all_results(); //total row
		$config['per_page'] = 6;  //show record per halaman
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data['data'] = $this->keranjang_model->get_produk_list($config["per_page"], $data['page'], $data['keyword']);

		$data['pagination'] = $this->pagination->create_links();
		// Kategori
		$kategori = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['product'] = $this->keranjang_model->get_produk_kategori($kategori);
		$data['category'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header', $data);
		$this->load->view('shopping/list_produk', $data);
		$this->load->view('themes/footer');
	}

	public function cara_bayar()
	{
		$product['category'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header', $product);
		$this->load->view('pages/cara_bayar', $product);
		$this->load->view('themes/footer');
	}
	public function check_out()
	{
		$product['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header', $product);
		$this->load->view('shopping/check_out', $product);
		$this->load->view('themes/footer');
	}

	public function detail_produk()
	{
		$id = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$product['kategori'] = $this->keranjang_model->get_kategori_all();
		$product['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$this->load->view('themes/header', $product);
		$this->load->view('shopping/detail_produk', $product);
		$this->load->view('themes/footer');
	}


	function tambah()
	{
		$data_produk = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('nama'),
			'price' => $this->input->post('harga'),
			'gambar' => $this->input->post('gambar'),
			'qty' => $this->input->post('qty')
		);
		$this->cart->insert($data_produk);
		redirect('shopping');
	}

	function hapus($rowid)
	{
		if ($rowid == "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
		redirect('shopping/tampil_cart');
	}

	function ubah_cart()
	{
		$cart_info = $_POST['cart'];
		foreach ($cart_info as $id => $cart) {
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$gambar = $cart['gambar'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array(
				'rowid' => $rowid,
				'price' => $price,
				'gambar' => $gambar,
				'amount' => $amount,
				'qty' => $qty
			);
			$this->cart->update($data);
		}
		redirect('shopping/tampil_cart');
	}

	public function proses_order()
	{
		//-------------------------Input data pelanggan--------------------------
		$data_pelanggan = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp')
		);
		$id_pelanggan = $this->keranjang_model->tambah_pelanggan($data_pelanggan);
		//-------------------------Input data order------------------------------
		$data_order = array(
			'tanggal' => date('Y-m-d'),
			'pelanggan' => $id_pelanggan
		);
		$id_order = $this->keranjang_model->tambah_order($data_order);
		//-------------------------Input data detail order-----------------------		
		if ($cart = $this->cart->contents()) {
			foreach ($cart as $item) {
				$data_detail = array(
					'order_id' => $id_order,
					'produk' => $item['id'],
					'qty' => $item['qty'],
					'harga' => $item['price']
				);
				$proses = $this->keranjang_model->tambah_detail_order($data_detail);
			}
		}
		//-------------------------Hapus shopping cart--------------------------		
		$this->cart->destroy();
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header', $data);
		$this->load->view('shopping/sukses', $data);
		$this->load->view('themes/footer');
	}
}
