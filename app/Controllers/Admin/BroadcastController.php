<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class BroadcastController extends BaseController
{
    public function index()
    {
        // $result = curlHelper(getenv('API_URL') . '/api/v1/admin/broadcast-history', 'GET');
        // $data["broadcast"] = $result;
        // // var_dump($data); die;

        return view("admin/broadcast/index");
    }

    public function create()
    {
        return view("admin/broadcast/create");
    }

    public function post()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $req = Services::request();

        $title = $req->getPost('title');
        $message = $req->getPost('message');
        $role = $req->getPost('role');

        if (is_string($role)) {
            $role = explode(',', $role); // Mengubah string menjadi array berdasarkan koma
        }

        $url = getenv('API_URL') . '/api/v1/broadcast';
        
        $body = [
            "title" => $title,
            "message" => $message,
            "roles" => $role,
        ];

        // var_dump($body); die;

        $req = $client->post(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type' => 'application/json',
                ]
            ]
        );
    }

    public function getData()
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/broadcast', 'GET');

        return json_encode([
            "data" => $result->data
        ]);
    }
}
