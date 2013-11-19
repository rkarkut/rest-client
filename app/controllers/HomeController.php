<?php

class HomeController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getHome')));
    }

	public function getHome()
	{
        $bundles = Bundle::whereRaw('user_id = ?', array(Auth::user()->id))->get();


        return View::make('home', array('bundles' => $bundles));
	}
}
