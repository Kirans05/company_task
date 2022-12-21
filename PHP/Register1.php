<?php
$servername = "database-1.cofj5augd608.ap-northeast-1.rds.amazonaws.com";
// $servername = "localhost";
$name = "root";
$password1 = "qwertyuiop";
$port = 3306;

// $email = $password = "";
// $emailErr = $passwordErr = $mainErr = "";

$conn = new mysqli($servername, $name, $password1, "userdata", $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = trim($_REQUEST["email"]);
$password = trim($_REQUEST["password"]);
$name = trim($_REQUEST["name"]);

// Check if username is empty

$sql = "SELECT email FROM user_table WHERE email=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);

    // Set the value of param username
    $param_email = $email;

    // Try to execute this statement
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            echo "This username is already taken";
        } else {
            $sql = "INSERT INTO user_table (email,password) VALUES(?,?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

                // $param_name = $name;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                if (mysqli_stmt_execute($stmt)) {
                    // header("location:Login.php");
                    echo "user Created";
                } else {
                    echo "something went wrong";
                }
            }
        }
    } else {
        echo "Something went wrong";
    }
}
mysqli_stmt_close($stmt);



?>
