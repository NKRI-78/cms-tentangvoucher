<?php

namespace App\Controllers\Auth;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class LoginController extends BaseController
{
    public function index()
    {
        // return view("errors/html/maintenance");
        return view("auth/login");
    }

    public function store()
    {
        $data = array();
        $request = Services::request();
        $session = Services::session();

        $val = $request->getPost('val');
        $password = $request->getPost('password');

        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $data = array(
            'email' => $val,
            'password' => $password
        );

        // $url = getenv('API_URL') . '/api/v1/auth/login';
        $url = getenv('API_URL') . '/api/v1/auth/login/admin';

        $req = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        $response = $req->getBody()->getContents();
        $result = json_decode($response);
        
        $session->set([
            "id" => $result->data->id,
            "fullname" => $result->data->profile->fullname,
            "email" => $result->data->email,
            "role" => $result->data->role_id,
            "token" => $result->data->token,
            "authenticated" => true
        ]);

        return json_encode([
            "id" => $result->data->id,
            "fullname" => $result->data->profile->fullname,
            "role" => $result->data->role_id,
            "token" => $result->data->token,
            "authenticated" => true,
            "email" => $result->data->email,
        ]);
    }

    public function logout()
    {
        $session = Services::session();
        $session->remove('id');
        $session->remove('fullname');
        $session->remove('role');
        $session->remove('authenticated');

        return redirect()->to(base_url('auth/login'));
    }
}