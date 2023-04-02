<?php
// defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;
class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('laporan_model');
    }

    public function index()
    {
        $data['title'] = 'Laporan Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $tglawal = $this->input->post('tglawal');
        $tglakhir = $this->input->post('tglakhir');

        if (!empty($tglawal) && !empty($tglakhir)) {
            $tglawal = $this->input->post('tglawal');
            $tglakhir = $this->input->post('tglakhir');
        } else {
            $tglawal = date('Y-m-d');
            $tglakhir = date('Y-m-d', strtotime('+1 days'));
        }
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
    }

    public function get_ajax_list()
	{
		$list = $this->laporan_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->namasantri;
			$row[] = format_indo(date($d->tanggal_pembayaran));
			$row[] = 'Rp'.number_format($d->nominal);
            $row[] = $d->namabulan;
            $row[] = $d->keterangan;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->laporan_model->count_all(),
						"recordsFiltered" => $this->laporan_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function cetak()
    {
        $tglawal=$this->input->get('tglawal');
        $tglakhir = $this->input->get('tglakhir');
        $data['title'] = 'Laporan Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['pembayaran'] = $this->laporan_model->cetakpdf($tglawal,$tglakhir);
        $dompdf = new Dompdf();
        $dompdf->set_paper('A4','Landscape');
        $html = $this->load->view('laporan/cetak', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Pembayaran',array("Attachment" => false));
    }

    public function indexpersantri()
    {
        $data['title'] = 'Laporan Pembayaran Persantri';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $tahun = $this->input->post('tahun');
        if (!empty($tahun)) {
            $tahun = $this->input->post('tahun');
        } else {
            $tahun = date('Y');
        }
        $data['tahun'] = $tahun;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/indexpersantri', $data);
    }
    public function get_ajax_listpersantri()
	{
		$list = $this->laporan_model->get_datatablespersantri();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->bulan;
            $row[] = 'Rp'.number_format($d->nominal);
            $row[] = $d->keterangan;
            if($d->status == 'Dibayar')
            {
                $tampilstatus =  "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-check-circle'></i> ".$d->status."</button>";
            }else{
                $tampilstatus =  "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-times-circle'></i> ".$d->status."</button>";
            }
			$row[] = $tampilstatus;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->laporan_model->count_allpersantri(),
						"recordsFiltered" => $this->laporan_model->count_filteredpersantri(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function cetakpersantri()
    {
        $tahun=$this->input->get('tahun');
        $id_santri = $this->input->get('id_santri');
        $data['title'] = 'Laporan Pembayaran Persantri';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $tahun;
        $data['namasantri'] = $this->laporan_model->getSantri($id_santri)->nama;
        $data['pembayaran'] = $this->laporan_model->cetakpdfpersantri($tahun,$id_santri);
        $dompdf = new Dompdf();
        $dompdf->set_paper('A4','Landscape');
        $html = $this->load->view('laporan/cetakpersantri', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Pembayaran Persantri',array("Attachment" => false));
    }
}
