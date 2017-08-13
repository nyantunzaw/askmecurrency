<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "athapyar_main";

echo $_GET["firstname"];
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];
$gender = $_GET["gender"];
$messengerid = $_GET["messengerid"];
$profilepic = $_GET["profilepic"];
$locale = $_GET["locale"];
$language = $_GET["language"];
$timezone = $_GET["timezone"];
echo gettype($firstname);
echo $firstname;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "INSERT INTO AMC_subscribers (firstname, lastname, gender,messengerID,profilepic,locale,language,timezone)
VALUES ('$firstname','$lastname','$gender','$messengerid','$profilepic','$locale','$language',$timezone)";

echo $sql;

echo "<br/>";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();