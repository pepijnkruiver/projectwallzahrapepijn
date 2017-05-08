        <?php

        require_once 'connectvars.php';
        $dbc = mysqli_connect(HOST, USER, PASS, DBNAME)         or die('Error connecting to MySQL server.');

        $mail = mysqli_real_escape_string($dbc, trim($_GET['mail']));
        $hashcode = mysqli_real_escape_string($dbc, trim($_GET['hashcode']));


        $query = "SELECT * FROM members
                      WHERE mail='$mail' AND hashcode='$hashcode'";
        $result = mysqli_query($dbc, $query) or die('Error querying for user.');

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $id = $row['id'];
            $query = "UPDATE members SET status=1 WHERE id=$id";
            $result = mysqli_query($dbc, $query) or die ('Error updating');
            echo '<br>Bedankt, je inschrijving is compleet!';
        }else{
            echo 'er klopt iets niet';
        }

        mysqli_close($dbc);


        ?>