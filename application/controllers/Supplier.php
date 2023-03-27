<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('supplier_model');
    }

    public function index()
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['supplier'] = $this->supplier_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('supplier/index', $data);
    }

    public function addsupplier()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->insert('supplier', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Supplier');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('supplier');
    }

    public function editsupplier()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'nama' => $this->input->post('namaedit'),
            'alamat' => $this->input->post('alamatedit'),
            'telepon' => $this->input->post('teleponedit'),
            'keterangan' => $this->input->post('keteranganedit')
        );
        $this->db->where('id', $id);
        $this->db->update('supplier', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Supplier');
    }
}
