<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsUserCreation extends Model
{
    protected $table            = 'uls_user_creation';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'user_id',
		'parent_org_id',
		'employee_id',
		'vendor_id',
		'resource_def_id',
		'assessor_id',
		'user_name',
		'email_address',
		'password',
		'description',
		'password_validity_days',
		'last_login_date',
		'session_number',
		'user_login',
		'user_type',
		'start_date',
		'end_date',
		'created_by',
		'modified_by',
		'last_modified_id',
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

    public function roles()
    {
        return $this->hasMany('roles', 'App\Models\UlsUserRole');
        // $this->hasMany('propertyName', 'model', 'foreign_key', 'local_key');
    }

    static function user_info($id){
        $db= \Config\Database::connect();
		$query="select * from uls_user_creation where user_id=".$id;
		$query=$db->query($query);
        return $query->getRow();
	}
}
