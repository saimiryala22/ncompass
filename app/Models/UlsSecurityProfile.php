<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsSecurityProfile extends Model
{
    protected $table            = 'uls_security_profile';
    protected $primaryKey       = 'secure_profile_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'status','secure_profile_id','profile_name','parent_org_id','modified_by','last_modified_id','created_by',
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

    //Function to get complete org and locations id based on security profile id
	public static function secureProfile($secure_id){
        $db= \Config\Database::connect();
		if(!empty($secure_id)){
			$secure="select p.secure_profile_id, p.parent_org_id, h.security_type, h.hierarchy_id, h.top_organization, o.organization_id, l.location_id from uls_security_profile p
			LEFT JOIN (select secure_hierarchy_id, secure_profile_id, security_type, hierarchy_id, top_organization from uls_security_hierarchy group by secure_hierarchy_id) h on h.secure_profile_id=p.secure_profile_id
			LEFT JOIN (select secure_org_id, secure_profile_id, organization_id from uls_security_org group by secure_org_id) o on o.secure_profile_id=p.secure_profile_id
			LEFT JOIN ( select secure_location_id, secure_profile_id, location_id from uls_security_location group by secure_location_id) l on l.secure_profile_id=p.secure_profile_id
			where p.secure_profile_id=".$secure_id;
            $sec_data=$db->query($secure);
            $sec_data=$sec_data->getResultArray();
			$locs='';$hier_orgs='';$add_orgs='';$allorgids='';$sql='';
			$orgid_arr=array();$locid_arr=array();$x=0;
			foreach($sec_data as $key=>$sec_dat){
				$par_org_id=$sec_dat['parent_org_id'];
				$sec_type=$sec_dat['security_type'];
				if($sec_type!='no'){
					if(!empty($sec_dat['hierarchy_id'])){
						if($x==0){
                            $orgmaster=new UlsOrganizationMaster();
							$hier_org=$orgmaster->getchildorgsdata_hierarchy($sec_dat['top_organization'],$sec_dat['hierarchy_id']);
							$hier_orgs=(!empty($hier_org))?$hier_org.",".$sec_dat['top_organization']:'';
							$x++;
						}
					}
					if(!empty($sec_dat['organization_id'])){
						if(!in_array($sec_dat['organization_id'],$orgid_arr)){
							$orgid_arr[]=$sec_dat['organization_id'];
							$add_orgs=(empty($add_orgs))?$sec_dat['organization_id']:$add_orgs.",".$sec_dat['organization_id'];
						}
					}
				}
				if(!empty($sec_dat['location_id'])){
					if(!in_array($sec_dat['location_id'],$locid_arr)){
						$locid_arr[]=$sec_dat['location_id'];
						$locs=(empty($locs))?$sec_dat['location_id']:$locs.",".$sec_dat['location_id'];
					}
				}		
			}
			$allorgids=(!empty($hier_orgs))?$hier_orgs:'';
			if(!empty($allorgids)){
				$allorgids=(!empty($add_orgs))?$allorgids.",".$add_orgs:$allorgids;				
			}else{
				$allorgids=(!empty($add_orgs))?$add_orgs:$par_org_id;				
			}
			
			session()->set('security_type',$sec_type);
			session()->set('security_org_id',$allorgids);
			session()->set('security_location_id',$locs);
		}
	}
}
