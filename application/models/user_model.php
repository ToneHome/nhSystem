<?php 

class User_model extends CI_Model {

	public function __construct()
	{
	    parent::__construct();
	    // Your own constructor code
	}

	public function getUser($name)
	{
		$this->db->select('*')
                 ->from('admin_user')
                 ->where('username', $name);
        $result = $this->db->get()->result_array();;
        if(count($result)==0){
        	return false;
        }
        else{
        	return $result[0];
        }
        
	}


}
?>
