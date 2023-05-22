<?php
// defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('santri_model');
        $this->load->model('pembayaran_model');
        $this->load->model('auth_model');
    }

    public function index()
    {
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembayaran/index', $data);
    }
    public function waliauto()
    {
        $santri = $this->input->get('santri');
        $query = $this->santri_model->getautowali($santri);
        echo json_encode($query);
    }
    public function add()
    {
        $nominal1 = $this->input->post('nominal');
        $nominal = str_replace(',', '', $nominal1);
        $bulan = $this->input->post('id_bulan');
        $tahun = $this->input->post('id_tahun');
        $keterangan = $this->input->post('keterangan');
        $idpage = $this->input->post('idpage');
        $data = array(
            'id_santri' => $idpage,
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'nominal' => $nominal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'keterangan' => $keterangan
        );
        $this->db->insert('pembayaran', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        // send text ultramsg
        $namabulan = $this->santri_model->getbulana($bulan)->nama;
        $nohp = $this->santri_model->getwaliwa($idpage)->no_hp;
        $santri = $this->santri_model->getwaliwa($idpage)->namasantri;
        $token = "svwmn181lj1uzif6"; // Ultramsg.com token
        $instance_id = "instance41358"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($token, $instance_id);

        $to = $nohp;
        $body = "Pembayaran Untuk Bulan " . $namabulan . " Tahun " . $tahun . " Sebesar Rp" . $nominal1 . " Atas Nama Santri " . $santri . " Sukses Dibayar Pada " . date('Y-m-d H:i:s') . " dengan Keterangan " . $keterangan;
        $api = $client->sendChatMessage($to, $body);


        redirect('Pembayaran/Detail/' . $idpage);
    }

    public function Data()
    {
        $data['title'] = 'Data Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembayaran/indexdata', $data);
    }

    public function get_ajax_list()
    {
        $list = $this->santri_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = '<a href="' . base_url('Pembayaran/Detail/') . $d->id . '" class="btn btn-success btn-sm">' . $d->nama . '</a>';
            $row[] = $d->alamat;
            $row[] = $d->namawali;
            $row[] = '<a href="' . base_url('Pembayaran/Detail/') . $d->id . '" class="btn btn-primary btn-block btn-sm"><i class="fas fa-eye"></i> Lihat / Bayar</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->santri_model->count_all(),
            "recordsFiltered" => $this->santri_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function Detail()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Detail Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->santri_model->detail($id);
        $xtahun = $this->input->post('tahun');
        if (!empty($xtahun)) {
            $xtahun = $this->input->post('tahun');
        } else {
            $xtahun = date('Y');
        }
        $data['tahun'] = $xtahun;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembayaran/detail', $data);
    }

    public function get_ajax_listdetail()
    {
        $list = $this->pembayaran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $d->bulan;
            if ($d->status == 'Dibayar') {
                $tampilstatus =  "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-check-circle'></i> " . $d->status . "</button>";
            } else {
                $tampilstatus =  "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-times-circle'></i> " . $d->status . "</button>";
            }
            $row[] = $tampilstatus;
            $row[] = 'Rp' . number_format($d->nominal);
            if ($d->nominal != 0) {
                $tampilaksi =  '<a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit" data-idedit="' . $d->id_pembayaran . '" data-bulanedit="' . $d->bulan . '" data-nominaledit="' . $d->nominal . '" data-keteranganedit="' . $d->keterangan . '" name="edit" id="edit"><i class="fa fa-edit"></i> Edit</a>
                <a href="' . base_url('Pembayaran/cetakkwitansi?pembayaran=') . $d->id_pembayaran . '" target="_blank" class="btn btn-danger btn-sm" name="print" id="print"><i class="fa fa-print"></i> Cetak Kwitansi</a><a href="' . base_url('Pembayaran/kirimkwitansi?pembayaran=') . $d->id_pembayaran . '&idpage=' . $d->id_santri . '" class="btn btn-warning btn-sm" name="print" id="print"><i class="fa fa-print"></i> Kirim Kwitansi</a>';
            } else {
                $tampilaksi =  '<a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalbayar" data-bulan="' . $d->bulan . '" data-id_bulan="' . $d->id_bulan . '" name="bayar" id="bayar"><i class="fa fa-money-bill-alt"></i> Bayar</a>';
            }
            $row[] = $tampilaksi;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pembayaran_model->count_all(),
            "recordsFiltered" => $this->pembayaran_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit()
    {
        $id = $this->input->post('idedit');
        $idsantri = $this->input->post('idpage');
        $nominal1 = $this->input->post('nominaledit');
        $nominal = str_replace(',', '', $nominal1);
        $namabulan = $this->input->post('bulanedit');
        $nohp = $this->santri_model->getwaliwa($idsantri)->no_hp;
        $santri = $this->santri_model->getwaliwa($idsantri)->namasantri;
        $tahun = $this->santri_model->getpembayaran($id)->tahun;
        $keterangan = $this->input->post('keteranganedit');
        $data = array(
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'nominal' => $nominal,
            'keterangan' => $this->input->post('keteranganedit')
        );
        $this->db->where('id', $id);
        $this->db->update('pembayaran', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        // send text
        $token = "svwmn181lj1uzif6"; // Ultramsg.com token
        $instance_id = "instance41358"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($token, $instance_id);

        $to = $nohp;
        $body = "Pembayaran Untuk Bulan " . $namabulan . " Tahun " . $tahun . " Atas Nama Santri " . $santri . " Telah Di Edit Pada " . date('Y-m-d H:i:s') . " Sebesar Rp" . $nominal1 . " dengan Keterangan " . $keterangan;
        $api = $client->sendChatMessage($to, $body);
        // print_r($api);

        // Send Picture

        // $to="+628991907216"; 
        // $caption="image Caption"; 
        // $image="https://file-example.s3-accelerate.amazonaws.com/images/test.jpg"; 
        // $api=$client->sendImageMessage($to,$image,$caption);
        // print_r($api);

        // $to="+6285845927512"; 
        // $filename="image Caption"; 
        // $document="https://file-example.s3-accelerate.amazonaws.com/documents/cv.pdf"; 
        // $api=$client->sendDocumentMessage($to,$filename,$document);
        // print_r($api);

        redirect('Pembayaran/Detail/' . $idsantri);
    }

    public function cetakkwitansi()
    {
        $data['title'] = 'Kwitansi Pembayaran';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $id = $this->input->get('pembayaran');

        $data['detail'] = $this->pembayaran_model->kwitansi($id);
        $data['identitas'] = $this->auth_model->getIdentitas();
        $dompdf = new Dompdf();
        $customPaper = array(0, 0, 480, 240);
        $dompdf->set_paper($customPaper);
        $html = $this->load->view('pembayaran/kwitansi', $data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Kwitansi Pembayaran', array("Attachment" => false));
    }

    public function kirimkwitansi()
    {
        $this->load->helper('file');

        $id = $this->input->get('pembayaran');
        $idsantri = $this->input->get('idpage');
        $data['detail'] = $this->pembayaran_model->kwitansi($id);
        $data['identitas'] = $this->auth_model->getIdentitas();
        $filename = dirname(__DIR__, 2) . '\files\pdf\kwitansi.pdf';

        $dompdf = new Dompdf();
        $customPaper = array(0, 0, 480, 240);
        $msg = $this->load->view('pembayaran/kwitansi', $data, true);
        $html = mb_convert_encoding($msg, 'HTML-ENTITIES', 'UTF-8');
        $dompdf->load_html($html);
        $dompdf->set_paper($customPaper);
        $dompdf->render();
        file_put_contents($filename, $dompdf->output());

        $nohp = $this->santri_model->getwaliwa($idsantri)->no_hp;
        $santri = $this->santri_model->getwaliwa($idsantri)->namasantri;
        $tahun = $this->santri_model->getpembayaran($id)->tahun;
        $namabulan = $this->santri_model->getpembayaran($id)->namabulan;

        $token = "svwmn181lj1uzif6"; // Ultramsg.com token
        $instance_id = "instance41358"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($token, $instance_id);

        $to = $nohp;
        $filename = "Kwitansi Bulan " . $namabulan . " Tahun " . $tahun . " Santri " . $santri;
        $document = dirname(__DIR__, 2) . '\files\pdf\kwitansi.pdf';
        $b64 = file_get_contents($document);
        $hasilb64 = base64_encode($b64);

        $api = $client->sendDocumentMessage($to, $filename, $hasilb64);
        $this->session->set_flashdata('message', 'Kwitansi Sukses');
        redirect('Pembayaran/Detail/' . $idsantri);
    }
    public function reminder()
    {
        $token = "svwmn181lj1uzif6"; // Ultramsg.com token
        $instance_id = "instance41358"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($token, $instance_id);
        $nohp = $this->pembayaran_model->getnohpall();

        $to = $nohp;
        $body = "Selamat Siang, Mengingatkan Untuk Pembayaran Iuran Wajib Bulanan Hampir Jatuh Tempo, Dimohon Untuk Segera Membayar , Terimakasih";
        $api = $client->sendChatMessage($to, $body);

        $this->session->set_flashdata('message', 'Reminder');
        redirect('Pembayaran/Data');
    }
}
