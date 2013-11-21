<?php

use App\Models\Request;

class MobileController extends BaseController {
    
    public function __construct()
    {
        // $this->beforeFilter('csrf', array('on'=>'post'));
        // $this->beforeFilter('auth', array('only'=>array('postAdd')));
    }

	public function create()
	{
        return Response::json(array('status' => 'ok', 'message' => 'Bundle has been saved.'));
	}
}
