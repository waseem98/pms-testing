<html>
    <head>
        <title>PMS - @yield('title')</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Custom Fonts -->
        <link href="{{url('/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/sb-admin.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/entire.css') }}">

<script type="text/javascript" src="{{ URL::asset('js/jquery.timepicker.js') }}"></script>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.timepicker.css') }}">

        <link rel="stylesheet" href="{{ URL::asset('jqueryTableSorter/themes/blue/style.css') }}">
         
        <script type="text/javascript" src="{{ URL::asset('jqueryTableSorter/jquery.tablesorter.js') }}"></script>
        <script type="text/javascript">


    $('document').ready(function () {
     


    $('#searchButton1').click(function () {
        var search1 = $('#search_box').val();
        $.get('{{ action('searchPatient@search') }}', {txt: search1}, function (response) {
            $('#p_div').html("");
            $('#p_div').html(response);
        });
    });


   $('#search_box').keypress(function(e){
        if(e.which == 13){//Enter key pressed
             $('#searchButton1').click();//Trigger search button click event
          }
    });

    function goToDetails( e )
    {
        window.location.href="{{url('/patient/detail')}}"+"?id="+ e;
    }

});
        </script>

    </head>
    <body>

        @section('sidebar')
        <div id="printView_div">
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/dashboard')}}">Patient Management System</a>

                    <div class="search" style="">

                        <div class="search" name="search_patient" style="    position: absolute;
                             left: 691px;
                             top: 12px;">
                            <!--                                {!! csrf_field() !!}-->
                            <input type="text" name="search" id="search_box" size="40" maxlength="50" placeholder="Search" style="    padding-left: 15px;"    />&nbsp;
                            <span class="input-group-btn">
                                <button class="btn btn-danger" name="searchButton" id="searchButton1" type="button" style="position: absolute;
                                        top: -26px;
                                        left: 314px;
                                        width: 50px;
                                        height: 26px;">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>



                    </div>



                </div>

                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            
                            
                            
                            <li>
                                <a href="{{url('/Auth/AuthController')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li <?php echo isset($page)&&$page=="dashboard"?'class="active"':''; ?> >
                            <a href="{{url('/dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li <?php echo isset($page)&&$page=="page_list"?'class="active"':''; ?> >
                            <a href="{{url('/patient/list/asc')}}"><i class="fa fa-fw fa-bar-chart-o"></i>Patient's List </a>
                        </li>
                        <li <?php echo isset($page)&&$page=="add"?'class="active"':''; ?>>
                            <a href="{{url('/patient')}}" ><i class="fa fa-fw fa-dashboard"></i> Add Patient</a>
                        </li>
                        <li <?php echo isset($page)&&$page=="appointments"?'class="active"':''; ?>>
                            <a href="{{url('/patient/appointments')}}"><i class="fa fa-fw fa-table"></i> Appointments</a>
                        </li>
                        
                        <li <?php echo isset($page)&&$page=="report"?'class="active"':''; ?>>
                            <a href="{{url('/patient/report')}}"><i class="fa fa-fw fa-table"></i> Reports</a>
                        </li>

                    </ul>
                </div>

            </nav>
        </div>
        @show

        <div class="container">
            @yield('content')
        </div>

</div>
        <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>

        <script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
        </script>

    </body>
</html>