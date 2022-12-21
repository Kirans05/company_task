<?php

    $servername = "database-1.cofj5augd608.ap-northeast-1.rds.amazonaws.com";
    // $servername = "localhost";
    $name = "root";
    $password1 = "qwertyuiop";
    $port = 3306;

    $email = $password = "";
    // $emailErr = $passwordErr = $mainErr = "";

    $conn = new mysqli($servername, $name, $password1, "userdata", $port);

    //  $redis = new Redis();
   //connect with server and port
    //  $redis->connect('localhost', 6379);

    if($conn->connect_error){
        echo "not connected";
        // echo $conn->connect_error;
        die("connection failed".$conn->connect_error);
    }
    else{
        echo "connected";
    }

    // mysqli_select_db($conn, "userdata");

    // $email = trim($_REQUEST["email"]);
    // $password = trim($_REQUEST["password"]);
    // $sql = "SELECT id,email,password,name,city,phone,pincode FROM user_table where email = ?";
    $sql = "SELECT * FROM user_table";
    // $sql "SELECT * FROM user_table";

    $stmt = mysqli_prepare($conn,$sql);

    if($stmt){
        // mysqli_stmt_bind_param($stmt,"s",$param_email);

        // $param_email = $email;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $name, $city, $phone, $pincode);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        $usersArr = array("name" => $name, "id" => $id, "email" => $email,"city" => $city, "phone" => $phone, "pincode" => $pincode);
                        $encoded = json_encode($usersArr);
                        // $redis->set("useremail",$email);
                        // $redis->set("loggedinAt",date("l jS \of F Y h:i:s A"));
                        // session_start();
                        echo $encoded;
                        // $_SESSION['emailId'] = $email;
                        // echo "<script> location.href='Profile.php'; </script>";
                        //         exit;
                    }else{
                        echo "Incorrect Password";
                    }
                }
            }else{
                echo "User Not Found Please Register";
            }
            // mysqli_stmt_bind_result($stmt, $id, $email, $password);
            //     if(mysqli_stmt_fetch($stmt)){
            //         $usersArr = array( "id" => $id, "email" => $email, "password" => $password);
            //             $encoded = json_encode($usersArr);
            //             echo $encoded;
            //     }else{
            //         echo "no data";
            //     }
        }else{
            echo "somthing went wrong";
        }
    }else{
        echo "no statement";
    }



?>