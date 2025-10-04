<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'controllers/General.php'; 

class Appointment extends General{

	private $limit = 10;

	public function __construct(){
		parent::__construct();
		$this->load->model("app/appointment_model");
		$this->load->model("app/patient_model");
		$this->load->model("general_model");
		if(General::is_logged_in() == FALSE){
            redirect(base_url().'login');    
        }
		General::variable();	
		
		$this->lang->load("message","english");
		
	}
	
	public function index(){
		// user restriction function
		$this->session->set_userdata('page_name','appointment');
		$page_id = $this->general_model->getPageID();
		//die(print_r($page_id,true));
		$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
		if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
			redirect(base_url().'access_denied');
		}
		// end of user restriction function
				
		$this->session->set_userdata(array(
				 'tab'			=>		'appointment',
				 'module'		=>		'add_appointment',
				 'subtab'		=>		'',
				 'submodule'	=>		''));
		
		$this->patient_master();
	}

	public function addAppointmentList($offset = 0){
		// user restriction function
		$this->session->set_userdata('page_name','add_appointment');
		$page_id = $this->general_model->getPageID();
		//die(print_r($page_id,true));
		$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
		if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
			redirect(base_url().'access_denied');
		}
		// end of user restriction function


		//pass value to session
		$this->session->set_userdata("search_patient_master",$this->input->post('search'));	

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		$patient = $this->appointment_model->addAppGetAll($this->limit, $offset);
		
		$config['base_url'] = base_url().'app/appointment/addAppointmentList/';
 		$config['total_rows'] = $this->appointment_model->addAppGetAllCount();
 		$config['per_page'] = $this->limit;
		
		
		$config['uri_segment'] = $uri_segment;
		$config['full_tag_open'] = '<ul class="pagination pagination no-margin pull-right">';
		$config['full_tag_close'] = '</ul><!--pagination-->';

		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
	
		$tmpl = array('table_open' => '<table class="table table-hover table-striped">');
        $this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Patient No', 'Patient Name','Action');
		$i = 0 + $offset;
		
		
		foreach ($patient as $patient)
		{	
				$this->table->add_row( 
									anchor('app/patient/view/'.$patient->patient_no,$patient->patient_no),
									$patient->name, 
									anchor('app/appointment/addAppointment/'.$patient->patient_no,'Make Appointment')
									//anchor('app/patient/delete/'.$patient->patient_no,'Delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete?')"))
			);
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['table'] = $this->table->generate();

		$this->load->view('app/appointment/pickPatient',$this->data);	
	}
	
	public function patient_master($offset = 0){
		//pass value to session
		$this->session->set_userdata("search_patient_master",$this->input->post('search'));	

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		$patient = $this->appointment_model->getAllAppointment($this->limit, $offset);
		
		$config['base_url'] = base_url().'app/appointment/index/';
 		$config['total_rows'] = $this->appointment_model->getAllAppointmentCount();
 		$config['per_page'] = $this->limit;
		
		
		$config['uri_segment'] = $uri_segment;
		$config['full_tag_open'] = '<ul class="pagination pagination no-margin pull-right">';
		$config['full_tag_close'] = '</ul><!--pagination-->';

		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
	
		$tmpl = array('table_open' => '<table class="table table-hover table-striped">');
        $this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Patient No', 'Patient Name','Date Appointment','Consultant Doctor','Status','Date Visited','Action');
		$i = 0 + $offset;
		
		
		foreach ($patient as $patient)
		{	
			if(date('M d, Y H:i:s',strtotime($patient->dateVisit)) == "Jan 01, 1970 08:00:00")
			{
				$dateVisit = "-";
			}else{
				$dateVisit = date('M d, Y',strtotime($patient->dateVisit));
			}

			if($patient->appointmentStatus == "D")
			{
				//$options = anchor('app/patient/edit/'.$patient->patient_no,'View EMR').'&nbsp|&nbsp;';
				$options = "";
			}
			else
			{
				$options = anchor('app/appointment/editAppointment/'.$patient->appID,'Edit').'&nbsp|&nbsp;'.
							anchor('app/appointment/checkInApp/'.$patient->appID,'Check IN',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to Check IN this Patient?')")).'&nbsp|&nbsp;';
			}

			if($patient->appointmentStatus == "A"){
				$status = "In Coming";
			}else if($patient->appointmentStatus == "D"){
				$status = "Done";
			}



				$this->table->add_row( 
									anchor('app/patient/view/'.$patient->patient_no,$patient->patient_no),
									$patient->name, 
									date('M d, Y',strtotime($patient->appointmentDate))." ".$patient->appHour.":".$patient->appMinutes." ".$patient->appAMPM,
									$patient->consultantDoctor, 
									$status,
									$dateVisit, 
									$options.
									anchor('app/appointment/delete/'.$patient->appID,'Delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete?')"))
			
					
			
			
			);
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['table'] = $this->table->generate();

		$this->load->view('app/appointment/index',$this->data);	
	}

	public function checkInApp($id){
				// user restriction function
				$this->session->set_userdata('page_name','checkIN_appointment');
				$page_id = $this->general_model->getPageID();
				$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
				if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
					redirect(base_url().'access_denied');
				}
				// end of user restriction function
			
		$this->appointment_model->checkInApp($id);
		
		$value = $id;
		General::logfile('Patient Appointment','CHECK IN',$value);
				
		$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Patient Appointment successfully Checked IN!</div>");
			
		//redirect
		redirect(base_url().'app/appointment',$this->data);
	}

	public function delete($id){
				// user restriction function
				$this->session->set_userdata('page_name','delete_appointment');
				$page_id = $this->general_model->getPageID();
				$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
				if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
					redirect(base_url().'access_denied');
				}
				// end of user restriction function
			
		$this->appointment_model->delete($id);
		
		$value = $id;
		General::logfile('Patient Appointment','DELETED',$value);
				
		$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Patient Appointment successfully Deleted!</div>");
			
		//redirect
		redirect(base_url().'app/appointment',$this->data);
	}

	public function editAppointment($id = 0){
		if(isset($_POST['btnSubmit'])){
			
			$this->edit_save();
			
		}else{
			// user restriction function
				$this->session->set_userdata('page_name','edit_appointment');
				$page_id = $this->general_model->getPageID();
				$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
				if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
					redirect(base_url().'access_denied');
				}
				// end of user restriction function
				
			$this->data['patientInfo'] = $this->appointment_model->editPatientAppt($id); 
			$this->load->view("app/appointment/editAppointment",$this->data);	
		}
	}
	
	public function view($id){
		$this->data['patientInfo'] = $this->patient_model->getPatientInfo($id);
		$this->load->view("app/patient/view",$this->data);
	}
	
	public function addPatient(){
		// user restriction function
		$this->session->set_userdata('page_name','add_new_patient');
		$page_id = $this->general_model->getPageID();
		$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
		if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
			redirect(base_url().'access_denied');
		}
		// end of user restriction function
		
		$this->session->set_userdata(array(
				 'tab'			=>		'patient',
				 'module'		=>		'add_new_patient',
				 'subtab'		=>		'',
				 'submodule'	=>		''));
				 
				 
		$this->data['lastPatientID'] = $this->patient_model->lastPatientID();
		
		$this->load->view("app/appointment/addNewAppointment",$this->data);
	}
	
	function validate_patient(){
		if($this->patient_model->validate_patient()){
			$this->form_validation->set_message("validate_patient","Patient Already Exists.");
			return false;
		}else{
			return true;
		}
	}
	
	function validate_email(){
		if($this->patient_model->validate_email()){
			$this->form_validation->set_message("validate_email","Email Address Already Exists.");
			return false;
		}else{
			return true;
		}
	}
	
	public function save(){
		$this->form_validation->set_rules("patientID","Patient ID","trim|xss_clean|required");
		$this->form_validation->set_rules("mode","Mode","trim|xss_clean|required");
		$this->form_validation->set_rules("title","Title Name","trim|xss_clean|required");
		$this->form_validation->set_rules("lastname","Last Name","trim|xss_clean|required");
		$this->form_validation->set_rules("firstname","First Name","trim|xss_clean|required");	
		$this->form_validation->set_rules("middlename","Middle Name","trim|xss_clean|required");	
		$this->form_validation->set_rules("gender","Gender","trim|xss_clean|required");	
		$this->form_validation->set_error_delimiters("<div class='alert alert-warning alert-dismissable'><i class='fa fa-warning'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>","</div>");
	
		if($this->form_validation->run()){
			
			//save the data
			$this->appointment_model->save();
			
			if($this->input->post('mode') == "new")
			{
				//update employeeID autonumber();	
				$this->appointment_model->updateAutoNum();
			}
			
			
			//logfile
			$value = $this->input->post('firstname')." ".$this->input->post('middlename')." ".$this->input->post('lastname');
			General::logfile('Appointment Registration','INSERT',$value);
			
			$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Patient successfully Added to Appointment List!</div>");
			
			//redirect
			redirect(base_url().'app/appointment',$this->data);
			
			
		}else{
			$this->addPatient();	
		}	
	}

	public function editAppointmentSave(){
		$this->form_validation->set_rules("id","Patient ID","trim|xss_clean|required");
		$this->form_validation->set_rules("dateAppointment","Appointment Date","trim|xss_clean|required");
		$this->form_validation->set_rules("appHour","Appointment Hour","trim|xss_clean|required");
		$this->form_validation->set_rules("appMinutes","Appointment Minutes","trim|xss_clean|required");
		$this->form_validation->set_rules("appAMPM","Appointment AM/PM","trim|xss_clean|required");	
		$this->form_validation->set_rules("consultantDoctor","Consultant Doctor","trim|xss_clean|required");	
		$this->form_validation->set_rules("appointmentReason","Reason","trim|xss_clean|required");	
		$this->form_validation->set_error_delimiters("<div class='alert alert-warning alert-dismissable'><i class='fa fa-warning'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>","</div>");
	
		if($this->form_validation->run()){
			
			//save the data
			$this->appointment_model->updateAppointment();
			
			
			//logfile
			$value = $this->input->post('firstname')." ".$this->input->post('middlename')." ".$this->input->post('lastname');
			General::logfile('Appointment Registration','UPDATED',$value);
			
			$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Patient Appointment successfully Updated!</div>");
			
			//redirect
			redirect(base_url().'app/appointment',$this->data);
			
			
		}else{
			$this->editAppointment($this->input->post('id'));	
		}	
	}


	
	public function addAppointment($id = 0){
		if(isset($_POST['btnSubmit'])){
			
			$this->edit_save();
			
		}else{
			// user restriction function
				$this->session->set_userdata('page_name','modiffy_patient');
				$page_id = $this->general_model->getPageID();
				$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
				if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
					redirect(base_url().'access_denied');
				}
				// end of user restriction function
				
			$this->data['patientInfo'] = $this->patient_model->getPatient($id); 
			$this->data['mode'] = "pickup";
			// $this->load->view('app/patient/editPatient',$this->data);
			$this->load->view("app/appointment/addNewAppointment",$this->data);	
		}
	}
	
	function validate_patient_edit(){
		if($this->patient_model->validate_patient_edit()){
			$this->form_validation->set_message("validate_patient_edit","Patient Already Exists.");
			return false;
		}else{
			return true;
		}
	}
	
	function validate_email_edit(){
		if($this->patient_model->validate_email_edit()){
			$this->form_validation->set_message("validate_email_edit","Email Address Already Exists.");
			return false;
		}else{
			return true;
		}
	}
	
	public function edit_save(){
		$this->form_validation->set_rules("lastname","Last Name","trim|xss_clean|required|callback_validate_patient_edit");
		$this->form_validation->set_rules("firstname","First Name","trim|xss_clean|required");	
		$this->form_validation->set_rules("middlename","Middle Name","trim|xss_clean|required");	
		$this->form_validation->set_rules("email","Email Address","trim|xss_clean|valid_email|callback_validate_email_edit");	
		$this->form_validation->set_error_delimiters("<div class='alert alert-warning alert-dismissable'><i class='fa fa-warning'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>","</div>");
	
		if($this->form_validation->run()){
			
			//save the data
			$this->patient_model->update();
			
			//logfile
			$value = $this->input->post('firstname')." ".$this->input->post('middlename')." ".$this->input->post('lastname');
			General::logfile('Patient Management','UPDATE',$value);
			
			$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Patient successfully Updated!</div>");
			
			//redirect
			redirect(base_url().'app/patient',$this->data);
			
			
		}else{
			// user restriction function
				$this->session->set_userdata('page_name','modiffy_patient');
				$page_id = $this->general_model->getPageID();
				$userRole = $this->general_model->getUserLoggedIn($this->session->userdata('username'));
				if(General::has_rights_to_access($page_id->page_id,$userRole->user_role) == FALSE){
					redirect(base_url().'access_denied');
				}
				// end of user restriction function
				
			$this->data['patientInfo'] = $this->patient_model->getPatient($this->input->post('id')); 
			$this->load->view('app/patient/editPatient',$this->data);	
		}	
	}
	
	public function attachment($id){
		$this->data['patientAttachment'] = $this->patient_model->getPatientAttachment($id); 
		$this->data['patient_no'] = $id;
		$this->data['error'] = "";
		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('app/patient/attachment',$this->data);	
	}
	
	public function remove_attachment(){
		$attach_id = $this->uri->segment("4");
		$patient_no = $this->uri->segment("5");	
		
		
		
		$this->db->where('attach_id',$attach_id);
		$this->data = array("InActive"=>"1");
		$this->db->update("patient_attachment",$this->data);
		
		$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Attachment successfully removed!</div>");
		redirect(base_url().'app/patient/attachment/'.$patient_no,$this->data);
	}
	
	public function addAttachment($id){
		$this->data['patient_no'] = $id;
		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('app/patient/addAttachment',$this->data);	
	}
	
	public function upload_attachment(){
		$config = array(
					'allowed_types'		=>		'*',
					'upload_path'		=>		realpath('public/patient_attachment'),
					'max_size'			=>		3000
					);
		
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
			$this->session->set_flashdata('message',"<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$this->upload->display_errors()."</div>");
			redirect(base_url().'app/patient/addAttachment/'.$this->input->post('patient_no'),$this->data);
		}else{
			
			$image_data = $this->upload->data();
			$this->patient_model->uploadAttachment($image_data,$this->input->post('patient_no'));
			$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Attachment successfully Uploaded</div>");
			redirect(base_url().'app/patient/attachment/'.$this->input->post('patient_no'),$this->data);
		}
	}
	
	public function upload_picture($id){
		$this->data['patient_no'] = $id;
		$this->data['patient'] = $this->patient_model->getPatient($id); 
		$this->data['error'] = "";
		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('app/patient/upload_picture',$this->data);	
	}
	
	public function upload_na(){
		$config = array(
					'allowed_types'		=>		'jpg|jpeg|gif|png',
					'upload_path'		=>		realpath('public/patient_picture'),
					'max_size'			=>		2000
					);
		
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
			//$this->session->set_flashdata('message',"<div class='alert alert-block'><a class='close' data-dismiss='alert' href='#'>&times;</a>".$this->upload->display_errors()."</div>");
			$this->session->set_flashdata('message',"<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$this->upload->display_errors()."</div>");
			redirect(base_url().'app/patient/upload_picture/'.$this->input->post('patient_no'),$this->data);
		}else{
			
			$image_data = $this->upload->data();
			$this->patient_model->uploadImg($image_data,$this->input->post('patient_no'));
			$this->session->set_flashdata('message',"<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Profile successfully Uploaded</div>");
			redirect(base_url().'app/patient/upload_picture/'.$this->input->post('patient_no'),$this->data);
		}
	}
	
	
	
	
	
	
	
	
	
}