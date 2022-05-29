<?php
include 'conection.php';

$id_blind = $_POST['text'];
$percentage = $_POST['rangeValue'];
#var_dump($_POST);
var_dump($_POST['text']);

$con = conectDatabase();

$con->query("UPDATE Blinds SET percentage = $percentage WHERE id_blind = '$id_blind'");


?>
