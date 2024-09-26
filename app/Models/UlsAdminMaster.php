<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsAdminMaster extends Model
{
    protected $table            = 'uls_admin_master';
    protected $primaryKey       = 'master_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'parent_org_id','modified_by','master_title','master_id','master_code','last_modified_id','description','created_by',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'modified_date';
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

    public static function get_value_names($year_code){
        $db= \Config\Database::connect();
		$query = "select mc.master_code, mv.value_code as code, mv.value_name as name from uls_admin_master mc, uls_admin_values mv where mc.master_code='".$year_code."' and mc.master_code=mv.master_code and (CURDATE() between mv.start_date and mv.end_date or (mv.start_date is null or mv.end_date is null))";
        $query=$db->query($query);
        return $query->getResultArray();      
	}
}
