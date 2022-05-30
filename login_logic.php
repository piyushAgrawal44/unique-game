<?php

include("./config.php");
session_start();
if ($_POST["email"]) {
    
            // $stmt="SELECT id,name,email,password,verified FROM `users` WHERE email=(?) AND is_admin=(?) LIMIT 1";
            $stmt="SELECT id,name,email FROM `users` WHERE email=(?) AND password=(?) AND deleted_at IS NULL LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);

            //binding the parameters to prepard statement
            // $pass=$_POST["password"];
           
            // mysqli_stmt_bind_param($sql,"si",$_POST["email"],$is_admin);
            mysqli_stmt_bind_param($sql,"ss",$_POST["email"],$_POST["password"]);
            $result=mysqli_stmt_execute($sql);
            $data= mysqli_stmt_get_result($sql);
            $row=mysqli_fetch_array($data);
            if (!empty($row['id'])){
                
                $logged=true;
                mysqli_stmt_close($sql);
                mysqli_close($conn);
                
                
                $_SESSION["loggedin"]=$logged;
                $_SESSION["player_id"]=$row["id"];
                $_SESSION["player_email"]=$row["email"];
                $_SESSION["player_fullname"]=$row["name"];
                
                echo "<script>
                   window.location.href='./logged_in/index.php';
                </script>";
            }
            else {
                mysqli_stmt_close($sql);
                mysqli_close($conn);
                echo "<script>alert('Either email or password is wrong.');
                window.location.href='./login.php';
                </script>";
            }
                
} 
else {
    mysqli_close($conn);
    echo "<script>alert('Sorry something went wrong');
    window.location.href='./login.php';
          </script>";
}

?>