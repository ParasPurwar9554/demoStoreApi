<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class AddProductModal extends Model
{
    public function insertProduct($inserArr){
      $success = DB::table('prodect_tbl')->insert($inserArr);
      if ($success) {
      	return true;
      }else{
      	return false;
      }
    }
	
 public function editProductList($product_up,$updateArr){
      $success = DB::table('prodect_tbl')->where('id',$product_up)->update($updateArr);
      if ($success) {
      	return true;
      }else{
      	return false;
      }
    }	
	public function getProductList(){
		 $success = DB::table('prodect_tbl')->orderby('id','desc')->get();
         if ($success) {
      	      return $success;
           }else{
         	  return false;
        }
	}
	
	public function getProductListById($catId){
		$success = DB::table('prodect_tbl')->where('product_category',$catId)->where('status',1)->orderby('id','desc')->get();
         if ($success) {
      	      return $success;
           }else{
         	  return false;
        }
	}
	
	public function getProductCategoryName($categoryId){
		 $categoryName = DB::table('home_category_tbl')->where('id',$categoryId)->get();
         if ($categoryName) {
      	      return $categoryName;
           }else{
         	  return false;
        }
		
	}
	
	public function deleteProductItemList($prodId){
		$success = DB::table('prodect_tbl')->where('id',$prodId)->delete();
		if ($success) {
      	      return true;
           }else{
         	  return false;
        }
	}
	public function statusForProList($prod,$statusValue){
		$success = DB::table('prodect_tbl')->where('id',$prod)->update(array('status'=>$statusValue));
		if ($success) {
      	      return true;
           }else{
         	  return false;
        }
	}
	
	public function proItmDetail($prod_id){
			$success = DB::table('prodect_tbl')->where('id',$prod_id)->get();
         if ($success) {
      	      return $success;
           }else{
         	  return false;
        }
	}
	
}
