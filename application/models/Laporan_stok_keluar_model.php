<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_stok_keluar_model extends CI_Model
{

    public function read($xtanggalawal, $xtanggalakhir)
    {
        $query = "SELECT sm.tanggal ,p.barcode,p.nama_produk,sm.jumlah,sm.keterangan
        FROM stok_keluar sm
        LEFT JOIN produk p on p.id = sm.barcode
        WHERE  sm.tanggal BETWEEN '$xtanggalawal' AND '$xtanggalakhir'
        ORDER BY sm.id DESC
        ";
        // die($query);
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
}
