<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri_model extends CI_Model
{
    var $table = 'santri';
	var $colum_search_santri = array('santri.id','santri.nama','santri.tanggal_lahir','santri.alamat','santri.jk','wali.nama');

    private function _get_datatables_query()
	{
		$this->db->select('santri.*,wali.nama as namawali');
		$this->db->from('santri');
        $this->db->join('wali', 'santri.id_wali = wali.id' , 'left' );
		$i = 0;
		foreach ($this->colum_search_santri as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->colum_search_santri) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}


	}
    function get_datatables(){
		$this->db->order_by('santri.id', 'desc');
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
    public function getwali($a)
    {
        $query = "SELECT id ,nama from wali WHERE nama LIKE '%$a%' AND is_active = 1";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getsantri($a)
    {
        $query = "SELECT id ,nama from santri WHERE nama LIKE '%$a%' AND is_active = 1";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getbulan($a)
    {
        $query = "SELECT id ,nama from bulan WHERE nama LIKE '%$a%'";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }

	public function getbulanbyid($a)
    {
        $query = "SELECT id ,nama from bulan WHERE id = $a";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }

    public function getautowali($santri)
    {
        $query = "SELECT w.nama as namawali FROM santri s JOIN wali w on w.id = s.id_wali WHERE s.id = '$santri' ";
        return $this->db->query($query)->result_array();
        echo json_encode($query);
    }
    public function getwaliwa($santri)
    {
        $query = "SELECT s.nama as namasantri,w.nama as namawali , w.no_hp FROM santri s JOIN wali w on w.id = s.id_wali WHERE s.id = '$santri' ";
        return $this->db->query($query)->row();
    }
    public function getbulana($bulan)
    {
        $query = "SELECT * FROM bulan WHERE id = '$bulan' ";
        return $this->db->query($query)->row();
    }
	public function detail($id)
	{
		$query = "SELECT s.*, w.nama as namawali FROM santri s LEFT JOIN wali w on w.id = s.id_wali WHERE s.id = $id";
		return $this->db->query($query)->row_array();
	}
	public function getpembayaran($id)
	{
		$query = "SELECT p.*,b.nama as namabulan FROM pembayaran p LEFT JOIN bulan b on b.id = p.bulan WHERE p.id = '$id' ";
        return $this->db->query($query)->row();
	}
}
