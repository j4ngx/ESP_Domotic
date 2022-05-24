<?php 
    include './sign.php';

    if(isset($_POST['signup'])){
        signup();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Sign up</title>
        <link rel="stylesheet" href="../../css/sign.css"/>
    </head>
    <body>
        <header>
        <nav>
          <ul>
            <li ><a href="./index.html">Contact me</a></li>
            <li ><a href="https://www.github.com">Github</a></li>
          </ul>
        </nav>
        </header>

        <div class="signup">
            <p class="sign" align="center">Sign up</p>
            <form class="form1" action="<?php $_SERVER["PHP_SELF"];?>" method="POST"> 
                <input type="text" class="un" name="name" placeholder="Name" required />
                <input type="text" class="un" name="lastName" placeholder="Last Name" required />
                <input type="email" class="un" name="email" placeholder="Email" required />
                <input type="text" class="un" name="username" placeholder="Username" required />
                <input type="password" class="pass" name="password" placeholder="Password" required />
                <input type="submit" class="submit" name="signup" value="Sign up"/>
            </form>

            <p class="text">Already have an account? <a href="../../index.php">Login now</a></p>

        </div>
    </body>

</html>
