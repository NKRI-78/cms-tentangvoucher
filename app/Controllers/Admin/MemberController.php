<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class MemberController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/admin/member', 'GET');
        $data["member"] = $result;
        // var_dump($data); die;

        return view("admin/member/index", $data);
    }

    public function delete($userId)
    {
        curlHelper(getenv('API_URL') . '/api/v1/admin/member/' . $userId, 'DELETE');

        return redirect()->to(base_url('admin/member'));
    }

    // public function edit($userId)
    // {
       
    //     $result = curlHelper(getenv('API_URL') . '/user-service/profile/' . $userId, 'GET');
        
    //     $data["member"] = $result->body;

    //     return view("admin/member/edit", $data);
    // }

    // public function update()
    // {
    //     $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $userId = $request->getPost('userId');
    //     $fullname = $request->getPost('fullname');
    //     $no_member = $request->getPost('no_member');
    //     $address = $request->getPost('address');

    //     $url = getenv('API_URL') . '/user-service/profile/' . $userId;
    //     $body = [
    //         "fullname" => $fullname,
    //         "no_member" => $no_member,
    //         "address" => $address,
    //     ];

    //     $req = $client->put(
    //         $url,
    //         [
    //             "body" => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Accept'        => 'application/json',
    //             ]
    //         ]
    //     );
    // }

    // public function rejected()
    // {
    //     $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $userId = $request->getPost('userId');
    //     $result = curlHelper(getenv('API_URL') . '/user-service/users/rejected/' . $userId, 'GET');
    // }

    // public function approval()
    // {
    //     $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $userId = $request->getPost('userId');
    //     $result = curlHelper(getenv('API_URL') . '/user-service/users/approval/' . $userId, 'GET');
    // }

    // public function partnership()
    // {
    //     $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $userId = $request->getPost('userId');

    //     $result = curlHelper(getenv('API_URL') . '/user-service/users/delete/' . $userId, 'GET');
    // }
}
