<?php
    include 'dbConn.php';
    $conn = getDatabaseConnection("cinder");
    
    $sql = "SELECT * FROM `match` WHERE user_id=:userid";
    $namedParameters[":userid"] = $_GET['userid'];

    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>