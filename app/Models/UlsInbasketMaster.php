<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsInbasketMaster extends Model
{
    protected $table            = 'ulsinbasketmasters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'position_id','parent_org_id','modified_date','modified_by','last_modified_by','inbasket_upload','inbasket_tray_name','inbasket_time_period','inbasket_status','inbasket_scorting_order','inbasket_reason','inbasket_narration_lang','inbasket_narration','inbasket_name','inbasket_instructions','inbasket_id','inbasket_action','created_date','created_by',
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
