<?php
    $host = 'localhost';//cloud 9
    $username = 'jnado';
    $password = '';
    $dbname = "poll";
    
    //using different database variables in Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Gets random word from the api and returns its length and id.

    $sql = "UPDATE poll_response
            SET option1 = option1 + :value1, option2 = option2 + :value2, option3 = option3 + :value3, option4 = option4 + :value4, option5 = option5 + :value5
            WHERE pollId = 'q1'";
    $stmt = $dbConn -> prepare($sql);  
    $stmt->execute(array(":value1" => $_POST['o1'],
                        ":value2" => $_POST['o2'],
                        ":value3" => $_POST['o3'],
                        ":value4" => $_POST['o4'],
                        ":value5" => $_POST['o5']));
    
    $sql = "SELECT * FROM poll_response WHERE pollId = 'q1'";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    
    $record = $stmt->fetch(PDO::FETCH_ASSOC); 

    echo json_encode($record);
?>