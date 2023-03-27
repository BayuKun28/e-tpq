<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('pelanggan_model');
    }

    public function index()
    {
        $data['title'] = 'Pelanggan';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pelanggan'] = $this->pelanggan_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/index', $data);
    }

    public function getpelanggans2()
    {
        $pel = $this->input->get('pel');
        $query = $this->pelanggan_model->getpelanggan($pel, 'nama');
        echo json_encode($query);
    }

    public function addpelanggan()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'no_identitas' => $this->input->post('no_identitas'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jk'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email'),
            'is_active' => 1,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );
        $this->db->insert('pelanggan', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Pelanggan');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pelanggan');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Pelanggan');
    }

    public function editpelanggan()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'nama' => $this->input->post('namaedit'),
            'jenis_kelamin' => $this->input->post('jkedit'),
            'alamat' => $this->input->post('alamatedit'),
            'telepon' => $this->input->post('teleponedit')
        );
        $this->db->where('id', $id);
        $this->db->update('pelanggan', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Pelanggan');
    }
    public function search()
    {
        header('Content-type: application/json');
        $pelanggan = $this->input->post('pelanggan');
        $search = $this->pelanggan_model->search($pelanggan);
        foreach ($search as $pelanggan) {
            $data[] = array(
                'id' => $pelanggan->id,
                'text' => $pelanggan->nama
            );
        }
        echo json_encode($data);
    }
}
