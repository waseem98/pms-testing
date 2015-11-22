<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class Diagnosis extends \Eloquent
{
    //
    protected $table = 'diagnosis';

    function get_diagnosis($pa)
    {
    	$diagnosis=DB::table('diagnosis')
             ->where('patient_id',  '=', $pa)->first();
    	return $diagnosis;
    }
    
    function edit_diagnosis($id,$pa)
    {
        // DB::table('diagnosis')
        //     ->where('id', 1)
        //     ->update(['votes' => 1]);
    }
    
    function get_all_diagnosis($pa)
    {
        $diagnosis=DB::table('diagnosis')
             ->where('patient_id',  '=', $pa)->get();
    	return $diagnosis;
    }
     function get_diagnosis_byId($id)
    {
        $diagnosis=DB::table('diagnosis')
             ->where('id',  '=', $id)->first();
    	return $diagnosis;
    }

    function get_patient_id($diag_id)
    {    //echo 'select * from diagnosis where id = "'.$diag_id.'"'; exit();
        $id=DB::table('diagnosis')->select('patient_id')->where('id', '=', $diag_id)->first();
        //$id=DB::select('select patient_id from diagnosis where id = "'.$diag_id.'"');
        //echo var_dump($id->patient_id); exit();
        return $id->patient_id;
    }

    function update_diagnosis($input)
    {
        DB::table('diagnosis')
        ->where('id', $input['id'])
        ->update(['disease' => $input['disease'] , 'treatment' => $input['treatment'] ]);
    }
}
