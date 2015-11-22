<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
         
            <div class="sectionHeading">
                <h1>Patient List</h1>
         

            <table class="bordered" >
                <thead>
                    <tr>
                        <td class="bold">id</td>
                        <td class="bold">Name @if( $sortby === 'asc' )
                <a style="float: right;" href="{{ url('patient/list/desc') }}"><span class="glyphicon glyphicon-chevron-down"></span></a>
            @else
                <a style="float: right;" href="{{ url('patient/list/asc') }}"><span class="glyphicon glyphicon-chevron-up"></span></a>
            @endif</td>	
                        <td class="bold">Gender</td>
                        <td class="bold">Mobile</td>
                        <td class="bold">Action</td>

                    </tr>
                </thead>
                @if(is_array($searchPatient) || is_object($searchPatient))
                @for ($pa = 0; $pa < count($searchPatient); $pa++)
                <tr>
                    <td>{{$searchPatient[$pa]->id}}</td>
                    <td onclick="goToDetails({{$searchPatient[$pa] -> id}})">{{$searchPatient[$pa]->name}} </td>	
                    <td>{{$searchPatient[$pa]->gender}}</td>
                    <td>{{$searchPatient[$pa]->mobile}}</td>
                    

                        <td> 
                            <a  class="edit" type="submit" onclick="myFunction({{$searchPatient[$pa] -> id}})"  value="Delete"> Delete </a>
                            <a href="{{url('/patient/edit/'.$searchPatient[$pa]->id)}}"  type="button"  class=" edit">Edit </a>
                            <a href="{{url('/patient/addAppointment/'.$searchPatient[$pa]->id)}}"class="edit">Add Appointment </a>
                        </td>
                </tr>
                @endfor
                @endif

            </table>
            <?php echo $searchPatient->render() ?>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">

function myFunction(id) {
   
    if (confirm("Are you sure to delete the patient!") == true) {
        window.location.href="{{url('/patient/delete')}}"+"/"+id;
    } else {
        
    }
    
}

</script>