<?php

$servername = "localhost";
$name = "root";
$password1 = "";
// $password1 = "qwertyuiop";
$port = 3306;

$email = $password = "";
// $emailErr = $passwordErr = $mainErr = "";

$conn = new mysqli($servername, $name, $password1, "userdata");
$email = $password = "";

     $redis = new Redis();
   //connect with server and port
     $redis->connect('localhost', 6379);

if($conn->connect_error){
    // echo $conn->connect_error;
    die("connection failed".$conn->connect_error);
}
else{
}


$fetch = trim($_REQUEST["fetch"]);

if ($fetch == "false") {
    $email = trim($_REQUEST["email"]);

    $manager = new MongoDB\Driver\Manager('mongodb+srv://kiran:qLaMEqPoveArDHDk@cluster0.zgq8i0e.mongodb.net/userdata');

    // var_dump($manager);
    $filter = ['email' => $email];
    $options = [
        'projection' => ['_id' => 0],
    ];
    $query = new MongoDB\Driver\Query($filter, $options);
    $rows = $manager->executeQuery('userdata.table', $query);
    // var_dump($rows);
    // var_dump($rows);
    foreach ($rows as $r) {
        $s = json_encode($r);
        echo $s;
    }

    // $sql = "SELECT id,email,password,name,city,phone,pincode FROM user_table where email = ?";

    // $stmt = mysqli_prepare($conn,$sql);

    // if($stmt){
    //     mysqli_stmt_bind_param($stmt,"s",$param_email);

    //     $param_email = $email;

    //     if(mysqli_stmt_execute($stmt)){
    //         mysqli_stmt_store_result($stmt);
    //         if(mysqli_stmt_num_rows($stmt) == 1){
    //             mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $name, $city, $phone, $pincode);
    //             if(mysqli_stmt_fetch($stmt)){
    //                 // if(password_verify($password, $hashed_password)){
    //                     $usersArr = array("name" => $name, "id" => $id, "email" => $email,"city" => $city, "phone" => $phone, "pincode" => $pincode);
    //                     $encoded = json_encode($usersArr);
    //                     echo $encoded;
    //                 // }
    //             }
    //         }
    //     }
    // }
}
if ($fetch == "true") {
    $name = trim($_REQUEST["name"]);
    $city = trim($_REQUEST["city"]);
    $phone = trim($_REQUEST["phone"]);
    $pincode = trim($_REQUEST["pincode"]);
    $email = trim($_REQUEST["email"]);
    $userExist = trim($_REQUEST["userExist"]);

    if ($userExist == "true") {
        $bulk = new MongoDB\Driver\BulkWrite;

        $bulk->update(['email' => $email], ['$set' => ['name' => $name, 'city' => $city, "phone" => $phone, "pincode" => $pincode]], ['multi' => false, 'upsert' => false]);

        $manager = new MongoDB\Driver\Manager('mongodb+srv://kiran:qLaMEqPoveArDHDk@cluster0.zgq8i0e.mongodb.net/userdata');

        $result = $manager->executeBulkWrite('userdata.table', $bulk);
        // var_dump($result);
        echo "old Record Updated";
    }

    if ($userExist == "false") {
        $bulk = new MongoDB\Driver\BulkWrite;
        $doc = [

            'name' => $GLOBALS['name'],

            'email' => $GLOBALS['email'],

            'city' => $GLOBALS['city'],

            'phone' => $GLOBALS['phone'],

            'pincode' => $GLOBALS['pincode'],

        ];

        $bulk->insert($doc);

        $manager = new MongoDB\Driver\Manager('mongodb+srv://kiran:qLaMEqPoveArDHDk@cluster0.zgq8i0e.mongodb.net/userdata');

        $result = $manager->executeBulkWrite('userdata.table', $bulk);

        // var_dump($result);
        echo "New Record Inserted";
    }

    // mysqli_select_db($conn, "userdata");

    // // this is for posting data or updating user Data

    //     $sql = "UPDATE user_table SET name=?, city=?, phone=?, pincode=? where email=?";

    //     $stmt = mysqli_prepare($conn, $sql);

    //     if($stmt){
    //         mysqli_stmt_bind_param($stmt,"ssiis",$param_name, $param_city, $param_phone, $param_pincode, $param_email);

    //         $param_name = $name;
    //         $param_city = $city;
    //         $param_phone = $phone;
    //         $param_pincode = $pincode;
    //         $param_email = $email;

    //         if(mysqli_stmt_execute($stmt)){
    //             mysqli_stmt_store_result($stmt);
    //             echo "updated";
    //         }
    //     }else{
    //         echo "something went wrong";
    //     }
}


?>