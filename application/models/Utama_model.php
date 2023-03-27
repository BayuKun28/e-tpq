<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utama_model extends CI_Model
{
    public function get_produk_kategori($kategori)
    {
        if ($kategori > 0) {
            $query = "SELECT p.id,p.barcode,
                        p.nama_produk,
                        p.kategori as kdkategori,
                        kp.kategori,
                        p.satuan as kdsatuan,
                        sp.satuan,
                        p.harga,
                        p.stok,
                        p.harga_modal,p.gambar,p.keterangan,CONCAT(LEFT(p.keterangan,30),' ......') as ringkasan
                        FROM produk p
                        JOIN kategori_produk kp on kp.id = p.kategori
                        JOIN satuan_produk sp on sp.id = p.satuan
                        WHERE kp.id = '$kategori' AND p.stok <> 0 ";
        } else {
            $query = "SELECT p.id,p.barcode,
                        p.nama_produk,
                        p.kategori as kdkategori,
                        kp.kategori,
                        p.satuan as kdsatuan,
                        sp.satuan,
                        p.harga,
                        p.stok,
                        p.harga_modal ,p.gambar,p.keterangan,CONCAT(LEFT(p.keterangan,30),' ......') as ringkasan
                        FROM produk p
                        JOIN kategori_produk kp on kp.id = p.kategori
                        JOIN satuan_produk sp on sp.id = p.satuan
                        WHERE p.stok <> 0 ";
        }
        return $this->db->query($query)->result_array();
    }

    public function get_kategori_all()
    {
        $query = $this->db->get('kategori_produk');
        return $query->result_array();
    }
    public function get_produk_id($id)
    {
        $query = "SELECT p.id,p.barcode,
                    p.nama_produk,
                    p.kategori as kdkategori,
                    kp.kategori,
                    p.satuan as kdsatuan,
                    sp.satuan,
                    p.harga,
                    p.stok,
                    p.harga_modal ,p.gambar,p.keterangan
                    FROM produk p
                    JOIN kategori_produk kp on kp.id = p.kategori
                    JOIN satuan_produk sp on sp.id = p.satuan
                    WHERE p.id = '$id'";
        return $this->db->query($query)->row_array();
        // die($query);
        echo json_encode($query);
    }
}
