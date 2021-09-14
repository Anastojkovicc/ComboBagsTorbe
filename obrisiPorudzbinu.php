<?php

include '../init.php';
$db_server = "localhost";
$db_db= "torba";
$db_user = "root";
$db_pass = "";
$id = $_GET['id'];

$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_db);
if ($mysqli->connect_error) {
    die("err");
} 
$sql = "DELETE FROM rezervacija WHERE id=".$id;

if ($mysqli->query($sql) === TRUE) {

    header("location: brisanjePorudzbina.php");
} else {
    echo "err";
}

$mysqli->close();


?>