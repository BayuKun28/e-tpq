<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('stok_masuk_model');
    }

    public function index()
    {
        $data['title'] = 'Stok Masuk';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['stok_masuk'] = $this->stok_masuk_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('stok_masuk/index', $data);
    }

    public function addstokmasuk()
    {
        $id = $this->input->post('barcode');
        $jumlah = $this->input->post('jumlah');
        $stok = $this->stok_masuk_model->getStok($id)->stok;
        $rumus = max($stok + $jumlah, 0);
        $addStok = $this->stok_masuk_model->addStok($id, $rumus);

        $tanggal = new DateTime($this->input->post('tanggal'));
        $data = array(
            'tanggal' => $tanggal->format('Y-m-d H:i:s'),
            'barcode' => $id,
            'jumlah' => $jumlah,
            'keterangan' => $this->input->post('keterangan'),
            'supplier' => $this->input->post('supplier')
        );

        $this->db->insert('stok_masuk', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Stok_masuk');
    }

    public function stok_hari()
    {
        header('Content-type: application/json');
        $now = date('d m Y');
        $total = $this->stok_masuk_model->stokHari($now);
        echo json_encode($total->total == null ? 0 : $total);
    }
    public function getbarcode()
    {
        $bar = $this->input->get('bar');
        $query = $this->stok_masuk_model->getbarcodeselect2($bar, 'barcode');
        echo json_encode($query);
    }
    public function getsupplier()
    {
        $sup = $this->input->get('sup');
        $query = $this->stok_masuk_model->getsupplierselect2($sup, 'nama');
        echo json_encode($query);
    }
}
