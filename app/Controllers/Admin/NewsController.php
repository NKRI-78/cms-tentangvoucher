<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class NewsController extends BaseController
{
    public function index()
    {
        $request = Services::request();

        $page = $request->getGet('page') ?? 1;

        $result = curlHelper(getenv('API_URL') . '/api/v1/news?page=' . $page, 'GET');
        // var_dump($result); die;

        $data["news"] = $result->data->data;
        $data['pagination'] = [
            'current' => $result->data->currentPage,
            'previous' => $result->data->previous,
            'next' => $result->data->next,
            'total' => $result->data->totalPages,
        ];

        return view("admin/news/index", $data);
    }

    // public function getData()
    // {
    //     $result = curlHelper(getenv('API_URL') . '/news', 'GET');

    //     return json_encode([
    //         "body" => $result->data
    //     ]);
    // }

    public function create()
    {
        return view("admin/news/create");
    }

    public function post()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $link = $request->getPost('link');
        $content = $request->getPost('content');
        $content = str_replace("&lsquo;", '"', str_replace("&rsquo;", '"', str_replace("&rdquo;", '"', str_replace("&ldquo;", '"', str_replace("&quot;", '"', str_replace("&nbsp;", "", str_replace("var(--iq-body-text)", "#fffff", str_replace("var(--iq-white)", "#fffff", $content))))))));
        // $image = $request->getFile('image');

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

        $url = getenv('API_URL') . '/api/v1/news/assign';

        $body = [
            "title" => $title,
            "link" => $link,
            "image_url" => $path,
            "description" =>  $content,
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

        return json_encode([
            "body" => json_decode($req->getBody()->getContents()),
        ]);
    }

    public function edit($newsId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/news/' . $newsId, 'GET');

        $data["news"] = $result->data;

        return view("admin/news/edit", $data);
    }

    public function update()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        $newsId = $request->getPost('newsId');
        $title = $request->getPost('title');
        $link = $request->getPost('link');
        $content = $request->getPost('content');
        $content = str_replace("&lsquo;", '"', str_replace("&rsquo;", '"', str_replace("&rdquo;", '"', str_replace("&ldquo;", '"', str_replace("&quot;", '"', str_replace("&nbsp;", "", str_replace("var(--iq-body-text)", "#fffff", str_replace("var(--iq-white)", "#fffff", $content))))))));
        $image = $request->getFile('image');
        $imageOld = $request->getPost('imageOld');

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
            $path = $imageOld;
        }

        $url = getenv('API_URL') . '/api/v1/news/assign';

        $body = [
            "id" =>  $newsId,
            "title" => $title,
            "image_url" => $path,
            "description" => $content,
            "link" => $link
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

    public function detail($newsId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/news/' . $newsId, 'GET');

        return json_encode([
            "body" => $result->data
        ]);
    }

    public function delete($newsId)
    {
        curlHelper(getenv('API_URL') . '/api/v1/news/' . $newsId, 'DELETE');

        return redirect()->to(base_url('admin/news'));
    }
}
