<?php
    session_start();
    
    $page_title = "DQ Motobike Rentals";
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/message.php';
?>
<section class="home" id="home">
    <div class="container"> 
        <h4 class="text-center welcome">Welcome to DQ Motorbike Rentals</h4>   
        <!-- <span class="d-flex justify-content-center align-items-center fs-4"> -->
        <h4 class="text-center tagline">You want to ride a motorbike?</h4>
        <!-- </span> -->
        <h6 class="text-center">Please call <span class="text-danger fw-bold fs-5 text">09451234567</span> for booking.</h6>

        <!--Login Modal -->
        <div class="modal fade py-5" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog py-5">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">User's Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="login.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Password</label>
                        <input type="text" class="form-control" name="password" required>
                    </div>
                    <div class="form-group mt-3 float-end mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="login_btn">Submit</button>
                    </div>
                </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog py-2">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Booking Registration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="register.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="fw-bold">Fullname</label>                
                        <input type="text" class="form-control" name="name" id="name" required pattern='([a-zA-Z]+\s\ñ){1,}([a-zA-Z]+)' title="Fullname format: Mark Cañete">   
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Mobile No.</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" required pattern="^[0-9]{1,20}$" title="Numeric characters only.">
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Current Address</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="fw-bold">Pickup Date</label>
                                <input type="datetime-local" class="form-control" name="pickup_date" id="pickup_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="fw-bold">Return Date</label>
                                <input type="datetime-local" class="form-control" name="return_date" id="return_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group float-end mt-3">                
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="register_btn">Submit</button>        
                    </div>
                </div>
                </form>
            </div>
        </div>
    <div>
</section>
<section class="bikes text-white" id="our_bikes">
    <h5 class="page_title">Available Bikes</h5>
        <div class="d-flex justify-content-center">
            <a href="images/honda_adv_160cc.jpg" data-lightbox="data-gallery" data-title="Honda ADV 160cc"><img class="img_thumbnail" src="images//honda_adv_160cc_sm.jpg" alt="image"></a>
            <a href="images//honda_beat_110cc.jpg" data-lightbox="data-gallery" data-title="Honda Beat 110cc"><img class="img_thumbnail" src="images/honda_beat_110cc_sm.jpg" alt="image"></a>
            <a href="images//honda_click_125cc.jpg" data-lightbox="data-gallery" data-title="Honda Click 125cc"><img class="img_thumbnail" src="images//honda_click_125cc_sm.jpg" alt="image"></a>
            <a href="images//kawasaki_klx_140.jpg" data-lightbox="data-gallery" data-title="Kawasaki KLX140"><img class="img_thumbnail" src="images//kawasaki_klx_140_sm.jpg" alt="image"></a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="images/suzuki_gixxer_sf250.jpg" data-lightbox="data-gallery" data-title="Suzuki Gixxer SF250"><img class="img_thumbnail" src="images/suzuki_gixxer_sf250_sm.jpg" alt="image"></a>
            <a href="images/suzuki_raider_r150.jpg" data-lightbox="data-gallery" data-title="Suzuki Raider R150"><img class="img_thumbnail" src="images/suzuki_raider_ r150_sm.jpg" alt="image"></a>
            <a href="images/suzuki_smash_115cc.jpg" data-lightbox="data-gallery" data-title="Suzuki Smash 115cc"><img class="img_thumbnail" src="images/suzuki_smash_115cc_sm.jpg" alt="image"></a>            
            <a href="images/suzuki_sniper_125cc.jpg" data-lightbox="data-gallery" data-title="Suzuki Sniper 125cc "><img class="img_thumbnail" src="images//suzuki_sniper_125cc_sm.jpg" alt="image"></a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="images//yamaha_mio_125cc.jpg" data-lightbox="data-gallery" data-title="Yamaha MIO 125cc"><img class="img_thumbnail" src="images//yamaha_mio_125cc_sm.jpg" alt="image"></a>
            <a href="images//yamaha_aerox_155cc.jpg" data-lightbox="data-gallery" data-title="Yamaha Aerox 155cc"><img class="img_thumbnail" src="images//yamaha_aerox_155cc_sm.jpg" alt="image"></a>
            <a href="images//yamaha_nmax_155cc.jpg" data-lightbox="data-gallery" data-title="Yamaha NMax 155cc"><img class="img_thumbnail" src="images//yamaha_nmax_155cc_sm.jpg" alt="image"></a>            
            <a href="images/yamaha_xmax_300cc.jpg" data-lightbox="data-gallery" data-title="Yamaha XMax 300cc"><img class="img_thumbnail" src="images//yamaha_xmax_300cc_sm.jpg" alt="image"></a>
        </div>
