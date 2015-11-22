
@extends('layouts.master')

@section('title', 'Patient Form')

@section('content')


<div id="p_div">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <table class="table">

                            <th style="text-align: center;
                                font-size: 30px;">Patient Information</th>

                        </table>


                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td class="haris" style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Id:</td>


                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->id}}</td>           

                                </tr>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td class="right" style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Name:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td >{{$searchPatient->name}}</td>           

                                </tr>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td class="right" style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Age:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->age}}</td>           

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Gender:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->gender}}</td>           

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Address:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-9">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->address}}</td>           

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Mobile:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->mobile}}</td>           

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Reference:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->references}}</td>           

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td style="float: left;
                                        text-align: right;
                                        font-weight: bold;">Social Information:</td>


                                </tr>

                            </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table">


                                <tr>
                                    <td>{{$searchPatient->social_info}}</td>           

                                </tr>
                            </table>
                        </div>

                    </div>


                    <div class="col-md-12">

                        <table class="table">
                            <th style="text-align: center;
                                font-size: 30px;">Patient Information</th>
                        </table>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>
                                        @if(is_array($visits) || is_object($visits))
                                        @for ($pa = 0; $pa < count($visits); $pa++)
                                        <a href="{{url('/patient/visit/'.$visits[$pa]->id)}}"> <button type="button"   class="btn btn-default navbar-btn visit">Visit No: {{$pa+1}}</button></a>
                                        @endfor
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a  class="btn btn-default navbar-btn edit" type="submit" onclick="myFunction({{$searchPatient -> id}})"  value="Delete"> Delete <span class="glyphicon glyphicon-remove"></span></a>
                    <a href="{{url('/patient/edit/'.$searchPatient->id)}}"> <button type="button"  class="btn btn-default navbar-btn edit">Edit <span class="glyphicon glyphicon-pencil"></span></button></a> 
                </div>



            </div>
        </div>
    </div>
</div>

@endsection

<script >

    function myFunction(id) {

    if (confirm("Are you sure to delete the patient!") == true) {
    window.location.href = "{{url('/patient/delete')}}" + "/" + id;
    } else {

    }
       
    
}

</script>
