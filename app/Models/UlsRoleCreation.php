<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsRoleCreation extends Model
{
    protected $table            = 'uls_role_creation';
    protected $primaryKey       = 'role_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'system_menu_type','start_date','security_org','secure_profile_id','role_name','role_int_name','role_id','role_code','report_group_id','parent_org_id','modified_by','menu_id','last_modified_id','hierarchy_id','end_date','created_by','comment',
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


    static function getAllRoles(){
        $db= \Config\Database::connect();
        $parent_org_id = session()->get('parent_org_id');
        $role="SELECT * FROM `uls_role_creation` WHERE `parent_org_id` =".$parent_org_id;
        $role=$db->query($role);
        return $role->getResultArray();
		
	}
}
