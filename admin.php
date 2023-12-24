<?php
    session_start();
    date_default_timezone_set("Asia/Manila");  
    $page_title = "DQ Motobike Rentals";
    include 'includes/header.php';
    include 'includes/navbar_admin.php';
    include 'includes/authentication.php';
    include 'includes/dbh.php';
?>
<div class="container-fluid">

    <h5 class="float-start mt-3">ADMIN CONFIGURATION PANEL</h5>
    
    <!-- Button trigger Add modal -->
    <button type="button" class="btn btn-sm btn-primary float-end mx-1 mt-3" data-bs-toggle="modal" data-bs-target="#addModal">
    ADD 
    </button> 
    <br/><br/>
    <hr>

    <table class="table table-striped table-sm" id="daTable" style="font-size:13px">
        <thead>
            <tr>
            <th>ID No.</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>USER_TYPE</th>
            <th>DATE_CREATED</th>
            <th>STATUS</th>
            <th>PROCESS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //PDO query
                $stmt = $pdo->query("SELECT * FROM users WHERE user_type != 'admin'");

                // Fetch style = object
                while($row = $stmt->fetch()){
            ?>    
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->name; ?></td>
                <td><?= $row->email; ?></td>
                <td><?= $row->password; ?></td>
                <td><?= $row->user_type; ?></td>
                <td><?= $row->date_created; ?></td>
                <td><?= $row->status; ?></td>
                <td>
                    <a class="btn btn-success btn-sm edit_btn" href="#" data-bs-toggle="modal" data-bs-target="#editModal">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>

                    <!-- <button type="button" class="btn btn-danger btn-sm"><a class="text-light delete_btn text-decoration-none" href='admin_delete_user.php?deleteid=<?php echo $row->id ?>'>Delete</a></button> -->
                   
                    <a class="btn btn-danger btn-sm btnDelete" href="admin_delete_user.php?deleteid=<?php echo $row->id ?>">Delete</a>                 
                </td>
            </tr>      
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="admin_add_user.php" method="POST">
        <div class="modal-body">            
            <div class="form-group">
                <label class="fw-bold mb-1">Fullname</label>                
                <input type="text" class="form-control" name="name" pattern="([ña-zA-Z]+\s){1,}([ña-zA-Z]+)" title="Fullname format: Niño Cañete">  
            </div>
            <div class="form-group">
                <label class="fw-bold mb-1">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>                                        
            <div class="form-group">
                <label class="fw-bold mb-1">Password</label>
                <input type="text" class="form-control" name="password" required>
            </div> 
            <div class="form-group float-end my-3">                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="admin_add_btn">Submit</button>        
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="admin_edit.php" method="POST">
                <div class="modal-body">
                <div class="form-group">
                    <!-- <label class="fw-bold mb-1">ID</label> -->
                    <input type="hidden" class="form-control" name="id" id="id" >                        
                </div>
                    <div class="form-group">
                        <label class="fw-bold mb-1">Fullname</label>                
                        <input type="text" class="form-control" name="name" id="name" pattern="([ña-zA-Z]+\s){1,}([ña-zA-Z]+)" title="Fullname format: Niño Cañete">  
                    </div>
                    <div class="form-group">
                        <label class="fw-bold mb-1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>                                        
                    <div class="form-group">
                        <label class="fw-bold mb-1">User_type</label>
                        <input type="text" class="form-control" name="user_type" id="user_type" required>
                    </div>                                             
                    <div class="form-group">
                        <label class="fw-bold mb-1">Status</label>
                        <input type="text" class="form-control" name="status" id="status" required>
                    </div>
                    <div class="form-group float-end my-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="admin_edit_btn">Submit</button>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<!-- <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                <div class="form-group">
                    <label class="fw-bold mb-1">ID</label>
                    <input type="text" class="form-control" name="id" id="id" >                        
                </div>
                    <div class="form-group">
                        <label class="fw-bold mb-1">Fullname</label>                
                        <input type="text" class="form-control" name="name" id="name" pattern="([ña-zA-Z]+\s){1,}([ña-zA-Z]+)" title="Fullname format: Niño Cañete">  
                    </div>
                    <div class="form-group">
                        <label class="fw-bold mb-1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>                                        
                    <div class="form-group">
                        <label class="fw-bold mb-1">User_type</label>
                        <input type="text" class="form-control" name="user_type" id="user_type" required>
                    </div>                                             
                    <div class="form-group">
                        <label class="fw-bold mb-1">Status</label>
                        <input type="text" class="form-control" name="status" id="status" required>
                    </div>
                    <div class="form-group float-end my-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="admin_edit_btn">Submit</button>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->

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
            $('#user_type').val(data[4]); 
            $('#status').val(data[6]);
        });
    });
</script>

<!-- Local Script JQuery Delete Modal -->
<script>
    $('.btnDelete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
            title: 'Delete Record',
            text: "Are you sure? You won't be able to revert this!",
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
                    confirmButtonText: '&nbsp;OK&nbsp;',
                })
            }
        })              
    })  
</script>  

<!-- Local Script Jquery *Focus) Add Modal -->
<script>
    $(document).ready(function () {
        $('#addModal').on('shown.bs.modal', function () {
            $('input:visible:enabled:first', this).focus();
        });
    });
</script>

<?php include('includes/footer.php'); ?>


