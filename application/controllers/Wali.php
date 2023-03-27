<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('wali_model');
    }

    public function index()
    {
        $data['title'] = 'Wali';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wali/index', $data);
    }

    public function get_ajax_list()
	{
		$list = $this->wali_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;

			$row[] = $d->nama;
			$row[] = $d->alamat;
            $row[] = $d->no_hp;
			$row[] = '<a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditwali" data-idedit="'.$d->id.'" data-namaedit="'.$d->nama.'" data-alamatedit="'.$d->alamat.'" data-no_hpedit="'.$d->no_hp.'" data-is_activeedit="'.$d->is_active.'" name="editwali" id="editwali"><i class="fa fa-edit"></i></a>
            <a data-kode="'.$d->id.'" href="javascript:void(0)" class="del_wali btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->wali_model->count_all(),
						"recordsFiltered" => $this->wali_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function addwali()
    {
        $originalNumber = $this->input->post('no_hp');
        $countryCode = '+62'; // Replace with known country code of user.
        $internationalNumber = preg_replace('/^0/', $countryCode, $originalNumber);

        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $internationalNumber,
            'is_active' => $this->input->post('is_active')
        );
        $this->db->insert('wali', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Wali');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wali');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Wali');
    }

    public function editwali()
    {
        $originalNumber = $this->input->post('no_hpedit');
        $countryCode = '+62'; // Replace with known country code of user.
        $internationalNumber = preg_replace('/^0/', $countryCode, $originalNumber);

        $id = $this->input->post('idedit');
        $data = array(
            'nama' => $this->input->post('namaedit'),
            'alamat' => $this->input->post('alamatedit'),
            'no_hp' => $internationalNumber,
            'is_active' => $this->input->post('is_activeedit')
        );
        $this->db->where('id', $id);
        $this->db->update('wali', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Wali');
    }
}
