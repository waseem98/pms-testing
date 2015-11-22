
@extends('layouts.master')

@section('title', 'Edit Appointment')

@section('content')

<div id="p_div">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Patient Appointment Form 
                        </h1>
                        <div class="col-lg-12">
                            <p class="sectionP">Patient Detail</p>
                        </div>
                        <form role="form" id="patient_form" method="post" files="true"  action="{{ action('Patient_Controller@editingAppointment') }}" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                <div class="id">
                                    <b>ID:</b>  {{$patient->id}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="id">
                                    <b>Name:</b>  {{$patient->name}}
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <p class="page-header">
                                </p>
                                <div class="Contact-Information">Set Appointment</div>
                            </div>
                            
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="Address">Add Note</label>
                                       
                                        <input type="text"  value="{{$appoint->notes}}" class="form-control" id="Reports" name="app_note" placeholder="Add Notes here" >

                                       
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="NextVisit" >Next Visit</label>
                                    <div class='input-group date' >
                                        <input type='text' class="form-control" id='datetimepicker1' value="{{$appoint->next_visit}}" name="nextVisit1" placeholder="Select Date"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="NextVisit">Visiting Time</label>
                                    <div class='input-group date' >
                                        <input class="form-control" id='timepicker' type='text' value="{{$appoint->time}}" name='timepicker' placeholder="Select Time!"/>
                                        <input type="hidden" class="form-control" name="id" value="{{$appoint->id}}" />
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/patient/appointments/all')}}"  class="btn btn-default navbar-btn edit" type="submit" name="submit"  value="Save"> Cancel <span class="glyphicon glyphicon-remove"></span></a> 
                            <button  class="btn btn-default navbar-btn edit" type="submit" name="submit"  value="Save"> Save <span class="glyphicon glyphicon-ok"></span></button></a> 


                            {!! csrf_field() !!}
                        </form>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#datetimepicker1").datepicker({dateFormat: 'yy-mm-dd'}).val();
        $('#timepicker').timepicker();
    });
</script>

@endsection