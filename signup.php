<?php
    if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
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
            window.location.href='./login.php';
            </script>";
        }
        else{
            mysqli_stmt_close($sql);
            $stmt="INSERT INTO `users` (name,email,password) VALUES (?,?,?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"sss",$_POST['fullname'],$_POST['email'],$_POST['password']);
        
            $result=mysqli_stmt_execute($sql);
            if ($result) {
                // $code=uniqid('',true);
                
        
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
                //    echo $_SESSION["player_fullname"];
                    echo "<script>
                                window.location.href='./logged_in/index.php';
                        </script>";
                }
                else {
                    echo mysqli_error($conn);
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                    window.location.href="./login.php"
                    <script>';
                }
            } 
            
            else {
                echo mysqli_error($conn);
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="./login.php"
                <script>';
            }
        }
    } else {
        echo '<script>
                    window.location.href="./login.php"
            <script>';
    }
    



?>