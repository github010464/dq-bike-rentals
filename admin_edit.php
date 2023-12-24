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
    if(isset($_POST['admin_edit_btn'])){
        $id=$_POST['id'];
        $name = ucwords(trim($_POST['name']));
        $email = trim($_POST['email']);
        $user_type = trim($_POST['user_type']);
        $status = trim($_POST['status']);                
        
        // INSERT DATA USING NAMED PARAMETER

        // UPDATE INTO users
        $update = "UPDATE users SET name=:name,email=:email,user_type=:user_type,status=:status WHERE id=:id";
            $stmt = $pdo->prepare($update);
            $stmt->execute(['id'=>$id,'name'=>$name,'email'=>$email,'user_type'=>$user_type,'status'=>$status]);

        echo '
            <script>
                Swal.fire({
                    title: "Edit Successful",
                    text: "One record updated !",
                    icon: "success"
                }).then(function() {
                    window.location = "admin.php";
                    });                      
            </script>                
        ';                           
        exit();
    }
        
    ?>

    <?php include 'includes/footer.php'; ?>
