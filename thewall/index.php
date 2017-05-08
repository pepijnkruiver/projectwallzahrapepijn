<!DOCTYPE html>
<html>

<head>
    <title>
        The Wall
    </title>
    <link rel="stylesheet" href="style.css">
    <!--<link rel="stylesheet" href="css/masonry-docs.css">-->
    <link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>




</head>

<body>
    
    
<?php

?>
    
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
        <div class="sorteer">
            
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <select name="sorteermenu">
                <option value="date_asc">datum oplopend</option>
                <option value="date_desc">datum aflopend</option>
                <option value="descr_asc">beschrijving aflopend</option>
                <option value="descr_desc">beschrijving oplopend</option>    
            
            </select>
        <input type="submit" name="submit_sort"  value="sorteren">
        </form>
<?php
    $sorttype='id';
    $order ='DESC';
            if (isset($_POST['submit_sort'])){
                switch ($_POST['sorteermenu']){
                    case'date_asc': $sorttype ='date';
                        $order ='ASC';
                        break;
                    case'date_desc': $sorttype ='date';
                        $order ='DESC';
                        break;
                    case'descr_asc': $sorttype ='description';
                        $order ='DESC';
                        break;
                    case'descr_desc': $sorttype ='description';
                        $order ='ASC';
                        break;
            }
                
            }    
            
?>
            
            
    
    </div>
        
        <div class="zoeken">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="text" name="searchterm"  placeholder="zoekterm"> 
            <input type="submit" name="submit_search"  value="zoeken">
        </form>
            
<?php

require_once('connectvars.php');
$dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error 2!');

            if (isset($_POST['submit_search'])){
                $searchterm = mysqli_real_escape_string($dbc, trim($_POST['searchterm']));
                $searchterm = '%' . $searchterm . '%';
            }
            else {
                $searchterm = '%';
            }
            
?>
        
        
        </div>
        <div class="images">
            
            
     <?php
    require_once('connectvars.php');
    $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error 2!');

    $query = "SELECT * FROM image
    WHERE title LIKE '$searchterm' 
    ORDER BY $sorttype $order";

 $result = mysqli_query($dbc,$query) or die ('Error querying');
    while ($row = mysqli_fetch_array($result)){
        $id = $row['id'];
        $target = $row['target'];
        $title = $row['title'];
        $date = $row['date'];
        $username = $row['username'];
        $description = $row['description'];

      echo '
        
<!-- Modal -->
<div id="'. $id . '" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <img class="images2 btn-lg" src="' . $target . '">
      </div>
      <div class="modal-foot">
      <div class="modal-beschrijving">  <p><p><b>Title:</b> '. $title .'</p><p><b>Description:</b> '. $description .'</p><p><b>Date:</b> '. $date .'</p><p><b>Uploaded By:</b> '. $username .'</p></p></div>
        
      </div>
    </div>

  </div>
</div>
			 <img class="images btn-lg" width="300px" height="300px" src="' . $target . '" alt="Random image" align="middle" data-toggle="modal" data-target="#' . $id .' ""/>
                    ';
      //echo '<div class="beschrijving">';

    }

    mysqli_close($dbc);
     ?>


      </div>      
        </div>



   
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>