<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsSelfAssessmentReportDevArea extends Model
{
    protected $table            = 'ulsselfassessmentreportdevareas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'assessment_id','created_by','created_date','employee_id','knowledge_dev','last_modified_by','leverage','long_term_goals','man_knowledge_dev','man_leverage','man_long_term_goals','man_medium_term_goals','man_reporting','man_review','man_short_term_goals','man_skill_dev','manager_id','medium_term_goals','modified_by','modified_date','parent_org_id','position_id','reporting','review','self_dev_report_id','short_term_goals','skill_dev',
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
