<!DOCTYPE html>
<html>
    <head>
        <title>
            Login
        </title>
    </head>
    <body>
    
    <?php
session_start();





if ( !  isset($_POST["user"]) || !isset($_POST["pwd"]) )
{
   die("je moet ingelogd zijn!");
}

$user=$_POST["user"];
$pwd=$_POST["pwd"];
$hashpwdcontroleer=hash("SHA512",$pwd);

require_once('connectvars.php');
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME)
or die('Error connecting to MySQL server.');

$query = "SELECT * FROM members WHERE hashpwd ='$hashpwdcontroleer' AND user ='$user'";
$result = mysqli_query($dbc,$query) or die('error querying.');

if ($result->num_rows > 0) {
   
    $_SESSION['login']= true;
    $_SESSION["user"]= $user;
    $_SESSION["actief"]= true;
    header ("location: index.php");
    
    function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

} else {
    
                function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
}
mysqli_close($dbc);
?>
    <p>Inlog gegevens kloppen niet, klik op 'terug' om opnieuw in te loggen</p>
    <input type="button" value="terug" onclick="window.location.href='login.php'" />
    </body>
</html>