<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class CategoryModal extends Model
{
    public function insertCategory($inserArr){
      $success = DB::table('home_category_tbl')->insert($inserArr);
      if ($success) {
      	return true;
      }else{
      	return false;
      }
    }
	public function getCategory(){
		 $success = DB::table('home_category_tbl')->orderby('id','desc')->get();
         if ($success) {
      	      return $success;
           }else{
         	  return false;
        }
	}
	public function deletCategoryname($catId){
		$success = DB::table('home_category_tbl')->where('id',$catId)->delete();
		if ($success) {
      	      return true;
           }else{
         	  return false;
        }
	}
	public function statusCategory($catId,$statusValue){
		$success = DB::table('home_category_tbl')->where('id',$catId)->update(array('status'=>$statusValue));
		if ($success) {
      	      return true;
           }else{
         	  return false;
        }
	}
}
