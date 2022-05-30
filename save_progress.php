<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    require('./config.php');
    session_start();
    $stmt="SELECT id FROM `users` WHERE email=(?) and deleted_at IS NULL";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement

    mysqli_stmt_bind_param($sql,"s",$_POST["email"]);
    $result=mysqli_stmt_execute($sql);
    $data= mysqli_stmt_store_result($sql);
    $no_of_row=mysqli_stmt_num_rows($sql);

    if ($no_of_row>0){
       //   echo $no_of_row;
        mysqli_stmt_close($sql);
        echo "<script>alert('Sorry email already registered.');
        window.location.href='./find_winner.php';
        </script>";
    }
    else{
        mysqli_stmt_close($sql);
        $stmt="INSERT INTO `users` (name,email,password) VALUES (?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"sss",$_POST['name'],$_POST['email'],$_POST['password']);
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            // $code=uniqid('',true);
            
    
            mysqli_stmt_close($sql);

            $stmt="INSERT INTO `user_winings` (user_id,win_or_lose) VALUES (?,?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"ii",$_SESSION['player_id'],$win_or_lose);
            $win_or_lose=$_POST["win_or_lose"];
        
            $result=mysqli_stmt_execute($sql);
            if ($result) {
              // do nothing
            }
            mysqli_stmt_close($sql);
            $stmt="SELECT id,email,name FROM `users` WHERE email=(?) LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);
    
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"s",$_POST['email']);
    
            $result=mysqli_stmt_execute($sql);

            if ($result) {
                $data= mysqli_stmt_get_result($sql);
                while ($row= mysqli_fetch_array($data)) {
                    $_SESSION["player_id"]=$row["id"];
                    $_SESSION["player_email"]=$row["email"];
                    $_SESSION["player_fullname"]=$row["name"];
                }
                setcookie("player_id", $_SESSION["player_id"], time() + 6000*(3600), "/");
            //    echo $_SESSION["player_name"];
                echo "<script>
                            alert('Progress saved success');
                            window.location.href='./logged_in/index.php';
                    </script>";
            }
            else {
                echo mysqli_error($conn);
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="./find_winner.php"
                <script>';
            }
        } 
        
        else {
            echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
            window.location.href="./find_winner.php"
            <script>';
        }
    }
  } 
  else {
      echo '<script>
                  alert("Sothing went wrong. We are facing some technical issue. It will be resolved soon.")
                  window.location.href="./find_winner.php"
            <script>';
  }
}
?>