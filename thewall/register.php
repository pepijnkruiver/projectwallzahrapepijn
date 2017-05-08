<!DOCTYPE html>
<html>
    <head>
        <title>
            Register
        </title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <nav id="nav">
        <ul class="knopjes">
            <li><a href="index.php">Wall</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Create Account</a></li>
            <li><a href="out.php">Log out</a></li>
        </ul>
    </nav>
    <div class="inhoud">
        <h2 style=text-align:center>Account Aanmaken</h2>
    <form action="processregister.php" method="post">
        <label>Username:</label> <input type="text" name="user"/><br>
        <label>E-mail:</label> <input type="text" name="mail"/><br>
        <label>Password:</label> <input type="password" name="pwd"/><br>
        <label>Password herhalen:</label> <input type="password" name="herhaalpwd"/><br>
        
    <label></label> <input type="submit" name="submit"/>
    
    </form>
    
    </div>
    </body>
</html>