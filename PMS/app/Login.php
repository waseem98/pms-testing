<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Login extends Model
{
    //

     function user_validate($name,$pass)
    {
       $jane = DB::table('Admins')
                    ->whereAnameAndApassword($name, $pass)
                    ->first();
         if($jane)
         {
            return true;
        }else
        {
            return false;
        }
    }
}
