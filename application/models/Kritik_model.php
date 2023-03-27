<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kritik_model extends CI_Model
{
    public function read()
    {
        $query = "SELECT k.id,p.nama,k.kritiksaran
					FROM kritik k
					LEFT JOIN pelanggan p on k.id_pelanggan = p.id";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
}
