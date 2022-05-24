<?php

include './services/addModule.php';

session_start();
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Settings</title>
        <link rel="stylesheet" href="../css/general.css"/>
        <link rel="stylesheet" href="../css/settings.css"/>
        <link rel="stylesheet" href="../css/home.css"/>
        <link rel="stylesheet" href="../css/navbar.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
       

        <nav class="sidebar-navigation">
            <ul>
                <li id="home">
                    <i class="fa fa-home"></i>
                    <span class="tooltip">Home</span>
                </li>
                <li id="device">
                    <i class="fa fa-hdd-o"></i>
                    <span class="tooltip">Devices</span>
                </li>
                <li class="active" id="setting">
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

        <?php
            $id_user=$_SESSION['id_user'];

            $con = conectDatabase();

            $sql_result = $con->query("Select * from Users where id_user='$id_user'");

            $user = $sql_result->fetch(5);

            $content_user = "<div id=\"content_user\"> ";
            $content_user .= "<img src=\"../images/default-user.png\">";
            $content_user .= "<div id=\"user_information\">";
            $content_user .= "<p>$user->name $user->lastName</p>";
            $content_user .= "<p>$user->username</p>";
            $content_user .= "<p>$user->email</p>";
            $content_user .= "</div>";
            $content_user .= "</div>";


            echo $content_user;



        ?>
    </div>
    </body>
</html>
