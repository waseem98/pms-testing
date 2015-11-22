@extends('layouts.master')

@section('title', 'Patient List')

@section('content')
<div id="p_div">
  @include('Patient.patientListPartial')
</div>


<script type="text/javascript">
$('document').ready(function () {


     $( ".target" ).change(function(e) {
       $.get('{{ action('Patient_Controller@patient_list') }}',{sortBy: $( "#mySelect" ).val()},function(response){
            $('#p_div').innerHTML="";
            $('#p_div').html(response);
            
        });
});


});

  function goToDetails( e )
  {
    window.location.href="{{url('/patient/detail')}}"+"?id="+ e;    
  }


</script>
@endsection