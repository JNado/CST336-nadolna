<?php

if ($_POST['op'] == 1) {
    $cSession = curl_init();
    
    $searchTerm = $_POST["q"];
    
    curl_setopt($cSession,CURLOPT_URL,"https://pixabay.com/api/?key=12230562-329c20fbe0bcb275979149d5a&q=" . $searchTerm . "&image_type=photo&pretty=true");
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER, false);
    
    curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
        "Accept: application/json",
        "Content-Type: application/json",
    ));
    
    $results = curl_exec($cSession);
    $err = curl_error($cSession);
    
    curl_close($cSession);
    
    echo ($results);
} else if ($_POST['op'] == 2) {
    $host = "127.0.0.1";
    $dbname = "lab7images";
    $username = "jnado";
    $password = "";
    
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "INSERT INTO images (search, url) VALUES " .
            "(:search, :url)";
    $stmt = $dbConn->prepare($sql);

    $stmt->execute(array(":search" => $_POST['search'],
                        ":url" => $_POST['url']));
    
    echo json_encode(array("true", "true"));
} else if ($_POST['op'] == 3) {
    $host = "127.0.0.1";
    $dbname = "lab7images";
    $username = "jnado";
    $password = "";
    
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "DELETE FROM images WHERE url=:url";
    $stmt = $dbConn->prepare($sql);

    $stmt->execute(array(":url" => $_POST['url']));
    
    echo json_encode(array("true", "true"));
} else if ($_POST['op'] == 4) {
    $host = "127.0.0.1";
    $dbname = "lab7images";
    $username = "jnado";
    $password = "";
    
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "SELECT distinct(search) FROM images";
    $stmt = $dbConn->prepare($sql);

    $stmt->execute();
    
    $records = $stmt->fetchAll();
    
    echo json_encode($records);
} else if ($_POST['op'] == 5) {
    $host = "127.0.0.1";
    $dbname = "lab7images";
    $username = "jnado";
    $password = "";
    
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "SELECT url FROM images WHERE search = :search";
    $stmt = $dbConn->prepare($sql);

    $stmt->execute(array(":search" => $_POST['search']));
    
    $records = $stmt->fetchAll();
    
    echo json_encode($records);
}
?>