<div class="alert text-center">
<?php
    session_start();   
    if(isset($_SESSION['authenticated_user'])){
        unset($_SESSION['authenticated_user']);
        unset($_SESSION['admin']);
        unset($_SESSION['user']);
        unset($_SESSION['message']);
        // $_SESSION['message'] = "You had successfully logout!";
        // header('Location: index.php');    
        echo "<script>window.close();</script>"; 
    }
?>
</div>

