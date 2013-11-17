<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Authentication App With Laravel 4</title>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
   {{ HTML::style('css/main.css')}}
  </head>
 
  <body>

      <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
        <div class="container">
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <ul class="nav navbar-nav">
                @if(!Auth::check())
                    <li>{{ HTML::link('users/register', 'Register') }}</li>   
                    <li>{{ HTML::link('users/login', 'Login') }}</li>   
                @else
                    <li>{{ HTML::link('users/logout', 'logout') }}</li>
                @endif
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif

         @yield('content')
    </div>

  </body>
</html>
