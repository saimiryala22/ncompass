<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsPosition extends Model
{
    protected $table            = 'uls_position';
    protected $primaryKey       = 'position_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'version_id','status','start_date_active','specific_experience','responsibilities','reports_to','reportees','position_type','position_structure_id','position_structure','position_org_id','position_name','position_id','position_desc','position_concate','position_code','parent_org_id','other_requirement','organization_id','modified_by','location_id','last_modified_id','grade_id','experience','end_date_active','education','created_by','bu_id','accountablities',
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

    static function pos_stru_count_details($id){
        $parent_org_id = session()->get('parent_org_id');
        $db= \Config\Database::connect();
		$posdef=array();
		if(!empty($id)){
			//and a.position_structure='S'
			$posdef="select a.* FROM uls_position a where a.parent_org_id=". $parent_org_id." and a.position_id in ($id)  order by a.position_name ASC";
            $posdef=$db->query($posdef);
            return $posdef->getResultArray();
			
		}
		return $posdef;  
		
    }
}
