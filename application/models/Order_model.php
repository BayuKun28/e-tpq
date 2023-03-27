<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function tambah_order($data)
    {
        $this->db->insert('transaksi', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    public function tambah_detail_order($data)
    {
        $this->db->insert('detail_transaksi', $data);
    }
    public function getnomornota()
    {
        $sql = "SELECT (CASE WHEN (SELECT t.id from transaksi t LIMIT 1) IS NULL THEN 'TRANTKUN1' 
                ELSE
                (SELECT (CONCAT(('TRANTKUN'),a.nomornota+1)) as nomornota 
                FROM
                (SELECT SUBSTRING(t.nota, 9) as nomornota 
                FROM transaksi t ORDER BY t.id DESC LIMIT 1) a)
                END) as nomornota";

        return $this->db->query($sql)->row()->nomornota;
        echo json_encode($sql);
    }

    public function getnotacetak()
    {
        $sql = "SELECT nota FROM transaksi ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql)->row()->nota;
        echo json_encode($sql);
    }
    public function totalcetak()
    {
        $sql = "SELECT  
                SUM(p.harga*dt.qty) as total
                FROM transaksi t 
                LEFT JOIN detail_transaksi dt on dt.transaksi_id = t.id
                LEFT JOIN produk p on p.id = dt.produk 
                WHERE t.id = (SELECT id FROM transaksi ORDER BY id DESC LIMIT 1)
                ORDER BY p.id ASC";
        return $this->db->query($sql)->row()->total;
        echo json_encode($sql);
    }

    public function getbayar()
    {
        $sql = "SELECT jumlah_uang FROM transaksi ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql)->row()->jumlah_uang;
        echo json_encode($sql);
    }

    public function getlistnota()
    {
        $sql = "SELECT  p.nama_produk,dt.qty ,
                (p.harga*dt.qty) as total
                FROM transaksi t 
                LEFT JOIN detail_transaksi dt on dt.transaksi_id = t.id
                LEFT JOIN produk p on p.id = dt.produk 
                WHERE t.id = (SELECT id FROM transaksi ORDER BY id DESC LIMIT 1)
                ORDER BY p.id ASC";
        return $this->db->query($sql)->result_array();
        echo json_decode($sql);
    }
    public function readmenunggu($xtanggalawal, $xtanggalakhir)
    {

        $query = "SELECT t.id ,t.tanggal,t.nota,
                    (GROUP_CONCAT(concat(p.nama_produk,'-->',dt.qty))) as nama_produk,
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
                    WHERE  (t.tanggal BETWEEN '$xtanggalawal' AND '$xtanggalakhir') AND t.status = 0
                    GROUP BY t.id,t.tanggal,t.nota
                    ORDER BY t.id DESC,dt.id
                    ";
        // die($query);
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function detailmenunggu($id)
    {
        $query = "SELECT t.id, 
                        p.nama_produk ,
                        dt.qty ,
                        dt.harga,
                        (dt.harga * dt.qty) as subtotal 
                FROM transaksi t 
                LEFT JOIN detail_transaksi dt on dt.transaksi_id = t.id 
                LEFT JOIN produk p on p.id = dt.produk
                WHERE t.id = '$id'
                    ";
        // die($query);
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function infomenunggu($id)
    {
        $query = "SELECT t.id as idtransaksi,
                            p.id as idpelanggan,
                            p.nama as nama_pelanggan,
                            t.tanggal,t.bukti,t.nota,t.jumlah_uang	
                    FROM transaksi t 
                    LEFT JOIN pelanggan p on p.id = t.pelanggan
                    WHERE t.id = '$id'
                    ";
        // die($query);
        return $this->db->query($query)->row_array();
        echo json_encode($query);
    }
    public function totalkonfirmasi($id)
    {
        $sql = "SELECT  
                SUM(p.harga*dt.qty) as total
                FROM transaksi t 
                LEFT JOIN detail_transaksi dt on dt.transaksi_id = t.id
                LEFT JOIN produk p on p.id = dt.produk 
                WHERE t.id = '$id'
                ORDER BY p.id ASC";
        return $this->db->query($sql)->row()->total;
        echo json_encode($sql);
    }
}
