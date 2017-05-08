<?php
require_once 'connectvars.php';

    if (!isset($_POST['submit'])){
        echo 'Sorry, je zit op de verkeerde pagina.';
        echo 'Klik <a href="register.php"> hier</a> om je te registreren.';
        exit();
    }

$dbc = mysqli_connect(HOST, USER, PASS, DBNAME)
or die('Error connecting to MySQL server.');

$user = mysqli_real_escape_string($dbc, trim($_POST['user']));
$pwd = mysqli_real_escape_string($dbc, trim($_POST['pwd']));
$hashpwd = hash('sha512', $pwd);
$mail = mysqli_real_escape_string($dbc, trim($_POST['mail']));
$random_number = rand(1000,9999);
$hashcode = hash('sha512', $random_number);



$query = "INSERT INTO members
              VALUES (0, '$user', '$hashpwd',  '$mail', '$hashcode', 0)";
$result = mysqli_query($dbc, $query) or die('Error querying database.');


$to = $mail;
$subject = 'Verifieren account Oh Snap!';
$message = 'Hallo ' . $user . '! <br>' .
            ' En welkom op Oh Snap! Ter verificatie willen we u vragen ' .
            'om op de volgende link te klikken: ' .
            'http://www.20313.hosts.ma-cloud.nl/bewijzen/jaar%201.2/periode3/project/thewall/verify.php?mail=' . $mail . '&hashcode=' . $hashcode;


$from =  'Team Oh Snap!';

mail($to,$subject,$message,'Tot gauw: ' . $from . '<br>' . '<a href="login.php" class="lolol">Terug naar de site!</a>') or die('Error mailing.');
echo 'Er is een bevestigingsemail gestuurd naar ' . $to . '; ';


mysqli_close($dbc);

?>