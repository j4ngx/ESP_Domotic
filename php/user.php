<?php
session_start();

include './services/addModule.php';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/general.css"/>
    <link rel="stylesheet" href="../css/switch.css"/>
    <link rel="stylesheet" href="../css/blind.css"/>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/user.css">
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
    <h1>Welcome to</h1>
    <img src="../images/logo.png" alt="logoESP_Domotic"/>


    <div class="dispositives w-75 h-100 ml-xl-5 mb-3">
      <div class="row">
        <p class="col ml-5 devices mt-3">Leds</p>
      </div>


      <?php
      $username = $_SESSION['id_user'];
      $sql_muestra_led = "SELECT * from Leds where id_user = '$username'";

      $con = conectDatabase();

      $result=$con->query($sql_muestra_led);

      echo "<div class=\"row mt-3 ml-5\">";
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
                echo "</div>";



            }else{
              echo"<div class=\"col-sm-1 d-inline\">
                      <label class='switch'>
                      <input type='checkbox' id='$id_led' value='$status' checked>
                      <span class='slider round'></span>
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
              echo "</div>";

            }

            echo "<script>
                    $(\"#$id_led\").change( function(){
                        $.ajax({
                            method: \"POST\",
                            url: \"./services/updateValuesLed.php\",
                            data: { text: $(\"p.$id_led\").text() }
                        });
                    });
            </script>";

        }
      }else{
        echo "<div class=\" d-inline\"><label id=\"empty\">This user dont have any Led yet<label></div>";
      }
      echo "</div>";
      ?>
    </div>


    <div class="dispositives w-75 h-100 ml-xl-5 mb-3">
      <div class="row">
        <p class="col ml-5 devices mt-3">Blinds</p>
      </div>

      <?php
      $username = $_SESSION['id_user'];
      $sql = "SELECT * from Blinds where id_user = '$username'";

      $con = conectDatabase();

      $result=$con->query($sql);
      if ($result->rowCount() != 0 ) {
        while ($row = $result->fetch(5)){

            $id_blind=$row->id_blind;
            $location=$row->location;
            $percentage=$row->percentage;

            echo "<div class=\"row mt-3 ml-5\">
              <div class=\"col slidecontainer mb-5\">
                <input type=\"range\" min=\"1\" max=\"100\" value=\"$percentage\" class=\"range\" id=\"blind_$id_blind\">
                <label class=\"row ml-5 pl-5 mt-3 \">$location</label>
                <p class ='blind_$id_blind text_id_led'>$id_blind</p>
                <li class='list-item'>
                  <button id='delete_blind_$id_blind' class=\"btn btn-danger btn-sm rounded-circle ml-3 mb-2\" type=\"button\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button>
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
          echo "<div class=\" d-inline ml-5\"><label id=\"empty\">This user dont have any Blind yet<label></div>";
        }

      ?>
      </div>
</div>

</body>
