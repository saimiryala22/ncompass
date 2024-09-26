<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UlsEmployeeMaster;

class Employee extends BaseController
{
    public function index()
    {
        //
    }

    public function profile()
	{		
		
		$emp_id=session()->get('emp_id');	
        $userdetails=new UlsEmployeeMaster();	
		$data['userdetails']=$userdetails->getempdetails($emp_id);
        return view('employee/employee_profile',$data);
	}
}
