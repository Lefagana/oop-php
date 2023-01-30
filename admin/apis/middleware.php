<?php
// $token = bin2hex(random_bytes(32));
// print_r($token);
function res($response_code, $response_message, $data)
{
 return array("response_code" => $response_code, "response_message" => $response_message, "data" => $data);

}
function response($response)
{
 $res_header = "HTTP/1.0 {$response['response_code']}";
 $headers = array("Content-Type: application/json", $res_header);
 http_response_code($response['response_code']);
 foreach ($headers as $header) {
  header($header);
 }
 return json_encode($response);
}

function auth_middleware()
{
 $header = getallheaders();
 $token = isset($header['Authorization']) ? $header['Authorization'] : '';
 if ($token == '') {
  $response = response(res(401, "UnAuthorized", ""));
  echo $response;
  return false;
 } else {
  $developer = Developer::find_by_query("SELECT * FROM " . Developer::$db_tbl . " WHERE token = '{$token}' LIMIT 1");
//   print_r($token);
  $developer = array_shift($developer);

  if ($developer) {
   $user = USER::find_byId($developer->user_id);
   if (!$user) {
    $response = response(res(401, "User Not authorized", ''));
    echo $response;
    return false;
   }
  } else {
   $response = response(res(401, "Invalid Token", ''));
   echo $response;
   return false;
  }
  $response = response(res(200, 'user Authorized', $user));
  print_r($response);
  return true;
 }

}