<?php
include './services/addModule.php';
include './services/addRoom.php';

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Devices</title>
    <link rel="stylesheet" href="../css/general.css"/>
    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/devices.css"/>
    <link rel="stylesheet" href="../css/switch.css"/>

    <link href="./navbar.css" rel="stylesheet/scss" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <nav class="sidebar-navigation">
    <ul>
        <li  id="home">
            <i class="fa fa-home"></i>
            <span class="tooltip">Home</span>
        </li>
        <li class="active" id="device">
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

<div class="content-general">
    <label>Do you want add a Room?</label>
    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <label>Please introduce the name of the room</label>
        <input type="text" name="roomName" placeholder="Room name"><br>
        <input type="submit" name="addRoom" value="Add room">
    </form>

    <?php
        if(isset($_POST['addRoom'])){
            addRoom();
        }
    ?>
    <?php

        $con = conectDatabase();

        $id_user = $_SESSION['id_user'];

        $rooms = $con -> query("SELECT * from Rooms where id_user='$id_user'");

        while ($room = $rooms->fetch(5)){

            echo "<div class=\"room\"><span id=\"roomName\">$room->roomName</span><div class=\"content_room\">";

            $result=$con->query("SELECT * from Leds where id_user = '$id_user' and roomName = '$room->roomName'");

            if ($result->rowCount() != 0 ) {

                while ($row = $result->fetch(5)){

                    $id_led=$row->id_led;
                    $location=$row->location;
                    $status=$row->status;

                    echo"<p>$location</p><label class='switch'>
                        <input type='checkbox' id='$id_led' value='$status'>
                        <span class='slider round'></span>
                        </label><p class ='$id_led text_id_led'>$id_led</p><br>";

                    echo "<script>
                        $(\"#$id_led\").change( function(){
                            $.ajax({
                                method: \"POST\",
                                url: \"http://localhost:8001/php/services/updateValues.php\",
                                data: { text: $(\"p.$id_led\").text() }
                            });
                        });
                    </script>";
                }

            }else{
                echo "<label id=\"empty\">This Room dont have any device yet<label>";
            }

            echo "</div></div>";

        }
    ?>


    <label>Do you want add a led?</label>
    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <input type="text" name="location" placeholder="Name"/><br/>
        <label>Point to the pin where you will connect it</label>
        <?php
            $id_user = $_SESSION['id_user'];

            echo "<select name=\"pinArduino\">";

            $pins = $con->query("SELECT pin from Leds");

            $used_pin[]=NULL;

            if ($pins->rowCount()!=0) {
                while($pin = $pins->fetch(5)){
                    $used_pin[]=$pin->pin;
                }
            }

            for ($i=1; $i <= 54; $i++) {
                if (!in_array($i, $used_pin)) {
                    echo "<option value=\"$i\">$i</option>";
                }
            }

            echo "</select>";
            echo "<select name=\"roomName\">";

            $rooms = $con -> query("SELECT * from Rooms where id_user='$id_user'");

            while ($room = $rooms->fetch(5)){
                 echo "<option value=\"$room->roomName\">$room->roomName</option>";

            }
        ?>
        </select><br>
        <input type="submit" name="addLed" value="Add Led"/>
        <?php
        if(isset($_POST['addLed'])){
            addLED();
        }
        ?>
    </form>

</div>
</body>
</html>
