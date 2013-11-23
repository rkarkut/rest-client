<?php
/**
 * Bundle controller.
 * 
 */
use App\Models\Bundle;

class BundlesController extends BaseController {
    
    /**
     * Construct.
     * 
     */
    public function __construct()
    {
        // authorize all methods.
        $this->beforeFilter('auth', array('except'=>array()));
    }

    /**
     * Method to create new bundle.
     * 
     * @return [type] [description]
     */
	public function create()
	{
        $data = Input::get();

        if(empty($data['name']))
            return Response::json(array('status' => 'error', 'message' => 'Name can\'t be empty'));

        $bundle = new Bundle();
        $bundle->name = $data['name'];
        $bundle->user_id = Auth::user()->id;

        $bundle->save();


        return Response::json(array('status' => 'ok', 'message' => 'Bundle has been saved.'));
	}

    /**
     * Method to update existing bundle.
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id)
    {
        $bundle = Bundle::find($id);

        if(empty($bundle) || $bundle->user_id != Auth::user()->id)
            return Response::json(array('status' => 'error', 'message' => 'Bundle not found.'));

        $data = Input::get();

        if(empty($data['name']))
            return Response::json(array('status' => 'error', 'message' => 'Name can\'t be empty.'));

        $bundle->name = $data['name'];
        $bundle->save();

        return Response::json(array('status' => 'ok', 'message' => 'Bundle has been saved.'));
    }
}
