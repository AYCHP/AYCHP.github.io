<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- User login form -->
<div class="container">

    <!-- User login form section -->
    <form class="col-sm-4 mx-auto UserLoginForm" id="UserLoginForm" name="UserLoginForm" action="UserLogin.php" method="post">
        <div class='form-group'>
            <label for="Username">Username:</label>
            <input type="text" name="Username" id="Username" placeholder="Username" class="input form-control" autocomplete="on" required
            autofocus />
        </div>
        <div class='form-group'>
            <label for="UserPassword">Password:</label>
            <input type="password" name="UserPassword" id="UserPassword" placeholder="Password" class="input form-control" autocomplete="off"
            required />
        </div>
        <input type="submit" name="UserLogin" value="Login" class="btn btn-outline-danger btn-md btn-block"
        />
        
        <!-- Alert section -->
        <section id="message">
            <?php if(!empty($_SESSION['AlertMessage'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                    <center>
                        <?php echo htmlentities($_SESSION['AlertMessage']) ?>
                    </center>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php unset($_SESSION['AlertMessage']); ?>
            </div>
            <?php endif; ?>
        </section>
        <!-- /Alert section -->
    </form>
    <!-- /User login form section -->
    <img src="assets/img/ABB_smaller2x.png" alt="ABB logo" class="img-responsive mx-auto d-block">
</div>
<!-- /User Login Form-->