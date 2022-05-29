<?php
include 'conection.php';

$id_blind = $_POST['text'];
#var_dump($_POST);
$con = conectDatabase();

$query = $con->query("DELETE FROM Blinds WHERE id_blind = '$id_blind'");


?>
