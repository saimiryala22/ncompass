<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsAssessmentTest extends Model
{
    protected $table            = 'ulsassessmenttests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'time_details','test_id','rating_id','position_id','per_c5','per_c4','per_c3','per_c2','per_c1','parent_org_id','no_questions','modified_date','modified_by','level','last_modified_id','lang_process','l4','l3','l2','l1','generate_test','criticality','created_date','created_by','c5','c4','c3','c2','c1','assessment_type','assessment_pos_id','assessment_id','assess_test_id','ass_start_date','ass_end_date',
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
