<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use DB;
use App\Patient;
use App\Diagnosis;
use App\Xrays;
use App\Appointment;
use Log;
class Patient_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
//        ini_set('display_errors',1);
//        ini_set('display_startup_errors',1);
//        error_reporting(-1);
        $page="add";
        return view('Patient.patient')->with('page',$page);
    }
    
    public function show_dashboard()
    {
        $page="dashboard";
        return \View('Patient.dashboard')->with('page',$page)  ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pa)
    {
        $diagnosis=new Diagnosis;
        $patient=new Patient;
        $pa1=$patient->get_patient($pa);
        $result=$diagnosis->get_diagnosis($pa);
        $flag=false;
        if(isset($result))
        {
           $flag=true;
        }
        //echo var_dump($flag); exit();
         return \View::make('Patient.editView')->with('editPatient',$pa1)->with('editDiagnosis',$result)->with('flag',$flag); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pa)
    {
        $patient=new Patient;
        $pa1=$patient->destroy($pa);
        //$page="page_list";
        $page="patient_list";
       return Redirect::to('patient/list/asc')->with('page',$page);
    }
    
    public function edit_as()
    {
        
        $input=Input::all();
        $flag=false;

        if(Input::hasFile('xrays'))
        {
            $flag=true;
        }
        $patient1 = new Patient;
        $patient1->edit_patient_as($input,$flag);  
        
        $page="patient_list";
       return Redirect::to('patient/list/asc')->with('page',$page);
        
    }


    public function save_as()
    {
        
        $input=Input::all();
        
        $flag=false;

        if(Input::hasFile('xrays'))
        {
            $flag=true;
        }
        $patient1 = new Patient;
        $patient1->save_patient($input,$flag);  
        $page="dashboard";
       return Redirect::to('dashboard')->with('page',$page);
    }

    
    public function patient_details()
    {
        $patient=new Patient;
        $int = (int)(Input::get('id'));
            $page="page_list";
            $result=$patient->get_patient($int);
            // to get the number of visits from diagnosis table
            $diagnosis=new Diagnosis;
            $visits=$diagnosis->get_all_diagnosis($int);
        return \View::make('Patient.patientDetail')->with('searchPatient',$result)->with('visits',$visits)->with('page',$page);
    }

    public function search()
    {
        $patient=new Patient;
        $text=Input::get('txt');

        $searchPatient=$patient->get_search(Input::get($text));
       
      return \View::make('Patient.searchView')->with('searchPatient',$searchPatient);
    
    }

    public function patient_list($sortby='asc')
    {
        $patient=new Patient;
            $result=Patient::orderBy('name', $sortby)->paginate(10);
            $result->setPath('');//->paginate(5);
            $page="page_list";
            return \View::make('Patient.patientList')->with('searchPatient',$result)->with('page',$page)->with('sortby',$sortby);   
    }

     public function appointments()
    {

        $patient=new Patient;
        
        $data=$patient->get_appoint('this_week');
        $appointment="this_week";
       return view('Patient.appointments')->with('data',$data)->with('appointment',$appointment);
         
    
    }

    public function appointment($by1)
    {

        $patient=new Patient;
            $data=$patient->get_appoint($by1);
          $appointment=$by1;
           return view('Patient.appointments')->with('data',$data)->with('appointment',$appointment);
    
    }

    public function visit_detail($diag)
    {
         $diagose=new Diagnosis;
         $result=$diagose->get_diagnosis_byId($diag);
         $xray=new Xrays;
         $xrays=$xray->get_images($diag);
         $xrasy_arr= array();
         if(isset($xrays))
         {
           $xrasy_arr=explode(",", $xrays->image);  
         }
         return \view('Patient.visitDetail')->with('diagose',$result)->with('response', $xrasy_arr);
    }

    public function addAppointment($pa)
    {
        $patient=new Patient;
        $pa1=$patient->get_patient($pa);
        return \view('Patient.addAppointment')->with('patient',$pa1);
    }
    
   
     public function addingAppointment()
    {
        $input=Input::all();
        $appoint = new Appointment;
        $appoint->next_visit=$input['nextVisit1'];
        $appoint->time=$input['timepicker'];
        $appoint->patient_id=$input['patient_id'];
        $appoint->notes=$input['app_note'];
        $appoint->save();
        $page="patient_list";
       return Redirect::to('patient/list/asc')->with('page',$page);
    }
  public function deleteAppointment($app)
  {
      $appoint=new Appointment;
        $pa1=$appoint->destroy($app);
        $page="appointment";
       return Redirect::to('patient/appointments/all')->with('page',$page);
  }
  
   public function editAppointment($app)
    {
        $appoint=new Appointment; 
        $app=$appoint->get_appoint($app);
        $patient=new Patient;
        $pa1=$patient->get_patient($app->patient_id);
        return \view('Patient.editAppointment')->with('appoint',$app)->with('patient',$pa1);
    }
    
    public function editingAppointment()
    {
        
        $input=Input::all();
        $appoint = new Appointment;
        $appoint->next_visit=$input['nextVisit1'];
        $appoint->time=$input['timepicker'];
        $appoint->id=$input['id'];
        $appoint->notes=$input['app_note'];
        $appoint->edit_appoint($appoint);
        $page="appointment";
       return Redirect::to('patient/appointments/all')->with('page',$page);
    }
    
    public function get_report($by1='Acute_severe_asthma',$by2='all')
    {
            $patient=new Patient; 
            $result=$patient->get_report_result($by1,$by2);
            $page="report";
            $dis1=$by1;
            $rep1=$by2;
            return \View::make('Patient.reportView')->with('searchPatient',$result)->with('page',$page)->with('disease',$by1)->with('dis1',$dis1)->with('rep1',$rep1);   
    }
    
     
     public function get_printView()
     {
         $input=Input::all();
         $view = \View::make('Patient.printView')->with('data',$input);
         $response=array();
         $response['html']=$view->render(); 
        return json_encode($response);
     }
    
    public function editVisit($v_id)
    {
       $diagose=new Diagnosis; 
       $result=$diagose->get_diagnosis_byId($v_id);
       $xray=new Xrays;
         $xrays=$xray->get_images($v_id);
         $xrasy_arr= array();
         if(isset($xrays))
         {
           $xrasy_arr=explode(",", $xrays->image);  
         }
         return \view('Patient.editVisit')->with('diagose',$result)->with('response', $xrasy_arr);
    }

    public function deleteVisit($v_id)
    {
        $diagose=new Diagnosis;
        $int_diag_id= (int)($v_id);
        
        $int=($diagose->get_patient_id($int_diag_id));
        
        //echo var_dump($int); exit();       
        
        $diagose->destroy($int_diag_id);

        $xray=new Xrays;
        $xray->delete_xray($int_diag_id);
        /*$id_1="";
        $id_1=$id_1.$int;
        *///echo var_dump($id_1); exit();       
        return Redirect::to('patient/detail?id='.$int);
        
    }

    public function editVisit_save()
    {
        $input=Input::all();
        $diagose=new Diagnosis;
        $diagose->update_diagnosis($input);

        return Redirect::to('patient/detail?id='.$input['p_id']);
    }
    
}