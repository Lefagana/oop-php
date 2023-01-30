<?php

$curl = curl_init();

curl_setopt_array($curl, [
 CURLOPT_URL => "http://localhost/oop-php/admin/apis/user",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "GET",
 CURLOPT_HTTPHEADER => [
  "Accept: */*",
  "Authorization: Bearer 9cd904d955ee392baf11707e929bcd7ec9fd0a5169e34ad9228f14d1ab7aef93",
 ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
 echo "cURL Error #:" . $err;
} else {
 echo $response;
}