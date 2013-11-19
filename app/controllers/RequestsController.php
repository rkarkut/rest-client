<?php

use App\Models\Request;

class RequestsController extends BaseController {
    
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

        $errors = $this->isValid($data);

        if(!empty($errors))
            return Response::json(array('status' => 'error', 'message' => implode('<br />', $errors)));

        $request = new Request();
        $request->name = $data['name'];
        $request->method = $data['method'];
        $request->link = $data['link'];
        $request->host = $data['host'];
        $request->content_type = $data['content_type'];
        $request->content = $data['content'];
        $request->bundle_id = $data['bundle'];

        $request->save();


        return Response::json(array('status' => 'ok', 'message' => 'Bundle has been saved.'));
	}

    public function isValid($data)
    {
        $errors = array();

        if(empty($data['name']))
            $errors[] = 'Name can\'t be empty.';

        if(empty($data['method']))
            $errors[] = 'Method can\'t be empty.';

        if(empty($data['link']))
            $errors[] = 'Link can\'t be empty.';

        if(empty($data['host']))
            $errors[] = 'Host can\'t be empty.';

        if(empty($data['content_type']))
            $errors[] = 'Content type can\'t be empty.';

        if(empty($data['bundle']))
            $errors[] = 'Bundle can\'t be empty.';

        return $errors;
    }

    public function show($id)
    {
        if(empty($id))
            return Response::json(array('status' => 'error', 'message' => 'Invalid Request ID.'));

        $request = Request::find($id);

        return Response::json(array('status' => 'ok', 'request'=>json_decode($request)));

    }
}
