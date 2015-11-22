<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PMS - Login</title>

        <!-- Bootstrap Core CSS -->
        
        <!-- Custom CSS -->
        <link href="{{url('/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/sb-admin.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/entire.css') }}">

        <!-- Custom Fonts -->
    
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("jquery", "1");
            google.load("jqueryui", "1");
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <script>
        function validateForm() {
            var x = document.forms["login_form"]["name"].value;
            if (x == null || x == "") {
                alert("Name must be filled out");
                return false;
            }
            var y = document.forms["login_form"]["password"].value;
            if (y == null || y == "") {
                alert("PASSWORD must be filled out");
                return false;
            }
        }
    </script>

    <body>

        <div id="wrapper">

            <div class="col-lg-5 col-centered margin">

                <h1 style="color: aliceblue;">Login Here</h1>

                <form name="login_form" method="post" onsubmit="return validateForm();"  action="{{ action('Auth\AuthController@postLogin') }}">

                    <div class="form-group has-success">
                        <label class="control-label" for="inputSuccess">User Name</label>
                        <input id="name" type="text" name="name" placeholder="Username" value="{{Input::old('name')}}" required="required" class="form-control" >
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label" for="inputWarning">Password</label>
                        <input type="Password" name="password" value="" placeholder="Password" required="required" class="form-control" id="inputSuccess">
                    </div>


                    <div class="form-group ">
                        <button  type="submit" name="submit" value="submit" class="btn btn-primary">Sign In</button>
                    </div>
                    {!! csrf_field() !!}
                </form>



            </div>
           
        </div>
        
        @if ($error = $errors->First('password'))
     
        <div class="error-username" >       
               
           <p>
                {{ $error }}
          </p>       
        </div>
        @endif

    </body>

</html>

