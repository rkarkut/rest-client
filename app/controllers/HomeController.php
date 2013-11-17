<?php

class HomeController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

	public function getHome()
	{
        return View::make('home', array('name' => 'Taylor'));
	}

    public function postGallery()
    {
        if (Request::ajax()) {

            die('ajax request');
        }
    }

}
