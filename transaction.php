<?php 
    date_default_timezone_set("Asia/Manila");  
?>
<?php
    session_start();
    $page_title = "DQ Motobike Rentals";
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/authentication.php';
    include 'includes/dbh.php'
?>

<div class="container-fluid">
    <h5 class="float-start mt-3">TRANSACTION LIST</h5>   
    <br/><br/>
    <hr>

    <table class="table table-striped table-sm" id="daTable" style="font-size:13px">
        <thead>
            <tr>
            <th>ID No.</th>
            <th>UID</th>
            <th>NAME</th>
            <th>ID PRESENTED</th>
            <th>ID DETAILS</th>
            <th>DUE DATE</th>
            <th>RENTAL FEE</th>
            <th>PAYMENT</th>
            <th>SERVICES</th>
            <th>STATUS</th>
            <th>PROCESS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM trans");

                // Fetch style = object
                while($row = $stmt->fetch()){
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->uid; ?></td>
                <td><?= $row->name; ?></td>
                <td><?= $row->id_presented; ?></td>
                <td><?= $row->id_details; ?></td>
                <td><?= $row->due_date; ?></td>
                <td><?= $row->rental_fee; ?></td>
                <td><?= $row->payment; ?></td>
                <td><?= $row->services; ?></td>
                <td><?= $row->status; ?></td>                
                <td>
                        <?php
                            if($row->status == "paid"){
                                echo '
                                    <div class="col-md-4">
                                    <a class="btn btn-secondary btn-sm done_btn disabled" data-bs-toggle="modal" data-bs-target="#paymentModal" name="payment">&nbsp;&nbsp;Done&nbsp;&nbsp;</a>
                                    </div>
                                    ';
                            }else{
                                echo '              
                                    <div class="col-md-4">
                                    <a class="btn btn-success btn-sm payment_btn mx-1" data-bs-toggle="modal" data-bs-target="#paymentModal" name="payment">Payment</a>
                                    </div>
                                    ';
                            }
                        ?>   
                </td>                      
            </tr>      
            <?php
                }                
            ?>
        </tbody>
    </table>
    
<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog py-4">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Process Payment Transaction</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="process_payment.php" method="POST">
            <div class="modal-body"> 
                <div class="form-group">
                    <label class="fw-bold mb-1">UID</label>
                    <input type="text" class="form-control" name="uid" id="uid" >                        
                </div>
                <div class="form-group">
                    <label class="fw-bold mb-1">Name</label>
                    <input type="text" class="form-control" name="name" id="name" >                        
                <!-- </div>
                <div class="form-group">
                    <label class="fw-bold mb-1">ID Presented</label>
                    <input type="text" class="form-control" name="id_presented" id="id_presented" >                        
                </div>
                <div class="form-group">
                    <label class="fw-bold mb-1">ID Details</label>
                    <input type="text" class="form-control" name="id_details" id="id_details" >                        
                </div> -->
                <div class="form-group">
                    <label class="fw-bold mb-1">Due Date</label>
                    <input type="text" class="form-control" name="due_date" id="due_date" >                        
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label class="fw-bold mb-1">Rental Fee</label>
                        <input type="text" class="form-control" name="rental_fee" id="rental_fee" >                        
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">                        
                            <label class="fw-bold mb-1">Payment</label>
                            <input type="text" class="form-control" name="payment" id="payment" required>
                        </div>
                    </div>
                </div>
                <div class="form-group float-end my-3">                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="payment_btn" id="payment_id">Submit</button>        
                </div>
            </div>
        </form>
    </div>
</div>

</div>

<!-- JQuery Edit & Delete and DataTables--> 
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Process Payment Modal -->
<script>
    $(document).ready(function () {
        $('.payment_btn').on('click', function() {  
            $('#paymentModal').modal('show');
                        
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // console.log(data);
            // $('#id').val(data[0]); 
            $('#uid').val(data[1]); 
            $('#name').val(data[2]); 
            $('#id_presented').val(data[3]); 
            $('#id_details').val(data[4]); 
            $('#due_date').val(data[5]); 
            $('#rental_fee').val(data[6]);  
            $('#payment').val(data[7]); 
        });        
    });
</script>

<!-- DataTables -->
<script>    
    $(document).ready(function() {
        $('#daTable').DataTable({
            order: [[0, 'desc']]
        });
    } );    
</script>

<?php include('includes/footer.php'); ?>


