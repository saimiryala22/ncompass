<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsEmployeeWorkInfo extends Model
{
    protected $table            = 'uls_employee_work_info';
    protected $primaryKey       = 'work_info_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'zone_id','work_info_id','total_ctc','to_date','supervisor_id','sub_grade_id','status','state_id','position_id','payroll_id','parent_org_id','parent_dep_id','org_id','net_salary','modified_by','manager_flag','location_id','last_modified_id','gross_salary','grade_id','from_date','employee_id','division_id','created_by','bu_id',
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

    static function getEmpPositionDetails($emp_ids){
        $db= \Config\Database::connect();
		$query="SELECT a.* from uls_employee_work_info a where a.employee_id=".$emp_ids;
		$query=$db->query($query);
        return $query->getRow();
	}
}
