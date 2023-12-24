<?php    
    date_default_timezone_set("Asia/Manila");  

    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/dbh.php';
?>
<?php
        if(isset($_POST['return_items_btn'])){
            //UPDATE bookings DATABASE
            $id = $_POST['uid'];
            $status = 'closed';

            $update = "UPDATE bookings SET status = :status WHERE id = :id";
            $stmt =  $pdo->prepare($update);
            $stmt->execute(['status' => $status, 'id' => $id]); 

            //UPDATE trans
            $uid = $_POST['uid'];
            $name = $_POST['name'];
            $due_date = $_POST['due_date'];
            $date_returned = $_POST['date_returned'];
            $excess_hr = $_POST['excess_hr'];
            $penalty = $_POST['penalty'];
            $payment = $_POST['payment'];
            $status = $_POST['status'];  
 
            if($due_date > $date_returned){
                echo '
                        <script>
                            Swal.fire({
                                title: "Process Return Error",
                                text: "Items not due for return!",
                                icon: "error"
                            }).then(function() {
                                window.location = "return_items.php";
                                });                      
                        </script>                
                    ';                           
                    exit();
            }else{
                //UPDATE return_items
                $update = "UPDATE return_items SET uid=:uid,name=:name,due_date=:due_date,date_returned=:date_returned,excess_hr=:excess_hr,penalty=:penalty,payment=:payment,status=:status WHERE uid=:uid";                
                $stmt = $pdo->prepare($update);

                if($penalty == $payment){   
                    $status = 'closed';                 
                    $stmt->execute(['uid'=>$uid,'name'=>$name,'due_date'=>$due_date,'date_returned'=>$date_returned,'excess_hr'=>$excess_hr,'penalty'=>$penalty,'payment'=>$payment,'status'=>$status]);
                    
                    header('location: return_items.php');
                }else{
                    echo '
                        <script>
                            Swal.fire({
                                title: "Process Return Denied",
                                text: "Penalty and payment does not match!",
                                icon: "error"
                            }).then(function() {
                                window.location = "return_items.php";
                                });                      
                        </script>                
                    ';                           
                    exit();
                }
            }
             
        }

         
        
?>    
<?php include 'includes/footer.php'; ?>
