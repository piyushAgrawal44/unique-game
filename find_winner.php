<?php

if (isset($_POST["round_win_by"]) && isset($_POST["round_no"])){
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
  <title>The Game</title>

  <style>
    #result {
      margin-top: 17%;
    }
  </style>

</head>

<body class="p-sm-5 bg-dark">
<?php require('./components/navbar.php'); ?>
  <div class="text-center" id="result" method="post">
    <?php
        if ($_SESSION["total_rounds_win_by_1"]>=2) {
            ?>
          <h1 class="text-center text-light">Player 1 is the winner</h1>
    <?php
        } else {
            ?>
    <h1 class="text-center text-light">Player 2 is the winner</h1>
    <?php
        }
        
    
    ?>
    <a href="./index.php" style="font-size: 16px;">Play Again</a>
    <br>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Save Your Progress
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please fill the details to save your progress.</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="text-start p-sm-2" action="./save_progress.php" method="post">
          <input type="number" hidden  name="win_or_lose" 
          value="<?php echo $_SESSION['total_rounds_win_by_1']>=2?'1':'0'; ?>">
          <div class="modal-body">
              <h5></h5>
              <div class="mb-3">
                <!-- <label for="exampleInputEmail1" class="form-label">Your Name</label> -->
                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" aria-describedby="nameHelp">
                <div id="emailHelp" class="form-text">Please enter your full name.</div>
              </div>
              <div class="mb-3">
                <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your Email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                <input type="password" class="form-control" placeholder="Create Password" name="password" id="exampleInputPassword1">
                <div id="passwordHelp" class="form-text">We recommend, your should choose minmun 8 digit password</div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php 
  $_SESSION["total_rounds_win_by_1"]=0;
?>

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