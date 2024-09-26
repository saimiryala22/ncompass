<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsSelfAssessmentReport extends Model
{
    protected $table            = 'ulsselfassessmentreports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'target_date','strengths_desc','strengths','self_report_id','require_scale_id','position_id','parent_org_id','org_support','modified_date','modified_by','method','manager_id','manager_assessed_scale_id','man_target_date','man_strengths_desc','man_strengths','man_org_support','man_method','man_knowledge_skill','man_comp_evidence','last_modified_by','knowledge_skill','final_admin_id','employee_id','created_date','created_by','competency_id','comp_evidence_file','comp_evidence','assessment_id','assessed_scale_id','admin_assessed_scale_id',
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
