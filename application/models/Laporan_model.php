<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    var $table = 'pembayaran';
	// var $column_search = array('s.nama,p.tanggal_pembayaran,p.nominal,b.nama,p.tahun,p.keterangan');
	
	var $column_search = array('s.nama');

    private function _get_datatables_query()
	{
		$this->db->select('p.id,s.id as idsantri, s.nama as namasantri,p.tanggal_pembayaran,p.nominal,p.bulan as idbulan,b.nama as namabulan,p.tahun,p.keterangan ');
		$this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.id_santri' , 'left' );
        $this->db->join('bulan b', 'b.id = p.bulan' , 'left' );
		if($this->input->post('tglawal') && $this->input->post('tglakhir'))
		{
			$this->db->where('p.tanggal_pembayaran >=', $this->input->post('tglawal'));
			$this->db->where('p.tanggal_pembayaran <=', $this->input->post('tglakhir'));
		}
		$i = 0;
		foreach ($this->column_search as $item)
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

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}


	}
    function get_datatables(){
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
		$this->_get_datatables_query();
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

	var $tablebulan = 'bulan';
	// var $column_search = array('s.nama,p.tanggal_pembayaran,p.nominal,b.nama,p.tahun,p.keterangan');
	
	var $column_searchbulan = array('kk.bulan');

	private function _get_datatables_querypersantri()
	{
		if ($this->input->post('tahun') && $this->input->post('id_santri')) {
            $tahun = $this->input->post('tahun');
            $id_santri = $this->input->post('id_santri');
            $ket = "WHERE p.tahun = $tahun AND p.id_santri = $id_santri";
        }else{
            $ket="";
        }
        $query = "(SELECT x.id_pembayaran,z.id,z.id as id_bulan,z.nama as bulan,(CASE WHEN x.nominal IS NULL THEN 'Belum Dibayar' WHEN x.nominal = 0 THEN 'Belum DIbayar' ELSE 'Dibayar' END) as status, x.nominal ,x.id_santri,x.tahun,x.tanggal_pembayaran,x.keterangan
                    FROM bulan z 
                    LEFT JOIN (
                                SELECT p.id as id_pembayaran,b.id,b.nama as bulan ,p.nominal,p.id_santri,p.tahun,p.tanggal_pembayaran,p.keterangan
                                FROM bulan b 
                                LEFT JOIN pembayaran p on p.bulan = b.id
                                $ket
                                ORDER BY b.id ASC
                    ) x on x.id = z.id) kk";
		$this->db->from($query);

		$i = 0;
		foreach ($this->column_searchbulan as $item)
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

				if(count($this->column_searchbulan) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

	}
    function get_datatablespersantri(){
		$this->db->order_by('kk.id', 'ASC');
		$this->_get_datatables_querypersantri();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    public function count_filteredpersantri()
	{
		$this->_get_datatables_querypersantri();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allpersantri()
	{
		$this->_get_datatables_querypersantri();
		return $this->db->count_all_results();
	}

	public function cetakpdfpersantri($tahun,$id_santri)
    {
        $query = "SELECT * FROM (SELECT x.id_pembayaran,z.id,z.id as id_bulan,z.nama as bulan,(CASE WHEN x.nominal IS NULL THEN 'Belum Dibayar' WHEN x.nominal = 0 THEN 'Belum DIbayar' ELSE 'Dibayar' END) as status, x.nominal ,x.id_santri,x.tahun,x.tanggal_pembayaran,x.keterangan
		FROM bulan z 
		LEFT JOIN (
					SELECT p.id as id_pembayaran,b.id,b.nama as bulan ,p.nominal,p.id_santri,p.tahun,p.tanggal_pembayaran,p.keterangan
					FROM bulan b 
					LEFT JOIN pembayaran p on p.bulan = b.id
					WHERE p.tahun = $tahun AND p.id_santri = $id_santri
					ORDER BY b.id ASC
		) x on x.id = z.id) kk";
        return $this->db->query($query)->result_array();   
    }
	public function getSantri($id_santri)
	{
		$query = "SELECT * FROM santri where id = $id_santri";
		return $this->db->query($query)->row();
	}
}
