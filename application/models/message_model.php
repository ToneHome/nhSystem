<?php 

class Message_model extends CI_Model {

	public function __construct()
	{
	    parent::__construct();
	    // Your own constructor code
	}
	public function save($data)
	{
		$this->db->insert('message', $data);
		if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }

        	return FALSE;
	}


}
?>
