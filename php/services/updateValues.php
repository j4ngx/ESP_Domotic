<?php
include 'conection.php';
    
$id_led = $_POST['text'];
#var_dump($_POST);
var_dump($_POST['text']);


$con = conectDatabase();

$query = $con->query("SELECT * from Leds where id_led = '$id_led'");

$led = $query->fetch(5);

if($led->status == "1"){
	$con->query("UPDATE Leds SET status = 0 WHERE id_led = '$id_led'");
}elseif($led->status == "0"){
	$con->query("UPDATE Leds SET status = 1 WHERE id_led = '$id_led'");
}
?>
