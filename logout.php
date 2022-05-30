<?php 

session_start();
session_unset();
session_destroy();
setcookie("player_id", $_SESSION["player_id"], time() - 1, "/");
header("location: ./login.php");
exit;

?>