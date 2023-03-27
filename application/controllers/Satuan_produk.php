<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('satuan_produk_model');
    }

    public function index()
    {
        $data['title'] = 'Satuan Produk';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['satuan_produk'] = $this->satuan_produk_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('satuan_produk/index', $data);
    }

    public function addsatuanproduk()
    {
        $data = array(
            'satuan' => $this->input->post('satuan')
        );
        $this->db->insert('satuan_produk', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Satuan_produk');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('satuan_produk');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Satuan_produk');
    }

    public function editsatuanproduk()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'satuan' => $this->input->post('satuanedit')
        );
        $this->db->where('id', $id);
        $this->db->update('satuan_produk', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Satuan_produk');
    }
}
