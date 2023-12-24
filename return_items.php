<?php 
    date_default_timezone_set("Asia/Manila");  
?>
<?php
    session_start();
    $page_title = "DQ Motobike Rentals";
    include 'includes/header.php';
    include 'includes/navbar_user.php';
    include 'includes/authentication.php';
    include 'includes/dbh.php';
?>
<div class="container-fluid">    
    <h5 class="float-start mt-3">PROCESS RETURN ITEMS</h5>
    <br><br>
    <hr>  

    <table class="table table-striped table-sm" id="daTable" style="font-size:13px">
        <thead>
            <tr>
            <th>ID No.</th>
            <th>UID</th>
            <th>NAME</th>
            <!-- <th>ITEM DESC</th> -->
            <th>DUE DATE</th>
            <th>DATE RETURNED</th>
            <th>EXCESS HR</th>
            <th>PENALTY</th>
            <th>PAYMENT</th>
            <th>STATUS</th>
            <th>PROCESS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM return_items");

                // Fetch style = object
                while($row = $stmt->fetch()){                    
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->uid; ?></td>
                <td><?= $row->name; ?></td>
                <!-- <td><?= $row->item_desc; ?></td> -->
                <td><?= $row->due_date; ?></td>
                <td><?= $row->date_returned; ?></td>
                <td><?= $row->excess_hr; ?></td>
                <td><?= $row->penalty; ?></td>
                <td><?= $row->payment; ?></td>
                <td><?= $row->status; ?></td>                
                <td>
                    <div class="row">           
                        <?php
                            if($row->status == "closed"){
                                echo '
                                    <div class="col-md-4">
                                    <a class="btn btn-secondary btn-sm return_btn mx-1 disabled" data-bs-toggle="modal" data-bs-target="#returnModal" id="return_id">&nbsp;&nbsp;Done&nbsp;&nbsp;</a>
                                    </div> 
                                    ';
                            }else{
                                    echo '
                                    <div class="col-md-4">
                                    <a class="btn btn-warning btn-sm return_btn mx-1" data-bs-toggle="modal" data-bs-target="#returnModal" id="return_id">&nbsp;Return&nbsp;</a>
                                    </div>
                                    ';
                            }
                        ?>
                    </div>
                </td>                      
            </tr>      
            <?php
                }                
            ?>
        </tbody>
    </table>
</div>

<!-- Return Items Modal -->
<div class="modal fade py-5" id="returnModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Process Return Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>      
        <form action="process_return.php" method="POST">
            <div class="modal-body">
                    <div class="row">                                    
                        <div class="col">                      
                            <div class="form-group">
                            <label class="fw-bold">UID</label>
                            <input type="text" class="form-control" name="uid" id="uid" required>
                            </div>
                        </div> 
                        <div class="col">                      
                            <div class="form-group">
                            <label class="fw-bold">Status</label>
                            <input type="text" class="form-control" name="status" id="status" required>
                            </div>
                        </div> 
                    </div>                             
                    <div class="col">
                        <div class="form-group">
                        <label class="fw-bold">Name</label>
                        <input type="text" class="form-control" name="name" id="name"  required>
                        </div>
                    </div>       
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="fw-bold">Due Date</label>
                                <input type="text" class="form-control" name="due_date" id="due_date" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label class="fw-bold">Date Returned</label>
                            <input type="text" class="form-control" name="date_returned" id="date_returned" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">                    
                            <div class="form-group">
                            <label class="fw-bold">Excess Hour</label>
                            <input type="text" class="form-control" name="excess_hr" id="excess_hr" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label class="fw-bold">Penalty</label>
                            <input type="text" class="form-control" name="penalty" id="penalty" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label class="fw-bold">Payment</label>
                            <input type="text" class="form-control" name="payment" id="payment" required>
                            </div>            
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="return_items_btn" id="return_items_id">Submit</button>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- JQuery Edit & Delete and DataTables--> 
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- JQuery Script Retun Modal--> 
<script>
    $(document).ready(function () {        
        $('.return_btn').on('click', function(event) {  
            event.preventDefault();            

            $('#returnModal').modal('show');
            
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // console.log(data);
            // $('#id').val(data[0]); 
            $('#uid').val(data[1]); 
            $('#name').val(data[2]); 
            // $('#item_desc').val(data[3]); 
            $('#due_date').val(data[3]); 
            
            //SOLVE FOR TIME            
            let date1 = new Date(data[3]);
            let date2 = new Date($.now());        
            let diff =  date2.getTime() - date1.getTime();
            let hh = Math.floor(diff / 1000 / 60 / 60);// hour difference
            // let days = diff/1000/60/60/24;

            let diffTime = Math.abs(date2 - date1);
            let days = (Math.ceil(diffTime / (1000 * 60 * 60 * 24)) - 1);

            let d = new Date($.now());
            let dateReturn = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();

            $('#date_returned').val(dateReturn); 
            if (date1 > date2){
                $('#excess_hr,#penalty,#payment').css({ 'color': 'gray',});

                let txt = 'n.a.';
                $('#excess_hr').val(txt);
                $('#penalty').val(txt);
                $('#payment').val(txt);
            }else{
                $('#excess_hr').val(hh);
                $('#penalty').val(hh*100);
                $('#payment').val(data[7]);
            }
            $('#status').val(data[8]);
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

<?php include 'includes/footer.php'; ?>
