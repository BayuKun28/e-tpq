<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $table = 'produk';

    public function read()
    {
        $query = "SELECT p.id,p.barcode,
                    p.nama_produk,
                    p.kategori as kdkategori,
                    kp.kategori,
                    p.satuan as kdsatuan,
                    sp.satuan,
                    p.harga,
                    p.stok,
                    p.harga_modal,p.gambar,p.keterangan 
                    FROM produk p
                    JOIN kategori_produk kp on kp.id = p.kategori
                    JOIN satuan_produk sp on sp.id = p.satuan";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }

    public function getprodukauto($barcode)
    {
        $this->db->where("barcode", $barcode);
        return $this->db->get("produk");
    }

    function get_all_produk()
    {
        $query = "SELECT p.id,p.barcode,
                    p.nama_produk,
                    p.kategori as kdkategori,
                    kp.kategori,
                    p.satuan as kdsatuan,
                    sp.satuan,
                    p.harga,
                    p.stok,
                    p.harga_modal 
                    FROM produk p
                    LEFT JOIN kategori_produk kp on kp.id = p.kategori
                    LEFT JOIN satuan_produk sp on sp.id = p.satuan
                    WHERE p.stok > 0 ORDER BY p.id";
        return $this->db->query($query)->result();
        // $hasil = $this->db->get('produk');
        // return $hasil->result();
    }

    function get_all_produk_search($cari = 'Voucher')
    {
        $query = "SELECT p.id,p.barcode,
                    p.nama_produk,
                    p.kategori as kdkategori,
                    kp.kategori,
                    p.satuan as kdsatuan,
                    sp.satuan,
                    p.harga,
                    p.stok,
                    p.harga_modal 
                    FROM produk p
                    LEFT JOIN kategori_produk kp on kp.id = p.kategori
                    LEFT JOIN satuan_produk sp on sp.id = p.satuan
                    WHERE p.stok > 0 AND p.nama_produk LIKE '%$cari%' 
                    ORDER BY p.id";
        return $this->db->query($query)->result();
        die($query);
        // $hasil = $this->db->get('produk');
        // return $hasil->result();
    }

    public function getsatuanselect2($sat)
    {
        $query = "SELECT * FROM satuan_produk WHERE satuan LIKE '%$sat%'";
        return $this->db->query($query)->result_array();
        // die($query);
        echo json_encode($query);
    }

    public function getkategoriselect2($kat)
    {
        $query = "SELECT * FROM kategori_produk WHERE kategori LIKE '%$kat%'";
        return $this->db->query($query)->result_array();
        // die($query);
        echo json_encode($query);
    }

    public function getNama($id)
    {
        $this->db->select('nama_produk, stok');
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function getStok($id)
    {
        $this->db->select('stok, nama_produk, harga, barcode');
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function getBarcode($search = '')
    {
        $this->db->select('produk.id, produk.barcode');
        $this->db->like('barcode', $search);
        return $this->db->get($this->table)->result();
    }
}
