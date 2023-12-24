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
    <h5 class="float-start mt-3">BOOKING REGISTRATION LIST</h5>    
    <!-- Button trigger Add modal -->
    <button type="button" class="btn btn-sm btn-primary float-end mx-1 mt-3" data-bs-toggle="modal" data-bs-target="#addModal">
    ADD 
    </button> 
    <!-- Button trigger Import modal -->
    <button type="button" class="btn btn-sm btn-dark float-end mx-1 mt-3 import_btn" data-bs-toggle="modal" data-bs-target="#importModal">
    IMPORT 
    </button>   
    <br/><br/>
    <hr>

    <table class="table table-striped table-sm" id="daTable" style="font-size:13px">
        <thead>
            <tr>
            <th>ID No.</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>ADDRESS</th>
            <th>ITEM DESC</th>
            <th>BOOKING DATE</th>
            <th>DUE DATE</th>
            <th>DURATION</th>
            <th>STATUS</th>
            <th>PROCESS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM bookings");

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
                <td>
                    <div class="row">    
                        <?php
                            if($row->status == 'cancelled' || $row->status == 'closed'){
                                echo '
                                    <div class="col-md-4">
                                    <a class="btn btn-success btn-sm edit_btn mx-3 disabled" href="#" data-bs-toggle="modal" data-bs-target="#editModal">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                    </div>     
                                    
                                    <div class="col-md-4">
                                    <a class="btn btn-danger btn-sm btnCancel mx-3 disabled" data-bs-toggle="modal" data-bs-target="#cancelModal" name="cancel">Cancel</a>
                                    </div>
                                ';
                            }else{
                                echo '
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-sm edit_btn mx-3" href="#" data-bs-toggle="modal" data-bs-target="#editModal">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                </div>     
                                
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-sm btnCancel mx-3" data-bs-toggle="modal" data-bs-target="#cancelModal" name="cancel">Cancel</a>
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
    
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog py-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Bookings</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="fw-bold mb-1">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold mb-1">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold mb-1">Mobile No.</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" required pattern="^[0-9]{1,20}$" title="Numeric characters only.">
                        </div>
                        <div class="form-group">
                            <label class="fw-bold mb-1">Current Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                        <div class="form-group float-end mt-3 mb-3">                
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="update_btn">Update</button>        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                            <label class="fw-bold mb-1">Fullname</label>                
                            <input type="text" class="form-control" name="name" id="name" pattern="([ña-zA-Z]+\s){1,}([ña-zA-Z]+)" title="Fullname format: Niño Cañete">  
                            </div>
                        </div>
                        <div class="col">                               
                            <div class="form-group">
                                <label class="fw-bold mb-1">Mobile No.</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" pattern="[0-9]{11}" title="11 numeric characters only." required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                <label class="fw-bold mb-1">Email</label>
                                <input type="email" class="form-control" name="email" required>
                    </div>                                      
                    <div class="form-group">
                        <label class="fw-bold mb-1">Current Address</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>                                             
                    <div class="form-group">
                        <label class="fw-bold mb-1">Motorbike Item Description</label>
                        <input type="text" class="form-control" name="item_desc" id="item_desc" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">                        
                            <label class="fw-bold mb-1">ID Presented</label>
                            <input class="form-control" type="text" name="id_presented" id="id_presented" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">                        
                            <label class="fw-bold mb-1">ID Details</label>
                            <input class="form-control" type="text" name="id_details" id="id_details" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="fw-bold mb-1">Due Date</label>
                        <input class="form-control" type="datetime-local" name="due_date" id="due_date" required>
                    </div>
                    <div class="form-group float-end my-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="add_btn">Submit</button>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog py-3">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Cancel Bookings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="cancel_bookings.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="fs-5">Are you sure you want to cancel this bookings?</p>
                        <label class="fw-bold mb-1">ID No.</label>
                        <input type="text" class="form-control" name="id" id="id">                        
                    </div>
                    <div class="form-group float-end mt-3 mb-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="cancel_btn">&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</button>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog py-3">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Import Database Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="import.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="fw-bold mb-1">ID No.</label>
                        <input type="text" class="form-control" name="id" id="id" autofocus required>
                    </div>
                    <div class="form-group float-end mt-3 mb-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="import_btn">Submit</button>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JQuery Edit & Delete and DataTables--> 
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Local Script JQuery Edit Modal -->
<script>
    $(document).ready(function () {
        $('.edit_btn').on('click', function() {  
            $('#editModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#id').val(data[0]); 
            $('#name').val(data[1]); 
            $('#email').val(data[2]);  
            $('#mobile').val(data[3]); 
            $('#address').val(data[4]); 
            $('#booking_date').val(data[6]);
            $('#due_date').val(data[7]);
            $('#duration').val(data[8]);
        });
    });
</script>

<!-- Local Script JQuery Delete Modal -->
<script>
    $('.btnDelete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '&nbsp;&nbsp;Yes&nbsp;&nbsp;',
            
        }).then((result) => {
            if (result.value) {
                document.location.href = href;                
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'No record deleted.',
                    icon: 'info',
                    type: 'info',
                    confirmButtonText: '&nbsp;OK&nbsp;',
                })
            }
        })              
    })  
</script>  

<!-- Local Script JQuery Cancel Modal -->
<script>
    $(document).ready(function () {
        $('.btnCancel').on('click', function() {  
            $('#cancelModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // console.log(data);

            $('#id').val(data[0]); 
            // $('#name').val(data[1]); 
            // // $('#rental_fee').val(1000); 
            // $('#rental_fee').val(data[2]);  
            // $('#payment').val(data[3]); 
        });
    });
</script>

<!-- Local Script JQuery Import Modal -->
<script>
    $(document).ready(function () {
        $('#importModal').on('shown.bs.modal', function () {
            $('input:visible:enabled:first', this).focus();
        });
    });
</script>

<!-- Local Script Jquery *Focus) Add Modal -->
<!-- <script>
    $(document).ready(function () {
        $('#addModal').on('shown.bs.modal', function () {
            $('input:visible:enabled:first', this).focus();
        });
    });
</script> -->

<!-- DataTables -->
<script>    
    $(document).ready(function() {
        $('#daTable').DataTable({
            order: [[0, 'desc']]
        });
    } );    
</script>

<?php include('includes/footer.php'); ?>


