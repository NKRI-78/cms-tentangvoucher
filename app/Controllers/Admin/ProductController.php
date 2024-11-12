<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class ProductController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/product/my/list', 'GET');

        if (isset($result->message) && $result->message === "Kamu belum membuka toko") {
            $data["produk"] = false;
        } else {
            $data["produk"] = $result->data;
        }

        return view("admin/product/index", $data);
    }

    public function getData()
    {
        $limit = $_POST['length'];
        $start = $_POST['start'];

        $page = $start / $limit + 1;

        if (empty($_POST['search']['value'])) {
            $result = curlHelper(getenv('API_URL') . '/api/v1/product/my/list?page=' . $page . '&limit=' . $limit, 'GET');
            // var_dump($result); die;
            $recordsTotal = intval($result->data->totalPages);
        } else {
            $search = $_POST['search']['value'];
            $search = str_replace(" ", "%20", $search);
            $result = curlHelper(getenv('API_URL') . '/api/v1/product/my/list?page=' . $page . '&limit=' . $limit, 'GET');
            $recordsTotal = intval($result->data->totalPages);
        }

        $data = array();
        $no = 1;

        function formatRupiah($amount)
        {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }

        $userRole = session()->get('role');

        if (!empty($result)) {
            foreach ($result->data->data as $row) {
                $nestedData['no'] = $no++;
                $nestedData['name'] = $row->name;
                $nestedData['stok'] = $row->stock;
                $nestedData['category'] = $row->type;
                // $nestedData['code'] = $row->voucher_code;
                $nestedData['price'] = formatRupiah($row->price);
                $nestedData['action'] =
                    '
                    <div class="send-panel">
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                        <a href="' . base_url("admin/product/edit/$row->id") . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit News">
                            <i class="ri-edit-line text-primary"></i>
                        </a>
                        </label>
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                            <a onclick="DetailProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail">
                                <i class="ri-list-check-2 text-primary"></i>
                            </a>
                        </label>
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                            <a onclick="DeleteProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Product">
                                <i class="ri-delete-bin-line text-primary"></i>
                            </a>
                        </label>
                    </div>';
                // $actionButtons = '<div class="send-panel">';

                // if ($userRole === 'client') {
                //     $actionButtons .= '
                //     <label class="ml-2 mb-0 iq-bg-primary rounded">
                //         <a href="' . base_url("admin/product/edit/$row->id") . '" data-toggle="tooltip" data-placement="top" title="Edit Product">
                //             <i class="ri-edit-line text-primary"></i>
                //         </a>
                //     </label>';
                // }

                // $actionButtons .= '
                // <label class="ml-2 mb-0 iq-bg-primary rounded">
                //     <a onclick="DetailProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="Show Detail">
                //         <i class="ri-list-check-2 text-primary"></i>
                //     </a>
                // </label>';

                // if ($userRole === 'client') {
                //     $actionButtons .= '
                // <label class="ml-2 mb-0 iq-bg-primary rounded">
                //     <a onclick="DeleteProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="Delete Product">
                //         <i class="ri-delete-bin-line text-primary"></i>
                //     </a>
                // </label>';
                // }

                // $actionButtons .= '</div>';

                // $nestedData['action'] = $actionButtons;
                $data[] = $nestedData;
            }
        }

        return json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data"            => $data
        ]);
    }

    public function create()
    {
        return view("admin/product/create");
    }

    // public function post()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $session = Services::session();
    //     $request = Services::request();

    //     $product_id = $request->getPost('productId');
    //     $app_id = $request->getPost('app_id');
    //     $store_id = $request->getPost('store_id');
    //     $title = $request->getPost('title');
    //     $price = $request->getPost('price');
    //     $stock = $request->getPost('stock');
    //     $weight = $request->getPost('weight');
    //     $category = $request->getPost('category');
    //     $caption = $request->getPost('caption');

    //     // if ($_FILES['image']) {
    //     //     $bodyImage = [
    //     //         "folder" => "saka",
    //     //         "subfolder" => "product",
    //     //         "media" => $_FILES['image']
    //     //     ];

    //     //     $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
    //     // }

    //     // $path = isset($_FILES['image']) ? $result->data->path : '';

    //     $imagePaths = [];

    //     if (!empty($_FILES['images'])) {
    //         foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    //             $file = new \CURLFile($tmpName, $_FILES['images']['type'][$key], $_FILES['images']['name'][$key]);

    //             $bodyImage = [
    //                 "folder" => "saka",
    //                 "subfolder" => "product",
    //                 "media" => $file
    //             ];

    //             // $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);

    //             // if (isset($result->data->path)) {
    //             //     $imagePaths[] = $result->data->path;
    //             // }

    //             $ch = curl_init('https://api-media.inovatiftujuh8.com/api/v1/media/upload');
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyImage); // POSTFIELDS harus berupa array dengan objek CURLFile
    //             $response = curl_exec($ch);

    //             // Handle error
    //             if (curl_errno($ch)) {
    //                 echo 'Error:' . curl_error($ch);
    //             }
    //             curl_close($ch);

    //             $result = json_decode($response);

    //             // Periksa apakah path berhasil diupload dan simpan
    //             if (isset($result->data->path)) {
    //                 $imagePaths[] = $result->data->path;
    //             }
    //         }
    //     }

    //     $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store';

    //     $body = [
    //         "id" => $product_id,
    //         "title" => $title,
    //         "caption" => $caption,
    //         "price" => $price,
    //         "weight" => $weight,
    //         "stock" => $stock,
    //         "is_draft" => 0,
    //         "cat_id" => $category,
    //         "app_id" => $app_id,
    //         "store_id" => $store_id,
    //     ];

    //     $req = $client->post(
    //         $url,
    //         [
    //             "body" => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Accept'        => 'application/json',
    //                 'Content-Type' => 'application/json'
    //             ]
    //         ]
    //     );

    //     $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';
    //     foreach ($imagePaths as $path) {
    //         $body = [
    //             "product_id" => $product_id,
    //             "path" => $path,
    //         ];

    //         $client->post(
    //             $imageUrl,
    //             [
    //                 "body" => json_encode($body),
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $session->get('token'),
    //                     'Accept'        => 'application/json',
    //                     'Content-Type'  => 'application/json'
    //                 ]
    //             ]
    //         );
    //     }
    // }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $price = $request->getPost('price');
        $stock = $request->getPost('stock');
        $category = $request->getPost('category');
        $voucherCode = $request->getPost('voucherCode');
        $dateExpire = $request->getPost('dateExpire');
        $description = $request->getPost('description');

        $imagePaths = [];

        // if (!empty($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            try {

                // Using Guzzle to upload image
                $response = $client->post('https://api-media.inovatiftujuh8.com/api/v1/media/upload', [
                    'multipart' => [
                        [
                            'name' => 'folder',
                            'contents' => 'tentang-voucher'
                        ],
                        [
                            'name' => 'subfolder',
                            'contents' => 'product'
                        ],
                        [
                            'name' => 'media',
                            'contents' => fopen($tmpName, 'r'),
                            'filename' => $_FILES['images']['name'][$key],
                            'headers'  => ['Content-Type' => $_FILES['images']['type'][$key]]
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody()->getContents());

                // Check if the path is successfully uploaded
                if (isset($result->data->path)) {
                    $imagePaths[] = $result->data->path;
                }
            } catch (\Exception $e) {
                // Handle any errors that occur during the image upload
                echo 'Error uploading image: ' . $e->getMessage();
            }
        }
        // }

        try {
            // Prepare the body for the product data
            $url = getenv('API_URL') . '/api/v1/product';

            $body = [
                "name" => $title,
                "description" => $description,
                "price" => $price,
                "stock" => $stock,
                "voucher_code" => "-",
                "expire" => $dateExpire,
                "status" => 1,
                "pictures" => $imagePaths,
                "type" => $category,
            ];

            // var_dump($body); die;

            // Post product data
            $response = $client->post($url, [
                "body" => json_encode($body),
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ]
            ]);
        } catch (\Exception $e) {
            // Handle any errors that occur during the product data post
            echo 'Error posting product data: ' . $e->getMessage();
        }
    }

    public function edit($productId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/product/' . $productId, 'GET');

        $data["product"] = $result->data;

        return view("admin/product/edit", $data);
    }

    // public function update()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $session = Services::session();
    //     $request = Services::request();

    //     $product_id = $request->getPost('productId');
    //     $imageOld = $request->getPost('imageOld');
    //     $title = $request->getPost('title');
    //     $price = $request->getPost('price');
    //     $stock = $request->getPost('stock');
    //     $weight = $request->getPost('weight');
    //     $category = $request->getPost('category');
    //     $caption = $request->getPost('caption');
    //     $imageId = $request->getPost('imageId');

    //     $imagePaths = [];

    //     if (!empty($_FILES['images'])) {
    //         foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    //             $file = new \CURLFile($tmpName, $_FILES['images']['type'][$key], $_FILES['images']['name'][$key]);

    //             $bodyImage = [
    //                 "folder" => "saka",
    //                 "subfolder" => "product",
    //                 "media" => $file
    //             ];

    //             // $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);

    //             // if (isset($result->data->path)) {
    //             //     $imagePaths[] = $result->data->path;
    //             // }

    //             $ch = curl_init('https://api-media.inovatiftujuh8.com/api/v1/media/upload');
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyImage);
    //             $response = curl_exec($ch);

    //             if (curl_errno($ch)) {
    //                 echo 'Error:' . curl_error($ch);
    //             }
    //             curl_close($ch);

    //             $result = json_decode($response);

    //             // Periksa apakah path berhasil diupload dan simpan
    //             if (isset($result->data->path)) {
    //                 $imagePaths[] = $result->data->path;
    //             }
    //         }
    //     }

    //     $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/update/' . $product_id;

    //     $body = [
    //         "title" => $title,
    //         "description" => $caption,
    //         "price" => $price,
    //         "weight" => $weight,
    //         "stock" => $stock,
    //         "is_draft" => 0,
    //         "cat_id" => $category,
    //     ];

    //     $req = $client->put(
    //         $url,
    //         [
    //             "body" => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Accept'        => 'application/json',
    //                 'Content-Type' => 'application/json'
    //             ]
    //         ]
    //     );

    //     $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';

    //     foreach ($imagePaths as $path) {
    //         $body = [
    //             "product_id" => $product_id,
    //             "path" => $path,
    //         ];

    //         $client->post(
    //             $imageUrl,
    //             [
    //                 "body" => json_encode($body),
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $session->get('token'),
    //                     'Accept'        => 'application/json',
    //                     'Content-Type'  => 'application/json'
    //                 ]
    //             ]
    //         );
    //     }
    // }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $productId = $request->getPost('productId');
        $title = $request->getPost('title');
        $price = $request->getPost('price');
        $stock = $request->getPost('stock');
        $category = $request->getPost('category');
        $dateExpire = $request->getPost('dateExpire');
        $voucherCode = $request->getPost('voucherCode');
        $description = $request->getPost('description');
        $images = $request->getPost('images');

        $existingImages = [];
        if (is_string($images)) {
            $existingImages = json_decode($images, true) ?: [];
        } elseif (is_array($images)) {
            $existingImages = $images;
        }

        $imagePaths = [];

        if (!empty($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                try {
                    $response = $client->post('https://api-media.inovatiftujuh8.com/api/v1/media/upload', [
                        'multipart' => [
                            [
                                'name' => 'folder',
                                'contents' => 'tentang-voucher'
                            ],
                            [
                                'name' => 'subfolder',
                                'contents' => 'product'
                            ],
                            [
                                'name' => 'media',
                                'contents' => fopen($tmpName, 'r'),
                                'filename' => $_FILES['images']['name'][$key],
                                'headers'  => ['Content-Type' => $_FILES['images']['type'][$key]]
                            ]
                        ]
                    ]);

                    $result = json_decode($response->getBody()->getContents());

                    if (isset($result->data->path)) {
                        $imagePaths[] = $result->data->path;
                    }
                } catch (\Exception $e) {

                    echo 'Error uploading image: ' . $e->getMessage();
                }
            }
        }

        $allImagePaths = array_merge($imagePaths, $existingImages);

        try {
            $url = getenv('API_URL') . '/api/v1/product/';

            $body = [
                "id" => $productId,
                "name" => $title,
                "description" => $description,
                "price" => $price,
                "stock" => $stock,
                "voucher_code" => "-",
                "expire" => $dateExpire,
                "status" => 1,
                "pictures" => $allImagePaths,
                "type" => $category,
            ];

            $response = $client->post($url, [
                "body" => json_encode($body),
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ]
            ]);
        } catch (\Exception $e) {
            echo 'Error updating product: ' . $e->getMessage();
        }
    }

    public function detail($productId)
    {
        $result = curlHelper(getenv('API_URL') . '/api/v1/product/' . $productId, 'GET');

        return json_encode([
            "data" =>  $result->data
        ]);
    }

    public function delete($productId)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();

        $url = getenv('API_URL') . '/api/v1/product/' . $productId;

        $req = $client->delete(
            $url,
            [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/product'));
    }

    public function deleteImage()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $imageId = $request->getPost('imageId');

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/delete-product-image';

        $body = [
            "id" => $imageId,
        ];

        $req = $client->delete(
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
}
