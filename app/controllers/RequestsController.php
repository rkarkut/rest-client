<?php

/**
 * Request controller.
 * 
 */
use App\Models\Request;

class RequestsController extends BaseController {
    
    /**
     * Construct
     */
    public function __construct()
    {
        // authorize all methods.
        $this->beforeFilter('auth', array('except'=>array()));
    }

    /**
     * Method to create new request.
     * 
     * @return [type] [description]
     */
	public function create()
	{
        $data = Input::get();

        $errors = $this->isValid($data);

        if(!empty($errors))
            return Response::json(array('status' => 'error', 'message' => implode('<br />', $errors)));

        $request = new Request();
        $request->name = $data['name'];
        $request->method = $data['method'];
        $request->url = $data['url'];
        $request->content_type = $data['content_type'];
        $request->content = $data['content'];
        $request->bundle_id = $data['bundle'];

        $request->save();


        return Response::json(array('status' => 'ok', 'message' => 'Request has been saved.'));
	}

    /**
     * Method to check if params are valid.
     * 
     * @param  [type]  $data [description]
     * @return boolean       [description]
     */
    public function isValid($data)
    {
        $errors = array();

        if(empty($data['name']))
            $errors[] = 'Name can\'t be empty.';

        if(empty($data['method']))
            $errors[] = 'Method can\'t be empty.';

        if(empty($data['url']))
            $errors[] = 'URL can\'t be empty.';

        if(empty($data['content_type']))
            $errors[] = 'Content type can\'t be empty.';

        if(empty($data['bundle']))
            $errors[] = 'Bundle can\'t be empty.';

        return $errors;
    }

    /**
     * Method to return request details.
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        if(empty($id))
            return Response::json(array('status' => 'error', 'message' => 'Invalid Request ID.'));

        $request = Request::find($id);

        return Response::json(array('status' => 'ok', 'request'=>json_decode($request)));

    }

    /**
     * Method to make request.
     * 
     * @return [type] [description]
     */
    public function makeRequest()
    {
        if (Auth::check() == false)
            return Response::json(array('status' => 'error', 'message' => 'You must be logged in.'));

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

    /**
     * Method to update request.
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function updateRequest($id)
    {
        $data = Input::get();

        $request = Request::find($id);

        if(empty($request))
            return Response::json(array('status' => 'false', 'error'=>'Request not found.'));

        $request->name = $data['name'];
        $request->method = $data['method'];
        $request->url = $data['url'];
        $request->content_type = $data['content_type'];
        $request->content = $data['content'];
        $request->bundle_id = $data['bundle'];

        $request->save();
        return Response::json(array('status' => 'ok', 'message'=>'Request has been saved.'));
    }
}
