<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsPositionArchive extends Model
{
    protected $table            = 'ulspositionarchives';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'version_id','status','start_date_active','specific_experience','responsibilities','reports_to','reportees','position_type','position_org_id','position_name','position_id','position_desc','position_concate','position_code','parent_org_id','other_requirement','organization_id','modified_date','modified_by','location_id','last_modified_id','id','grade_id','experience','end_date_active','education','created_date','created_by','bu_id','accountablities',
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
