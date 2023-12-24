<?php    
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/dbh.php';
?>
<?php
    if(isset($_POST['import_btn'])){
        if(isset($_POST['id'])){
            $id = trim($_POST['id']);
            
            $sql = "SELECT * FROM bookings WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $row = $stmt->fetch();  

            if($row){                
                $status = $row->status;
                if($status == 'cancelled'){
                    //INSERT INTO cancel TABLE
                    $transfer = "INSERT INTO cancel SELECT * FROM bookings WHERE id=:id";
                    $stmt = $pdo->prepare($transfer);
                    $stmt->execute(['id'=>$id]);

                    //DELETE bookings TABLE
                    $delete = "DELETE FROM bookings WHERE id=:id";
                    $stmt = $pdo->prepare($delete);
                    $stmt->execute(['id'=>$id]);
                
                    header('location: bookings.php');

                }elseif($status == 'closed'){
                    //INSERT INTO closed TABLE
                    $transfer = "INSERT INTO close SELECT * FROM bookings WHERE id=:id";
                    $stmt = $pdo->prepare($transfer);
                    $stmt->execute(['id'=>$id]);

                    //DELETE bookings TABLE
                    $delete = "DELETE FROM bookings WHERE id=:id";
                    $stmt = $pdo->prepare($delete);
                    $stmt->execute(['id'=>$id]);
                
                    header('location: bookings.php');
                }else{
                    echo '
                        <script>
                            Swal.fire({
                                title: "Import Error",
                                text: "Unable to import this record !",
                                icon: "error"
                            }).then(function() {
                                window.location = "bookings.php";
                                });                      
                        </script>                
                        ';                           
                        exit();
                }       
            }else{
                echo '
                <script>
                    Swal.fire({
                        title: "Invalid Input",
                        text: "ID No. not found !",
                        icon: "error"
                    }).then(function() {
                        window.location = "bookings.php";
                        });                      
                </script>                
                ';                           
                exit();
            }
        }     
    }
?>

<?php include 'includes/footer.php'; ?>
