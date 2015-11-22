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
                               font-size: 30px;">Set Appointment</th>
                       </table>
                       <form role="form" id="patient_form" method="post" files="true"  action="{{ action('Patient_Controller@addingAppointment') }}" enctype="multipart/form-data">
                           {!! csrf_field() !!}
                           <div class="col-md-3">
                               <table class="table">
                                   <tr>
                                       <td class="haris" style="float: left;
                                           text-align: right;
                                           font-weight: bold;">ID:</td>
                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-3">
                               <table class="table">


                                   <tr>
                                       <td>{{$patient->id}}</td>           

                                   </tr>
                               </table>
                           </div><div class="col-md-3">
                               <table class="table">
                                   <tr>
                                       <td class="haris" style="float: left;
                                           text-align: right;
                                           font-weight: bold;">Name:</td>
                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-3">
                               <table class="table">


                                   <tr>
                                       <td>{{$patient->name}}</td>           

                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-3">
                               <table class="table">


                                   <tr>
                                       <td class="haris" style="float: left;
                                           text-align: right;
                                           font-weight: bold;">Add Notes:</td>    

                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-9">
                               <input type="text"  class="form-control" id="Reports" name="app_note" placeholder="Add Notes here" >
                           </div>

                           <div class="col-md-12">
                           </div>
                           <div class="col-md-3">
                               <table class="table">



                                   <p class="haris" > Next Visit: </p>    


                               </table>
                           </div>
                           <div class="col-md-3" >
                               <input type='text' class="form-control" id='datetimepicker1' name="nextVisit1" placeholder="Select Date"/>
                           </div>
                           <div class="col-md-3">
                               <table class="table">
<p class="haris1" >Visit Timing:</p>    


                               </table>
                           </div>
                           <div class="col-md-3">
                               <input class="form-control" id='timepicker' type='text' name='timepicker' placeholder="Select Time!"/>
                               <input type="hidden" class="form-control" name="patient_id" value="{{$patient->id}}" 
                           </div>

                           
                           <a href="{{url('/patient/list/asc')}}"> <button type="button"  class="btn btn-default navbar-btn edit">Cancel <span class="glyphicon glyphicon-remove"></span></button></a> 
                           <button  class="btn btn-default navbar-btn edit" type="submit" name="submit"  value="Save"> Save <span class="glyphicon glyphicon-ok"></span></button></a> 


                       </form>
                   </div>
                   

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