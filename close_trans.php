<?php
    session_start();
    date_default_timezone_set("Asia/Manila");  
    $page_title = "DQ Motobike Rentals";
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/authentication.php';
    include 'includes/dbh.php';

?>
<div class="container-fluid">
    <h5 class="float-start mt-3">LIST OF CLOSED TRANSACTION</h5>
         
    <br/><br/>
    <hr>

    <table class="table table-striped table-sm" id="daTable" style="font-size:13px">
        <thead>
            <tr>
            <th>ID No.</th>
            <th>NAME</th>
            <th>ITEM DESC</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>ADDRESS</th>
            <th>BOOKING DATE</th>
            <th>DUE DATE</th>
            <th>DURATION</th>
            <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM close");

                // Fetch style = object
                while($row = $stmt->fetch()){
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->name; ?></td>
                <td><?= $row->email; ?></td>
                <td><?= $row->mobile; ?></td>
                <td><?= $row->address; ?></td>
                <td><?= $row->item_desc; ?></td>
                <td><?= $row->booking_date; ?></td>
                <td><?= $row->due_date; ?></td>
                <td><?= $row->duration; ?></td>
                <td><?= $row->status; ?></td>                
            </tr>      
            <?php
                }
            ?>
        </tbody>
    </table>    
</div>

<!-- JQuery Edit & Delete and DataTables--> 
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- DataTables -->
<script>    
    $(document).ready(function() {
        $('#daTable').DataTable({
            order: [[0, 'desc']]
        });
    } );    
</script>

<?php include('includes/footer.php'); ?>


