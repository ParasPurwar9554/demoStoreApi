<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\CategoryModal;

class Category extends Controller
{	

    public function __construct(){
		$categoryModal = new CategoryModal();
	} 

    public function getCategory(){
		$categoryModal = new CategoryModal();
		$retuArr = array();
		$allCategoryList = $categoryModal->getCategory();
		if(!empty($allCategoryList)){
			foreach($allCategoryList as $key=>$valucat){
				$retuArr[$key]['id'] = $valucat->id;
				$retuArr[$key]['category'] = $valucat->category;
				$retuArr[$key]['addedon'] = date("d/M/Y",$valucat->addedon);
				$retuArr[$key]['status'] = $valucat->status;
			}
		}
		 echo json_encode($retuArr); die;	 
		   
		
	}
	public function insert_Category_Data(Request $request){
		    $categoryModal = new CategoryModal();
			$postdata = file_get_contents("php://input");
		    $request = json_decode($postdata,true);
		    $saveArr = array();
		    $returnArr = array();
		    $saveArr['category'] = $request['catname'];
		    $saveArr['addedon'] =  time();
		    $successSave = $categoryModal->insertCategory($saveArr);
		      if ($successSave == true) {
		           $returnArr['type'] = "save";
		        }else{
		           $returnArr['type'] = "not save";
		       }
		    echo json_encode($returnArr); die;	 
	}
	
	public function deleteCategory(Request $request){
		    $categoryModal = new CategoryModal();
			$postdata = file_get_contents("php://input");
		    $request = json_decode($postdata,true);
			$returnArr = array();
			$catId = $request['id'];
			if($catId !=""){
				$datele =$categoryModal->deletCategoryname($catId);
				if($datele){
					$returnArr['type'] = "deleteCat";
				}else{
					$returnArr['type'] = "not deleteCat";
				}
			}else{
				echo "delete Id not coming"; die;
			}
			echo json_encode($returnArr); die;
	}
	
	public function statusChangeforCategory(Request $request){ 
	        $categoryModal = new CategoryModal();
		    $postdata = file_get_contents("php://input");
		    $request = json_decode($postdata,true);
			$returnArr = array();
			$catId = $request['id'];
			$status = $request['status'];
			$statusValue = "";
			if($status == 1){
				$statusValue = 0;
		    }else{
				$statusValue = 1;
			}
			if($catId !=""){
				$datele =$categoryModal->statusCategory($catId,$statusValue);
				if($datele){
					$returnArr['type'] = "statuschange";
				}else{
					$returnArr['type'] = "statuschange not change";
				}
			}else{
				echo "status Id not coming"; die;
			}
			echo json_encode($returnArr); die;
	}
}
