<?
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '256M');
require_once('includes/Unirest.php' );

//test_custome_field();
test_create_user();

function test_create_user() {
  $username = 'admin'; // Twitter login
  $password = 'admin'; // Twitter password
  $params = array(
      'username' => 'hello-world',
      'email' => 'po@po.com',
      'password' => 'admin',
  );
// Unirest\Request::auth($username, $password);

  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  Unirest\Request::defaultHeaders($headers);   
  
  $api_url = 'http://shetrades/wp-json/wp/v2/users';
  
  $result = Unirest\Request::post($api_url, null, $params );
  print_r($result);
  exit;
  
}

function test_custome_field() {
  // You would edit the following:
  $username = 'admin'; // Twitter login
  $password = 'admin'; // Twitter password
  $message = "Hey neat, I'm posting with the API";
   
   

  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/custom/field/product/?search_terms=cof';
//  $body = null;
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  Unirest\Request::defaultHeaders($headers);   
  $result = Unirest\Request::get($api_url, null, null );
  print_r($result->body);
  exit;
   
   
   
   
  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/custom/field/verifier/';
  $body = null;
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );

  print_r($result);

  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/custom/field/product/010514';
  $body = array( 'status' => $message );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );

  //print_r($result);
  
}

function test_friend() {
  // You would edit the following:
  $username = 'regis.vidal@gmail.com'; // Twitter login
  $password = 'admin'; // Twitter password
  $message = "Hey neat, I'm posting with the API";
   
   
  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/friend/?search_terms=a';
  $body = array( 'status' => $message );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );

  print_r($result);
  
  
  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/friend/8324';
  $body = array( 'status' => $message );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  //$result = $request->request( $api_url , array( 'method' => 'POST', 'body' => $body, 'headers' => $headers ) );
  
  print_r($result);

  $api_url = 'http://shetrades/wp-json/shetrades/v1/friend/8324';
  $body = array( 'status' => 'cancel' );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'PUT', 'body' => $body, 'headers' => $headers ) );
  
  print_r($result);

  $api_url = 'http://shetrades/wp-json/shetrades/v1/friend/8623';
  $body = array( 'status' => 'cancel' );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'DELETE', 'body' => $body, 'headers' => $headers ) );
  
  print_r($result);
  
}



function test_member() {
  // You would edit the following:
  $username = 'regis.vidal@gmail.com'; // Twitter login
  $password = 'admin'; // Twitter password
  $message = "Hey neat, I'm posting with the API";
   
   
  // Now, the HTTP request:
//  $api_url = 'http://shetrades/wp-json/shetrades/v1/member/?member_type=verifier,buyer';
//  $api_url = 'http://shetrades/wp-json/shetrades/v1/member/?member_type=verifier,buyer';
/*  $api_url = 'http://shetrades/wp-json/shetrades/v1/member/?member_type=verifier';
  $body = array( 'status' => $message );
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );
*/  

}


function test_notification() {

  $password = $username = 'regis.vidal+business-name@gmail.com';
  $password = $username = 'regis.vidal+curry-one-catering@gmail.com';

  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/notification/17';
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $body = array( 'status' => "read" );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'POST', 'body' => $body, 'headers' => $headers ) );
  
  $json = json_decode($result['body']);
  if ($result['response']['code'] != 200) {
    print_r($result);
  } else {
  }
    print_r($result);
   
  // Now, the HTTP request:
  $api_url = 'http://shetrades/wp-json/shetrades/v1/notification/?type=po';
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $body = array( 'type' => "read" );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );
  
  $json = json_decode($result['body']);
  if ($result['response']['code'] != 200) {
    print_r($result);
  } else {
    print_r($json);
  }
  //print_r($result);
//    print_r($result);*/
}

exit;
  
function test_message() {

  $password = $username = 'regis.vidal+business-name@gmail.com';
  $password = $username = 'regis.vidal+curry-one-catering@gmail.com';

  // 
  $api_url = 'http://shetrades/wp-json/shetrades/v1/thread/';
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $body = array( 'content' => "My message", 'subject' => "Important", 'recipients' => array("regis-vidalcurry-one-cateringgmail-com") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'POST', 'body' => $body, 'headers' => $headers ) );
  
  $json = json_decode($result['body']);
  if ($result['response']['code'] != 200) {
    print_r($result);
    exit;
  } else {
    print_r($json);
  }
  $threadid = $json->data->id;
echo "----------------------\n";  
echo $threadid . "\n";
echo "----------------------\n";  

  $api_url = 'http://shetrades/wp-json/shetrades/v1/thread/' . $threadid;
  $headers = array( 'Authorization' => 'Basic '.base64_encode("$username:$password") );
  $request = new WP_Http;
  $result = $request->request( $api_url , array( 'method' => 'GET', 'body' => $body, 'headers' => $headers ) );
  
  $json = json_decode($result['body']);
  if ($result['response']['code'] != 200) {
    print_r($result);
  } else {
    print_r($json);
  }
  print_r($json);
//    print_r($result);*/
}