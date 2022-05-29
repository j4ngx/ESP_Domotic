<?php
include 'conection.php';

$id_room = $_POST['text'];
#var_dump($_POST);
var_dump($_POST['id_room']);

$con = conectDatabase();

$query = $con->query("DELETE FROM Rooms WHERE id_room = '$id_room'");


?>
