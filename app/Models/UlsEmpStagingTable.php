<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsEmpStagingTable extends Model
{
    protected $table            = 'uls_emp_staging_table';
    protected $primaryKey       = 'staging_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'work_info_id','title','status','staging_id','position_id','phone','parent_org_id','org_id','location_id','joining_date','grade_id','gendar','employee_id','emp_status','emp_number','emp_name','email',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
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

    static function getEmpStageDetails($emp_ids){
		$db= \Config\Database::connect();
		$query="SELECT a.* from uls_emp_staging_table a where a.employee_id=".$emp_ids;
		$query=$db->query($query);
        return $query->getResultArray();
	}
}
