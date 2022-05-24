<?php 
    include './php/services/sign.php';

    if(isset($_POST['login'])){
        login();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Login</title>
        <link rel="stylesheet" href="./css/sign.css"/>
    </head>
    <body>
        <header>
        <nav>
          <ul>
            <li><a href="./index.php">Contact me</a></li>
            <li><a href="https://github.com/joseng2709">Github</a></li>
          </ul>
        </nav>
        </header>

        <div class="login">
            <p class="sign">Login</p>
            <form class="form1" action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
                <input type="text" class="un" name="username_log" align="center" placeholder="Username" require/>
                <input type="password" class="pass" name="password_log" align="center" placeholder="Password" require/>
                <input type="submit" class="submit" name="login" value="Login"/>
            </form>

            <p class="text">New at ESP_Domotic? <a href="./php/services/signup.php">Sign up now</a></p>
        </div>
    </body>

</html>
