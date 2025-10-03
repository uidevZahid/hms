<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Benchmark class object
	 *
	 * @var	object
	 */
	public $benchmark;

	/**
	 * CI_Hooks class object
	 *
	 * @var	object
	 */
	public $hooks;

	/**
	 * CI_Config class object
	 *
	 * @var	object
	 */
	public $config;

	/**
	 * CI_Utf8 class object
	 *
	 * @var	object
	 */
	public $uni;

	/**
	 * CI_Utf8 class object (alternative name)
	 *
	 * @var	object
	 */
	public $utf8;

	/**
	 * CI_URI class object
	 *
	 * @var	object
	 */
	public $uri;

	/**
	 * CI_Router class object
	 *
	 * @var	object
	 */
	public $router;

	/**
	 * CI_Output class object
	 *
	 * @var	object
	 */
	public $output;

	/**
	 * CI_Security class object
	 *
	 * @var	object
	 */
	public $security;

	/**
	 * CI_Input class object
	 *
	 * @var	object
	 */
	public $input;

	/**
	 * CI_Lang class object
	 *
	 * @var	object
	 */
	public $lang;

	/**
	 * CI_Loader class object
	 *
	 * @var	object
	 */
	public $load;

	/**
	 * CI_Log class object
	 *
	 * @var	object
	 */
	public $log;

	/**
	 * CI_Session class object
	 *
	 * @var	object
	 */
	public $session;

	/**
	 * CI_DB_driver class object (database)
	 *
	 * @var	object
	 */
	public $db;

	/**
	 * CI_Form_validation class object
	 *
	 * @var	object
	 */
	public $form_validation;

	/**
	 * CI_Pagination class object
	 *
	 * @var	object
	 */
	public $pagination;

	/**
	 * CI_Table class object
	 *
	 * @var	object
	 */
	public $table;

	/**
	 * CI_Email class object
	 *
	 * @var	object
	 */
	public $email;

	/**
	 * CI_Upload class object
	 *
	 * @var	object
	 */
	public $upload;

	/**
	 * General_model class object
	 *
	 * @var	object
	 */
	public $general_model;

	/**
	 * Login_model class object
	 *
	 * @var	object
	 */
	public $login_model;

	/**
	 * Profile_model class object
	 *
	 * @var	object
	 */
	public $profile_model;

	/**
	 * Dashboard_model class object
	 *
	 * @var	object
	 */
	public $dashboard_model;

	/**
	 * Billing_model class object
	 *
	 * @var	object
	 */
	public $billing_model;

	/**
	 * Opd_model class object
	 *
	 * @var	object
	 */
	public $opd_model;

	/**
	 * Patient_model class object
	 *
	 * @var	object
	 */
	public $patient_model;

	/**
	 * Bill_history_model class object
	 *
	 * @var	object
	 */
	public $bill_history_model;

	/**
	 * Appointment_model class object
	 *
	 * @var	object
	 */
	public $appointment_model;

	/**
	 * Room_master_model class object
	 *
	 * @var	object
	 */
	public $room_master_model;

	/**
	 * Ipd_model class object
	 *
	 * @var	object
	 */
	public $ipd_model;

	/**
	 * Room_category_model class object
	 *
	 * @var	object
	 */
	public $room_category_model;

	/**
	 * Room_bed_master_model class object
	 *
	 * @var	object
	 */
	public $room_bed_master_model;

	/**
	 * Doctor_model class object
	 *
	 * @var	object
	 */
	public $doctor_model;

	/**
	 * User_model class object
	 *
	 * @var	object
	 */
	public $user_model;

	/**
	 * Roles_model class object
	 *
	 * @var	object
	 */
	public $roles_model;

	/**
	 * Department_model class object
	 *
	 * @var	object
	 */
	public $department_model;

	/**
	 * Designation_model class object
	 *
	 * @var	object
	 */
	public $designation_model;

	/**
	 * Group_name_model class object
	 *
	 * @var	object
	 */
	public $group_name_model;

	/**
	 * Particular_bills_model class object
	 *
	 * @var	object
	 */
	public $particular_bills_model;

	/**
	 * Complain_model class object
	 *
	 * @var	object
	 */
	public $complain_model;

	/**
	 * Diagnosis_model class object
	 *
	 * @var	object
	 */
	public $diagnosis_model;

	/**
	 * Surgery_model class object
	 *
	 * @var	object
	 */
	public $surgery_model;

	/**
	 * Insurance_company_model class object
	 *
	 * @var	object
	 */
	public $insurance_company_model;

	/**
	 * Drug_name_model class object
	 *
	 * @var	object
	 */
	public $drug_name_model;

	/**
	 * Medicine_category_model class object
	 *
	 * @var	object
	 */
	public $medicine_category_model;

	/**
	 * Reports_model class object
	 *
	 * @var	object
	 */
	public $reports_model;

	/**
	 * Parameters_model class object
	 *
	 * @var	object
	 */
	public $parameters_model;

	/**
	 * Backup_model class object
	 *
	 * @var	object
	 */
	public $backup_model;

	/**
	 * Pages_model class object
	 *
	 * @var	object
	 */
	public $pages_model;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
