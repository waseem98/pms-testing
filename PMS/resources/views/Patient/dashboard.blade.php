@extends('layouts.master')

@section('title', 'Patient Form')


@section('content')

<div id="p_div">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <p>
                                Welcome To Patient Management System 
                            </p>
                        </h1>

                    </div>
                </div>

                <div class="container">
                    <br>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{url('/images/hospital.jpg')}}" alt="Chania" width="1000" height="345">
                            </div>

                            <div class="item">
                                <img src="{{url('/images/hospital.jpg')}}" alt="Chania" width="1000" height="345">
                            </div>

                            <div class="item">
                                <img src="{{url('/images/hospital.jpg')}}" alt="Flower" width="1000" height="345">
                            </div>

                            <div class="item">
                                <img src="{{url('/images/hospital.jpg')}}" alt="Flower" width="1000" height="345">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
<!--     end div above               -->      
