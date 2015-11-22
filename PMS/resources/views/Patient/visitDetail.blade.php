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
                                   <td>{{$diagose->disease}}</td>           

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
                                   <td>{{$diagose->treatment}}</td>           

                               </tr>
                           </table>
                       </div>
                       <table class="table">
                           <th style="text-align: center;
                               font-size: 30px;">Details Via Images</th>
                       </table>
                       
                       <div class="col-md-12">
                       
                       @foreach ($response as $pr)
                       <div class="col-md-4">
                           <ul class="row">
                          
                             
                                 <p class="col-lg-2 col-md-2 col-sm-3 col-xs-4 image-section"><img src="{{ url('/XRaysDirectory/'.$pr) }}" /></p>          
                                    
                           </ul>
                       </div>
                         @endforeach
                       </div>

                       <a  class="btn btn-default navbar-btn edit" type="submit" onclick="del_visit({{$diagose->id}})"  value="Delete"> Delete <span class="glyphicon glyphicon-remove"></span></a>
                       <a href="{{url('/patient/edit/visit/'.$diagose->id)}}"> <button type="button"  class="btn btn-default navbar-btn edit">Edit <span class="glyphicon glyphicon-pencil"></span></button></a>      

                   </div>

               </div>
           </div>
       </div>
   </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/jquery.zoom.js') }}"></script>
<script type="text/javascript" >

   function del_visit(id) {

     if (confirm("Are you sure to delete the Visit!") == true) {
          window.location.href = "{{url('/patient/visit/delete')}}" + "/" + id;
       } else {

       }

   }

  $('div.col-md-4').zoom();

</script>


@endsection