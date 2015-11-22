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
                               font-size: 30px;">Patient Visit Details</th>
                       </table>
    <form role="form" id="editVisit_Form" method="post"  action="{{ action('Patient_Controller@editVisit_save') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                       <div class="col-md-3">
                           <table class="table">
                               <tr>
                                   <td class="haris" style="float: left;
                                       text-align: right;
                                       font-weight: bold;">Disease:</td>
                               </tr>
                           </table>
                       </div>
                       <div class="col-md-9">
                           <table class="table">


                               <tr>
                                   <td><input name="disease" value='{{$diagose->disease}}'></td>           

                               </tr>
                           </table>
                       </div>
                       <div class="col-md-3">
                           <table class="table">
                               <tr>
                                   <td class="haris" style="float: left;
                                       text-align: right;
                                       font-weight: bold;">Treatment:</td>
                               </tr>
                           </table>
                       </div>
                       <div class="col-md-9">
                           <table class="table">
                               <tr>
                                   <td><input name="treatment" value='{{$diagose->treatment}}'></td>           
                               </tr>
                           </table>
                       </div>
                       <table class="table">
                           <th style="text-align: center;
                               font-size: 30px;">Details Via Images</th>
                       </table>
                      <input type="hidden" name="p_id" value='{{$diagose->patient_id}}'> 
                      <input type="hidden" name="id" value='{{$diagose->id}}'> 
                       <div class="col-md-12">
                       
                       @foreach ($response as $pr)
                       <div class="col-md-4">
                           <ul class="row">
                                 <p class="col-lg-2 col-md-2 col-sm-3 col-xs-4 image-section"><img src="{{ url('/XRaysDirectory/'.$pr) }}" /></p>          
                           </ul>
                       </div>
                         @endforeach
                       </div>

                       <a  class="btn btn-default navbar-btn edit" type="submit" onclick="myFunction({{$diagose -> patient_id}})"  value="Cancel"> Cancel <span class="glyphicon glyphicon-remove"></span></a>
                        <button type="submit"  class="btn btn-default navbar-btn edit">Save <span class="glyphicon glyphicon-pencil"></span></button>      
      </form>           
                  </div>

               </div>
           </div>
       </div>
   </div>
</div>

<script type="text/javascript" >

   function myFunction(id) {
      window.location.href = "{{url('/patient/detail')}}" + "?id=" + id;
   }

</script>

@endsection