<?php
class Get_campaign extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'vicidial_campaigns';
	var $column_order = array(null,'campaign_id','campaign_name','dial_method','active',null);
	var $column_search = array('campaign_id','campaign_name','dial_method','active');
    
    private function _getCampaignQuery()
	{
		$this->db->from($this->table);
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
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function getCampaign()
	{
		$this->_getCampaignQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltCamp()
	{
		$this->_getCampaignQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllCamp()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_camp_id($campaign_id)
	{
		$this->db->from($this->table);
		$this->db->where('campaign_id',$campaign_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}
?>