<?php
//step1
$cSession = curl_init();

$searchTerm = $_POST["q"];


//step2
curl_setopt($cSession,CURLOPT_URL,"https://pixabay.com/api/?key=12230562-329c20fbe0bcb275979149d5a&q=" . $searchTerm . "&image_type=photo&pretty=true");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);



curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
));

//step3
$results = curl_exec($cSession);
$err = curl_error($cSession);

//step4
curl_close($cSession);

//step5


echo ($results);
?>