<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    var $table = 'bulan';
	var $colum_search_santri = array('bulan.id','bulan.nama');

    private function _get_datatables_query()
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
		$this->db->order_by('kk.id', 'ASC');
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

	public function kwitansi($id)
	{
		$query = "SELECT p.id,p.tanggal_pembayaran,p.nominal,b.nama as bulan,p.tahun,p.keterangan,s.nama as namasantri,w.nama as namawali,w.no_hp
						FROM pembayaran p 
						JOIN santri s on s.id = p.id_santri
						JOIN wali w on w.id = s.id_wali
						JOIN bulan b on b.id = p.bulan
						WHERE p.id = $id";
		return $this->db->query($query)->row_array();
	}
}
