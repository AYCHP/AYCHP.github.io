<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- User create form -->
<div class="container justify-content-md-center">
    <div class="container">
        <!-- Main body section -->
        <div class="mainContainer">

            <!-- Header section -->
            <div class="mainContainer-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="UserManagement.php">Portal users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create new user</li>
                    </ol>
                </nav>
            </div>
            <!-- /Header section -->

            <!-- User create form section -->
            <form class="col-sm-8 mx-auto" id="UserCreateForm" name="UserCreateForm" action="UserCreate.php" method="post">
                <span><b>Create new user</b></span>
                <div class="form-row border">
                    <div class="form-group col-md-3">
                        <label for="Username">Username:</label>
                        <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" required>
                    </div> 
                    <div class="form-group col-md-3">
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                    </div> 
                    <div class="form-group col-md-3">
                        <label for="RPassword">Repeat:</label>
                        <input type="password" class="form-control" id="RPassword" name="RPassword" placeholder="Repeat password" required>
                    </div> 
                    <div class="form-group col-md-3">
                    <label for="UserGroup">Group</label>
                    <select id="UserGroup" id="UserGroup" name="UserGroup" name="UserGroup" class="form-control">
                        <option value = <?php echo htmlspecialchars(ucfirst($row['UserGroupDescription'])); ?>><?php echo htmlspecialchars(ucfirst($row['UserGroupDescription'])); ?></option>
                        <?php 
                        $User = new User();
                        $User->UserGroupGetData(); 
                        ?>
                    </select>
                    </div> 
                </div>
                <div class="form-row justify-content-md-center button-container">
                    <div class="form-group col-auto">
                        <button type="submit" name="UserCreateConfirm" id="UserCreateConfirm" class="btn btn-sm btn-block btn-outline-success">Create user</button>
                    </div>
                </div>
            </form>
            <!-- /User create form section -->
            
            <!-- Alert section -->
            <section id="message">
                <?php if(!empty($_SESSION['AlertMessage'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><center><?php echo htmlentities($_SESSION['AlertMessage']) ?></center></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php unset($_SESSION['AlertMessage']); ?>
                </div>
                <?php elseif(!empty($_SESSION['SuccessMessage'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><center><?php echo htmlentities($_SESSION['SuccessMessage']) ?></center></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php unset($_SESSION['SuccessMessage']); ?>
                </div>
                <?php endif; ?>
            </section>
            <!-- /Alert section -->
        </div>
    </div>
</div>
<!-- /User create form -->