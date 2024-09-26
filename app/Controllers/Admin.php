<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UlsEmployeeMaster;
use App\Models\UlsAdminMaster;
use App\Models\UlsEmployeeWorkInfo;
use App\Models\UlsEmpStagingTable;
use App\Models\UlsSecurityProfile;

class Admin extends BaseController
{
    public $db;

    public function __construct(){
		$this->db = \Config\Database::connect();
	}

    public function index()
    {
		if(session()->get('emp_id')){
			//$data["aboutpage"]=$this->pagedetails('admin','index');
			
			return view('admin/dashboard/dashboard',$data);
		}
    }

    public function profile(){
        $emp_ids=session()->get('emp_id');
        if(!empty($emp_ids)){
			$emp_id=session()->get('emp_id');
            $userdetails=new UlsEmployeeMaster();
            $adminmasters=new UlsAdminMaster();
            $empworkinfo=new UlsEmployeeWorkInfo();
            $empstaging=new UlsEmpStagingTable();
			$data['userdetails']= $userdetails->getempdetails($emp_id);
			
			if(isset($_REQUEST['home'])){
				$orgid=session()->get('parent_org_id');
                $query = $db->query("SELECT * from uls_employee_work_info WHERE employee_id=".$emp_id." and parent_org_id=".$orgid." and org_id<>'' and status='A'");
				$orgcoun=$query->getResultArray();
				$orgcounts=count($orgcoun);
				if($orgcounts>0){
                    foreach($orgcoun as $orgid){
                        session()->set('org_id',$orgid->org_id);
                    }
                }
                else{
                    session()->set('org_id',session()->set('parent_org_id'));
                }
				$super_id=$userdetails->get_supervisor_id($emp_id);
				$man_id=isset($super_id->supervisor_id)?$super_id->supervisor_id:0;
				if(isset($super_id->location_id)){
					$location=$super_id->location_id;
					$data['location']=$userdetails->get_admin_location($location);
				}
				$emp_type="NEW_EMP_TYPE";
				$nationality="NATIONALITY";
				$data['emp_type']=$adminmasters->get_value_names($emp_type);
				$data['nationalityes']=$adminmasters->get_value_names($nationality);
				//echo $emp_id;
				$data['emp_photo']=$userdetails->get_emp_photo($emp_id);
				$man_photo=$userdetails->get_emp_photo($man_id);
				$data['man_photo']=$man_photo;
				$man_org_id=(isset($man_photo->employee_id))?$man_photo->employee_id:'';
				$man_org_id=$userdetails->get_org_id($man_org_id);
				$orga_name=(isset($man_org_id->org_id))?$man_org_id->org_id:null;
				//echo $emp_id;
				if($orga_name>0){
					$data['man_org_name']=$userdetails->get_orga_name($orga_name);
				}
				$emp_org_id=$userdetails->get_org_id($emp_id);
				$emp_orga_name=(isset($emp_org_id->org_id))?$emp_org_id->org_id:null;
				if($emp_orga_name>0){
				$data['emp_org_name']=$userdetails->get_orga_name($emp_orga_name);
				}
                return view('employee/profile',$data);

			}else if(session()->get('user_role')=='emp'){
				if(!empty($_REQUEST['position_id']))
				{
				    $data['positionid']=$_REQUEST['position_id'];
				}
				$getempdetails=$empworkinfo->getEmpPositionDetails($emp_ids);
				
				if(!empty($getempdetails)){
					$empwork=array();
					$empwork[0]['joining_date']=$getempdetails->from_date;
					$empwork[0]['position_id']=$getempdetails->position_id;
					
				}
				$getempstagdetails=$empstaging->getEmpStageDetails($emp_ids);
				if(count($getempstagdetails)>0){
					$getemppos=array();
					foreach($getempstagdetails as $k=>$val){
						$getemppos[$k]['joining_date']=$val['joining_date'];
						$getemppos[$k]['position_id']=$val['position_id'];
					}
					$merge = array_merge($empwork, $getemppos);
					$data['joining']=$merge;
				}
				else{
					$merge = array_merge($empwork);
					$data['joining']=$merge;
				}
				if($this->request->getPost('new_password')){
                    $checkuser = $db->query('SELECT * FROM `uls_user_creation` WHERE `user_id`='.session()->get('user_id'));
					$checkuser =$checkuser->getRow();
					if(isset($checkuser->user_id)){
						$checkuser->password=(!empty($this->request->getPost('new_password')))?trim($this->request->getPost('new_password')):'welcome';
						$checkuser->user_login=1;
						$checkuser->save();
						//redirect("employee/profile");
					}
					else{
						$data['message']="Some error occurred please try again";
					}
				}
                return redirect()->to(base_url('employee/profile'));
			}
			else if(session()->get('user_role')=='man'){
                return view('manager/manager_profile',$data);
			}
			else if(session()->get('user_role')=='aptri'){
				return view('admin/employee_training_tna_report','');
			}
			else if(session()->get('user_role')=='agel'){
                return view('admin/agel_dashboard','');
			}
			else if(session()->get('user_role')=='admin'){
				session()->set('emp_type','');	
				if(!empty(session()->get('security_location_id'))){
                    return view('admin/location_employee_search');
				}
				else{
					return redirect()->to(base_url('admin/maindashboard'));
				}
			}
			else{
                return view('employee/employee_profile',$data);
		    }
		}
        else{
            return view('admin/lms_admin_no_profile',$data);
        }
    }

