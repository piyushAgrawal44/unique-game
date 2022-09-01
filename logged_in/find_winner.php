<?php

if (isset($_POST["round_win_by"]) && isset($_POST["round_no"])){
  require('../config.php');
  session_start();
  if ($_POST["round_win_by"]==1) {
            $_SESSION["total_rounds_win_by_1"]=3;
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="./index.css">
  <title>Words Battle</title>

  <style>
    #result{
        margin-top: 20%;
    }
  </style>

</head>

<body >
<?php require('./components/navbar.php'); ?>
  <div class="text-center" id="result" method="post">
    <?php
        if ($_SESSION["total_rounds_win_by_1"]>=2) {
          $stmt="INSERT INTO `user_winings` (user_id,win_or_lose) VALUES (?,?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"ii",$_SESSION['player_id'],$win_or_lose);
            $win_or_lose=1;
        
            $result=mysqli_stmt_execute($sql);
            if ($result) {
              // do nothing
            }
            ?>
             <h1 class="text-center text-light">Player 1 is the winner</h1>
            <?php
        } 
        else {
          $stmt="INSERT INTO `user_winings` (user_id,win_or_lose) VALUES (?,?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"ii",$_SESSION['player_id'],$win_or_lose);
            $win_or_lose=0;
        
            $result=mysqli_stmt_execute($sql);
            if ($result) {
            // do nothing
            }
            
            ?>
            <h1 class="text-center text-light">Player 2 is the winner</h1>
           <?php
        }

         
         $stmt="SELECT count(id) FROM `user_winings` WHERE id=(?)  AND win_or_lose=(?) AND deleted_at IS NULL";
         $sql=mysqli_prepare($conn, $stmt);
         mysqli_stmt_bind_param($sql,"ii",$_SESSION["player_id"],$win_or_lose);
         $win_or_lose=1;
         $result=mysqli_stmt_execute($sql);
         $data= mysqli_stmt_get_result($sql);
         $row=mysqli_fetch_array($data);
        $total_wins=$row[0];
        mysqli_stmt_close($sql);

        $stmt="SELECT id,level FROM `user_level` WHERE id=(?) AND deleted_at IS NULL LIMIT 1";
        $sql=mysqli_prepare($conn, $stmt);
        mysqli_stmt_bind_param($sql,"i",$_SESSION["player_id"]);
        $win_or_lose=1;
        $result=mysqli_stmt_execute($sql);
        $data= mysqli_stmt_get_result($sql);
        $row1=mysqli_fetch_array($data);

        mysqli_stmt_close($sql);

        if ($total_wins>5 && $row1['level']==1) {
          $stmt="UPDATE user_level SET level=(?) WHERE id=(?)";
          $sql=mysqli_prepare($conn, $stmt);
          mysqli_stmt_bind_param($sql,"ii",$level,$row1['id']);
          $level=2;
          $result=mysqli_stmt_execute($sql);
          if (!$result) {
            echo mysqli_error($conn);
            mysqli_stmt_close($sql);
          }
        }
        else if ($total_wins>10 && $row1['level']==2) {
          $stmt="UPDATE user_level SET level=(?) WHERE id=(?)";
          $sql=mysqli_prepare($conn, $stmt);
          mysqli_stmt_bind_param($sql,"ii",$level,$row1['id']);
          $level=3;
          $result=mysqli_stmt_execute($sql);
          if (!$result) {
            echo mysqli_error($conn);
            mysqli_stmt_close($sql);
          }
        }


    
    ?>
    <a href="./index.php">Play Again <?php echo $total_wins; ?></a>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>