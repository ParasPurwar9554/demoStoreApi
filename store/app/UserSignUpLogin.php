<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class UserSignUpLogin extends Model
{
    public function insertSignData($inserArr){
      $success = DB::table('users')->insert($inserArr);
      if ($success) {
      	return true;
      }else{
      	return false;
      }
    }
}
