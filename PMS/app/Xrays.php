<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Xrays extends \Eloquent
{
    //
    protected $table = 'xrays';

 function get_images($diag)
    {
         $xray=DB::table('xrays')
            ->where('image',  'LIKE', ''.$diag.'%')->first();
        return $xray;
    }
  function delete_xray($v_id)
  {
  	DB::table('xrays')->where('diagnose_id', '=', $v_id)->delete();
  }
}
