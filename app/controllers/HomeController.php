<?php
/**
 * Home controller.
 *
 * Default controller of application.
 * 
 */
use App\Models\Bundle;

class HomeController extends BaseController {
    
    /**
     * Construct.
     * 
     */
    public function __construct()
    {
        // secure formular by CSRF.
        $this->beforeFilter('csrf', array('on'=>'post'));

        // authorize selected methods
        $this->beforeFilter('auth', array('only'=>array('getHome')));
    }

    /**
     * Method to display default content.
     * 
     * @return [type] [description]
     */
	public function getHome()
	{
        $bundles = Bundle::whereRaw('user_id = ?', array(Auth::user()->id))->get();

        return View::make('home', array('bundles' => $bundles));
	}
}
