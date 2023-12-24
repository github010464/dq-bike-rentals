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
    if(isset($_POST['admin_add_btn'])){
        $name = ucwords(trim($_POST['name']));
        $email = trim($_POST['email']);
        $password = $_POST['password'];
    }
    // INSERT INTO users
    $addUser = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password)";
    $stmt = $pdo->prepare($addUser);
    $stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password]);
    header('location: admin.php');
?>

<?php include 'includes/footer.php'; ?>
