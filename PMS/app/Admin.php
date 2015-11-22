<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Admin extends Model
{
    //

    function admin_validate($name,$pass)
    {
       $jane = DB::table('Admins')
                    ->whereAnameAndApassword($name, $pass)
                    ->first();
        // $credentials = array('name' => $input['username'] , 'password' => $input['password']);
        //  if(AuthController::attempt($credentials))
        //  {
        //      return Redirect::to('patient');
        //  }
        //  else{
        //      return Redirect::to('login');
        //  }   

         if($jane)
         {
            return true;
        }else
        {
            return false;
        }
    }
}
