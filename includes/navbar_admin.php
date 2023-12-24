
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">

<div class="container-fluid">    
<a class="navbar-brand fs-6" href="#">DQ Motorbike Rentals</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" >
        <ul class="navbar-nav ms-auto">  
                        
            <?php if(isset($_SESSION['admin'])) : ?> 
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item mt-2 mx-2"> 
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="current user = <?=$_SESSION['admin']?>"><i class="fa-solid fa-user" style="color: gray;"></i></a> 
                    <!-- <i title="current user = <?=$_SESSION["admin"]?>" class="fa-solid fa-user" style="color: gray;"></i>  -->
                </li>
            <?php endif ?>
            </ul>             
        </div>
    </div>
</nav>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

