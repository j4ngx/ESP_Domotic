<?php
session_start();

include './services/addModule.php';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Home</title>
    <link rel="stylesheet" href="../css/general.css"/>
    <link rel="stylesheet" href="../css/switch.css"/>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>


    <nav class="sidebar-navigation">
    <ul>
        <li class="active" id="home">
            <i class="fa fa-home"></i>
            <span class="tooltip">Home</span>
        </li>
        <li id="device">
            <i class="fa fa-hdd-o"></i>
            <span class="tooltip">Devices</span>
        </li>
        <li id="setting">
            <i class="fa fa-sliders"></i>
            <span class="tooltip">Settings</span>
        </li>
        <li class="logOut">
            <i class="fa fa-sign-out" ></i>
            <span class="tooltip">Log Out</span>
        </li>
    </ul>
</nav>

<script src="../js/logOut.js"></script>
<script src="../js/sideBar.js"></script>


    <!--Here will be all the dispositives-->
<div class="content-general">
    <?php
    $username = $_SESSION['id_user'];
    $sql_muestra_led = "SELECT * from Leds where id_user = '$username'";

    $con = conectDatabase();

    $result=$con->query($sql_muestra_led);

    while ($row = $result->fetch(5)){

        $id_led=$row->id_led;
        $location=$row->location;
        $status=$row->status;

        echo "$id_led $location";
        if($status==0){
            echo"<label class='switch'>
                <input type='checkbox' id='$id_led' value='$status'>
                <span class='slider round'></span>
                </label><p class ='$id_led text_id_led'>$id_led</p><br>";


        }else{
            echo"<label class='switch'>
                <input type='checkbox' id='$id_led' value='$status' checked>
                <span class='slider round'></span>
                </label><p class ='$id_led text_id_led'>$id_led</p><br>";

        }

        echo "<script>
                $(\"#$id_led\").change( function(){
                    $.ajax({
                        method: \"POST\",
                        url: \"http://localhost:800/php/services/updateValues.php\",
                        data: { text: $(\"p.$id_led\").text() }
                    });
                });
        </script>";

    }
    ?>
</div>
</body>
