<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ReviewCommentModal extends Model
{
    public function insertComment($inserComment){
	   $success = DB::table('product_review_tbl')->insert($inserComment);
      if ($success) {
      	return true;
      }else{
      	return false;
      }
	}
	
	public function getComment($prodId){
		$success = DB::table('product_review_tbl')->where('product_id',$prodId)->orderby('id','desc')->get()->toArray();
         if ($success) {
      	      return $success;
           }else{
         	  return false;
        }
	}
}
