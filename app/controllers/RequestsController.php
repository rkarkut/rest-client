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

    public function makeRequest()
    {
        $response = null;

        $data = Input::get();

        $curl = curl_init(); 

        curl_setopt($curl, CURLOPT_URL, $data['url']); // url
        curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data['request']); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($curl, CURLOPT_USERPWD, 'username:password');
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                          
        curl_setopt($curl, CURLOPT_USERAGENT, 'Sample Code');

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data['request']))                                                                       
        );      

        $response = curl_exec($curl); 
        
        curl_close($curl); 

        $data = json_decode($response);
        $response = "<pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>";


        return Response::json(array('stauts' => 'ok', 'response' => $response));
    }
}
