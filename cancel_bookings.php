<?php    
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/dbh.php';

    if(isset($_POST['cancel_btn'])){
        $id = trim($_POST['id']);        
        $status = trim('cancelled'); 

        // UPDATE bookings DATABASE
        $update = "UPDATE bookings SET id=:id,status=:status WHERE id=:id";
        $stmt = $pdo->prepare($update);
        $stmt->execute(['id'=>$id,'status'=>$status]);
               
        $select = $pdo->query("SELECT * FROM trans"); //PDO query
        $row = $select->fetch();
        $id = $row->id;

        // DELETE trans TABLE
        $trans = "DELETE FROM trans WHERE id=:id";
        $stmt = $pdo->prepare($trans);
        $stmt->execute(['id'=>$id]);

        header('location: bookings.php');
    }
?>
<?php include 'includes/footer.php'; ?>
