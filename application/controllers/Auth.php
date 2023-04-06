<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth_model');
    }
    public function index()
    {
        $data['title'] = 'Login Page TPQ Darul Jannah';
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $identitas = $this->auth_model->getIdentitas();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'id_wali' => $user['id_wali'],
                        'status' => 'login',
                        'is_logged_in' => TRUE,
                        'identitas' => $identitas
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="ni ni-time-alarm"></i></span>
                                                                <span class="alert-text"> Wrong Password!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="ni ni-time-alarm"></i></span>
                                                                <span class="alert-text"> Username Is Not Active!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="ni ni-time-alarm"></i></span>
                                                                <span class="alert-text"> Username Not Found!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>');
            redirect('auth');
        }
    }

    public function tambah()
    {
        $cek = $this->input->post('role');

        if ($cek == 4) {
            $id_wali = $this->input->post('id_wali');
        } else {
            $id_wali = 0;
        }
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'nama' => $this->input->post('nama'),
            'role' => $this->input->post('role'),
            'is_active' => 1,
            'id_wali' => $id_wali
        );
        $this->db->insert('pengguna', $data);
        $this->session->set_flashdata('message', 'Berhasil Ditambah');
        redirect('Auth/pengguna');
    }

    public function edit()
    {
        $id = $this->input->post('idedit');
        $cek = $this->input->post('roleedit');

        if ($cek == 4) {
            $id_wali = $this->input->post('id_waliedit');
        } else {
            $id_wali = 0;
        }
        $data = array(
            'username' => $this->input->post('usernameedit'),
            'password' => password_hash($this->input->post('passwordedit'), PASSWORD_DEFAULT),
            'nama' => $this->input->post('namaedit'),
            'role' => $this->input->post('roleedit'),
            'id_wali' => $id_wali
        );
        $this->db->where('id', $id);
        $this->db->update('pengguna', $data);
        $this->session->set_flashdata('message', 'Berhasil Di Update');
        redirect('Auth/pengguna');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pengguna');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Auth/pengguna');
    }
    public function pengguna()
    {
        $data['title'] = 'Pengguna';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->auth_model->read();
        $data['role'] = $this->auth_model->getRole();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/pengguna');
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('is_logged_in');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have been LogOut.!</div>');
        redirect('auth');
    }

    public function profil()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->auth_model->profil($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/profil', $data);
    }

    public function simpanprofil()
    {
        $id = $this->input->post('idedit');
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'nama' => $this->input->post('nama')
        );
        $this->db->where('id', $id);
        $this->db->update('pengguna', $data);


        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('is_logged_in');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Update Profile, Silahkan Login Ulang</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Acces Blocked';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('templates/footer', $data);
    }
}
