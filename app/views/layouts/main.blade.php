<!DOCTYPE html>
<html>
<head>
  <title>REST Client</title>

    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/main.css')}}

    {{ HTML::script('scripts/jquery.min.js')}}
    {{ HTML::script('packages/bootstrap/js/modal.js')}}
    {{ HTML::script('scripts/main.js')}}

</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a href="/" class="navbar-brand">REST Client</a>

            </div>

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
    
    <div class="container page">
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if(Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        @yield('content')

    </div>
</body>
</html>
