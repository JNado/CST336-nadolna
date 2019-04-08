<?php
    include 'dbConn.php';
    $conn = getDatabaseConnection("midterm");

    $sql = "SELECT * FROM mp_product";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>