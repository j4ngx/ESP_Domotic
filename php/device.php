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
    <link rel="stylesheet" href="../css/blind.css"/>


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
  <h1 class="text-white ml-3 mt-2">Rooms</h1>
  <div class="justify-center-md-center">

  <?php

        $con = conectDatabase();

        $id_user = $_SESSION['id_user'];
        $rooms = $con -> query("SELECT * from Rooms where id_user='$id_user'");


       while ($room = $rooms->fetch(5)){

          echo "<div class=\"room m-5\">";
            echo "<div class=\"row\">";
              echo "<p class=\"row col-10 mt-4 ml-5 roomName\">$room->roomName</p>";
              echo "<li class='list-item mt-1 ml-5 pl-4'>";
                echo "<button id='room_$room->id_room' class=\"btn btn-danger btn-sm rounded-circle ml-5\" type=\"button\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button>";
              echo "</li>";
              echo "<spam class ='room_$room->id_room text_id_led'>$room->id_room</spam>";
              echo "<script>
                      $( \"#room_$room->id_room\" ).click(function(){
                          $.ajax({
                              method: \"POST\",
                              url: \"./services/deleteRoom.php\",
                              data: { text: $(\"spam.room_$room->id_room\").text() }
                          }).done(function(){
                            location.reload(true);
                          });

                      });
                    </script>";


            echo "</div>";

            echo "<div class=\"row\">";
              echo "<p class=\"row col ml-5 devices\">Devices</p>";
            echo "</div>";

            $result=$con->query("SELECT * from Leds where id_user = '$id_user' and roomName = '$room->roomName' UNION SELECT * from Blinds where id_user = '$id_user' and roomName = '$room->roomName'");

            if ($result->rowCount() != 0 ) {

              // Show all leds
              echo "<div class=\"row mt-3 ml-5\">";
              $result=$con->query("SELECT * from Leds where id_user = '$id_user' and roomName = '$room->roomName'");

              while ($row = $result->fetch(5)){

                  $id_led=$row->id_led;
                  $location=$row->location;
                  $status=$row->status;


                      echo"<div class=\"col-sm-1 d-inline\">
                              <label class='switch'>";
                      if($status==0){
                            echo "<input type='checkbox' id='$id_led' value='$status'>";
                      }else{
                            echo "<input type='checkbox' id='$id_led' value='$status' checked>";
                      }
                      echo "<span class='slider round'></span>
                              </label>
                              <p class ='$id_led text_id_led'>$id_led</p>
                              <p>$location</p>";
                        echo "<li class='list-item'>";
                          echo "<button id='led_$id_led' class=\"btn btn-danger btn-sm rounded-circle ml-3 mb-2\" type=\"button\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button>";
                        echo "</li>";
                        echo "<script>
                                $( \"#led_$id_led\" ).click(function(){
                                    $.ajax({
                                        method: \"POST\",
                                        url: \"./services/deleteLed.php\",
                                        data: { text: $(\"p.$id_led\").text() }
                                    }).done(function(){
                                      location.reload(true);
                                    });

                                });
                              </script>";
                        echo "<script>
                              $(\"#$id_led\").change( function(){
                                  $.ajax({
                                      method: \"POST\",
                                      url: \"./services/updateValuesLed.php\",
                                      data: { text: $(\"p.$id_led\").text() }
                                  });
                              });
                          </script>";


                  echo "</div>";

              }
              echo "</div>";
              //Show all the Blinds
              $result=$con->query("SELECT * from Blinds where id_user = '$id_user' and roomName = '$room->roomName'");
              while ($row = $result->fetch(5)){

                  $id_blind=$row->id_blind;
                  $location=$row->location;
                  $percentage=$row->percentage;

                  echo "<div class=\"row mt-3 ml-5\">
                    <div class=\"col slidecontainer mb-5\">
                      <input type=\"range\" min=\"1\" max=\"100\" value=\"$percentage\" class=\"range\" id=\"blind_$id_blind\">
                      <label class=\"row ml-5 pl-5 mt-3 \">$location</label>
                      <p class ='blind_$id_blind text_id_led'>$id_blind</p>
                      <li class='list-item '>
                        <button id='delete_blind_$id_blind' class=\"btn btn-danger btn-sm rounded-circle \" type=\"button\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button>
                      </li>
                    </div>
                  </div>";

                  echo "<script>
                          $(\"#blind_$id_blind\").change( function(){
                              $.ajax({
                                  method: \"POST\",
                                  url: \"./services/updateValuesBlind.php\",
                                  data: { text: $(\"p.blind_$id_blind\").text(),
                                          rangeValue: $(\"#blind_$id_blind\").val()
                                   }
                              });
                            alet($(\"#rangeValue\").val());
                          });
                  </script>";

                  echo "<script>
                          $( \"#delete_blind_$id_blind\" ).click(function(){
                              $.ajax({
                                  method: \"POST\",
                                  url: \"./services/deleteBlind.php\",
                                  data: { text: $(\"p.blind_$id_blind\").text() }
                              }).done(function(){
                                location.reload(true);
                              });
                          });
                        </script>";
              }

          }else{
              echo "<div class=\"row d-inline m-5 p-5\"><label id=\"empty\">This Room dont have any device yet<label></div>";
          }

          echo "</div>";

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
                <input type="text" class="form-control" id="exampleFormControlInput1" name="roomName" placeholder="Room name" required><br>
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
      Do you want add a Device?
    </button>
    <div class="pl-xl-5 m-3" id="collapseLed">
      <div class="well pl-xl-5 ">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
          <div class="form-row">
            <div class="form-group col-md-2">
              <label>Dispositive name</label>
              <input type="text" name="location" class="form-control" placeholder="Name" required/><br/>
            </div>
            <div class="form-group col">
              <label for="inputPinArduino" class="d-block">Arduino pin</label>
              <select name="pinArduino" class="form-control  col-sm-1" id="inputPinArduino">
              <?php
                $id_user = $_SESSION['id_user'];

                $pins = $con->query("(SELECT pin FROM Leds) UNION (SELECT pin FROM Blinds)");

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

              <div class="form-group col-md-2">
                  <label for="inputRoomName">Type device</label>
                  <select class="form-control col-md-8" name="type_device" id="inputTypeDevice">
                    <option value="led">Led</option>
                    <option value="blind">Blind</option>
                    <option value="led_rgb" disabled>Led RGB</option>
                </select>
              </div>


            <div class="form-row">
              <div class="form-group col">
                <input  type="submit" class="btn btn-success mt-4" name="addDevice" value="Add device"/>
              </div>
            </div>
      </div>
    </div>



        <?php
        if(isset($_POST['addRoom'])){
            addRoom();
        }

        if (isset($_POST['addDevice'])) {
          if($_POST['type_device']=="led"){
              addLED();
          }elseif ($_POST['type_device']=="blind") {
              addBlind();
          }
        }

        ?>
  </div>
</div>
</div>
</body>
</html>
