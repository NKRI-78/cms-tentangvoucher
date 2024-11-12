<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class EventController extends BaseController
{
    public function index()
    {

        return view("admin/event/index");
    }

    public function getData()
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/event', 'GET');

        return json_encode([
            "body" => $result->data
        ]);
    }

    public function create()
    {
        return view("admin/event/create");
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $start = $request->getPost("start");
        $end = $request->getPost("end");
        $eventDateStart = $request->getPost("eventDateStart");
        $eventDateEnd = $request->getPost("eventDateEnd");
        $title = $request->getPost("title");
        $desc = $request->getPost("description");
        $location = $request->getPost("location");
        $image = $request->getFile('image');

        $image = $this->request->getFile('image');

        if ($image->isValid() && !$image->hasMoved()) {
            try {
                $response = $client->request('PUT', 'http://157.245.193.49:3099/api/v1/media', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        // 'Content-Type' => 'multipart/form-data',
                    ],
                    'multipart' => [
                        [
                            'name' => 'folder',
                            'contents' => 'admin/news',
                        ],
                        [
                            'name' => 'app',
                            'contents' => 'mhs',
                        ],
                        [
                            'name' => 'media',
                            'contents' => fopen($image->getTempName(), 'r'),
                            'filename' => $image->getClientName(),
                            'Mime-Type' => $image->getClientMimeType(),
                        ],
                    ],
                ]);

                $result = json_decode($response->getBody(), true);

                if (isset($result['data'][0]['url'])) {
                    $path = $result['data'][0]['url'];
                } else {
                    throw new \Exception("Error uploading file: " . json_encode($result));
                }
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
                return;
            }
        } else {
            echo 'File not valid or already moved: ' . $image->getErrorString();
            return;
        }

        $url = getenv('API_URL') . '/api/v1/event/assign';

        $body = [
            // "id" => $id,
            "title" => $title,
            "description" => $desc,
            "startDate" => $eventDateStart,
            "endDate" => $eventDateEnd,
            "address" => $location,
            "start" => date("H:i", strtotime($start)),
            "end" => date("H:i", strtotime($end)),
            "imageUrl" => $path,
        ];

        $client->post(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'  => 'application/json',
                ]
            ]
        );
    }

    public function edit($eventId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/event/' . $eventId, 'GET');

        $data['event'] = $result->data;

        return view('admin/event/edit', $data);
    }

    public function postUpdate()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        $eventId = $request->getPost("eventId");
        $start = $request->getPost("start");
        $end = $request->getPost("end");
        $eventDateStart = $request->getPost("eventDateStart");
        $eventDateEnd = $request->getPost("eventDateEnd");
        $title = $request->getPost("title");
        $description = $request->getPost("description");
        $image = $request->getFile('image');
        $location = $request->getPost("location");
        $OldImage = $request->getPost("oldImage");

        // $resultUploadImage = $image ? curlImageHelper(getenv('API_URL') . '/media', $image) : null;

        $path= '';

        if ($image) {
            $response = $client->request('PUT', 'http://157.245.193.49:3099/api/v1/media', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                ],
                'multipart' => [
                    [
                        'name' => 'folder',
                        'contents' => 'admin/banner',
                    ],
                    [
                        'name' => 'app',
                        'contents' => 'mhs',
                    ],
                    [
                        'name' => 'media',
                        'contents' => fopen($image->getTempName(), 'r'),
                        'filename' => $image->getClientName(),
                        'Mime-Type' => $image->getClientMimeType(),
                    ],
                ],
            ]);

            $resultUploadImage = json_decode($response->getBody(), true);

            if (isset($resultUploadImage['data'][0]['url'])) {
                $path = $resultUploadImage['data'][0]['url'];
            } else {
                throw new \Exception("Error uploading file: " . json_encode($resultUploadImage));
            }
        } else {
            $path = $OldImage;
        }

        $url = getenv('API_URL') . '/api/v1/event/assign';

        $body = [
            "id" => $eventId,
            "title" => $title,
            "description" => $description,
            "startDate" => $eventDateStart,
            "endDate" => $eventDateEnd,
            "address" => $location,
            "start" => date("H:i", strtotime($start)),
            "end" => date("H:i", strtotime($end)),
            "imageUrl" => $path,
        ];

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

        return json_encode([
            "body" => json_decode($req->getBody()->getContents()),
        ]);
    }

    public function detail($eventId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/event/' . $eventId, 'GET');

        return json_encode([
            "body" => $result->data
        ]);
    }

    // public function postDelete()
    // {
    //     $client = new \GuzzleHttp\Client(['verify' => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $rawData =  json_decode($request->getBody(), true);
    //     $eventId = $rawData['id'];

    //     $body = [
    //         "id" => $eventId
    //     ];

    //     $url = getenv('API_URL') . '/events';

    //     $req = $client->delete(
    //         $url,
    //         [
    //             'body' => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Content-type'        => 'application/json',
    //             ]
    //         ]
    //     );

    //     return json_encode([
    //         "body" => json_decode($req->getBody()->getContents()),
    //     ]);
    // }

    public function delete($eventId)
    {
        curlHelper(getenv('API_URL') . '/api/v1/event/' . $eventId, 'DELETE');

        return redirect()->to(base_url('admin/event'));
    }
}
