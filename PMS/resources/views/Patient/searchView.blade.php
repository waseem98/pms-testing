<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            
            <table class="bordered" >
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>   
                        <td>Gender</td>
                        <td>Mobile</td>
                        <td> Action </td>
                    </tr>
                </thead>
                <tbody>
                @if(is_array($searchPatient) || is_object($searchPatient))
                @for ($pa = 0; $pa < count($searchPatient); $pa++)
                <tr>
                    <td>{{$searchPatient[$pa]->id}}</td>
                    <td onclick="goToDetails({{$searchPatient[$pa] -> id}})">{{$searchPatient[$pa]->name}}</td>  
                    <td>{{$searchPatient[$pa]->gender}}</td>
                    <td>{{$searchPatient[$pa]->mobile}}</td>
                    <td><a href="{{url('/patient/addAppointment/'.$searchPatient[$pa]->id)}}"> Add Appointment </a> | <a href="{{url('/patient/edit/'.$searchPatient[$pa]->id)}}" >Edit</a> | <a href="{{url('/patient/delete/'.$searchPatient[$pa]->id)}}"> Delete </a></td>
                </tr>
                @endfor
                @endif
              </tbody>

            </table>

        </div>
    </div>
</div>

<script>
    function goToDetails( e )
    {
       window.location.href="{{url('/patient/detail')}}"+"?id="+ e;
    }


</script>