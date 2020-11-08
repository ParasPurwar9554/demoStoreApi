<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class DashboardModal extends Model
{
   public function totalUser(){
		$success = DB::table('users')->select('*')->get();
         if ($success) {
      	      return count($success);
           }else{
         	  return false;
        }
   }	
  
   public function totalProduct(){
	    $success = DB::table('prodect_tbl')->select('*')->get();
         if ($success) {
      	      return count($success);
           }else{
         	  return false;
        }
   }	
  
	
}
