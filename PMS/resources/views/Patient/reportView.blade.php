@extends('layouts.master')

@section('title', 'Patient List')


@section('content')

<div id="p_div">
  <div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="sectionHeading">

                <h1>Patient Report List</h1>

                <div class="dropdown">
    
                    Disease:
    <select id="disease">
            <option  value="Acute_severe_asthma">Acute severe asthma</option>
            <option <?php echo isset($dis1)&&$dis1=="Acute_severe_asthma"?'selected="true"':''; ?> value="Acute_severe_asthma">Acute severe asthma</option>
            <option <?php echo isset($dis1)&&$dis1=="Empyema"?'selected="true"':''; ?> value="Empyema">Empyema</option>
            <option <?php echo isset($dis1)&&$dis1=="Severe_persistent_asthma"?'selected="true"':''; ?> value="Severe_persistent_asthma">Severe persistent asthma</option>
            
            <option <?php echo isset($dis1)&&$dis1=="Acute_LRTI"?'selected="true"':''; ?> value="Acute_LRTI">Acute LRTI</option>
            <option <?php echo isset($dis1)&&$dis1=="Severe_persistent_asthma"?'selected="true"':''; ?> value="Severe_persistent_asthma">Severe persistent asthma</option>
            <option <?php echo isset($dis1)&&$dis1=="APD"?'selected="true"':''; ?> value="APD">APD</option>
            <option <?php echo isset($dis1)&&$dis1=="Mild_intermittent_asthma"?'selected="true"':''; ?> value="Mild_intermittent_asthma">Mild intermittent asthma</option>
            
            <option <?php echo isset($dis1)&&$dis1=="COPD_acute_exacerbation"?'selected="true"':''; ?> value="COPD_acute_exacerbation">COPD acute exacerbation</option>
            <option <?php echo isset($dis1)&&$dis1=="GERD"?'selected="true"':''; ?> value="GERD">GERD</option>
            <option <?php echo isset($dis1)&&$dis1=="DM"?'selected="true"':''; ?> value="DM">DM</option>
            <option <?php echo isset($dis1)&&$dis1=="Perennial_rhinitis"?'selected="true"':''; ?> value="Perennial_rhinitis">Perennial rhinitis</option>
            
             <option <?php echo isset($dis1)&&$dis1=="Heart_failure"?'selected="true"':''; ?>  value="Heart_failure">Heart failure</option>
            <option <?php echo isset($dis1)&&$dis1=="Rhinosinusitis"?'selected="true"':''; ?> value="Rhinosinusitis">Rhinosinusitis</option>
            <option <?php echo isset($dis1)&&$dis1=="Pneumonia"?'selected="true"':''; ?> value="Pneumonia">Pneumonia</option>
            <option <?php echo isset($dis1)&&$dis1=="Acute_URTI"?'selected="true"':''; ?> value="Acute_URTI">Acute URTI</option>
            
             <option <?php echo isset($dis1)&&$dis1=="Parapneumonic_effusion"?'selected="true"':''; ?> value="Parapneumonic_effusion">Parapneumonic effusion</option>
            <option <?php echo isset($dis1)&&$dis1=="Tuberculous_pleural_effusion"?'selected="true"':''; ?> value="Tuberculous_pleural_effusion">Tuberculous pleural effusion</option>
            
            
            
            
   </select>
    
                    Report: 
    <select id="by1">
            <option <?php echo isset($rep1)&&$rep1=="all"?'selected="true"':''; ?> value="all">All</option>
            <option <?php echo isset($rep1)&&$rep1=="today"?'selected="true"':''; ?> value="today">Today</option>
            <option <?php echo isset($rep1)&&$rep1=="this_week"?'selected="true"':''; ?> value="this_week">This Week</option>
            <option <?php echo isset($rep1)&&$rep1=="this_month"?'selected="true"':''; ?> value="this_month">This Month</option>
   </select>
      
                    <button onclick="get_result()">Get Result</button>
  </div>
                
                
            <table class="bordered" >
                <thead>
                    <tr>
                        <td class="bold">Name</td> 
                        <td class="bold">Age</td>
                        <td class="bold">Gender</td>
                        <td class="bold">Disease</td>
                        <td class="bold">Date</td>
                    </tr>
                </thead>
                @if(is_array($searchPatient) || is_object($searchPatient))
                @for ($pa = 0; $pa < count($searchPatient); $pa++)
                <tr>
                    
                    <td onclick="goToDetails({{$searchPatient[$pa] -> id}})">{{$searchPatient[$pa]->name}} </td>  
                    <td>{{$searchPatient[$pa]->age}}</td>
                    <td>{{$searchPatient[$pa]->gender}}</td>
                    <td>{{$searchPatient[$pa]->disease}}</td>
                    <td>{{$searchPatient[$pa]->date}}</td>
                         
                </tr>
                @endfor
                @endif

            </table>



            
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    function goToDetails( e )
    {
      window.location.href="{{url('/patient/detail')}}"+"?id="+ e;
    }

function get_result()
{
    var d1 = document.getElementById("disease");
    var d_value = d1.options[d1.selectedIndex].value;
    var by1 = document.getElementById("by1");
    var by1_value = by1.options[by1.selectedIndex].value;
    window.location.href="{{url('/patient/report')}}"+"/"+ d_value+"/"+ by1_value;
}
</script>

@endsection