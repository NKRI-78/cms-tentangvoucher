<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;
use App\Libraries\UUIDGenerator;

class ListStoreController extends BaseController
{
    public function index()
    {
        return view("admin/listStore/index");
    }

    public function getData()
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/admin/store/list', 'GET');

        return json_encode([
            "body" => $result->data
        ]);
    }

    public function create()
    {
        return view("admin/banner/create");
    }

    public function post()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        $bannerId = $request->getPost('bannerId');
        $name = $request->getPost('name');
        $post_link = $request->getPost('post_link');
        // $image = $this->request->getFile('image');

        // if ($this->request->getFile('image')) {

        //     if ($image->isValid() && !$image->hasMoved()) {
        //         try {
        //             $response = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', [
        //                 // $response = $client->request('PUT', 'http://157.245.193.49:3099/api/v1/media', [
        //                 'headers' => [
        //                     'Authorization' => 'Bearer ' . $session->get('token'),
        //                     // 'Content-Type' => 'multipart/form-data',
        //                 ],
        //                 'multipart' => [
        //                     [
        //                         'name' => 'folder',
        //                         'contents' => 'admin/banner',
        //                     ],
        //                     [
        //                         'name' => 'app',
        //                         'contents' => 'mhs',
        //                     ],
        //                     [
        //                         'name' => 'media',
        //                         'contents' => fopen($image->getTempName(), 'r'),
        //                         'filename' => $image->getClientName(),
        //                         'Mime-Type' => $image->getClientMimeType(),
        //                     ],
        //                 ],
        //             ]);

        //             $result = json_decode($response->getBody(), true);

        //             if (isset($result['data'][0]['url'])) {
        //                 $path = $result['data'][0]['url'];
        //             } else {
        //                 throw new \Exception("Error uploading file: " . json_encode($result));
        //             }
        //         } catch (\Exception $e) {
        //             echo 'Error: ' . $e->getMessage();
        //             return;
        //         }
        //     } else {
        //         echo 'File not valid or already moved: ' . $image->getErrorString();
        //         return;
        //     }
        // }

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $bodyImage = [
                "folder" => "tentang-voucher",
                "subfolder" => "banner",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $path = $result->data->path;
        }

        $url = getenv('API_URL') . '/api/v1/banner';

        $body = [
            "title" => $name,
            "link_banner" => $post_link,
            "link_image" => $path,
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

    public function edit($bannerId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/banner/' . $bannerId, 'GET');

        $data["banner"] = $result->data;

        // var_dump($data); die;

        return view("admin/banner/edit", $data);
    }

    public function update()
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $session = Services::session();
        $request = Services::request();

        $bannerId = $request->getPost('bannerId');
        $name = $request->getPost('name');
        $postLink = $request->getPost('postLink');
        $image = $request->getFile('image');
        $bannerOldImage = $request->getPost('bannerOld');

        // $path = '';

        try {
            // if ($image) {
            //     $response = $client->request('PUT', 'http://157.245.193.49:3099/api/v1/media', [
            //         'headers' => [
            //             'Authorization' => 'Bearer ' . $session->get('token'),
            //         ],
            //         'multipart' => [
            //             [
            //                 'name' => 'folder',
            //                 'contents' => 'admin/banner',
            //             ],
            //             [
            //                 'name' => 'app',
            //                 'contents' => 'mhs',
            //             ],
            //             [
            //                 'name' => 'media',
            //                 'contents' => fopen($image->getTempName(), 'r'),
            //                 'filename' => $image->getClientName(),
            //                 'Mime-Type' => $image->getClientMimeType(),
            //             ],
            //         ],
            //     ]);

            //     $resultUploadImage = json_decode($response->getBody(), true);

            //     if (isset($resultUploadImage['data'][0]['url'])) {
            //         $path = $resultUploadImage['data'][0]['url'];
            //     } else {
            //         throw new \Exception("Error uploading file: " . json_encode($resultUploadImage));
            //     }
            // } else {
            //     $path = $bannerOldImage;
            // }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $bodyImage = [
                    "folder" => "mhs",
                    "subfolder" => "banner",
                    "media" => $_FILES['image']
                ];
    
                $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
                $path = $result->data->path;
            } else {
                $path = $bannerOldImage;
            }

            $url = getenv('API_URL') . '/api/v1/banner';

            $body = [
                "id" => $bannerId,
                "title" => $name,
                "link_image" => $path,
                "link_banner" => $postLink
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
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                $exception = (string) $e->getResponse()->getBody();
                $exception = json_decode($exception);
                // var_dump($exception); die;
                return json_encode([
                    "code" => 400,
                    "message" => $exception
                ]);
            }
        }
    }

    public function detail($bannerId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/banner/' . $bannerId, 'GET');

        return json_encode($result);
    }

    public function delete($bannerId)
    {
        $url = getenv('API_URL') . '/api/v1/banner/' . $bannerId;

        curlHelper($url, 'DELETE');

        return redirect()->to(base_url('admin/banner'));
    }
}
