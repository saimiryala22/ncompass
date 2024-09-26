<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct(){
		$this->db = \Config\Database::connect();
	}
	
    public function index(): string
    {
        return view('welcome_message');
    }
}
