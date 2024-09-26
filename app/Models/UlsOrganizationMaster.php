<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsOrganizationMaster extends Model
{
    protected $table            = 'uls_organization_master';
    protected $primaryKey       = 'organization_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'start_date','parent_org_id','organization_id','org_url','org_type1','org_type','org_name','org_manager','org_code','modified_by','location','last_modified_id','end_date','division_id','created_by','bu_type',
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


    public static function getchildorgsdata_hierarchy($orgid,$hier){
		global $asd;
        $db= \Config\Database::connect();
		$result="SELECT oh.parent_org_id as parentid, oh.child_org_id as chilid, p_id.count FROM `uls_organization_heirarchy` oh   LEFT OUTER JOIN (SELECT parent_org_id, COUNT(*) AS count FROM `uls_organization_heirarchy` GROUP BY parent_org_id) p_id ON oh.child_org_id= p_id.parent_org_id WHERE oh.parent_org_id <> oh.child_org_id AND oh.parent_org_id=".$orgid." and oh.hierarchy_id=".$hier."";
        $org_values=$db->query($result);
        $org_values=$query->getResultArray();
		foreach($org_values as $key=>$value){
			if($value['count']>0){
				$asd=empty($asd)? $value['chilid']:$asd.",".$value['chilid'];
				//$asd=$value['chilid'].",";
				$var=new UlsOrganizationMaster();
				$var->getchildorgsdata_hierarchy($value['chilid'],$hier);
            }
            else{
				$asd=empty($asd)? $value['chilid']:$asd.",".$value['chilid'];
			}            
		}
		return $asd;
	}
}
