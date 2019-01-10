<?php
 include "checklogin.php";
?>
<!DOCTYPE html>
 <html>
  <head>
   <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
    
  </head>
  <body>
        <button onclick="location.href='inquiry.php'"  class="inqbutton" name="inquiry">Inquiry</button>
        <div class="middle">
            <form method="POST" action="index.php" >
                <h1>Login</h1>
                    <div class="textbox">
                        <span class="glyphicon glyphicon-user"></span>
                        <input type="text" placeholder="Username" name="username" value="">
                    </div>
                    <div class="textbox">
                        <span class="glyphicon glyphicon-lock"></span>
                        <input type="password" placeholder="Password" name="password" value="">
                    </div>
                    <div>
                        <input type="checkbox" name="rememberme" value="1">Remember me
                    </div>
                    <button type="submit" class="button" name="submit">Submit</button>
            </form>
        </div>
  </body>
 </html>