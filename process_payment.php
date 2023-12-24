<?php    
    session_start();
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/dbh.php';

    if(isset($_POST['payment_btn'])){
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        // $item_desc = $_POST['item_desc'];
        $due_date = $_POST['due_date'];
        $rental_fee = $_POST['rental_fee'];
        $payment = $_POST['payment'];
        $services = 'served';
        $status = 'paid';
        
        if($rental_fee != $payment){
            echo '
                <script>
                    Swal.fire({
                        title: "Process Payment Denied",
                        text: "Rental fee and payment does not match!",
                        icon: "error"
                    }).then(function() {
                        window.location = "transaction.php";
                        });                   
                </script>                
            ';  
        }else{            

            //UPDATE trans DATABASE
            $update = "UPDATE trans SET name=:name,rental_fee=:rental_fee,payment=:payment,services=:services,status=:status WHERE uid=:uid";
            $stmt = $pdo->prepare($update);
            $stmt->execute(['uid'=>$uid,'name'=>$name,'rental_fee'=>$rental_fee,'payment'=>$payment,'services'=>$services,'status'=>$status]);

            //INSERT return items DATABASE
            $return = "INSERT INTO return_items (uid,name,due_date) VALUES (:uid,:name,:due_date)";
            $stmt = $pdo->prepare($return);
            $stmt->execute(['uid'=>$uid,'name'=>$name,'due_date'=>$due_date]);

            header('location: transaction.php');
        }
    }    
?>
<?php include 'includes/footer.php'; ?>
