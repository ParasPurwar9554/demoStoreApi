<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\UserSignUpLogin;

class Users extends Controller
{
    function list(){
       return User::all();
    }
	
	public function insert_Sign_Data(Request $request){
				$userSignUpLogin = new UserSignUpLogin();
				$postdata = file_get_contents("php://input");
		        $request = json_decode($postdata,true);
		          $saveArr = array();
		          $returnArr = array();
				  $saveArr['first_name'] = $request['firstname'];
				  $saveArr['last_name'] = $request['lastname'];
				  $saveArr['email'] = $request['email'];
				  $saveArr['password'] = $request['password'];
				  $saveArr['contact'] = $request['contact'];
				  $saveArr['addedon'] =  time();
		          $successSave = $userSignUpLogin->insertSignData($saveArr);
		          if ($successSave == true) {
		          	  $returnArr['type'] = "save";
		          }else{
		          	  $returnArr['type'] = "not save";
		          }
		         echo json_encode($returnArr); die;
		 
	}
}
