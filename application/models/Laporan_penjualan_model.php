<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_penjualan_model extends CI_Model
{

    public function read($xtanggalawal, $xtanggalakhir)
    {
        $query = "SELECT t.id ,t.tanggal,t.nota,
        (GROUP_CONCAT(concat(p.nama_produk,' = ',dt.qty,'<br>') SEPARATOR '\n' )) as nama_produk,
        tbtotal.total as  total_bayar,
        t.jumlah_uang,t.diskon,pel.nama as pelanggan,peng.nama as kasir
        FROM transaksi t
        LEFT JOIN detail_transaksi dt on dt.transaksi_id = t.id
        LEFT JOIN produk p on p.id = dt.produk
        LEFT JOIN pelanggan pel on pel.id = t.pelanggan
        LEFT JOIN pengguna peng on peng.id = t.kasir
        LEFT JOIN (SELECT  
                        a.id,SUM(c.harga*b.qty) as total
                        FROM transaksi a
                        LEFT JOIN detail_transaksi b on b.transaksi_id = a.id
                        LEFT JOIN produk c on c.id = b.produk 
                        GROUP BY a.id) tbtotal on tbtotal.id = t.id
        WHERE  (t.tanggal BETWEEN '$xtanggalawal' AND '$xtanggalakhir') AND status = 1
        GROUP BY t.id,t.tanggal,t.nota
        ORDER BY t.id DESC,dt.id
        ";
        // die($query);
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function labauntung($xtanggalawal, $xtanggalakhir)
    {
        $sql = "SELECT
                SUM((p.harga*dt.qty)) as laba,
                SUM(((p.harga*dt.qty)-(p.harga_modal*dt.qty))) as untung
                FROM transaksi t 
                JOIN detail_transaksi dt on dt.transaksi_id = t.id
                JOIN produk p on p.id = dt.produk
                WHERE  (t.tanggal BETWEEN '$xtanggalawal' AND '$xtanggalakhir') AND status = 1 
                ";
        return $this->db->query($sql)->row();
    }
}
