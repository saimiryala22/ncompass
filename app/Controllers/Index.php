<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UlsPresentationDownload;
use App\Models\UlsNotificationHistory;
use App\Models\UlsUserCreation;
use CodeIgniter\HTTP\ResponseInterface;

class Index extends BaseController
{
    public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services :: session();
	}

	private function readTemplateFile($FileName){
		$fp = fopen($FileName,"r") or exit("Unable to open File ".$FileName);
		$str = "";
		while(!feof($fp)) {
			$str .= fread($fp,1024);
		}	
		return $str;
	}
	
    public function index(): string
    {
		$data = array();
        return view('index/index',$data);
    }

	public function features(): string
    {
		$data = array();
        return view('index/features',$data);
    }

	public function consulting(): string
    {
		$data = array();
        return view('index/consulting',$data);
    }

	public function prerequestinsert(){
		
		$presentation= new UlsPresentationDownload();

		$data = [
			"full_name" => $this->request->getPost('full_name'),
			"email_id" => $this->request->getPost('email_id'),
			"mobile" => $this->request->getPost('mobile'),
			"ip_address" =>$_SERVER["REMOTE_ADDR"],
		];
		$presentation->save($data);
		
		if($presentation){
			$content2 =$this->readTemplateFile("public/templates/whitepapertemplate.html");
			$name=$presentation->full_name;
			$fullname=ucfirst($name);
			$mailcontent="Dear ".$fullname.",<br><br>Greetings from UniTol Training Solutions!<br><br>Thank you for your interest in our N-Compas Presentation. The same is being enclosed with this mail.<br><br>Hope you enjoy reading it.<br><br>Please feel free to reach us at info@n-compas.com or Sales@UniTol.in for any further information on this topic.<br><br><br>Regards,<br>Content & Research<br>UniTol Training Solutions<br>www.UniTol.in";
			$content2=str_replace("#MAILCONTENT#",$mailcontent,$content2);
			
			$subject="Thank you for Downloading Presentation";
			$file_not=base_url('public/CompCMS_Prsnt.pdf');
			$notification= new UlsNotificationHistory();
			$data = [
				"to" => $presentation->email_id,
				"subject" => $subject,
				"mail_content" => $content2,
				"mail_type" =>'Pres',
				"parent_org_id" =>3,
				"timestamp" =>date('Y-m-d'),
				"attachment" =>$file_not,
			];
			$notification->save($data);
			return redirect()->to(base_url('index/consulting'))->with('presentation','1');
		}

	}

	public function customisedcms(): string
    {
		$data = array();
        return view('index/customisedcms',$data);
    }

	public function aboutus(): string
    {
		$data = array();
        return view('index/aboutus',$data);
    }

	public function contactusform(){
		$subject="N-compas Contact-us";
		$body_data="Following are the Details<br><br> 
		Name: ".$this->request->getPost('your_name')."<br>
		Email: ".$this->request->getPost('business_mail')."<br>
		Mobile/Landline:".$this->request->getPost('phone_number')."<br>
		Message:".$this->request->getPost('company');
		$notification= new UlsNotificationHistory();
			$data = [
				"to" => "info@simplifymytraining.com",
				"subject" => $subject,
				"mail_content" => $body_data,
				"mail_type" =>'CONT',
				"parent_org_id" =>3,
				"timestamp" =>date('Y-m-d'),
			];
			$notification->save($data);
			return redirect()->to(base_url())->with('msg','Thank you for your interest. Our sales team will contact you shortly');
	}

	public function loginuser(): string
    {
		$data = array();
        return view('index/loginuser',$data);
    }

	public function logininsert()
	{		
		if($this->request->getPost('username')){
			
			$data_user=array('username'=>trim($this->request->getPost('username')),'password'=>trim($this->request->getPost('password')));
			if(!empty($data_user['username']) && !empty($data_user['password'])){
				
				$user=new UlsUserCreation();
				$data=$user->where("user_name",[$data_user['username']]);
				$data=$user->where("password",[$data_user['password']]);
				$data=$user->first();
				// echo "<pre>";
				// print_r($data['user_id']);
				// exit();
				//$data=Doctrine_Core::getTable('UlsUserCreation')->findOneByUser_nameAndPassword($data['username'],$data['password']);
				
				if(isset($data['user_id'])){
					if($data['start_date']<=date("Y-m-d") && (empty($data['end_date']) || $data['end_date']=="0000-00-00" || $data['end_date']=="1970-01-01"|| $data['end_date']>=date("Y-m-d"))){
						$userupdate=new UlsUserCreation();
						$dataupdate=$userupdate->set("last_login_date",date("Y-m-d H:i:s"));
						$dataupdate=$userupdate->where("user_id",$data['user_id']);
						$dataupdate=$userupdate->update();
						session()->set('type', '');
						/* global $session;
						$session->login($data); */
						session()->set('username',$data['user_name']);
						session()->set('user_id',$data['user_id']);
						session()->set('parent_org_id',$data['parent_org_id']);
						$db      = \Config\Database::connect();
						$query = $db->query("SELECT c.system_menu_type, a.user_role_id, a.`role_id`, c.menu_creation_id, b.parent_org_id FROM `uls_user_role` a INNER JOIN uls_role_creation b ON  a.`role_id` = b.`role_id` INNER JOIN uls_menu_creation c ON b.menu_id = c.menu_creation_id WHERE `user_id` =".$data['user_id']." and (a.start_date<='".date('Y-m-d')."' and (a.end_date is NULL || a.end_date >='".date('Y-m-d')."'))");
						$roleasd=$query->getResultArray();
						//$roleasd=UlsMenu::callpdo($query);
						$usertypess=array();
						$ii=0;
						foreach($roleasd as $key=>$val){
							if($val['system_menu_type']=="emp"){
								//['UlsRoleCreation']['UlsMenuCreation']
								$ii=$key;
								break;
							}
						}
						if(isset($roleasd[$ii]['user_role_id'])){
							session()->set('Role_id',$roleasd[$ii]['role_id']);
							session()->set('Menu_Id',$roleasd[$ii]['menu_creation_id']);
							session()->set('user_role',$roleasd[$ii]['system_menu_type']);
							session()->set('parent_org_id',$roleasd[$ii]['parent_org_id']);
							//$orgdata=Doctrine_Core::getTable('UlsOrganizationMaster')->find($roleasd[$ii]['parent_org_id']);
							$emporgquery = $db->query('SELECT * FROM `uls_organization_master` WHERE `parent_org_id`='.$roleasd[$ii]['parent_org_id']);
							$orgdata =$emporgquery->getRow();
							session()->set('org_start_date',$orgdata->start_date);
							session()->set('org_end_date',$orgdata->end_date);
							if(!empty($data['employee_id'])){
								$empquery = $db->query('SELECT * FROM `uls_employee_master` WHERE `employee_id`='.$data['employee_id']);
								$emp_id =$empquery->getRow();
								//$emp_id=Doctrine_Core::getTable('UlsEmployeeMaster')->findOneByEmployee_id($data['employee_id']);
								$empworkquery = $db->query('SELECT * FROM `uls_employee_work_info` WHERE `employee_id`='.$data['employee_id']);
								$org =$empworkquery->getRow();
								//$org=Doctrine_Core::getTable('UlsEmployeeWorkInfo')->findOneByEmployee_id($data->employee_id);
								session()->set('emp_type',$emp_id->emp_type);
								session()->set('emp_id',$data['employee_id']);
								session()->set('ven_id',$data['vendor_id']);
								session()->set('org_id',$org->org_id);
								session()->set('location_id',$org->location_id);
							}
							if($roleasd[$ii]['system_menu_type']=='emp'){
								$link=($data['user_login']==1)?("admin/profile"):("employee/changepassword");
								return redirect()->to(base_url($link));
							}
							elseif($roleasd[$ii]['system_menu_type']=='man'){
								
								//$this->session->set_userdata('man_id',$data->employee_id);
								$aaa=($data['user_login']==1)?("manager/profile"):("manager/changepassword");
								return redirect()->to(base_url($aaa))->with('man_id',$data->employee_id);
							}
							elseif($roleasd[$ii]['system_menu_type']=='asr'){
								
								//$this->session->set_userdata('asr_id',$data->assessor_id);
								$aaa=($data['user_login']==1)?("assessor/profile"):("assessor/changepassword");
								return redirect()->to(base_url($aaa))->with('asr_id',$data->assessor_id);
							}
							elseif($roleasd[$ii]['system_menu_type']=='aptri'){
								/* echo $roleasd[$ii]['system_menu_type'];
								exit; */
								/* echo $roleasd[$ii]['system_menu_type'];
								exit; */
								$link=($data['user_login']==1)?("admin/profile"):("admin/changepassword");
								return redirect()->to(base_url($link));
							}
							else{							   
								$link=($data['user_login']==1)?("admin/dashboard"):("admin/changepassword");
								return redirect()->to(base_url($link));
							}
						}
						else{
							$link=($data['user_login']==1)?("admin/dashboard"):("admin/changepassword");
							return redirect()->to(base_url($link));
						}
					}
					else{
						return redirect()->to(base_url('index/loginuser'))->with('contact_admin','1');
					}
				}
				else{
					return redirect()->to(base_url('index/loginuser'))->with('wrong_username','1');
				}
			}
			else{
				return redirect()->to(base_url('index/loginuser'))->with('username_empty','1');
			}
		}
		else{
			return redirect()->to(base_url('index/loginuser'))->with('both_empty','1');
		}
		
	}

	public function customlogout(){
		session()->destroy();
		return redirect()->to(base_url());
	}
}
