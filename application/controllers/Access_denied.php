<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'controllers/General.php'; 

class Access_denied extends General{

	function __construct(){
		parent::__construct();	
		$this->load->model('general_model');
		General::variable();
	}
	
	public function index(){
		$this->load->view("access_denied",$this->data);	
	}
	
}