<?php

if (isset($_POST["round_win_by"]) && isset($_POST["round_no"])){
  session_start();
  if ($_POST["round_win_by"]==1) {
    $_SESSION["total_rounds_win_by_1"]=2;
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
    #next_round_form{
      position: absolute;
      width: 100px;
      top: 40%;
      left: 45%;
      visibility: hidden;
    }
  </style>

</head>

<body class="  bg-dark">
<?php require('./components/navbar.php'); ?>
  
<div class="container-fluid">

<div id="lsc_app" class="row">

  <!-- Start Section Header Bar -->
  <!-- <section id="lsc_header_bar" class="col-12">
    <div class="row lsc_page_title_row">
      <div class="col-2">
        <i class="fa fa-chevron-left"></i>
      </div>
      <div class="col-8 lsc_page_title">
        Match Overview
      </div>
    </div>
  </section> -->
  <!-- End Section Header Bar -->

  <!-- Start Section Header -->
  <section id="lsc_header" class="col-12">
    <div class="row lsc_series_meta_row">
      <div class="col-12">
        <span class="lsc_series_meta_detail">Round 3 of 3</span>
        <span class="lsc_series_meta_title">UEFA Champions League</span>
      </div>
    </div>
    <div class="row lsc_match_meta_row mb-0">
      <div class="col-4 lsc_team_left">
        <img src="./images/player1.jpg" id="player1" class="lsc_team_icon player1 active" />
        <div class="lsc_team_stat">
          <ul>
            <li><?php echo $_SESSION['player_fullname']; ?> <br>(YOU)</li>
            <li class="score">Life <span name="player1_score" class="player1_score">600</span></li>
          </ul>
        </div>
      </div>
      <div class="col-4 lsc_match_score_meta">
        <span class="lsc_match_score"><?php echo $_SESSION["total_rounds_win_by_1"];?> - <?php echo 2-$_SESSION["total_rounds_win_by_1"];?></span>
        <!-- <span class="lsc_match_time">90 + 2'</span> -->
      </div>
      <div class="col-4 lsc_team_right">
        <img src="./images/player2.jpg" id="player2" class="lsc_team_icon player2" />
        <div class="lsc_team_stat">
          <ul>
            <li>Player 2 <br>(CPU)</li>
            <li class="score">Life <span name="player2_score" class="player2_score">600</span></li>
          </ul>
        </div>
      </div>
    </div>
   
    <div class="text-center inputDiv mb-5">
      <input type="text" readonly
      class="border-bottom-1 inputBox text-center"
        name="search">
        <button onclick="cut()" class="bg-transparent border-0 text-light">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
          </svg>
        </button>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="char_box col-12 col-sm-6 col-md-4 offset-sm-3 offset-md-4">
          <div class="row" id="btns_row">
            <!-- All the button comes here -->
          </div>
        </div>
      </div>

      <div class="row text-center mt-3" style="margin-bottom: 80px;">
        <div class="col">
          <button onclick="search()" class="btn btn-success">Submit</button>
          <button onclick="window.location.reload()" class="btn btn-danger">Shuffle</button>
        </div>
      </div>
    </div>
  </section>


  <section id="lsc_footer" class="col-12">
    <div class="row lsc_app_footer_row">
      <div class="col-12 lsc_footer_tabs px-5">
        <ul>
            <div class="alert alert-danger alert-dismissible fade show mt-2 d-none" id="alert" role="alert">
              <span id="damage_from"></span> gives damage of <span id="damage"></span> to <span id="damage_to"></span> 
            </div>
        </ul>
      </div>
    </div>
  </section>
  <!-- End Section Footer -->

</div>

</div>

<form action="./find_winner.php" id="next_round_form" method="post">
<input type="number" name="round_no" value="3" hidden>
<input type="number" hidden name="round_win_by" id="round_win_by">
<button type="submit" class="btn btn-primary">View Result</button>
</form>

  <script src="./index3.js"></script>

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