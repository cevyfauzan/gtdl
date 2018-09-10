<?php
class Get_log extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save_user_log($param)
    {
        $sql = $this->db->insert_string('Get_user_log',$param);
        $ex = $this->db->query($sql);
        return $this->db->affected_rows($sql);
	}
}
?>