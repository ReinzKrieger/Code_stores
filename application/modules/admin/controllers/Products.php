<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->library('form_validation');
        $this->load->model('login/login_m');
    }

    public function index($num = '')
    {
        if ($this->login_m->cek_session()) {
            $config['base_url'] = site_url('admin/products/index'); //site url
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
            $config['per_page'] = 5;  //show record per halaman
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            $this->pagination->initialize($config);
            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data['data'] = $this->product_model->get_produk_list($config["per_page"], $data['page'], $data['keyword']);

            $data['pagination'] = $this->pagination->create_links();

            $this->load->view('products/list', $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function add()
    {
        if ($this->login_m->cek_session()) {
            $product = $this->product_model;
            $validation = $this->form_validation;
            $validation->set_rules($product->rules());

            if ($validation->run()) {
                $product->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            $data['category'] = $this->product_model->getCategory();
            $this->load->view("products/new_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function edit($id = null)
    {
        if ($this->login_m->cek_session()) {
            if (!isset($id)) redirect('admin/products');

            $product = $this->product_model;
            $validation = $this->form_validation;
            $validation->set_rules($product->rules());

            if ($validation->run()) {
                $product->update();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $data["product"] = $product->getById($id);
            if (!$data["product"]) show_404();

            $this->load->view("admin/products/edit_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete($id = null)
    {
        if ($this->login_m->cek_session()) {
            if (!isset($id)) show_404();

            if ($this->product_model->delete($id)) {
                redirect(base_url('admin/products'));
            }
        } else {
            redirect(base_url('login'));
        }
    }
}
