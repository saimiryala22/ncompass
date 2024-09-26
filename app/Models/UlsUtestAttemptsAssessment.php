<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsUtestAttemptsAssessment extends Model
{
    protected $table            = 'ulsutestattemptsassessments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'assessment_id','assessor_id','attempt_id','attempt_status','correct_ans','created_by','created_date','elearning_object_id','employee_id','end_period','event_id','finished_date','inbasket_upload','internal_state','last_modified_id','mastery_score','modified_by','modified_date','parent_org_id','performance_source','score','scorm_learner_attempt_id','start_period','status','test_id','test_status','test_type','time_extended','timee','timestamp','version_number','wrong_ans',
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
