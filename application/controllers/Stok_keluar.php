<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_keluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('stok_keluar_model');
    }

    public function index()
    {
        $data['title'] = 'Stok Keluar';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['stok_keluar'] = $this->stok_keluar_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('stok_keluar/index', $data);
    }

    public function addstokkeluar()
    {
        $id = $this->input->post('barcode');
        $jumlah = $this->input->post('jumlah');
        $stok = $this->stok_keluar_model->getStok($id)->stok;
        $rumus = max($stok - $jumlah, 0);
        $addStok = $this->stok_keluar_model->addStok($id, $rumus);

        $tanggal = new DateTime($this->input->post('tanggal'));
        $data = array(
            'tanggal' => $tanggal->format('Y-m-d H:i:s'),
            'barcode' => $id,
            'jumlah' => $jumlah,
            'keterangan' => $this->input->post('keterangan')
        );

        $this->db->insert('stok_keluar', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Stok_keluar');
    }

    public function getbarcode()
    {
        $bar = $this->input->get('bar');
        $query = $this->stok_keluar_model->getbarcodeselect2($bar, 'barcode');
        echo json_encode($query);
    }
    public function getsupplier()
    {
        $sup = $this->input->get('sup');
        $query = $this->stok_keluar_model->getsupplierselect2($sup, 'nama');
        echo json_encode($query);
    }
}
