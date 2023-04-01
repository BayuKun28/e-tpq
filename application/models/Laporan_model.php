<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    var $table = 'pembayaran';
	var $colum_search_santri = array('p.id,s.id as idsantri, s.nama as namasantri,p.tanggal_pembayaran,p.nominal,p.bulan as idbulan,b.nama as namabulan,p.tahun,p.keterangan');

    private function _get_datatables_query()
	{
		$this->db->select('p.id,s.id as idsantri, s.nama as namasantri,p.tanggal_pembayaran,p.nominal,p.bulan as idbulan,b.nama as namabulan,p.tahun,p.keterangan ');
		$this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.id_santri' , 'left' );
        $this->db->join('bulan b', 'b.id = p.bulan' , 'left' );
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
    function get_datatables($tglawal,$tglakhir){
        $this->db->where('p.tanggal_pembayaran >=',$tglawal);
        $this->db->where('p.tanggal_pembayaran <=',$tglakhir);
		$this->db->order_by('p.tanggal_pembayaran', 'asc');
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
    public function cetakpdf($tglawal,$tglakhir)
    {
        $query = "SELECT p.id,s.id as idsantri, s.nama as namasantri,p.tanggal_pembayaran,p.nominal,p.bulan as idbulan,b.nama as namabulan,p.tahun,p.keterangan 
                FROM pembayaran p
                JOIN santri s on s.id = p.id_santri
                JOIN bulan b on b.id = p.bulan
                WHERE p.tanggal_pembayaran BETWEEN '".$tglawal."' AND '".$tglakhir."'
                ORDER BY p.tanggal_pembayaran, p.id";
        return $this->db->query($query)->result_array();   
    }
}
