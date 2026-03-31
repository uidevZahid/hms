<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'controllers/General.php'; 

class Dashboard extends General{

	function __construct(){
		parent::__construct();	
		$this->load->model("app/dashboard_model");
		if(General::is_logged_in() == FALSE){
            redirect(base_url().'login');    
        }
		General::variable();
	}
	
	public function index(){
		$this->dashboard();	
	}
	
	public function dashboard(){
		$this->session->set_userdata(array(
				 'tab'			=>		'',
				 'module'		=>		'',
				 'subtab'		=>		'',
				 'submodule'	=>		''));
		
		// Latest data
		$this->data['latest_patient'] = $this->dashboard_model->latest_patient();		 
		$this->data['latest_visited_patient'] = $this->dashboard_model->latest_visited_patient();		 
		$this->data['getTodayAppointment'] = $this->dashboard_model->getTodayAppointment();		 
		
		// Key metrics
		$this->data['total_patients'] = $this->dashboard_model->getTotalPatients();
		$this->data['today_appointments'] = $this->dashboard_model->getTodayAppointmentsCount();
		$this->data['today_visits'] = $this->dashboard_model->getTodayVisitsCount();
		$this->data['total_doctors'] = $this->dashboard_model->getTotalDoctors();
		
		// Chart data
		$this->data['appointments_by_status'] = json_encode($this->dashboard_model->getAppointmentsByStatus());
		$this->data['visits_by_department'] = json_encode($this->dashboard_model->getVisitsByDepartment());
		$this->data['monthly_trend'] = json_encode($this->dashboard_model->getMonthlyAppointmentTrend());
		$this->data['recent_activities'] = $this->dashboard_model->getRecentActivities();
		$this->data['hospital_contact'] = $this->dashboard_model->getHospitalContact();
				 
		$this->load->view('app/dashboard',$this->data);	
	}
	
}