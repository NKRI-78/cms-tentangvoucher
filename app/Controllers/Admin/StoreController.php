<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;
use App\Libraries\UUIDGenerator;

class StoreController extends BaseController
{
    public function index($status)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $result = curlHelper(getenv('API_URL') . '/api/v1/store/me', 'GET');

        if (isset($result->message) && $result->message === "Toko belum di buat") {
            $data["store"] = false;
        } else {
            $data["store"] = $result->data;
        }

        $resultRevenue = curlHelper(getenv('API_URL') . '/api/v1/admin/dashboard/store', 'GET');
        $produk = curlHelper(getenv('API_URL') . '/api/v1/product/my/list', 'GET');

        $dataProduct = count($produk->data->data);

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
        }

        $statusCount = [];
        foreach ($statusMapping as $tabStatus => $apiStatus) {
            $url = getenv('API_URL') . '/api/v1/order/seller/my-order?status=' . $apiStatus;

            $response = $client->get(
                $url,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                    ]
                ]
            );

            $resultStatus = json_decode($response->getBody(), true);
            $statusCount[$tabStatus] = count($resultStatus['data']['data'] ?? []);
        }

        $data["revenue"] = $resultRevenue->data->order->totalAmount;
        $data["produk"] = $dataProduct;
        $data["statusCount"] = $statusCount;

        return view("admin/officialStore/index", $data);
    }

    public function getCity()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        try {
            $province = $request->getPost('provinceId');

            $result = getenv('API_URL') . '/api/v1/administration/cities';

            $body = [
                "province_name" => $province,
            ];

            $req = $client->post(
                $result,
                [
                    "body" => json_encode($body),
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Content-Type'        => 'application/json',
                    ]
                ]
            );

            $responseBody = json_decode($req->getBody()->getContents());

            // Kembalikan hasil response ke client (JavaScript)
            return $this->response->setJSON([
                "body" => $responseBody->data
            ]);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return json_encode([
                "error" => "Terjadi kesalahan saat mengambil data kota: " . $e->getMessage()
            ]);
        }
    }

    public function getDistrict()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        try {
            $city = $request->getPost('city_name');

            $result = getenv('API_URL') . '/api/v1/administration/districts';

            $body = [
                "city_name" => $city,
            ];

            $req = $client->post(
                $result,
                [
                    "body" => json_encode($body),
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Content-Type'        => 'application/json',
                    ]
                ]
            );

            $responseBody = json_decode($req->getBody()->getContents());

            // Kembalikan hasil response ke client (JavaScript)
            return $this->response->setJSON([
                "body" => $responseBody->data
            ]);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return json_encode([
                "error" => "Terjadi kesalahan saat mengambil data kota: " . $e->getMessage()
            ]);
        }
    }

    public function getSubdistrict()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        try {
            $district_name = $request->getPost('district_name');
            $city_name = $request->getPost('city_name');

            $result = getenv('API_URL') . '/api/v1/administration/postal-codes';

            $body = [
                "city_name" => $city_name,
                "district_name" => $district_name,
            ];

            $req = $client->post(
                $result,
                [
                    "body" => json_encode($body),
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Content-Type'        => 'application/json',
                    ]
                ]
            );

            $responseBody = json_decode($req->getBody()->getContents());

            // Kembalikan hasil response ke client (JavaScript)
            return $this->response->setJSON([
                "body" => $responseBody->data
            ]);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return json_encode([
                "error" => "Terjadi kesalahan saat mengambil data kota: " . $e->getMessage()
            ]);
        }
    }

    public function getPostal()
    {
        $client = new Client([\GuzzleHttp\RequestOptions::VERIFY  => false]);
        $session = Services::session();
        $request = Services::request();

        try {
            $district_name = $request->getPost('district_name');
            $city_name = $request->getPost('city_name');

            $result = getenv('API_URL') . '/api/v1/administration/postal-codes';

            $body = [
                "district_name" => $district_name,
                "city_name" => $city_name,
            ];

            $req = $client->post(
                $result,
                [
                    "body" => json_encode($body),
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Content-Type'        => 'application/json',
                    ]
                ]
            );

            $responseBody = json_decode($req->getBody()->getContents());

            // Kembalikan hasil response ke client (JavaScript)
            return $this->response->setJSON([
                "body" => $responseBody->data
            ]);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return json_encode([
                "error" => "Terjadi kesalahan saat mengambil data kota: " . $e->getMessage()
            ]);
        }
    }

    public function edit()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $result = curlHelper(getenv('API_URL') . '/api/v1/store/me', 'GET');

        if (isset($result->message) && $result->message === "Toko belum di buat") {
            $data["store"] = false;
        } else {
            $data["store"] = $result->data;
        }

        $getProvince = $result->data->address->province;
        $getCity = $result->data->address->city;
        $getDistrict = $result->data->address->district;

        $postData = [];
        $resultProvince = curlHelper(getenv('API_URL') . '/api/v1/administration/provinces', 'POST', $postData);

        $results = getenv('API_URL') . '/api/v1/administration/cities';
        
        $bodyProvince = [
            "province_name" => $getProvince,
        ];

        $req = $client->post(
            $results,
            [
                "body" => json_encode($bodyProvince),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        $responseBodyCity = json_decode($req->getBody()->getContents());

        $resultdistrict = getenv('API_URL') . '/api/v1/administration/districts';
        
        $bodyCity = [
            "city_name" => $getCity,
        ];

        $req = $client->post(
            $resultdistrict,
            [
                "body" => json_encode($bodyCity),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        $responseBodyDistrict = json_decode($req->getBody()->getContents());

        $resultPos = getenv('API_URL') . '/api/v1/administration/postal-codes';

        $bodyPos = [
            "district_name" => $getDistrict,
            "city_name" => $getCity,
        ];

        $req = $client->post(
            $resultPos,
            [
                "body" => json_encode($bodyPos),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        $responseBodyPos = json_decode($req->getBody()->getContents());

        $data["province"] = $resultProvince->data;
        $data["city"] = $responseBodyCity->data;
        $data["district"] = $responseBodyDistrict->data;
        $data["subDistrict"] = $responseBodyPos->data;
        // var_dump($data); die;

        return view("admin/officialStore/edit", $data);
    }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $address = $request->getPost('address');
        $province = $request->getPost('province');
        $city = $request->getPost('city');
        $district = $request->getPost('district');
        $subdistrict = $request->getPost('subdistrict');
        $posCode = $request->getPost('posCode');
        $latitude = $request->getPost('latitude');
        $longitude = $request->getPost('longitude');
        $photoOld = $request->getPost('photoOld');
        $bannerOld = $request->getPost('bannerOld');

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $bodyImage = [
                "folder" => "tentang-voucher",
                "subfolder" => "banner",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $path = $result->data->path;
        } else {
            $path = $bannerOld;
        }

        if (isset($_FILES['imageProfile']) && $_FILES['imageProfile']['error'] == 0) {
            $bodyImage = [
                "folder" => "tentang-voucher",
                "subfolder" => "bannerProfile",
                "media" => $_FILES['imageProfile']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $pathProfile = $result->data->path;
        } else {
            $pathProfile = $photoOld;
        }

        $url = getenv('API_URL') . '/api/v1/store/';

        $body = [
            "name" => $title,
            "link_banner" => $path,
            "link_photo" => $pathProfile,
            "name_address" => 'awww',
            "detail_address" => $address,
            "status_open" => true,
            "province" => $province,
            "city" => $city,
            "district" => $district,
            "sub_district" => $subdistrict,
            "postal_code" => $posCode,
            "latitude" => $latitude,
            "longitude" => $longitude,
        ];

        // var_dump($body); die;

        $req = $client->post(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        );
    }

    // public function getData()
    // {
    //     $result = curlHelper(getenv('API_URL') . '/api/v1/banner', 'GET');

    //     return json_encode([
    //         "body" => $result->data
    //     ]);
    // }

    public function create()
    {
        $postData = [];
        $resultProvince = curlHelper(getenv('API_URL') . '/api/v1/administration/provinces', 'POST', $postData);

        $data["province"] = $resultProvince->data;

        return view("admin/officialStore/create", $data);
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $address = $request->getPost('address');
        $province = $request->getPost('province');
        $city = $request->getPost('city');
        $district = $request->getPost('district');
        $subdistrict = $request->getPost('subdistrict');
        $posCode = $request->getPost('posCode');
        $latitude = $request->getPost('latitude');
        $longitude = $request->getPost('longitude');

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $bodyImage = [
                "folder" => "tentang-voucher",
                "subfolder" => "banner",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $path = $result->data->path;
        }

        if (isset($_FILES['imageProfile']) && $_FILES['imageProfile']['error'] == 0) {
            $bodyImage = [
                "folder" => "tentang-voucher",
                "subfolder" => "banner",
                "media" => $_FILES['imageProfile']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $pathProfile = $result->data->path;
        }

        $url = getenv('API_URL') . '/api/v1/store/';

        $body = [
            "name" => $title,
            "link_banner" => $path,
            "link_photo" => $pathProfile,
            "name_address" => '-',
            "detail_address" => $address,
            "status_open" => true,
            "province" => $province,
            "city" => $city,
            "district" => $district,
            "sub_district" => $subdistrict,
            "postal_code" => $posCode,
            "latitude" => $latitude,
            "longitude" => $longitude,
        ];

        $req = $client->post(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        );
    }

    // public function update()
    // {
    //     $client = new \GuzzleHttp\Client(['verify' => false]);
    //     $session = Services::session();
    //     $request = Services::request();

    //     $bannerId = $request->getPost('bannerId');
    //     $name = $request->getPost('name');
    //     $postLink = $request->getPost('postLink');
    //     $image = $request->getFile('image');
    //     $bannerOldImage = $request->getPost('bannerOld');

    //     // $path = '';

    //     try {
    //         // if ($image) {
    //         //     $response = $client->request('PUT', 'http://157.245.193.49:3099/api/v1/media', [
    //         //         'headers' => [
    //         //             'Authorization' => 'Bearer ' . $session->get('token'),
    //         //         ],
    //         //         'multipart' => [
    //         //             [
    //         //                 'name' => 'folder',
    //         //                 'contents' => 'admin/banner',
    //         //             ],
    //         //             [
    //         //                 'name' => 'app',
    //         //                 'contents' => 'mhs',
    //         //             ],
    //         //             [
    //         //                 'name' => 'media',
    //         //                 'contents' => fopen($image->getTempName(), 'r'),
    //         //                 'filename' => $image->getClientName(),
    //         //                 'Mime-Type' => $image->getClientMimeType(),
    //         //             ],
    //         //         ],
    //         //     ]);

    //         //     $resultUploadImage = json_decode($response->getBody(), true);

    //         //     if (isset($resultUploadImage['data'][0]['url'])) {
    //         //         $path = $resultUploadImage['data'][0]['url'];
    //         //     } else {
    //         //         throw new \Exception("Error uploading file: " . json_encode($resultUploadImage));
    //         //     }
    //         // } else {
    //         //     $path = $bannerOldImage;
    //         // }

    //         if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    //             $bodyImage = [
    //                 "folder" => "mhs",
    //                 "subfolder" => "banner",
    //                 "media" => $_FILES['image']
    //             ];

    //             $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
    //             $path = $result->data->path;
    //         } else {
    //             $path = $bannerOldImage;
    //         }

    //         $url = getenv('API_URL') . '/api/v1/banner/assign';

    //         $body = [
    //             "id" => $bannerId,
    //             "name" => $name,
    //             "banner_link" => $path,
    //             "post_link" => $postLink
    //         ];

    //         $req = $client->post(
    //             $url,
    //             [
    //                 "body" => json_encode($body),
    //                 'headers' =>  [
    //                     'Authorization' => 'Bearer ' . $session->get('token'),
    //                     'Content-Type' => 'application/json',
    //                 ]
    //             ]
    //         );
    //     } catch (\GuzzleHttp\Exception\ClientException $e) {
    //         if ($e->hasResponse()) {
    //             $exception = (string) $e->getResponse()->getBody();
    //             $exception = json_decode($exception);
    //             // var_dump($exception); die;
    //             return json_encode([
    //                 "code" => 400,
    //                 "message" => $exception
    //             ]);
    //         }
    //     }
    // }

    // public function detail($bannerId)
    // {
    //     $result = curlHelper(getenv('API_URL') . '/api/v1/banner/' . $bannerId, 'GET');

    //     return json_encode($result);
    // }

    // public function delete($bannerId)
    // {
    //     $url = getenv('API_URL') . '/api/v1/banner/' . $bannerId;

    //     curlHelper($url, 'DELETE');

    //     return redirect()->to(base_url('admin/banner'));
    // }
}
