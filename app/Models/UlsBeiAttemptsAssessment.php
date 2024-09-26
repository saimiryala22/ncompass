<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsBeiAttemptsAssessment extends Model
{
    protected $table            = 'ulsbeiattemptsassessments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'wrong_ans','version_number','timestamp','timee','time_extended','test_type','test_status','status','scorm_learner_attempt_id','score','performance_source','parent_org_id','modified_date','modified_by','mastery_score','last_modified_id','internal_state','instrument_id','finished_date','event_id','employee_id','elearning_object_id','created_date','created_by','correct_ans','attempt_status','attempt_id','assessment_id','admin_id','admin_bei_result','admin_bei_comment',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
}
