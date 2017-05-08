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
        <h2 style=text-align:center>Upload</h2>
            <form method="post" enctype="multipart/form-data" action="upload.php">
<!--                <input type="hidden" name="MAX_FILE_SIZE" value="30000000">-->
                <label>Title:</label>
                <input type="text" name="title">
                <br>
                <label>Description:</label>
                <input type="text" name="description">
                <br>
                <label>Image:</label>
                <input type="file" name="image">
                <br>
                <label></label>
                <input type="submit" value="Upload image" name="submit">
            </form>

<?php
    require_once 'check.php';
    if(isset($_POST['submit'])){

        require_once('connectvars.php');
        $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error!');
        
        $user_check = $_SESSION['user'];
        $sql = mysqli_query($dbc, "SELECT user FROM members WHERE user='$user_check'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));

          $temp = $_FILES['image']['tmp_name'];
          $target = 'uploads/' . time() . $_FILES['image']['name'];
        
        if (!empty($description) && !empty($title)){
            if (move_uploaded_file($temp,$target)){
                $query = "INSERT INTO image VALUES (0,NOW(),'$description','$target','$user_check','$title')";
                $result = mysqli_query($dbc,$query) or die('error querying.');
                function Redirect($url, $permanent = false) {
                  header('Location: ' . $url, true, $permanent ? 301 : 302);
                  exit();
                }
                Redirect('index.php', false);
              } else{
              echo'<br>Mislukt.<br>';
              }
            echo 'werkt dit?';
        }


    }
?>


    </div>


</body>

</html>
