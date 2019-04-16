<?php
    $host = "127.0.0.1";
    $dbname = "ottermart";
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
    
    $sql = '';
    
    if ($_POST['op'] == 1) {
        $sql = "SELECT * FROM om_product";
        $stmt = $dbConn->prepare($sql);
        
        $stmt->execute();
        
        $record = $stmt->fetchAll();
        
        echo json_encode($record);

    } else if ($_POST['op'] == 2) {
        try {
            $sql = "DELETE FROM om_product WHERE productId = :productId";
            $stmt = $dbConn->prepare($sql);
        
            $stmt->execute(array(":productId" => $_POST['id']));
    
            $record = $stmt->fetch();
        
            echo json_encode($record);
        } catch (PDOException $ex) {
            echo json_decode($ex);
        }
    } else if ($_POST['op'] == 3) {
        try {
            $sql = "INSERT INTO om_product (productName, productDescription, productImage, price, catId) VALUES " .
                    "(:name, :desc, :image, :price, :cat)";
                    
            $stmt = $dbConn->prepare($sql);
        
            $stmt->execute(array(":name" => $_POST['name'],
                                    ":desc" => $_POST['desc'],
                                    ":image" => $_POST['image'],
                                    ":price" => $_POST['price'],
                                    ":cat" => $_POST['cat']));
    
            $record = $stmt->lastInsertId();
        
            echo json_encode($record);
        } catch (PDOException $ex) {
            echo json_decode($ex);
        }
    } else if ($_POST['op'] == 4) {
        $sql = "SELECT * FROM om_product WHERE productId = :prodId";
                    
        $stmt = $dbConn->prepare($sql);
        
        $stmt->execute(array(":prodId" => $_POST['pId']));
    
        $record = $stmt->fetch();
        
        echo json_encode($record);
    } else if ($_POST['op'] == 5) {
        $sql = "UPDATE om_product
                SET productName = :pname, productDescription = :pdesc, productImage = :pimage, price = :prodPrice, catId = :cat
                WHERE productId = :prodId; ";
    
        $stmt = $dbConn->prepare($sql);
        
        $stmt->execute(array(":prodId" => $_POST['pId'],
                                ":pname" => $_POST['name'],
                                ":pdesc" => $_POST['desc'],
                                ":pimage" => $_POST['image'],
                                ":prodPrice" => $_POST['price'],
                                ":cat" => $_POST['cat']));
    
        $record = $stmt->lastInsertId();
        
        echo json_encode($record);
    }
    
    
?>