</section>
<section class="services" id="services">
    <h5 class="page_title">Services</h5>
    <p class="first_paragraph">We offer  service rental fee depending on the engine capacity of our bike. See below for the list of the following rates. Subject rates may change without notice.</p>

    <table class="table table-striped table-dark table-sm w-50" style="margin: 0 auto;">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Rental Fee</th>
                <th>Duration</th>
                <th>Excess Hour Charges</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="200px">Yamaha XMax 300 CC</td>
                <td>P 700.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Yamaha NMAX 155 CC</td>
                <td>P 600.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr>
            <tr>
                <td>Suzuki Sniper 125 CC</td>
                <td>P 700.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Yamaha Aerox 155 CC</td>
                <td>P 600.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Yamaha Mio 125 CC</td>
                <td>P 500.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Honda ADV  160 CC</td>
                <td>P 600.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Honda Beat 125  CC</td>
                <td>P 500.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Honda Click 125 CC</td>
                <td>P 500.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Suzuki Sniper 125 CC</td>
                <td>P 500.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
            <tr>
                <td width="200px">Suzuki Smash 125 CC</td>
                <td>P 500.00</td>
                <td>8 hours</td>
                <td>100 per hour</td>
            </tr> 
        </tbody>
</table>
</section>
<section class="about text-white" id="about">
    <h5 class="page_title">About us</h5>
    <p class="first_paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid doloremque tempora quis voluptate quasi quibusdam aspernatur deleniti minus asperiores vel eaque corrupti aperiam, a impedit voluptas voluptatibus similique inventore, consequuntur necessitatibus cupiditate, repellendus sit vitae voluptatem? Fuga quibusdam, cumque soluta quisquam illum ipsa voluptatum explicabo praesentium laudantium, adipisci quas quia saepe autem recusandae vel molestias. Cumque nostrum voluptate veritatis. Accusantium reiciendis ratione natus. Quaerat et perferendis tempore veniam omnis distinctio fugit sed, non fuga ipsum? Repellendus, sapiente voluptatem ex nulla ut illo odio quis magni nostrum maxime placeat unde sed eos. Doloribus culpa similique alias provident reiciendis pariatur quis eos?</p>
    
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ratione dolorum dolores totam pariatur eligendi consequuntur provident! Maiores quo fugiat natus perferendis obcaecati eaque, unde omnis quibusdam esse tempore quidem dolorem, voluptas asperiores. Exercitationem, quidem modi magnam nobis nesciunt non, sint praesentium nostrum repellat beatae nemo, voluptatem dolorum alias. Maiores.</p>
    
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid doloremque tempora quis voluptate quasi quibusdam aspernatur deleniti minus asperiores vel eaque corrupti aperiam, a impedit voluptas voluptatibus similique inventore, consequuntur necessitatibus cupiditate, repellendus sit vitae voluptatem? Fuga quibusdam, cumque soluta quisquam illum ipsa voluptatum explicabo praesentium laudantium, adipisci quas quia saepe autem recusandae vel molestias. Cumque nostrum voluptate veritatis. Accusantium reiciendis ratione natus.</p>
</section>
<footer class="text-center text-white py-2">
    <small>DQ Motorbike Rentals. &#169;	Copyright 2023.</small>
</footer>
<?php include 'includes/footer.php';?>