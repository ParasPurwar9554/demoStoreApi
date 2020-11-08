<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\CategoryModal;
use App\AddProductModal;

class AddProduct extends Controller
{	

    public function __construct(){
		$addProductModal = new AddProductModal();
	} 

    public function filesUpload(Request $request){
		   $addProductModal = new AddProductModal();
	       $addProdArr = array();
		   $reurnArr = array();
		   $productId = $request->post('productId');
		   $productname = $request->post('productname');
		   $product_price = $request->post('product_price');
		   $product_category = $request->post('product_category');
		   $product_discription = $request->post('product_discription');
		   $addProdArr['productname'] = $productname;
		   $addProdArr['product_price'] = $product_price;
		   $addProdArr['product_category'] = $product_category;
		   $addProdArr['product_discription'] = $product_discription;
		   $addProdArr['addedon'] = time();
		   $uploadedFile = $request->file('image'); 
		   if($uploadedFile !=''){
			
			   $fileName = time()."_".$uploadedFile->getClientOriginalName();
		       if($uploadedFile->isValid()) {
                 $uploadSuccess = $uploadedFile->move(public_path("productImage"), $fileName);
			     $addProdArr['product_image'] = $fileName;
             }     
		   }
			
		   if($productId !=''){
			 $updatePro = $addProductModal->editProductList($productId,$addProdArr);
				if($updatePro){
			       $reurnArr['type'] = "update";
		          }else{
			       $reurnArr['type'] = "not update";
		        }
		   }else{
		     $insert = $addProductModal->insertProduct($addProdArr);
		     if($insert){
			    $reurnArr['type'] = "save";
		     }else{
			    $reurnArr['type'] = "not save";
		    }
		   }
		  
		  echo json_encode($reurnArr); die;
		
	}
	
	public function getAllProductList(){
		  $addProductModal = new AddProductModal();
		  $reurnArr = array();
		  $productList = $addProductModal->getProductList();
		  if(!empty($productList)){
			  foreach($productList as $key=>$value){
				  $reurnArr[$key]['id'] = $value->id;
				  $reurnArr[$key]['productname'] = $value->productname;
				  $reurnArr[$key]['product_price'] = $value->product_price;
				  if($value->product_category != ''){
					 $categoryName = $addProductModal->getProductCategoryName($value->product_category);
				  }
				  $reurnArr[$key]['category_id'] = $categoryName[0]->id;
				  $reurnArr[$key]['product_category'] = $categoryName[0]->category;
				  $reurnArr[$key]['product_discription'] = $value->product_discription;
				  $reurnArr[$key]['status'] = $value->status;
				  $reurnArr[$key]['product_image'] = url('productImage')."/".$value->product_image;
			  }
		  }
		  echo json_encode($reurnArr); die;
	}
	
	public function deleteProductItem(Request $request){
		     $addProductModal = new AddProductModal();
		     $returnArr = [];
		     $product_id = $request->post('id');
			 if(isset($product_id) && $product_id !=''){
				  $deletSuccess = $addProductModal->deleteProductItemList($product_id);
				  if($deletSuccess){
					   $returnArr['type'] = "delete";
				  }else{
					   $returnArr['type'] = "not delete";
				  }
			 }
			 
			 echo json_encode($returnArr); die;
			
	}
	
	public function statusChangeforProduct(Request $request){
		 $addProductModal = new AddProductModal();
		     $returnArr = [];
		     $product_id = $request->post('id');
			 $status = $request->post('status');
			 $statusValue = "";
			 if($status == 1){
				$statusValue = 0;
		      }else{
				$statusValue = 1;
			  }
			 if(isset($product_id) && $product_id !=''){
				  $statusSuccess = $addProductModal->statusForProList($product_id,$statusValue);
				  if($statusSuccess){
					   $returnArr['type'] = "change";
				  }else{
					   $returnArr['type'] = "not change";
				  }
			 }
			 
			 echo json_encode($returnArr); die;
		
	}
	
	public function getProductById(Request $request){
		 $addProductModal = new AddProductModal();
		 $cat_id = $request->post('catId');
		 $reurnArr = array();
		  $productList = $addProductModal->getProductListById($cat_id);
		  if(!empty($productList)){
			  foreach($productList as $key=>$value){
				  $reurnArr[$key]['id'] = $value->id;
				  $reurnArr[$key]['productname'] = $value->productname;
				  $reurnArr[$key]['product_price'] = $value->product_price;
				  if($value->product_category != ''){
					 $categoryName = $addProductModal->getProductCategoryName($value->product_category);
				  }
				  $reurnArr[$key]['category_id'] = $categoryName[0]->id;
				  $reurnArr[$key]['product_category'] = $categoryName[0]->category;
				  $reurnArr[$key]['product_discription'] = $value->product_discription;
				  $reurnArr[$key]['status'] = $value->status;
				  $reurnArr[$key]['product_image'] = url('productImage')."/".$value->product_image;
			  }
		  }
		  echo json_encode($reurnArr); die;
	}
	
 public function proItemDetail(Request $request){
	   		$addProductModal = new AddProductModal();
			$returnArrItem = [];
		    $prod_id = $request->post('prod_id');
			if($prod_id !=""){
				$prodArr = $addProductModal->proItmDetail($prod_id);
				$returnArrItem['id'] = $prodArr[0]->id;
				$returnArrItem['productname'] = $prodArr[0]->productname;
				$returnArrItem['product_price'] = $prodArr[0]->product_price;
				$returnArrItem['product_category'] = $prodArr[0]->product_category;
				$returnArrItem['product_discription'] = $prodArr[0]->product_discription;
				$returnArrItem['product_image'] = url('productImage')."/".$prodArr[0]->product_image;
			}
			echo json_encode($returnArrItem); die;
	 
 } 	
	
	
	
}
