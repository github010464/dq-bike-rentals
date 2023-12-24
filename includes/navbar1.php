<?php
    if(!isset($_SESSION['login_user'])){
        echo '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1 position-fixed w-100">
        ';
    }else{
        echo '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
        ';
    }
?>
    <div class="container-fluid">    
            <a class="navbar-brand fs-6" href="#">DQ Motorbike Rentals</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" >
            <ul class="navbar-nav ms-auto">     
                <?php if(!isset($_SESSION['login_user'])) : ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#our_bikes">Bikes Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal" href="login.php">Login</a>
                    </li>   
                <?php endif ?>  

                <?php if(isset($_SESSION['login_user'])) : ?>                    
                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php">Transaction</a>
                    </li>
                    <li class="nav-item dropdown">                        
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Utilities
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="close_trans.php"><small>List of Closed Transaction</small></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="cancel_trans.php"><small>List of Cancelled Transaction</small></a></li> 
                        </ul>                           
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="return_items.php">Return Items</a>
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item mt-2 mx-2">
                        <i title="current login = <?=$_SESSION["user_type"]?>" class="fa-solid fa-user" style="color: gray;"></i> 
                    </li>
                <?php endif ?>                
            </ul>             
        </div>
    </div>
</nav>


