<?php
/**
 * User Controller.
 *
 * Contains authorization methods.
 * 
 */
class UsersController extends BaseController 
{
    /**
     * Construct.
     * 
     */
    public function __construct()
    {
        // secure forms by CSRF.
        $this->beforeFilter('csrf', array('on'=>'post'));

        // authorize selected methods.
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

    /**
     * Logout User ($_GET method)
     * 
     * @return [type] [description]
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'You are now logged out.');
    }

    /**
     * Display User dashboard.
     * 
     * @return [type] [description]
     */
    public function getDashboard()
    {
        $this->layout->content = View::make('users.dashboard');
    }

    /**
     * Sign In User ($_POST method)
     * 
     * @return [type] [description]
     */
    public function postSignin()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password'))))
            return Redirect::to('/')->with('message', 'You are now logged in!');

        else
            return Redirect::to('users/login')->with('error', 'Your username/password combination was incorrect')->withInput();

    }

    /**
     * Register new User ($_GET method)
     * 
     * @return [type] [description]
     */
    public function getRegister() 
    {
        return View::make('users.register');
    }

    /**
     * Log In User ($_GET method)
     * 
     * @return [type] [description]
     */
    public function getLogin()
    {
        return View::make('users.login');
    }

    /**
     * Create new User ($_POST method)
     * 
     * @return [type] [description]
     */
    public function postCreate() 
    {
        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes()) {

            $user = new User;
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('users/login')->with('message', 'Thanks for registering!');
        }
        else {

            return Redirect::to('users/register')->with('error', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
}

