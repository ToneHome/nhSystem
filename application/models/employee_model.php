<?php 

class Employee_model extends CI_Model {

	public function __construct()
	{
	    parent::__construct();
	    // Your own constructor code
	}
    public function allUser()
	{
		
		$sql = "select * from empolyee 
            order by id asc ";
        $query  = $this->db->query($sql)->result();
        $rs = array();
        foreach ($query as $key => $value) {
            $value = (array)$value;
            $rs[$key] = $value;
        }
        return $rs;
	}

    	public function getDetail($id)
	{
		$this->db->select('*')
                 ->from('empolyee')
                 ->where('id', $id);
        $result = $this->db->get()->result_array();;
        return $result;
	}

	public function getTotal(){
		$sql = "select count(1) as num from content";
        $query  = $this->db->query($sql)->result();
        $rs = array();
        foreach ($query as $key => $value) {
            $value = (array)$value;
            $rs[$key] = $value;
        }
        return $rs;
	}

    public function save($data){
        if(!isset($data['status']))
        {
             $data['status']=0;
        }

        $data['addTime'] = time();

       	if(isset($data['id'])&&is_numeric($data['id'])){
       		$id = $data['id'];
       		unset($data['id']);
       		$this->db->update('content',$data,array('id'=>$id));
       	}
       	else{
       		$this->db->insert('content', $data);
       	}
        
		if ($this->db->affected_rows() > 0)
	    {
	        return TRUE;
	    }

	    	return FALSE;
	}
	public function deleteOne($id='')
	{
		 $this->db->delete('content',array('id'=>$id));
	}

}
?>
