<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsCompetencyDefinition extends Model
{
    protected $table            = 'uls_competency_definition';
    protected $primaryKey       = 'comp_def_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'parent_org_id','modified_by','last_modified_by','created_by','competency_type','comp_structure','comp_def_sub_category','comp_def_status','comp_def_short_desc','comp_def_name_alt','comp_def_name','comp_def_level','comp_def_key_indicator','comp_def_key_coverage','comp_def_id','comp_def_category','comp_def_add_category','bu_id',
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


    static function competency_dashdetails($type="",$con=""){
		$db= \Config\Database::connect();
        $parent_org_id = session()->get('parent_org_id');
		$sq=!empty($type)?" and a.competency_type='$type'":"";
		$query="select a.comp_def_id,UPPER(a.comp_def_name) as comp_def_name, a.competency_type from uls_competency_definition a where 1 and  a.parent_org_id=".$parent_org_id." $sq $con order by a.comp_def_name asc";
		$query=$db->query($query);
        return $query->getResultArray();
	}
}
