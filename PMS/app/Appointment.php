<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Appointment extends \Eloquent
{
   protected $table = 'appointment';

   function get_appoint($app)
   {
       $appoint=DB::table('appointment')
            ->where('id',  '=', $app)->first();
        return $appoint;
   }
   
     function edit_appoint($app)
   {
        DB::table('appointment')
        ->where('id', $app->id)
        ->update(['next_visit' => $app->next_visit , 'time' => $app->time,'notes' => $app->notes]);
   }
}