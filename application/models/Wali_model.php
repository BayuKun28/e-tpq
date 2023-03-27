<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali_model extends CI_Model
{
    var $table = 'wali';
	var $colum_search_santri = array('wali.id','wali.nama','wali.alamat','wali.no_hp');

    private function _get_datatables_query()
	{
		$this->db->select('wali.*');
		$this->db->from('wali');
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
		$this->db->order_by('wali.id', 'desc');
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
}
