<?php 
    date_default_timezone_set("Asia/Manila");  
?>
<?php    
    session_start();
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/dbh.php';

    if(isset($_POST['add_btn'])){
        //BOOKINGS DATABASE        
        $name = ucwords(trim($_POST['name']));
        $email = trim($_POST['email']);
        $mobile = trim($_POST['mobile']);
        $address = ucwords(trim($_POST['address']));        
        $item_desc = ucwords(trim($_POST['item_desc']));        
        $id_presented = ucwords(trim($_POST['id_presented']));        
        $id_details = ucwords(trim($_POST['id_details']));        
        $date_now = new DateTime('now');
        $booking_date = $date_now->format('Y-m-d H:i');
        $due_date = $_POST['due_date'];
        $due_date = str_replace('T',' ',$due_date);
        $date_booked = new DateTime($booking_date);
        $date_due = new DateTime($due_date);
        $diff = $date_booked->diff($date_due);
        $days_duration = $diff->d;
                
        if($booking_date > $due_date){
            echo    '
                    <script>
                        Swal.fire({
                            title: "Error",
                            text: "Date range selection invalid.",
                            icon: "error"
                        }).then(function() {
                            window.location = "bookings.php";
                            });
                    </script>
                    ';
            exit();
        }

        if($days_duration == "0"){
            $duration = $days_duration;
        }elseif($days_duration == "1"){
            $duration = $days_duration." day";
        }else{
            $duration = $days_duration." days";
        }    
        
        // INSERT DATA USING NAMED PARAMETER

        // INSERT INTO bookings
        $bookings = "INSERT INTO bookings (name,email,mobile,address,item_desc,booking_date,due_date,duration) VALUES (:name,:email,:mobile,:address,:item_desc,:booking_date,:due_date,:duration)";
        $stmt = $pdo->prepare($bookings);
        $stmt->execute(['name'=>$name,'email'=>$email,'mobile'=>$mobile,'address'=>$address,'item_desc'=>$item_desc,'booking_date'=>$booking_date,'due_date'=>$due_date,'duration'=>$duration]);

        //INSERT INTO trans
        $trans = "INSERT INTO trans (uid,name,id_presented,id_details,due_date) VALUES (:uid,:name,:id_presented,:id_details,:due_date)";
        $stmt = $pdo->prepare($trans);
        $uid = $pdo->lastInsertId();
        $stmt->execute(['uid'=>$uid,'name'=>$name,'id_presented'=>$id_presented,'id_details'=>$id_details,'due_date'=>$due_date]);

        echo '
            <script>
                Swal.fire({
                    title: "Registration Successful",
                    text: "One record added !",
                    icon: "success"
                }).then(function() {
                    window.location = "bookings.php";
                    });                      
            </script>                
        ';                           
        exit();
    }
    
    ?>

    <?php include 'includes/footer.php'; ?>
