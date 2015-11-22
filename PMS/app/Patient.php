<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Patient extends \Eloquent
{
    protected $table = 'patient';

    function get_patients($txt)
    {
         $patiets=DB::table('patient')
            ->where('name',  'LIKE', ''.$txt.'%')->get();
        return $patiets;
    }
 
    function edit_patient_as($input,$flag)
    {
         $patient1 = new Patient;
        $patient1->name=$input['name'];
        $patient1->age=$input['age'];
        $patient1->mobile=$input['number'];
        $patient1->address=$input['address'];
        $patient1->social_info=$input['socialinfo'];
        $patient1->edit_patient($input['patient_id'],$patient1);
        
        $diagose=new Diagnosis;
        $diagose->disease=strip_tags($input['Diseases_p']);
        $diagose->treatment=strip_tags($input['treatment']);
        $diagose->g_report=$input['Report'];
        $diagose->clinical_info=strip_tags($input['Clinicalinfo']);
    
        $diagose->next_visit=$input['nextVisit1'];
        $diagose->patient_id=$input['patient_id'];
        $diagose->save();
        $insertedId_diag = $diagose->id;
        
        $patient1->save_xrays($input,$insertedId_diag,$input['patient_id'],$flag);

    }

    function save_patient($input,$flag)
    {
        $patient1 = new Patient;
        $patient1->name=$input['name'];
        $patient1->age=$input['age'];
        $patient1->gender=$input['gender'];
        $patient1->mobile=$input['number'];
        $patient1->address=$input['address'];
        $patient1->references=$input['reference'];
        $patient1->social_info=$input['socialinfo'];
        $patient1->dr_id=1;
        $patient1->save();
        $insertedId = $patient1->id;
        $diagose=new Diagnosis;
        $diagose->disease=$input['diagnosis_list'];
        $diagose->treatment=strip_tags($input['treatment']);
        $diagose->g_report=$input['Report'];
        $diagose->clinical_info=strip_tags($input['Clinicalinfo']);
        $diagose->patient_id=$insertedId;
        $diagose->next_visit=$input['nextVisit1'];
        $diagose->date=$input['visitDate'];
        $diagose->time=$input['timepicker'];
        $diagose->save();
         $insertedId_diag = $diagose->id;
        // save appointment if entered
        
        if($input['nextVisit1']!==null && $input['timepicker']!==null)
        {
            $appoint = new Appointment;
            $appoint->next_visit=$input['nextVisit1'];
            $appoint->time=$input['timepicker'];
            $appoint->patient_id=$insertedId;
            $appoint->save();
        
        }
        
        $patient1->save_xrays($input,$insertedId_diag,$insertedId,$flag);
        
    }

    function get_search($txt)
    {
       $patiets=DB::select('select distinct(patient.id), patient.name, patient.gender , patient.references, patient.mobile from patient , diagnosis where patient.id = diagnosis.patient_id and patient.id  LIKE "'.$txt.'%" or patient.name  LIKE "'.$txt.'%" or patient.mobile  LIKE "'.$txt.'%" or diagnosis.disease  LIKE "'.$txt.'%" or patient.gender  LIKE "'.$txt.'%" ');
       return $patiets;
       
       // $patiets = DB::table('patient')->select(distinct('id'),'name','gender','mobile')
       //  ->join('diagnosis', function ($join) {
       //      $join->on('patient.id', '=', 'diagnosis.patient_id')
       //           ->where('patient.name', 'like', 'asd%')
       //           ->orwhere('diagnosis.disease'  ,'like' ,'Acute%');         
       //  })
       //  ->get();
    }

    function get_appoint($o_By)
    {
         if($o_By==="this_week")
         {
            $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE "" and WEEKOFYEAR(appointment.next_visit)=WEEKOFYEAR(NOW()) order by appointment.next_visit desc');

         return $patiets;   
         }
         
         if($o_By==="today")
         {
             
            $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE "" and appointment.next_visit=CURDATE() order by appointment.next_visit desc');

         return $patiets;   
         }
         
         if($o_By==='next_week')
         {
            
            $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE "" and WEEKOFYEAR(appointment.next_visit)=(WEEKOFYEAR(NOW())+1) order by appointment.next_visit desc');

         return $patiets;   
         }
         if($o_By==='all')
         {
            
            $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE ""  order by appointment.time asc');

         return $patiets;   
         }

         if($o_By==='this_month')
         {
            
             $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE "" and Year(appointment.next_visit) = Year(CURRENT_TIMESTAMP) 
                 AND Month(appointment.next_visit) = Month(CURRENT_TIMESTAMP) order by appointment.time asc');

         return $patiets;   
         }

         if($o_By==='next_month')
         {
            
             $patiets=DB::select('select appointment.id as ap_id, patient.id, patient.name, patient.gender, patient.references, patient.mobile, appointment.next_visit , appointment.time from patient , appointment where patient.id =appointment.patient_id and appointment.next_visit NOT LIKE "" and Year(appointment.next_visit) = Year(CURRENT_TIMESTAMP) 
                 AND Month(appointment.next_visit) = (Month(CURRENT_TIMESTAMP)+1) order by appointment.time asc');

         return $patiets;   
         }
         
    }
    
    
     function get_sorted_result($sortBy)
     {
        if($sortBy==='asc')
         {
            
            $patiets= DB::table('patient')
                    ->orderBy('name', 'asc')
                    ->get();
          return $patiets;
         }
         if($sortBy==='desc')
         {
             
             $patiets= DB::table('patient')
                    ->orderBy('name', 'desc')
                    ->get();
          return $patiets;
         }
     }

     function get_patient($id)
    {
        $patiets=DB::table('patient')
             ->where('id',  '=', $id)->first();
        return $patiets;
    }
    
    function edit_patient($id,$pa)
    {  
        DB::table('patient')
        ->where('id', $id)
        ->update(['name' => $pa->name , 'age' => $pa->age,'mobile' => $pa->mobile,'address' => $pa->address,'social_info' => $pa->social_info]);
    }

    function save_xrays($input,$insertedId_diag,$patientId,$flag)
    {
        if($flag)
        {

               $files=$input['xrays'];
            $file_count = count($files);
    
            if($file_count>0)
            {

                $count=0;
                $image_record="";

                if($file_count>1)
                {
                   foreach($files as $file) {
                      
                      $filename  =  $insertedId_diag. '.' . $file->getClientOriginalName();

                       $path = public_path('XRaysDirectory' , $filename);
                       $file->move($path, $filename);
                        if($count===0)
                        {
                          $image_record=$filename;    
                        }
                        else
                        {
                           $image_record=$image_record.",".$filename;    
                        }
                        
                        $count++;
                   }
                         
                }
                else
                {
                     $image_record  =  $insertedId_diag. '.' . $files[0]->getClientOriginalName();

                       $path = public_path('XRaysDirectory' , $image_record);
                       // $image->move($path);
                       $files[0]->move($path, $image_record);
                }
                
                // save record in Xrays

                $xray=new Xrays;  
                $xray->image = $image_record;
                $xray->patient_id=$patientId;
                $xray->diagnose_id=$insertedId_diag;
                $xray->save();   
           
            }
        }
    }

    function get_report_result($by1,$by2)
    {
        if($by1==='all' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id), patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease , diagnosis.date from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%" or diagnosis.disease  LIKE "%Acute LRTI%" or diagnosis.disease  LIKE "%Empyema%" or diagnosis.disease  LIKE "%Severe persistent asthma%" or diagnosis.disease  LIKE "%COPD stable%" or diagnosis.disease  LIKE "%APD%" or diagnosis.disease  LIKE "%Mild intermittent asthma%" or diagnosis.disease  LIKE "%COPD acute exacerbation%" or diagnosis.disease  LIKE "%GERD%" or diagnosis.disease  LIKE "%Interstitial lung disease%" or diagnosis.disease  LIKE "%DM%" or diagnosis.disease  LIKE "%Allergic rhinitis%" or diagnosis.disease  LIKE "%Pulmonary tuberculosis%" or diagnosis.disease  LIKE "%HTN%" or diagnosis.disease  LIKE "%Perennial rhinitis%" or diagnosis.disease LIKE "%Heart failure%" or diagnosis.disease LIKE "%Rhinosinusitis%" or diagnosis.disease LIKE "%Pneumonia%" or diagnosis.disease LIKE "%Acute URTI%" or diagnosis.disease LIKE "%Parapneumonic effusion %" or diagnosis.disease LIKE "%Tuberculous pleural effusion%" or diagnosis.disease LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }

       

        if($by1==='all' && $by2==='today')
        {

          $patiets=DB::select('select distinct(patient.id), diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Acute severe asthma%" or diagnosis.disease  LIKE "%Acute LRTI%" or diagnosis.disease  LIKE "%Empyema%" or diagnosis.disease  LIKE "%Severe persistent asthma%" or diagnosis.disease  LIKE "%COPD stable%" or diagnosis.disease  LIKE "%APD%" or diagnosis.disease  LIKE "%Mild intermittent asthma%" or diagnosis.disease  LIKE "%COPD acute exacerbation%" or diagnosis.disease  LIKE "%GERD%" or diagnosis.disease  LIKE "%Interstitial lung disease%" or diagnosis.disease  LIKE "%DM%" or diagnosis.disease  LIKE "%Allergic rhinitis%" or diagnosis.disease  LIKE "%Pulmonary tuberculosis%" or diagnosis.disease  LIKE "%HTN%" or diagnosis.disease  LIKE "%Perennial rhinitis%" or diagnosis.disease LIKE "%Heart failure%" or diagnosis.disease LIKE "%Rhinosinusitis%" or diagnosis.disease LIKE "%Pneumonia%" or diagnosis.disease LIKE "%Acute URTI%" or diagnosis.disease LIKE "%Parapneumonic effusion %" or diagnosis.disease LIKE "%Tuberculous pleural effusion%" or diagnosis.disease LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }
        
         if($by1==='all' && $by2==='this_week')
        {
        
          $patiets=DB::select('select distinct(patient.id), diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Acute severe asthma%" or diagnosis.disease  LIKE "%Acute LRTI%" or diagnosis.disease  LIKE "%Empyema%" or diagnosis.disease  LIKE "%Severe persistent asthma%" or diagnosis.disease  LIKE "%COPD stable%" or diagnosis.disease  LIKE "%APD%" or diagnosis.disease  LIKE "%Mild intermittent asthma%" or diagnosis.disease  LIKE "%COPD acute exacerbation%" or diagnosis.disease  LIKE "%GERD%" or diagnosis.disease  LIKE "%Interstitial lung disease%" or diagnosis.disease  LIKE "%DM%" or diagnosis.disease  LIKE "%Allergic rhinitis%" or diagnosis.disease  LIKE "%Pulmonary tuberculosis%" or diagnosis.disease  LIKE "%HTN%" or diagnosis.disease  LIKE "%Perennial rhinitis%" or diagnosis.disease LIKE "%Heart failure%" or diagnosis.disease LIKE "%Rhinosinusitis%" or diagnosis.disease LIKE "%Pneumonia%" or diagnosis.disease LIKE "%Acute URTI%" or diagnosis.disease LIKE "%Parapneumonic effusion %" or diagnosis.disease LIKE "%Tuberculous pleural effusion%" or diagnosis.disease LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }

        if($by1==='all' && $by2==='this_month')
        {
        
          $patiets=DB::select('select distinct(patient.id), patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease , diagnosis.date from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Acute severe asthma%" or diagnosis.disease  LIKE "%Acute LRTI%" or diagnosis.disease  LIKE "%Empyema%" or diagnosis.disease  LIKE "%Severe persistent asthma%" or diagnosis.disease  LIKE "%COPD stable%" or diagnosis.disease  LIKE "%APD%" or diagnosis.disease  LIKE "%Mild intermittent asthma%" or diagnosis.disease  LIKE "%COPD acute exacerbation%" or diagnosis.disease  LIKE "%GERD%" or diagnosis.disease  LIKE "%Interstitial lung disease%" or diagnosis.disease  LIKE "%DM%" or diagnosis.disease  LIKE "%Allergic rhinitis%" or diagnosis.disease  LIKE "%Pulmonary tuberculosis%" or diagnosis.disease  LIKE "%HTN%" or diagnosis.disease  LIKE "%Perennial rhinitis%" or diagnosis.disease LIKE "%Heart failure%" or diagnosis.disease LIKE "%Rhinosinusitis%" or diagnosis.disease LIKE "%Pneumonia%" or diagnosis.disease LIKE "%Acute URTI%" or diagnosis.disease LIKE "%Parapneumonic effusion %" or diagnosis.disease LIKE "%Tuberculous pleural effusion%" or diagnosis.disease LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }
        
        
        if($by1==='Acute_severe_asthma' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }

        if($by1==='Acute_severe_asthma' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Acute_severe_asthma' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Acute_severe_asthma' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
         

         if($by1==='Acute_LRTI' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        } 
        if($by1==='Acute_LRTI' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Acute LRTI%"');
         return $patiets;   
        }
        if($by1==='Acute_LRTI' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Acute LRTI%"');
         return $patiets;   
        }
        if($by1==='Acute_LRTI' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Acute LRTI%"');
         return $patiets;   
        }
        
        
        if($by1==='Empyema' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Empyema' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Empyema%"');
         return $patiets;   
        }
        if($by1==='Empyema' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Empyema%"');
         return $patiets;   
        }
        if($by1==='Empyema' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Empyema%"');
         return $patiets;   
        }
        
        
        if($by1==='Severe_persistent_asthma' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Severe_persistent_asthma' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Severe persistent asthma%"');
         return $patiets;   
        }
        if($by1==='Severe_persistent_asthma' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Severe persistent asthma%"');
         return $patiets;   
        }
        if($by1==='Severe_persistent_asthma' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Severe persistent asthma%"');
         return $patiets;   
        }
        
        
        if($by1==='APD' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='APD' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%APD%"');
         return $patiets;   
        }
        if($by1==='APD' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%APD%"');
         return $patiets;   
        }
        if($by1==='APD' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%APD%"');
         return $patiets;   
        }
        
         
         if($by1==='Mild_intermittent_asthma' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
         if($by1==='Mild_intermittent_asthma' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Mild intermittent asthma%"');
         return $patiets;   
        }
        if($by1==='Mild_intermittent_asthma' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Mild intermittent asthma%"');
         return $patiets;   
        }
        if($by1==='Mild_intermittent_asthma' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Mild intermittent asthma%"');
         return $patiets;   
        }
        

        
        if($by1==='COPD_acute_exacerbation' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='COPD_acute_exacerbation' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%COPD acute exacerbation%"');
         return $patiets;   
        }
        if($by1==='COPD_acute_exacerbation' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%COPD acute exacerbation%"');
         return $patiets;   
        }
        if($by1==='COPD_acute_exacerbation' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%COPD acute exacerbation%"');
         return $patiets;   
        }
        
        

         if($by1==='GERD' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='GERD' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%GERD%"');
         return $patiets;   
        }
        if($by1==='GERD' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%GERD%"');
         return $patiets;   
        }
        if($by1==='GERD' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%GERD%"');
         return $patiets;   
        }
        

        
         if($by1==='DM' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='DM' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%DM%"');
         return $patiets;   
        }
        if($by1==='DM' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%DM%"');
         return $patiets;   
        }
        if($by1==='DM' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%DM%"');
         return $patiets;   
        }
        

        
         if($by1==='Perennial_rhinitis' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Perennial_rhinitis' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Perennial rhinitis%"');
         return $patiets;   
        }
        if($by1==='Perennial_rhinitis' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Perennial rhinitis%"');
         return $patiets;   
        }
        if($by1==='Perennial_rhinitis' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Perennial rhinitis%"');
         return $patiets;   
        }
        

        if($by1==='Heart_failure' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
       if($by1==='Heart_failure' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%DM%"');
         return $patiets;   
        }
        if($by1==='Heart_failure' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%DM%"');
         return $patiets;   
        }
        if($by1==='Heart_failure' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Heart failure%"');
         return $patiets;   
        }
        
        
        

        if($by1==='Rhinosinusitis' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Rhinosinusitis' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Rhinosinusitis%"');
         return $patiets;   
        }
        if($by1==='Rhinosinusitis' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Rhinosinusitis%"');
         return $patiets;   
        }
        if($by1==='Rhinosinusitis' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Rhinosinusitis%"');
         return $patiets;   
        }


        if($by1==='Pneumonia' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
        if($by1==='Pneumonia' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Pneumonia%"');
         return $patiets;   
        }
        if($by1==='Pneumonia' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Pneumonia%"');
         return $patiets;   
        }
        if($by1==='Pneumonia' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Pneumonia%"');
         return $patiets;   
        }



        
        if($by1==='Acute_URTI' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
          if($by1==='Acute_URTI' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Acute URTI%"');
         return $patiets;   
        }
        if($by1==='Acute_URTI' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Acute URTI%"');
         return $patiets;   
        }
        if($by1==='Acute_URTI' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Acute URTI%"');
         return $patiets;   
        }


          
        if($by1==='Parapneumonic_effusion' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
         if($by1==='Parapneumonic_effusion' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }
        if($by1==='Parapneumonic_effusion' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }
        if($by1==='Parapneumonic_effusion' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Parapneumonic effusion%"');
         return $patiets;   
        }

       
       
          if($by1==='Tuberculous_pleural_effusion' && $by2==='all')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.disease  LIKE "%Acute severe asthma%"');
         return $patiets;   
        }
         if($by1==='Tuberculous_pleural_effusion' && $by2==='today')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and diagnosis.date=CURDATE() and diagnosis.disease  LIKE "%Tuberculous pleural effusion%"');
         return $patiets;   
        }
        if($by1==='Tuberculous_pleural_effusion' && $by2==='this_week')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date, patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and WEEKOFYEAR(diagnosis.date)=WEEKOFYEAR(NOW()) and diagnosis.disease  LIKE "%Tuberculous pleural effusion%"');
         return $patiets;   
        }
        if($by1==='Tuberculous_pleural_effusion' && $by2==='this_month')
        {
          $patiets=DB::select('select distinct(patient.id) , diagnosis.date , patient.name, patient.gender , patient.age , patient.references, patient.mobile , diagnosis.disease from patient , diagnosis where patient.id = diagnosis.patient_id and Year(diagnosis.date) = Year(CURRENT_TIMESTAMP) AND Month(diagnosis.date) = Month(CURRENT_TIMESTAMP) and diagnosis.disease  LIKE "%Tuberculous pleural effusion%"');
         return $patiets;   
        }

       

    }
  
}
