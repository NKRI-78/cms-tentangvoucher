<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class OrderController extends BaseController
{
  // public function status($status)
  // {
  //   $result = curlHelper(getenv('API_URL') . '/commerce-service/order?orderStatus=' . strtoupper($status), 'GET');
  //   $data["order"] = $result->data;

  //   return view("admin/reportOrder/index", $data);
  // }

  public function status($status)
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();

    $statusMapping = [
      // 'received' => 'WAITING_PAYMENT',
      'confirmed' => 'WAITING_CONFIRM',
      'packing' => 'ON_PROCESS',
      'shipping' => 'DELIVERY',
      'delivered' => 'DELIVERED',
      'done' => 'FINISHED',
      'cancel' => 'CANCEL',
    ];

    if (isset($statusMapping[$status])) {
      $privateStatus = $statusMapping[$status];

      $postData = [
        'status' => $privateStatus
      ];

      $url = getenv('API_URL') . '/api/v1/order/seller/my-order?status=' . $postData['status'];

      $response = $client->get(
        $url,
        [
          "body" => json_encode($postData),
          'headers' =>  [
            'Authorization' => 'Bearer ' . $session->get('token'),
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
          ]
        ]
      );

      $resultStore = json_decode($response->getBody(), true);
      $data["order"] = $resultStore['data']['data'];

      // var_dump($data); die;

      return view("admin/reportOrder/index", $data);
    }
  }

  public function detail($buyerId)
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();

    $url = getenv('API_URL') . '/api/v1/order/detail/' . $buyerId;

    $response = $client->get(
      $url,
      [
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
          'Content-Type'  => 'application/json',
        ]
      ]
    );

    $result = json_decode($response->getBody(), true);

    return json_encode([
      "body" =>  $result['data']
    ]);
  }

  public function confirmed()
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();

    $buyerId = $request->getPost('buyerId');

    $url = getenv('API_URL') . '/api/v1/order/seller/confirm-order/' . $buyerId;

    $req = $client->post(
      $url,
      [
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
        ]
      ]
    );

    return redirect()->to(base_url('admin/reportOrder/status/confirmed'));
  }

  public function submitVoucher()
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();

    $voucherId = $request->getPost('voucherId');
    $voucherCode = $request->getPost('voucherCode');

    $url = getenv('API_URL') . '/api/v1/order/seller/finish-digital-order/' . $voucherId;

    $body = [
      "description" => $voucherCode,
    ];

    $req = $client->post(
      $url,
      [
        "body" => json_encode($body),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Content-Type'        => 'application/json',
        ]
      ]
    );

  }
}
