@extends('layouts.master')

@section('title', 'Patient List')

@section('content')
<div id="p_div">
<div id="wrapper">
    <div id="page-wrapper">
     
        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> @if($appointment==="this_month")Appointments of This Month @endif
    @if($appointment==="today")Appointments of Today @endif
    @if($appointment==="next_week") Appointments of Next Week @endif
    @if($appointment==="all") Appointments of All @endif
    @if($appointment==="next_month") Appointments of Next Month @endif
    @if($appointment==="this_week") Appointments of This Week @endif
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li ><a href="{{url('/patient/appointments/all')}}">All</a></li>
      <li ><a href="{{url('/patient/appointments/today')}}">Today</a></li>
      <li><a href="{{url('/patient/appointments/this_week')}}">This Week</a></li>
      <li><a href="{{url('/patient/appointments/next_week')}}">Next Week</a></li>
      <li  ><a href="{{url('/patient/appointments/this_month')}}">This Month</a></li>
      <li><a href="{{url('/patient/appointments/next_month')}}">Next Month</a></li>
      
    </ul>
  </div>  
 
  

            <table class="bordered">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>   
                        <td>Gender</td>
                        <td>Mobile</td>
                        <td>Appointment</td>
                        <td>Time</td>
                        <td>Action</td>
                        
                    </tr>
                </thead>
                <tbody>
                @if(is_array($data) || is_object($data))
                @for ($pa = 0; $pa < count($data); $pa++)
                <tr>
                    <td>{{$data[$pa]->id}}</td>
                    <td onclick="goToDetails({{$data[$pa] -> id}})">{{$data[$pa]->name}}</td>  
                    <td>{{$data[$pa]->gender}}</td>
                    <td>{{$data[$pa]->mobile}}</td>
                    <td>{{$data[$pa]->next_visit}}</td>
                    <td>{{$data[$pa]->time}}</td>
                    <td> 
                            <a  class="edit" type="submit" onclick="deleteAppointment({{$data[$pa]->ap_id}})"  value="Delete"> Delete </a>
                            <a href="{{url('/patient/editAppointment/'.$data[$pa]->ap_id)}}"  type="button"  class=" edit">Edit </a>
                           
                        </td>   
                </tr>
                @endfor
                @endif

             </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    function goToDetails( e )
    {
        window.location.href="{{url('/patient/detail')}}"+"?id="+ e;
    }
    function deleteAppointment(id) {
   
    if (confirm("Are you sure to delete the Appointment!") == true) {
        window.location.href="{{url('/patient/deleteAppointment')}}"+"/"+id;
    } else {
        
    }
    
}
</script>
@endsection