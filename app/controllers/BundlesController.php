<?php

class BundlesController extends BaseController {
    
    public function __construct()
    {
        // $this->beforeFilter('csrf', array('on'=>'post'));
        // $this->beforeFilter('auth', array('only'=>array('postAdd')));
    }

	public function create()
	{
        if (Auth::check() == false)
            return Response::json(array('status' => 'error', 'message' => 'You must be logged in.'));

        $data = Input::get();

        if(empty($data['name']))
            return Response::json(array('status' => 'error', 'message' => 'Name can\'t be empty'));

        $bundle = new Bundle();
        $bundle->name = $data['name'];
        $bundle->user_id = Auth::user()->id;

        $bundle->save();


        return Response::json(array('status' => 'ok', 'message' => 'Bundle has been saved.'));
	}
}
