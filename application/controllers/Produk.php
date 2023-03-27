<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('/');
        }
        $this->load->model('produk_model');
    }

    public function index()
    {
        $data['title'] = 'Produk';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->produk_model->read();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/index', $data);
    }

    public function getdatasatuan()
    {
        $sat = $this->input->get('sat');
        $query = $this->produk_model->getsatuanselect2($sat, 'satuan');
        echo json_encode($query);
    }

    public function getdatakategori()
    {
        $kat = $this->input->get('kat');
        $query = $this->produk_model->getkategoriselect2($kat, 'kategori');
        echo json_encode($query);
    }

    public function addproduk()
    {
        $harga1 = $this->input->post('harga');
        $harga = str_replace(',', '', $harga1);
        $harga_modal1 = $this->input->post('harga_modal');
        $harga_modal = str_replace(',', '', $harga_modal1);

        $config['upload_path'] = './upload/produk/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $message = array('error' => $this->upload->display_errors());
            echo "<script>alert('$message');</script>";
        } else {
            $fileData = $this->upload->data();
            $data = array(
                'barcode' => $this->input->post('barcode'),
                'nama_produk' => $this->input->post('nama_produk'),
                'kategori' => $this->input->post('kategori'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $harga,
                'harga_modal' => $harga_modal,
                'stok' => $this->input->post('stok'),
                'keterangan' => $this->input->post('keterangan'),
                'terjual' => '0',
                'gambar' => $fileData['file_name']
            );
            $this->db->insert('produk', $data);
            $this->session->set_flashdata('message', 'Berhasil Ditambah');
            redirect('Produk');
        }
    }



    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('produk');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
        redirect('Produk');
    }

    public function editproduk()
    {
        $id = $this->input->post('idedit');
        $harga1 = $this->input->post('hargaedit');
        $harga = str_replace(',', '', $harga1);
        $harga_modal1 = $this->input->post('harga_modaledit');
        $harga_modal = str_replace(',', '', $harga_modal1);

        $config['upload_path'] = './upload/produk/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileedit')) {
            $data = array(
                'barcode' => $this->input->post('barcodeedit'),
                'nama_produk' => $this->input->post('nama_produkedit'),
                'kategori' => $this->input->post('kategoriedit'),
                'satuan' => $this->input->post('satuanedit'),
                'harga' => $harga,
                'harga_modal' => $harga_modal,
                'stok' => $this->input->post('stokedit'),
                'keterangan' => $this->input->post('keteranganedit')
            );
            $this->db->where('id', $id);
            $this->db->update('produk', $data);
            $this->session->set_flashdata('message', 'Berhasil Di Update');
            redirect('Produk');
        } else {
            $fileData = $this->upload->data();
            $data = array(
                'barcode' => $this->input->post('barcodeedit'),
                'nama_produk' => $this->input->post('nama_produkedit'),
                'kategori' => $this->input->post('kategoriedit'),
                'satuan' => $this->input->post('satuanedit'),
                'harga' => $harga,
                'harga_modal' => $harga_modal,
                'stok' => $this->input->post('stokedit'),
                'keterangan' => $this->input->post('keteranganedit'),
                'gambar' => $fileData['file_name']
            );
            $this->db->where('id', $id);
            $this->db->update('produk', $data);
            $this->session->set_flashdata('message', 'Berhasil Di Update');
            redirect('Produk');
        }
    }
    public function get_nama()
    {
        header('Content-type: application/json');
        $id = $this->input->post('id');
        echo json_encode($this->produk_model->getNama($id));
    }

    public function get_stok()
    {
        header('Content-type: application/json');
        $id = $this->input->post('id');
        echo json_encode($this->produk_model->getStok($id));
    }
    public function get_barcode()
    {
        header('Content-type: application/json');
        $barcode = $this->input->post('barcode');
        $search = $this->produk_model->getBarcode($barcode);
        foreach ($search as $barcode) {
            $data[] = array(
                'id' => $barcode->id,
                'text' => $barcode->barcode
            );
        }
        echo json_encode($data);
    }
}
