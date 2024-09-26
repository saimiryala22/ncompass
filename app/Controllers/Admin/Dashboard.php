<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UlsAdminMaster;
use App\Models\UlsCompetencyDefinition;
use App\Models\UlsPosition;

class Dashboard extends BaseController
{
    public $db;

    public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services :: session();
	}

    public function pagedetails($controller,$page){
        $str=array(); $values=array("pagetitle"=>"title","pagekeyword"=>"keyword","pagedescription"=>"description","pagecss"=>"css","pagejs"=>"js");
		$pagedeatils = $this->db->query("SELECT * FROM `uls_pages` WHERE `controller`='$controller' and page='$page'");
		$pagedeatils =$pagedeatils->getRow();
		$data=array();
        foreach($values as $key=>$val){
			$str[$key]=isset($pagedeatils->id)? $pagedeatils->$val:"";
			$data[$key]=$str[$key];
        }
		return $data;
    }

    public function index()
    {
        if(session()->get('emp_id')){
			//$data["aboutpage"]=$this->pagedetails('admin','index');
			
			return view('admin/dashboard/dashboard',$data);
		}
    }

    public function maindashboard(){
		//print_r($_SESSION);
		$data=array();
		$data["aboutpage"]=$this->pagedetails('admin','dashboard');
        $adminmaster=new UlsAdminMaster();
		$data['emp_types']=$adminmaster->get_value_names("POSTYPE");
		if(isset($_REQUEST['emp_type'])){
			session()->set('emp_type',$_REQUEST['emp_type']);
		}
		$emp_type=isset($_SESSION['emp_type'])?$_SESSION['emp_type']:"";
		$data['emp_type']=$emp_type;
		$sq=$sq2=$sq3=$sq4=$sq5="";
		if(!empty($emp_type)){
			$sq=" and a.position_type='$emp_type'";
			$sq2=" and position_type='$emp_type'";
			$sq3=" and competency_type='$emp_type'";
			$sq4=" and a.competency_type='$emp_type'";
			$sq5=" and a.assessment_cycle_type='$emp_type'";
		}
		
		$org=session()->get('security_org_id');
		$possq="";$possq2="";$comps="";$comps2="";
		if($_SESSION['security_type']=='no'){
			$possq="";$possq2="";$comps="";$comps2="";
		}
		elseif(!empty($org)){
			$comps=" and bu_id in (SELECT `organization_id` FROM `uls_organization_master` WHERE `division_id` in ($org) or `organization_id` in ($org))";
			$comps2=" and bu_id in (SELECT `organization_id` FROM `uls_organization_master` WHERE `division_id` in ($org) or `organization_id` in ($org))";
			$possq=" and a.bu_id in (SELECT `organization_id` FROM `uls_organization_master` WHERE `division_id` in ($org) or `organization_id` in ($org))";
			$possq2=" and bu_id in (SELECT `organization_id` FROM `uls_organization_master` WHERE `division_id` in ($org) or `organization_id` in ($org))";
			if($_SESSION['parent_org_id']==$org){
				
				$locs=explode(",",$_SESSION['security_location_id']);
				$possq=" and (";
				$possq2=" and (";
				foreach($locs as $loc){
					$possq.="find_in_set($loc,a.`location_id`)";
					$possq2.="find_in_set($loc,`location_id`)";
				}
				$possq.=")";
				$possq2.=")";
				$sqbus="";
                $buss = $this->db->query("SELECT distinct(`bu_id`) as buid  FROM `uls_location` WHERE `location_id` in (".$_SESSION['security_location_id'].")");
				$buss=$buss->getResultArray();
				foreach($buss as $k=>$bus2){
					if(empty($sqbus)){
						$sqbus.=" WHERE `division_id` in (".$bus2['buid'].") or `organization_id` in (".$bus2['buid'].")";
					}
					else{
						$sqbus.=" or `division_id` in (".$bus2['buid'].") or `organization_id` in (".$bus2['buid'].")";
					}
				}
				if(!empty($sqbus)){
					$comps=" and bu_id in (SELECT `organization_id` FROM `uls_organization_master` $sqbus)";
					$comps2=" and a.bu_id in (SELECT `organization_id` FROM `uls_organization_master` $sqbus)";
				}
			}
		}
		//and position_structure='S'
        $positiondet = $this->db->query("SELECT count(*) as total,b.incomplete FROM `uls_position` a left join (select count(*) as incomplete,parent_org_id from uls_position where `position_desc` is not null $sq2 $possq2 and `parent_org_id`=".$_SESSION['parent_org_id']."  group by parent_org_id)b on a.parent_org_id=b.parent_org_id WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']." and a.position_structure='S'".$sq.$possq);
        $data["positiondet"]= $positiondet->getRow();
		//and position_structure='S' 
        $competenctprofile = $this->db->query("SELECT count(distinct(`comp_position_id`)) as total FROM `uls_competency_position_requirements` WHERE `comp_position_id` in (SELECT position_id FROM `uls_position` WHERE `parent_org_id`=".$_SESSION['parent_org_id']."  $sq2 $possq2 ) ORDER BY `comp_position_id` DESC ");
        $data["competenctprofile"]= $competenctprofile->getRow();
		//and comp_structure='S'
        $competencies = $this->db->query("SELECT count(*) as total FROM `uls_competency_definition`  WHERE `parent_org_id`=".$_SESSION['parent_org_id']." ".$sq3.$comps);
        $data["competencies"]= $competencies->getRow();
		if(!empty($sq3)){
			//and comp_structure='S'
            $competency = $this->db->query("SELECT comp_def_id as id, comp_def_name as name FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id']."  $sq3 $comps order by comp_def_name asc");
            $data["competency"]= $competencies->getResultArray();
		}
		else{
            $compdefinition= new UlsCompetencyDefinition();
			$data['competencymsdetails']=$compdefinition->competency_dashdetails("MS",$comps2);
			$data['competencynmsdetails']=$compdefinition->competency_dashdetails("NMS",$comps2);
		}
		//and comp_structure='S'
        $compincomp = $this->db->query("SELECT count(*) as total FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id']."  and `comp_def_id` not in (SELECT distinct(`comp_def_id`) FROM `uls_competency_def_level_indicator` WHERE `parent_org_id`=".$_SESSION['parent_org_id']." ) $sq3 $comps");
        $data["compincomp"]= $compincomp->getRow();
		
		//and a.comp_structure='S'
        $graphs = $this->db->query("SELECT count(*) as tot,a.`comp_def_category`,b.name,group_concat(a.`comp_def_id`),c.total FROM `uls_competency_definition` a inner join (SELECT * FROM `uls_category` )b on b.`category_id`=a.comp_def_category left join(SELECT count(*) as total,`comp_def_category` FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id']." and comp_structure='S' and `comp_def_id` not in (SELECT distinct(`comp_def_id`) FROM `uls_competency_def_level_indicator` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].") $sq3 $comps group by `comp_def_category`)c on c.`comp_def_category`=a.comp_def_category WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']."  $sq4 $comps2 group by a.`comp_def_category` ");
        $data["graphs"]= $graphs->getResultArray();
		
		$assessors_ext = $this->db->query("SELECT b.`assessor_id`,b.`assessor_name`,b.assessor_email,b.assessor_type FROM `uls_assessment_position_assessor` a 
		left join(SELECT `assessor_id`,`assessor_name`,assessor_email,assessor_type FROM `uls_assessor_master`) b on a.assessor_id=b.assessor_id
		WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']." and a.`assessor_type`='EXT' group by a.`assessor_id`");
        $data["assessors_ext"]= $assessors_ext->getResultArray();
		
		$assessors_int = $this->db->query("SELECT c.employee_id,c.`employee_number`,c.`full_name`,c.`email`,b.assessor_type,b.assessor_id FROM `uls_assessment_position_assessor` a 
		left join(SELECT `assessor_id`,`assessor_name`,assessor_email,assessor_type,employee_id FROM `uls_assessor_master`) b on a.assessor_id=b.assessor_id
		left join(SELECT `employee_id`,`employee_number`,`full_name`,`email` FROM `employee_data`) c on c.employee_id=b.employee_id
		WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']." and a.`assessor_type`='INT' group by a.`assessor_id`");
        $data["assessors_int"]= $assessors_int->getResultArray();
		
		
		$loc=session()->get('security_location_id');
		$losq="";
		if(!empty($loc)){
			$losq=" and (a.location_id in (".$loc.") )";
		}
		$assessments = $this->db->query("SELECT c.employees,b.positions,d.ass_emp,b.pos_id,a.* FROM `uls_assessment_definition` a 
		left join(select count(*) as positions,assessment_id,group_concat(position_id) as pos_id from `uls_assessment_position` group by `assessment_id` )b on a.`assessment_id`=b.`assessment_id`
		left join(select count(*) as employees,assessment_id from `uls_assessment_employees` group by `assessment_id` )c on a.`assessment_id`=c.`assessment_id`
		left join(SELECT count(DISTINCT `employee_id`) as ass_emp,assessment_id  FROM `uls_assessment_report_final` group by `assessment_id`) d on a.`assessment_id`=d.`assessment_id`
		WHERE 1 and a.`parent_org_id`=".$_SESSION['parent_org_id']." $sq5 $losq order by assessment_id desc");
        $data["assessments"]= $assessments->getResultArray();
		

        $questionbanks = $this->db->query("SELECT b.mcq,c.cases,d.inbasket,e.interview FROM `uls_questionbank` a left join ( SELECT count(*) as mcq,`parent_org_id` FROM `uls_questionbank` WHERE `type`='COMP_TEST' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) group by `parent_org_id` )b on a.`parent_org_id`=b.`parent_org_id` left join ( SELECT count(*) as cases,`parent_org_id` FROM `uls_questionbank` WHERE `type`='COMP_CASESTUDY' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) group by `parent_org_id` )c on a.`parent_org_id`=c.`parent_org_id` left join ( SELECT count(*) as inbasket,`parent_org_id` FROM `uls_questionbank` WHERE `type`='COMP_INBASKET' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) group by `parent_org_id` )d on a.`parent_org_id`=d.`parent_org_id` left join ( SELECT count(*) as interview,`parent_org_id` FROM `uls_questionbank` WHERE `type`='COMP_INTERVIEW' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) group by `parent_org_id` )e on a.`parent_org_id`=e.`parent_org_id` WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']." group by a.`parent_org_id`");
        $data["questionbanks"]= $questionbanks->getRow();

        $questions = $this->db->query("SELECT (SELECT count(*) as mcq FROM `uls_questions` WHERE `question_bank_id` in (SELECT `question_bank_id` FROM `uls_questionbank` WHERE `type`='COMP_TEST' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) and `parent_org_id`=".$_SESSION['parent_org_id'].")) as mcq, (SELECT count(*) as mcq FROM `uls_questions` WHERE `question_bank_id` in (SELECT `question_bank_id` FROM `uls_questionbank` WHERE `type`='COMP_CASESTUDY' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps)  and `parent_org_id`=".$_SESSION['parent_org_id'].")) as cases, (SELECT count(*) as mcq FROM `uls_questions` WHERE `question_bank_id` in (SELECT `question_bank_id` FROM `uls_questionbank` WHERE `type`='COMP_INBASKET' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3.") and `parent_org_id`=".$_SESSION['parent_org_id'].")) as inbasket, (SELECT count(*) as mcq FROM `uls_questions` WHERE `question_bank_id` in (SELECT `question_bank_id` FROM `uls_questionbank` WHERE `type`='COMP_INTERVIEW' and comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps) and `parent_org_id`=".$_SESSION['parent_org_id'].")) as interview ");
        $data["questions"]= $questions->getRow();

        $questionbanks_inbasket = $this->db->query("SELECT count(distinct(a.`question_id`)) as q_bank,a.comp_def_id FROM `uls_question_values` a WHERE a.comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps)");
        $data["questionbanks_inbasket"]= $questionbanks_inbasket->getRow();
		
		$question_inbasket = $this->db->query("SELECT count(a.`question_id`) as ques FROM `uls_question_values` a WHERE a.comp_def_id in (SELECT comp_def_id FROM `uls_competency_definition` WHERE `parent_org_id`=".$_SESSION['parent_org_id'].$sq3." $comps)");
        $data["question_inbasket"]= $question_inbasket->getRow();
		//and position_structure='S'

        $position_info = $this->db->query("SELECT g.value_name as position_type,a.position_id,a.position_name,a.position_desc,a.experience,a.specific_experience,a.accountablities,b.conp_profile,c.kra, if(b.conp_profile is NULL,0,1) as checka,if(a.position_desc is NULL,0,1) as checkb FROM `uls_position` a
		left join(SELECT count(*) as conp_profile,`comp_position_id` FROM `uls_competency_position_requirements` where 1 group by comp_position_id) b on a.position_id=b.comp_position_id
		left join(SELECT count(*) as kra,`comp_position_id` FROM `uls_competency_position_requirements_kra` where 1 group by comp_position_id) c on a.position_id=c.comp_position_id
		LEFT JOIN (SELECT value_id, master_code, value_code, value_name FROM uls_admin_values GROUP BY value_id)g ON g.master_code = 'POSTYPE' AND a.position_type = g.value_code 
		WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']."  $sq $possq ORDER BY a.position_structure DESC,a.position_name ASC, checkb DESC , checka DESC");
        $data["position_info"]= $position_info->getResultArray();

		
		
		//$org=$this->session->userdata('security_org_id');
		$busq="";$data['sbu']="";
		if($_SESSION['security_type']=='no'){
			$busq="";$data['sbu']="";
		}
		elseif(!empty($org)){
			$busq=" and (a.organization_id in (".$org.") or division_id in (".$org.") )";
			if($_SESSION['parent_org_id']!=$org){
				$data['sbu']=$org;
			}
		}

        $bus = $this->db->query("SELECT a.`organization_id` as id,a.`org_name` as name,b.totloc FROM `uls_organization_master` a left join (SELECT count(*) as totloc,bu_id FROM `uls_location` group by bu_id )b on a.`organization_id`=b.bu_id WHERE 1 and a.`org_type`='BU' and a.`parent_org_id`=".$_SESSION['parent_org_id']." $busq ORDER BY `a`.`org_name` ASC");
        $data["bus"]= $bus->getResultArray();
		
		
		//and position_structure='S'
        $locations = $this->db->query("SELECT sum(b.total) as positions,a.* FROM `uls_location` a left join(SELECT 1 as total,`location_id` FROM `uls_position` where 1   $sq2 group by `position_id`)b on find_in_set(a.`location_id`,b.`location_id`)>0 WHERE a.`parent_org_id`=".$_SESSION['parent_org_id']." $losq group by a.`location_id` ORDER BY a.`location_name` ASC");
        $data["locations"]= $locations->getResultArray();
		//and a.position_structure='S'
        $pos_department = $this->db->query("SELECT a.position_org_id,b.org_name,COUNT(1) as pos_count FROM uls_position a
		left join(SELECT `organization_id`,`org_name` FROM `uls_organization_master`) b on a.position_org_id=b.organization_id
		WHERE $sq2 $possq2 a.`parent_org_id`=".$_SESSION['parent_org_id']."  GROUP BY a.position_org_id ORDER BY pos_count; ");
        $data["pos_department"]= $pos_department->getResultArray();
		
        return view('admin/dashboard/dashboard',$data);
	}
}
