<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = '上海融为信息科技有限公司';
		$this->load->view('index',$data);
	}

	public function allUser()
	{
		echo json_encode(array('action'=>'allUser'));
	}

	public function getUser($id){
		echo json_encode(array('id'=>$id,'action'=>'getUser'));
	}

	public function allWin()
	{
		echo json_encode(array('action'=>'allWin'));
	}

	public function win(){
		echo json_encode(array('action'=>'win'));
	}
}
