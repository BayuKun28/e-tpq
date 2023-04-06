<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getBulanIni()
    {
        $query = "SELECT COUNT(*) as hitung FROM pembayaran p WHERE p.bulan = month(now())";
        return $this->db->query($query)->row_array();
    }
    public function getHariIni()
    {
        $query = "SELECT COUNT(*) as hitung FROM pembayaran p WHERE cast(p.tanggal_pembayaran as date) = cast(now() as date)";
        return $this->db->query($query)->row_array();
    }
    public function getTahunIni()
    {
        $query = "SELECT COUNT(*) as hitung FROM pembayaran p WHERE tahun = YEAR(now())";
        return $this->db->query($query)->row_array();
    }
}
