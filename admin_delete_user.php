<?php 
    date_default_timezone_set("Asia/Manila");  
?>
<?php    
    session_start();
    include 'includes/header.php';
    include 'includes/navbar_admin.php';
    include 'includes/dbh.php';
?>

<?php
    if(isset($_GET['deleteid'])){
        $id = trim($_GET['deleteid']);

        $delete = "DELETE  FROM users WHERE id = ?";
        $stmt = $pdo->prepare($delete);
        $stmt->execute([$id]);
        header('location: admin.php');
    }    
    // echo '
    //     <script>
    //         Swal.fire({
    //             title: "Delete Successful",
    //             text: "Selected record has been deleted !",
    //             icon: "success"
    //         }).then(function() {
    //             window.location = "admin.php";
    //             });                      
    //     </script>                
    //     ';                           
    //     exit();
?>

<?php include 'includes/footer.php'; ?>
