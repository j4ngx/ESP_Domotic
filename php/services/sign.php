<?php
include 'conection.php';

function login(){

    $con = conectDatabase();
    //Recives the values fron the input of the form
    $username=$_POST['username_log'];
    $password=$_POST['password_log'];

    //Encryp the password with the sha1;
    $pass_encrypted=sha1($password);
    //The query return the id_user
    $sql = "SELECT id_user from Users where username=:username and password=:password";
    $sql_result=$con->prepare($sql);
    $sql_result->execute(array(':username' => $username, ':password' => $pass_encrypted));

    //Count the rows of the query
    $rows=$sql_result->rowCount();

    //If the num of rows create a SESION variable
    if($rows>0){
        //Use the function for creating a new session
        session_start();
        //Asign the string that corresponds the row returned
        $row = $sql_result->fetch(5);
        $_SESSION['id_user']=$row->id_user;
        //Redirect to the user's page
        header("Location:./php/user.php");
   }else{
        //Print message and redirect to the index.php
        echo "<script>
                alert('User or password incorrect');

            </script>";
    }
}

function signup(){

    $con = conectDatabase();
    //Get the values
    $name=$_POST['name'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $user=$_POST['username'];
    $password=$_POST['password'];
    //Encryp the password with the sha1;
    $pass_encrypted= sha1($password);

    $sql_user="SELECT id_user from Users where username=:username";
    //The query return the id_user
    $result= $con->prepare($sql_user);
    $result->execute(array(':username' => $user));
    //Count the rows of the returned query
    $rows = $result->rowCount();

    //If the num rows isnt 0 means that the username exists in the database
    if($rows>0){
        //Print a message and redirect to index.php
        echo "<script>
        alert('User entered already exists');
        </script>";

    //If the num rows is 0 means that the username not exists in the database
    }else{
        $sqlinsert= $con -> prepare("INSERT INTO Users (name,lastName,email,username,password) values (:name,:lastName,:email,:user,:password)");
        $sqlinsert->execute(array(':name' => $name,':lastName' => $lastName,':email' => $email,':user' => $user,':password' => $pass_encrypted));

        //If the query was good do the scrpit in the echo
        header("Location: ../../index.php");

    }
}

?>
