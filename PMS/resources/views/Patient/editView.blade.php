@extends('layouts.master')

@section('title', 'Patient Edit Form')



@section('content')


<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <p>
                            Patients
                        </p>
                    </h1>

                </div>
            </div>
            <!--     make div here               -->
            <div id="p_div" >
                <div class="container">
                    <div class="row">
                        <form role="form" id="patient_form" method="post" files="true"  action="{{ action('Patient_Controller@edit_as') }}" enctype="multipart/form-data">
                        <!-- hidden patient id and disease id -->
                        <input type="hidden" class="form-control" name="patient_id" id="patient_id1"  value='{{$editPatient->id}}'>
                        <input type="hidden" class="form-control" name="diagnosis_d" id="diag_id"  value="">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="InputName" class="patient">Last Visited Date</label>
                                    @if($flag)<div class="id-div"><input type="text" id="curr_date" name="visitDate" value='{{$editDiagnosis->date}}' /> 
                                    @endif 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">

                                    <div class="id-div" id="div1"></div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <input type="hidden" class="form-control" name="diagnosis_list" id="diagnosis_list1" />                         

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputName">Patient Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name" id="InputName" placeholder="Enter Name" value='{{$editPatient->name}}' required>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Age">Age</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="InputAge" name="age" placeholder="Enter Age" value='{{$editPatient->age}}' required>
                                            
                                        </div>
                                    </div>
                                </div>

                                
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value='{{$editPatient->address}}' required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Phone Number">Phone Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="number" id="InputNumber" placeholder="Enter Number" value='{{$editPatient->mobile}}' required>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="social information">Social Information</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="socialinfo" id="InputSocialInfo" placeholder="Enter Social Information" value='{{$editPatient->social_info}}' required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputfile">Attach File</label>
                                        <input type="file" name="xrays[]" multiple>
                                        <p class="help-block">X-Ray or Reports </p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="Clinicalinfo">Clinical Information</label>
                                    <div class="form-group">
                                        <textarea  name="Clinicalinfo" id="ClinicalInfo" placeholder="your statement goes here" >@if($flag){{$editDiagnosis->clinical_info}}@endif</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <label for="Diseases">Diseases</label>
                                    <div class="form-group">
                                        <textarea  name="Diseases_p" id="Diseases1" placeholder="your statement goes here" >@if($flag){{$editDiagnosis->disease}}@endif</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="investigation">investigation</label>
                                    <div class="form-group">
                                        <textarea name="investigation" id="investigation1" placeholder="your statement goes here"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="Treatment">Treatment</label>
                                    <div class="form-group">
                                        <textarea  name="treatment" id="Treatment1" placeholder="your statement goes here"  >@if($flag){{$editDiagnosis->treatment}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="Address">General Reports</label>
                                        <!--                                        <div class="form-control">-->
                                        <input type="text"  class="form-control" id="Reports" name="Report" placeholder="General Reports goes here" required>

                                        <!--                                        </div>-->
                                    </div>
                                </div>

                                <!-- commented -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="NextVisit" >Next Visit</label>
                                        <div class='input-group date' >
                                            <input type='text' class="form-control" id='datetimepicker1' name="nextVisit1" placeholder="Select Date"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="NextVisit">Visiting Time</label>
                                        <div class='input-group date' >
                                            <input class="form-control" id='timepicker' type='text' name='timepicker' placeholder="Select Time!"/>

                                        </div>
                                    </div>
                                </div>

                                    <input type="submit" name="submit" id="submit" value="Edit" class="btn btn-info pull-right">
                                </div>
                                {!! csrf_field() !!}
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
