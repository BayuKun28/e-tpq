<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('kategori_produk_model');
    }

    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori_produk'] = $this->kategori_produk_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori_produk/index', $data);
    }

    public function addkategoriproduk()
    {
        $data = array(
            'kategori' => $this->input->post('kategori')
        );
        $this->db->insert('kategori_produk', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Kategori_produk');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori_produk');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Kategori_produk');
    }

    public function editproduk()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'kategori' => $this->input->post('kategoriedit')
        );
        $this->db->where('id', $id);
        $this->db->update('kategori_produk', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Kategori_produk');
    }
}
