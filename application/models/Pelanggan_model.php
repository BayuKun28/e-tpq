<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    private $table = 'pelanggan';

    public function read()
    {
        $query = "SELECT * FROM pelanggan";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getSupplier($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function search($search = "")
    {
        $this->db->like('nama', $search);
        return $this->db->get($this->table)->result();
    }
    public function getpelanggan($a)
    {
        $query = "SELECT id ,nama from pelanggan WHERE nama LIKE '%$a%'";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
}
