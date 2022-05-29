<?php
include 'conection.php';

$id_led = $_POST['text'];
#var_dump($_POST);
$con = conectDatabase();

$query = $con->query("DELETE FROM Leds WHERE id_led = '$id_led'");


?>
