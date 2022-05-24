<?php

    function conectDatabase(){
        $dsn = "mysql:host=db:3306;"
            . "dbname=ESP_Domotic;charset=utf8";
        $user = "user";
        $pass = "test";

        try {
            $con = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Error en la conexion: " . $e->getMessage() . "<br/>");
        }

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }

 ?>
