<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\DashboardModal;

class Dashboard extends Controller
{	

    public function todalUserProduct(){
		$retur = array();
		$dashboardModal = new DashboardModal();
		$total_user = $dashboardModal->totalUser();
		$total_product = $dashboardModal->totalProduct();
		$retur['total_user'] = $total_user;
		$retur['total_product'] = $total_product;
		echo json_encode($retur); die;
		
	}
	
}
