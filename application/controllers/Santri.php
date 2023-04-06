<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('santri_model');
    }

    public function index()
    {
        $data['title'] = 'Santri';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('santri/index', $data);
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

            $row[] = $d->nama;
            $row[] = format_indo(date($d->tanggal_lahir));
            $row[] = $d->alamat;
            $row[] = $d->namawali;
            $row[] = $d->jk;
            $row[] = '<a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditsantri" data-idedit="' . $d->id . '" data-namaedit="' . $d->nama . '" data-tanggal_lahiredit="' . $d->tanggal_lahir . '" data-alamatedit="' . $d->alamat . '" data-jkedit="' . $d->jk . '" data-id_waliedit="' . $d->id_wali . '" data-namawaliedit="' . $d->namawali . '" data-is_activeedit="' . $d->is_active . '" name="editsantri" id="editsantri"><i class="fa fa-edit"></i></a>
            <a data-kode="' . $d->id . '" href="javascript:void(0)" class="del_santri btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
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

    public function getwali2()
    {
        $wal = $this->input->get('wal');
        $query = $this->santri_model->getwali($wal, 'nama');
        echo json_encode($query);
    }
    public function getsantri2()
    {
        $hak = $this->session->userdata('role');
        $wali = $this->session->userdata('id_wali');
        $san = $this->input->get('san');
        $query = $this->santri_model->getsantri($san, $hak, $wali);
        echo json_encode($query);
    }

    public function getbulan2()
    {
        $bul = $this->input->get('bul');
        $query = $this->santri_model->getbulan($bul, 'nama');
        echo json_encode($query);
    }

    public function getbulan()
    {
        $bul = $this->input->get('id');
        $query = $this->santri_model->getbulanbyid($bul);
        echo json_encode($query);
    }

    public function addsantri()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'id_wali' => $this->input->post('id_wali'),
            'jk' => $this->input->post('jk'),
            'is_active' => $this->input->post('is_active')
        );
        $this->db->insert('santri', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Santri');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('santri');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Santri');
    }

    public function editsantri()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'nama' => $this->input->post('namaedit'),
            'alamat' => $this->input->post('alamatedit'),
            'tanggal_lahir' => $this->input->post('tanggal_lahiredit'),
            'id_wali' => $this->input->post('id_waliedit'),
            'jk' => $this->input->post('jkedit'),
            'is_active' => $this->input->post('is_activeedit')
        );
        $this->db->where('id', $id);
        $this->db->update('santri', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Santri');
    }
}
