<?php

function addRoom(){
  $id_user = $_SESSION['id_user'];
  $roomName = $_POST['roomName'];

  $con = conectDatabase();

  $result = $con->query("INSERT INTO Rooms (id_user,roomName) values ('$id_user','$roomName')");

  if($result != False){
      system("echo 'Room added successfully | User: $id_user' >> ../../docs/registry.txt | date >> registry.txt");
  //Else print a Error message and date in the registry.txt
  }else{
      system("echo 'Error adding room to database | User: $id_user' >> ../../docs/registry.txt | date >> registry.txt");
  }

  echo "<script>window.location = window.location.href.split(\"#\")[0];</script>";
}
?>
