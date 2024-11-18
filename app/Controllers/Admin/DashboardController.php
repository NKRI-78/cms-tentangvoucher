<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class DashboardController extends BaseController
{
  public function index()
  {
    $result = curlHelper(getenv('API_URL') . '/api/v1/admin/dashboard', 'GET');
    $produk = curlHelper(getenv('API_URL') . '/api/v1/product/my/list', 'GET');
    $store = curlHelper(getenv('API_URL') . '/api/v1/admin/store/list', 'GET');
    
    $dataProduct = count($produk->data->data);
    $dataStore = count($store->data);

    $data["revenue"] = $result->data->order->totalAmount;
    $data["revenueTotal"] = $result->data->order->totalOrder;
    $data["produk"] = $result->data->totalProduct;
    $data["member"] = $result->data->totalMember;
    $data["store"] = $dataStore;

    return view("admin/dashboard/index", $data);
    // return view("admin/dashboard/index");   
  }

  public function detailTransaction()
  {
    return view("admin/dashboard/transaction");
  }

  public function getData()
  {
    $result = curlHelper(getenv('API_URL') . '/api/v1/admin/dashboard', 'GET');

    return json_encode([
      "body" => $result->data->orders
    ]);
  }
}
