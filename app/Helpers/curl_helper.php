<?php

use Config\Services;

// function curlHelper($url = '', $method = 'GET', $fields = [])
// {
//   $curl = curl_init();
//   $session = Services::session();
//   $token = $session->get('token');
//   curl_setopt($curl, CURLOPT_URL, $url);
//   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//   if ($method === 'POST' || $method === 'PUT' || $method === "PATCH") {
//     $template = "";
//     $values = $fields;
//     $keys = array_keys($fields);
//     for ($i = 0; $i < count($keys); $i++) {
//       $template .= $keys[$i] . '=' . $values[$keys[$i]] . '&';
//       $query_string = substr($template, 0, -1);
//     }
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
//   }
//   curl_setopt($curl, CURLOPT_VERBOSE, true);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//   // SSL Certificate Problem : Self Signed Certificate 
//   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($curl, CURLOPT_HTTPHEADER, [
//     'Authorization: Bearer ' . $token,
//     'Access-Control-Allow-Origin: *',
//     'Access-Control-Allow-Methods: GET, POST, OPTIONS',
//     "Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization"
//   ]);
//   $result = curl_exec($curl);
//   $resultDecoded = json_decode($result);

//   curl_close($curl);
//   return $resultDecoded;
// }

function curlHelper($url = '', $method = 'GET', $fields = [])
{
  $curl = curl_init();
  $session = \Config\Services::session();
  $token = $session->get('token');

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

  // Inisialisasi query_string sebagai string kosong di luar blok
  $query_string = '';

  if ($method === 'POST' || $method === 'PUT' || $method === 'PATCH') {
    // Jika ada fields yang dikirim, buat query string dari array fields
    if (!empty($fields)) {
      $query_string = http_build_query($fields);
    }

    // Set POSTFIELDS untuk request method POST/PUT/PATCH
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
  }

  curl_setopt($curl, CURLOPT_VERBOSE, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Untuk sertifikat self-signed
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Access-Control-Allow-Origin: *',
    'Access-Control-Allow-Methods: GET, POST, OPTIONS',
    "Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization"
  ]);

  $result = curl_exec($curl);
  $resultDecoded = json_decode($result);

  curl_close($curl);
  return $resultDecoded;
}


function curlPortHelper($url = '', $method = 'GET', $fields = [], $path)
{
  $session = \Config\Services::session();
  $client = \Config\Services::curlrequest([
    'base_uri' => $url
  ]);
  $result = $client->request($method, $path, [
    'headers' => [
      'Authorization' => 'Bearer ' . $session->get('token'),
      'Accept'     => 'application/json',
    ]
  ]);
  $body = json_decode($result->getBody());
  return $body;
}

function curlImageHelperOld($url, $file)
{
  $session = Services::session();
  $token = $session->get('token');
  $headers = ["Content-Type : application/json", "Authorization: Bearer " . $token];

  $postfields = [
    "folder" => "admin",
    "app" => "mhs",
    "media" => curl_file_create($file->getTempName(), $file->getClientMimeType(), $file->getClientName())
  ];

  $curl = curl_init();
  $options = [
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_SSL_VERIFYHOST => 0
  ];

  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  $decoded = json_decode($result);

  return $decoded;
}

function curlImageGeneralHelper($url, $data)
{
  $session = Services::session();
  $token = $session->get('token');
  $headers = ["Content-Type : application/json", "Authorization: Basic aW5vdmFzaTc4Omlub3Zhc2k3OCE="];
  $postfields = [
    "directory" => "sma4Medan",
    "file" => curl_file_create($data['file']['tmp_name'], $data['file']['type'], basename($data['file']['name']))
  ];
  $curl = curl_init();
  $options = [
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_SSL_VERIFYHOST => 0
  ];
  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  $decoded = json_decode($result);

  return $decoded;
}

function curlHelperDelete($url, $method, $data = array())
{
  // Inisialisasi cURL
  $ch = curl_init();

  // Set URL
  curl_setopt($ch, CURLOPT_URL, $url);

  // Set metode HTTP
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

  // Set data untuk POST atau PUT, jika ada
  if (!empty($data)) {
    $query_string = http_build_query($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
  }

  // Eksekusi cURL
  $result = curl_exec($ch);

  // Tangani kesalahan jika ada
  if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
  }

  // Tutup koneksi cURL
  curl_close($ch);

  return $result;
}

function curlImageHelper($url, $data)
{
  $session = Services::session();
  $token = $session->get('token');
  $headers = ["Content-Type : application/json", "Authorization: Bearer " . $token];
  $postfields = [
    "folder" => "images",
    "subfolder" => "tentang-voucher",
    "media" => curl_file_create($data['media']['tmp_name'], $data['media']['type'], basename($data['media']['name']))
  ];
  $curl = curl_init();
  $options = [
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true
  ];
  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  $decoded = json_decode($result);
  return $decoded;
}
