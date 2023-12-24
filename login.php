<link rel="stylesheet" href="css/style.css">

<?php
    session_start();
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbh.php'
?>

<?php
    if(isset($_POST['login_btn'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = :email && password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email,'password' => $password]);
        $row = $stmt->fetch();
       
        $count = $stmt->rowCount(); 
         
        if($count > 0)  
        {           
            $_SESSION['authenticated_user'] = TRUE;

            if($row->user_type == 'admin'){
                $_SESSION['admin'] = $row->user_type;
                header('location: admin.php');
                exit();
            }
            if($row->user_type == 'user' && $row->status == 'active'){
                $_SESSION['user'] = $row->user_type;
                // echo $_SESSION['user'];
                header('location: bookings.php');
                exit();
            }
            if($row->user_type == 'user' && $row->status == 'inactive'){     
                echo '
                    <script>
                        Swal.fire({
                            title: "Account Inactive",
                            text: "Please contact administrator for account activation.",
                            icon: "warning"
                        }).then(function() {
                            window.location = "index.php";
                            });                      
                    </script>                
                    ';                           
                    exit();                
            }
        }else{
            echo '
                <script>
                    Swal.fire({
                        title: "Account Invalid",
                        text: "Username and password not found in database.",
                        icon: "warning"
                    }).then(function() {
                        window.location = "index.php";
                        });                      
                </script>                
                ';                           
                exit();
        }
    }
?>

<?php include 'includes/footer.php' ?>
