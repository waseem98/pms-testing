@extends('layouts.master')

@section('title', 'Patient Form')

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
                        <form role="form" id="patient_form" method="post" files="true" onsubmit="get_diagnosis()" action="{{ action('Patient_Controller@save_as') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="InputName" class="patient">Visiting Date</label>
                                    <div class="id-div"><input type="text" id="curr_date" name="visitDate" /> 

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
                                            <input type="text" class="form-control" name="name" id="InputName" placeholder="Enter Name" required>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Age">Age</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="InputAge" name="age" min="1" max="100" placeholder="Enter Age" required>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-xs-9">
                                    <div >
                                        <label>Male</label>
                                        <input type="radio" id="r1" name="gender" value="male" checked />
                                        <label>Female</label> 
                                        <input type="radio" id="r2" name="gender" value="female" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Phone Number">Phone Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="number" id="InputNumber" placeholder="Enter Number" required>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">Reference</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="reference" id="InputReference" placeholder="Enter Reference" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="social information">Social Information</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="socialinfo" id="InputSocialInfo" placeholder="Enter Social Information" required>

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
                                        <textarea  name="Clinicalinfo" id="ClinicalInfo1" placeholder="your statement goes here"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="Diagnosis">Diagnosis</label>
                                    <div id="div_diagnosis">
                                        <div class="section1">
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox1" value="Acute severe asthma" class = ""> Acute severe asthma
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox2" value="Severe persistent asthma"> Severe persistent asthma
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox3" value="Moderate persistent asthma"> Moderate persistent asthma
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox4" value="Mild intermittent asthma"> Mild intermittent asthma
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox5" value="Allergic rhinitis"> Allergic rhinitis
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox6" value="Perennial rhinitis"> Perennial rhinitis
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox7" value="Rhinosinusitis"> Rhinosinusitis
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox8" value="Acute URTI"> Acute URTI
                                            </label>
                                        </div>
                                        <div class="section2">
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox9" value="Acute LRTI"> Acute LRTI
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox10" value="COPD stable"> COPD stable
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox11" value="COPD acute exacerbation"> COPD acute exacerbation
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox12" value="Interstitial lung disease"> Interstitial lung disease
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox13" value="Pulmonary tuberculosis"> Pulmonary tuberculosis
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox14" value="Tuberculous pleural effusion"> Tuberculous pleural effusion
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox15" value="Pneumonia"> Pneumonia
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox16" value="Parapneumonic effusion"> Parapneumonic effusion
                                            </label>
                                        </div>
                                        <div class="section3">

                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox17" value="Empyema"> Empyema
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox18" value="APD"> APD
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox19" value="GERD"> GERD
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox20" value="DM"> DM
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox21" value="HTN"> HTN
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="inlineCheckbox22" value="Heart failure"> Heart failure
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="investigation">investigation</label>
                                    <div class="form-group">
                                        <textarea name="investigation" id="investigation1" ></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="Treatment">Treatment</label>
                                    <div class="form-group">
                                        <textarea  name="treatment" id="Treatment1" ></textarea>
                                    </div>
                                </div>
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
                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <div class='action_button' >
                                            <div class="print">
                                                <input type="button" name="print" onClick="get_form_data()" value="Print" class="btn btn-info pull-center" style="margin-right: 10px;"> 
                                                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right" style="margin-right: 10px;">
                                            </div>


                                        </div>
                                    </div>
                                </div>

                        </form>

                    </div>
                </div>




            </div>
        </div>
    </div>

</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btnprints').on('click', function (event) {
            event.preventDefault();
            window.open("{{url('../resources/views/Patient/printView.blade.php')}}", "myWindow", "width=200, height=100");
        });
    });


  $(document).ready(function () {
    $("#datetimepicker1").datepicker({dateFormat: 'yy-mm-dd'}).val();
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();
    newdate = year + "/" + month + "/" + day;
    document.getElementById("curr_date").value = newdate;
    document.getElementById("curr_date").readOnly = true;
    $('#timepicker').timepicker();
});


function get_diagnosis()
{
    var z = '';
    $('input[type="checkbox"]:checked').each(function () {
        //     removed the space ^
        if (z === null || z === '')
        {
            console.log('in first value');
            z = z + $(this).val();

        } else {
            console.log('in 2nd value');

            z = z + "," + $(this).val();
        }

    });

    $("#diagnosis_list1").val(z);
}

function get_form_data()
{
    var z = '';
    $('input[type="checkbox"]:checked').each(function () {
        //     removed the space ^
        if (z === null || z === '')
        {
            console.log('in first value');
            z = z + $(this).val();

        } else {
            console.log('in 2nd value');

            z = z + "," + $(this).val();
        }
    });

    $("#diagnosis_list1").val(z);
    var data1 = $("#patient_form").serialize();

    $.post('{{ action('Patient_Controller@get_printView') }}', data1, function (response) {
        var xPos = (screen.width / 2) - (700 / 2);
        var yPos = (screen.height / 2) - (400 / 1.5);
        var myWindow = window.open("", "myWindow", "width=700, height=400,left=" + xPos + ",top=" + yPos + "");
        myWindow.document.write(response.html);

    }, 'JSON');

}

function trip_tinymce(data)
{
    var text = data;

    var clearRegexp = /<[^>]+>/g;

    text = text.replace(clearRegexp, "");

    var hasContent = text.trim() != "";
    return hasContent;
}


</script>


@endsection
<!--     end div above               -->      



