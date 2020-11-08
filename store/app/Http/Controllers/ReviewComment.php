<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ReviewCommentModal;

class ReviewComment extends Controller
{
	public function saveCommentReview(Request $request){
		   $rerunArr = array();
		   $reviewCommentModal = new ReviewCommentModal();
		   $comment = $request->post('comment');
		   $productId = $request->post('prod_id');
		   $insertArr = array();
		   $insertArr['review_comment'] = $comment;
		   $insertArr['product_id'] = $productId;
		   $insertArr['addedon'] = time();
		   $saveRecord = $reviewCommentModal->insertComment($insertArr);
		   if($saveRecord){
			   $rerunArr['type'] ="save"; 
		   }else{
			   $rerunArr['type'] ="not save"; 
		   }
		   echo json_encode($rerunArr); die;
	}
	
	public function getCommentReview(Request $request){
		$reviewCommentModal = new ReviewCommentModal();
		$returnCommentArr = array();
		$product_id = $request->post('product_id');
		if($product_id !=""){
			$comments = $reviewCommentModal->getComment($product_id);
			if(!empty($comments)){
				foreach($comments as $key=>$val){
					$returnCommentArr[$key]['id'] = $val->id;
					$returnCommentArr[$key]['review_comment'] = $val->review_comment;
					$returnCommentArr[$key]['product_id'] = $val->product_id;
					$returnCommentArr[$key]['addedon'] = date("d/m/Y",$val->addedon);
				}
			}
			echo json_encode($returnCommentArr); die;
		}
	}
}
