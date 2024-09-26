<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsAssessmentDefinition extends Model
{
    protected $table            = 'ulsassessmentdefinitions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'start_date','self_ass_type','rating_id','parent_org_id','modified_date','modified_by','location_id','last_modified_by','lang_id','feedback','end_date','created_date','created_by','broadcast','assessor_process','assessment_type','assessment_status','assessment_name','assessment_id','assessment_desc','assessment_cycle_type','ass_pro_selection','ass_pro_count','ass_pos_view','ass_methods','ass_comp_selection','ass_comp_count','ass_broadcast',
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
