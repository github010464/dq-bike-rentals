<?php  
    // session_start();

    if (!isset($_SESSION['authenticated_user']))
    { 
        $_SESSION['message'] = "<h1 style='padding-top:50px;color:red'>Unathorized Access !</h1>" . "<h6>Please contact administrator for proper authentication.</h6>";
        header('location: index.php');
        exit();
    }
?>