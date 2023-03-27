<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Pengaturan';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $identitas = $this->db->get('identitas')->row();
        $data['identitas'] = $identitas;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/index', $data);
    }

    public function edit()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'app_name' => $this->input->post('app_name'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp')
        );
        $this->db->where('id', 1);
        $this->db->update('identitas', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update Silahkan Login Ulang !');
        redirect('Auth/logout');
    }
}
