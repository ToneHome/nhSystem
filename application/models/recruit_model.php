<?php 

class Recruit_model extends CI_Model {

	public function __construct()
	{
	    parent::__construct();
	    // Your own constructor code
	}
	
	public function getRecruit($type)
	{
		$sql = "select a.*,b.`name` as cityname,c.`name` as jobname from recruitment_info a
            left join city b on a.City = b.id 
            left join job_type c on a.cRtype = c.id
            where a.Rtype = ".$type." and Status ='1' 
            order by Id desc ";
		$query  = $this->db->query($sql)->result();
        $recruitInfo['info'] = array();
            foreach ($query as $key => $value) {
                # code... object->array
                $value = (array)$value;
                $recruitInfo['info'][$key] = $value;
            }
        // $rs = $querys;
		$citySql = "select a.City,b.`name` from recruitment_info a
				left JOIN city b on a.City = b.id
				where a.Rtype = ".$type." and Status ='1' 
				group by 1,2 ";
		$query  = $this->db->query($citySql)->result();
        $recruitInfo['cityInfo'] = array();
            foreach ($query as $key => $value) {
                # code... object->array
                $value = (array)$value;
                $recruitInfo['cityInfo'][$key] = $value;
            }
		$typesql = "select a.cRtype,b.`name` from recruitment_info a
				left JOIN job_type b on a.cRtype = b.id
				where a.Rtype = ".$type." and Status ='1' 
				group by 1,2";
		// $recruitInfo['typeInfo'] = $this->db->query($typesql)->result();
		$query  = $this->db->query($typesql)->result();
        $recruitInfo['typeInfo'] = array();
            foreach ($query as $key => $value) {
                # code... object->array
                $value = (array)$value;
                $recruitInfo['typeInfo'][$key] = $value;
            }
		return $recruitInfo;

	}

	public function filterRecruit($data)
	{
		$city = $data['city'];
		$type = $data['type'];
		$ntype = $data['ntype'];
		$totype = $ntype=='school'?'2':'3';
		$sql = "select a.*,b.`name` as cityname,c.`name` as jobname from recruitment_info a
	            left join city b on a.City = b.id 
	            left join job_type c on a.cRtype = c.id where  a.Rtype = ".$totype." ";

	    if($city != "0"){
	    	$sql = $sql." and a.City = ".$city;
	    }
	    if($type !="0"){
	    	$sql = $sql." and a.cRtype = ".$type;
	    }
    	$sql = $sql." order by Id desc ";
    	
    	$query  = $this->db->query($sql)->result();
        $rs = array();
        foreach ($query as $key => $value) {
            $value = (array)$value;
            $rs[$key] = $value;
        }
        return $rs;

	}

	public function getAll($page=1,$limit=10)
	{
		$starSize=($page-1)*$limit;
        $endSize=$limit;
		$sql = "select a.*,b.`name` as cityname,c.`name` as jobname from recruitment_info a
            left join city b on a.City = b.id 
            left join job_type c on a.cRtype = c.id
            order by Id desc limit ".$starSize.",".$endSize."";
        $query  = $this->db->query($sql)->result();
        $rs = array();
        foreach ($query as $key => $value) {
            $value = (array)$value;
            $rs[$key] = $value;
        }
        return $rs;
	}

	public function save($data)
	{
		$data['ShowDate']="1990-01-01";
        if(!isset($data['Status']))
        {
             $data['Status']=0;
        }
        if($data['Status'])
        {
             $data['ShowDate']= date('Y-m-d',time());
        }
        $data['CreateTime'] = date('Y-m-d',time());

       	if(isset($data['Id'])&&is_numeric($data['Id'])){
       		$id = $data['Id'];
       		unset($data['Id']);
       		$this->db->update('recruitment_info',$data,array('Id'=>$id));
       	}
       	else{
       		$this->db->insert('recruitment_info', $data);
       	}
        
		if ($this->db->affected_rows() > 0)
	    {
	        return TRUE;
	    }

	    	return FALSE;
	}

	public function getDetail($id)
	{
		$this->db->select('*')
                 ->from('recruitment_info')
                 ->where('Id', $id);
        $result = $this->db->get()->result_array();;
        return $result;
	}

	public function getTotal(){
		$sql = "select count(1) as num from recruitment_info";
        $query  = $this->db->query($sql)->result();
        $rs = array();
        foreach ($query as $key => $value) {
            $value = (array)$value;
            $rs[$key] = $value;
        }
        return $rs;
	}

	public function deleteOne($id='')
	{
		 $this->db->delete('recruitment_info',array('Id'=>$id));
	}


}
 ?>
