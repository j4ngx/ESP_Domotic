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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/general.css"/>
    <link rel="stylesheet" href="../css/navbar.css"/>
    <link rel="stylesheet" href="../css/devices.css"/>
    <link rel="stylesheet" href="../css/switch.css"/>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



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
  <label>    </label>
  <h1>Rooms</h1>
  <div class="justify-center-md-center">

  <?php

        $con = conectDatabase();

        $id_user = $_SESSION['id_user'];
        $rooms = $con -> query("SELECT * from Rooms where id_user='$id_user'");


       while ($room = $rooms->fetch(5)){

          echo "<div class=\"room m-5\">";
            echo "<div class=\"row\">";
              echo "<p class=\"row col mt-4 ml-5 roomName\">$room->roomName</p>";
            echo "</div>";

            echo "<div class=\"row\">";
              echo "<p class=\"row col ml-5 devices\">Devices</p>";
            echo "</div>";

            echo "<div class=\"row mt-3 ml-5\">";
            $result=$con->query("SELECT * from Leds where id_user = '$id_user' and roomName = '$room->roomName'");

          if ($result->rowCount() != 0 ) {

              while ($row = $result->fetch(5)){

                  $id_led=$row->id_led;
                  $location=$row->location;
                  $status=$row->status;

                  if($status==0){
                      echo"<div class=\"col-sm-1 d-inline\">
                              <label class='switch'>
                              <input type='checkbox' id='$id_led' value='$status'>
                              <span class='slider round'></span>
                              </label>
                              <p class ='$id_led text_id_led'>$id_led</p>
                              <p>$location</p>
                            </div>";



                  }else{
                    echo"<div class=\"col-sm-1 d-inline\">
                            <label class='switch'>
                            <input type='checkbox' id='$id_led' value='$status' checked>
                            <span class='slider round'></span>
                            </label>
                            <p class ='$id_led text_id_led'>$id_led</p>
                            <p>$location</p>
                          </div>";

                  }

                  echo "<script>
                        $(\"#$id_led\").change( function(){
                            $.ajax({
                                method: \"POST\",
                                url: \"./services/updateValues.php\",
                                data: { text: $(\"p.$id_led\").text() }
                            });
                        });
                    </script>";
              }
          }else{
              echo "<div class=\" d-inline\"><label id=\"empty\">This Room dont have any device yet<label></div>";
          }

          echo "</div></div>";

        }

    ?>

    <button class="btn btn-primary m-2 d-block" type="button" data-toggle="collapse" data-target="#collapseRoom" aria-expanded="false" aria-controls="collapseRoom">
      Do you want add a Room?
    </button>
    <div class="pl-xl-5 m-3" id="collapseRoom">
      <div class="well pl-xl-5">

        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
          <div class="form-group">
            <label>Please introduce the name of the room</label>
            <div class="row">
              <div class="col-sm-4">
                <input type="text" class="form-control" id="exampleFormControlInput1" name="roomName" placeholder="Room name"><br>
              </div>
              <div class="col">
                <input type="submit" class="btn btn-success" name="addRoom" value="Add room">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <button class="btn btn-primary m-2" type="button" data-toggle="collapse" data-target="#collapseLed" aria-expanded="false" aria-controls="collapseLed">
      Do you want add a Led?
    </button>
    <div class="pl-xl-5 m-3" id="collapseLed">
      <div class="well pl-xl-5 ">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
          <div class="form-row">
            <div class="form-group col-md-2">
              <label>Dispositive name</label>
              <input type="text" name="location" class="form-control" placeholder="Name"/><br/>
            </div>
            <div class="form-group col">
              <label for="inputPinArduino" class="d-block">Arduino pin</label>
              <select name="pinArduino" class="form-control  col-sm-1" id="inputPinArduino">
              <?php
                $id_user = $_SESSION['id_user'];

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
                ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                  <label for="inputRoomName">Choose a room</label>
                  <select class="form-control col-md-8" name="roomName" id="inputRoomName">
                  <?php
                    $rooms = $con -> query("SELECT * from Rooms where id_user='$id_user'");

                    while ($room = $rooms->fetch(5)){
                         echo "<option value=\"$room->roomName\">$room->roomName</option>";
                    }
                  ?>
                </select>
              </div>
                <div class="form-group col">
                  <input  type="submit" class="btn btn-success mt-4" name="addLed" value="Add Led"/>
                </div>
            </div>
      </div>
    </div>

        <?php
        if(isset($_POST['addLed'])){
            addLED();
        }

        if(isset($_POST['addRoom'])){
            addRoom();
        }
        ?>
      </div>

    </div>
</body>
</html>
