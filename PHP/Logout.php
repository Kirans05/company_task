<?php
    $redis = new Redis();
     $redis->connect('localhost', 6379);
    $redis->del("useremail");
    $redis->del("loggedinAt");
    echo "hi <br />";
    echo "<script>document.write(localStorage.removeItem('userEmailId'))</script>";
    // echo "<script> location.href='Login.php'; </script>";
        // exit;
?>