	public function layoutmenus(){
		session()->remove('security_org_id');
		session()->remove('security_location_id');
		session()->remove('security_type');
		session()->remove('security_type');
		$db = \Config\Database::connect();
		$emp_id = $db->query('SELECT * FROM `uls_user_creation` WHERE `user_id`='.session()->get('user_id'));
		$emp_id =$emp_id->getRow();
		if(!empty($emp_id->employee_id)){
			$id=$_REQUEST['id'];
			session()->set('Role_id',$id);
			session()->set('Menu_Id',$_REQUEST['menu']);
			$role = $db->query('SELECT * FROM `uls_menu_creation` WHERE `menu_creation_id`='.$_REQUEST['menu']);
			$role =$role->getRow();
			session()->set('user_role',$role->system_menu_type);
			$parentid = $db->query('SELECT * FROM `uls_role_creation` WHERE `role_id`='.$id);
			$parentid =$parentid->getRow();
			session()->set('parent_org_id',$parentid->parent_org_id);
			$secprofile=new UlsSecurityProfile();
			$secure=$secprofile->secureProfile($parentid->secure_profile_id);
			$orgdata = $db->query('SELECT * FROM `uls_organization_master` WHERE `parent_org_id`='.$parentid->parent_org_id);
			$orgdata =$orgdata->getRow();
			session()->set('org_start_date',$orgdata->start_date);
			session()->set('org_end_date',$orgdata->end_date);
			$emp_id = $db->query('SELECT * FROM `uls_user_creation` WHERE `user_id`='.session()->get('user_id'));
			$emp_id =$emp_id->getRow();
			session()->set('emp_id',$emp_id->employee_id);
			$coun = $db->query('SELECT * FROM `uls_employee_work_info` WHERE `supervisor_id`='.$emp_id->employee_id);
			$coun =$coun->getResultArray();
			$counts=count($coun);
			($counts>0)?session()->set('mngr_id',$emp_id->employee_id):"";
			$orgcoun = $db->query("SELECT * FROM `uls_employee_work_info` WHERE employee_id=".$emp_id->employee_id." and parent_org_id=".$parentid->parent_org_id." and org_id<>'' and status='A'");
			$orgcoun =$orgcoun->getResultArray();
			$orgcounts=count($orgcoun);
			if($orgcounts>0){foreach($orgcoun as $orgid){session()->set('org_id',$orgid['org_id']);}}else{session()->set('org_id',$parentid->parent_org_id);}
			if($role->system_menu_type=='asr'){
				session()->set('asr_id',$emp_id->assessor_id);
				return redirect()->to(base_url('assessor/profile'));
			}
			elseif($role->system_menu_type=='man'){
				session()->set('man_id',$emp_id->employee_id);
				return redirect()->to(base_url('manager/profile'));
			}
			else{
				return redirect()->to(base_url('admin/profile'));
			}
		}
		else{
			session()->set('asr_id',$emp_id->assessor_id);
			return redirect()->to(base_url('assessor/profile'));
		}
		//print_r($this->session);
	}
}
