<?php
include 'conection.php';

function addLED(){
    $con = conectDatabase();
    //The query use de var $location and $pinArduino to insert in the database a new Led with the status default at false
    $location=$_POST['location'];
    $pinArduino=$_POST['pinArduino'];
    $id_user=$_SESSION['id_user'];
    $roomName=$_POST['roomName'];

    $sql_result=$con->prepare("INSERT INTO Leds (id_user,location,pin,roomName) values (:id_user,:location,:pin,:roomName)");
    $sql_result->execute(array(':id_user' => $id_user, ':location' => $location, ':pin' => $pinArduino,':roomName' => $roomName));

    //If the result is true print a Succesfull message and date in a registry.txt
    if($sql_result != False){
        system("echo 'Led succesfully added | User: $id_user' >> registry.txt | date >> registry.txt");
    //Else print a Error message and date in the registry.txt
    }else{
        system("echo 'Error adding led to database | User: $id_user' >> registry.txt | date >> registry.txt");
    }

    echo "<script>window.location = window.location.href.split(\"#\")[0];</script>";
}

?>
