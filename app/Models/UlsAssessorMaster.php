<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsAssessorMaster extends Model
{
    protected $table            = 'ulsassessormasters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'user_id','start_date','premission_to_add_quest','parent_org_id','modified_date','modified_by','last_modified_by','end_date','employee_id','created_date','created_by','assessor_type','assessor_status','assessor_prev_org_name','assessor_photo','assessor_name','assessor_mobile','assessor_linkedin_profile','assessor_id','assessor_experience','assessor_email','assessor_brief','assessor_add_role',
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
