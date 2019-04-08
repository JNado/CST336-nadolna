<?php
//Used to check the letter the user inputed in the form, and if the letter is in the word
//Should return an array of booleans as the api
include 'dbConnection.php';

$conn = getDatabaseConnection("hangman");
$w = $_GET['wordid'];
$l = $_GET['letterid'];

$sql = "SELECT * FROM words WHERE word_id = :wid";

$namedParameters = array();

$namedParameters[':wid'] = $w;

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bool = array();

if (strpos($records[0]->word, $l) != 0) {
    $bool[] = true;
} else {
    $bool[] = false;
}

echo json_encode($records);
?>