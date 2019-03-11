<?php
  session_start();
  $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
  switch($httpMethod) {
    case "OPTIONS":
      // Allows anyone to hit your API, not just this c9 domain
      header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
      header("Access-Control-Allow-Methods: POST, GET");
      header("Access-Control-Max-Age: 3600");
      exit();
    case "GET":
      http_response_code(401);
      break;
    case 'POST':
      // Get the body json that was sent
      $rawJsonString = file_get_contents("php://input");
      //var_dump($rawJsonString);
      // Make it a associative array (true, second param)
      $jsonData = json_decode($rawJsonString, true);
      // TODO: do stuff to get the $results which is an associative array
      //already used usernames
      $usernames = array("jeff","marcus","mitch","mitchell","walter","jake");
      // Allow any client to access
      header("Access-Control-Allow-Origin: *");
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");
      $returnVals = array();
      
      //check if username is in password and return error if it is
      if(strpos($_POST['pw'], $_POST['usr']) !== false){
        array_push($returnVals, "error");
      } 
      
      //check if username already in use
      if (in_array($_POST['usr'], $usernames)) {
          array_push($returnVals, "uerror");
      }
      
      //Build random password
      $pass= substr(md5(microtime()),rand(0,26), 25);
      //return random pass
      array_push($returnVals, $pass);
      echo json_encode($returnVals);
      break;
    case 'PUT':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'DELETE':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      break;
  }
?>