<?php
// defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;

class Laporan_penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('laporan_penjualan_model');
    }

    public function index()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $xtanggalawal = $this->input->post('tanggalawal');
        $xtanggalakhir = $this->input->post('tanggalakhir');

        if (!empty($xtanggalawal) && !empty($xtanggalakhir)) {
            $xtanggalawal = $this->input->post('tanggalawal');
            $xtanggalakhir = $this->input->post('tanggalakhir');
        } else {
            $xtanggalawal = date('Y/m/d');
            $xtanggalakhir = date('Y/m/d', strtotime('+1 days'));
        }

        $data['tanggalawal'] = $xtanggalawal;
        $data['tanggalakhir'] = $xtanggalakhir;
        $data['penjualan'] = $this->laporan_penjualan_model->read($xtanggalawal, $xtanggalakhir);
        $data['untung'] = $this->laporan_penjualan_model->labauntung($xtanggalawal, $xtanggalakhir)->untung;
        $data['laba'] = $this->laporan_penjualan_model->labauntung($xtanggalawal, $xtanggalakhir)->laba;

        $action = $this->input->post('action');


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_penjualan/index', $data);
    }
    public function cetak()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $xtanggalawal = $this->input->get('tglawal');
        $xtanggalakhir = $this->input->get('tglakhir');

        $data['tanggalawal'] = date('d F Y', strtotime($xtanggalawal));
        $data['tanggalakhir'] = date('d F Y', strtotime($xtanggalakhir));
        $data['penjualan'] = $this->laporan_penjualan_model->read($xtanggalawal, $xtanggalakhir);
        $data['untung'] = $this->laporan_penjualan_model->labauntung($xtanggalawal, $xtanggalakhir)->untung;
        $data['laba'] = $this->laporan_penjualan_model->labauntung($xtanggalawal, $xtanggalakhir)->laba;

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'Portrait');
        $html = $this->load->view('laporan_penjualan/cetak', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Penjualan Tanggal ' . $xtanggalawal . ' Sampai ' . date('Y-m-d'), array("Attachment" => false));
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('transaksi');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Laporan_penjualan');
    }
}
