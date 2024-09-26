<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Session\Session;
use Config\Database;

class UlsEmployeeMaster extends Model
{
    protected $table            = 'uls_employee_master';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'title','start_date','previous_exp','photo','parent_org_id','office_number','nationality','modified_date','modified_by','middle_name','last_name','last_modified_id','gender','full_name','first_name','employee_number','employee_id','emp_type','emp_cat','email','edu_qualification','date_of_joining','date_of_exit','date_of_birth','current_employee_flag','created_date','created_by','country','additional_info',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $session;

    public function __construct()
    {
        // Initialize the parent constructor
        parent::__construct();

        // Get the session instance
        $this->session = service('session');

        $this->db = Database::connect();
    }

    public static function getempdetails($empid){
        $parent_org_id = session()->get('parent_org_id');
        $db= \Config\Database::connect();
		$emp_dat="SELECT * FROM `employee_data` WHERE `employee_id` =".$empid." and `parent_org_id` =".$parent_org_id;
        $emp_dat=$db->query($emp_dat);
        return $emp_dat->getRow();
	}

    public static function get_supervisor_id($emp_id){
        $db= \Config\Database::connect();
        $emp_photo="SELECT * FROM `uls_employee_work_info` WHERE `employee_id` =".$empid." and `status` ='A'";
        $emp_photo=$db->query($emp_photo);
        return $emp_photo->getRow();
    }

    public static function get_admin_location($location){
        $db= \Config\Database::connect();
	    if(!empty($location)){
            $location="SELECT * FROM `uls_location` WHERE `location_id` =".$location;
            $location=$db->query($location);
            return $location->getRow();
		}
    }

    static function get_orga_name($orga_name){
        $db= \Config\Database::connect();
        $org_name="SELECT * FROM `uls_organization_master` WHERE `organization_id` =".$orga_name;
        $org_name=$db->query($org_name);
        return $org_name->getRow();
		
	}

    static  function get_org_id($emp_org_id){
        $db= \Config\Database::connect();
		if(!empty($emp_org_id)){
            $org_id="SELECT * FROM `uls_employee_work_info` WHERE `employee_id` =".$emp_org_id." and status='A'";
            $org_id=$db->query($org_id);
            return $org_id->getRow();
		}
	}
}
