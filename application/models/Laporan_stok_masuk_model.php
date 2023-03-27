<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_stok_masuk_model extends CI_Model
{

    public function read($xtanggalawal, $xtanggalakhir)
    {
        $query = "SELECT sm.tanggal ,p.barcode,p.nama_produk,sm.jumlah,sm.keterangan,s.nama as supplier
        FROM stok_masuk sm
        LEFT JOIN produk p on p.id = sm.barcode
        LEFT JOIN supplier s on s.id = sm.supplier
        WHERE  sm.tanggal BETWEEN '$xtanggalawal' AND '$xtanggalakhir'
        ORDER BY sm.id DESC
        ";
        // die($query);
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
}
