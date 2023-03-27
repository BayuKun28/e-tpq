<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_keluar_model extends CI_Model
{

    public function read()
    {
        $query = "SELECT sm.id,sm.tanggal,sm.jumlah,sm.keterangan,p.barcode,p.nama_produk
        FROM stok_keluar sm 
        JOIN produk p on sm.barcode = p.id";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getbarcodeselect2($bar)
    {
        $query = "SELECT id ,barcode from produk WHERE barcode LIKE '%$bar%'";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getsupplierselect2($sup)
    {
        $query = "SELECT id ,nama from supplier WHERE nama LIKE '%$sup%'";
        return $this->db->query($query)->result_array();
        // die($query);
        echo json_encode($query);
    }
    public function getStok($id)
    {
        $this->db->select('stok');
        $this->db->where('id', $id);
        return $this->db->get('produk')->row();
    }
    public function addStok($id, $stok)
    {
        $this->db->where('id', $id);
        $this->db->set('stok', $stok);
        return $this->db->update('produk');
    }
}
