<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- User modification form -->
<div class="container justify-content-md-center">
    <!-- Main body section --> 
    <div class="mainContainer">

        <!-- Header section -->
        <div class="mainContainer-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="UserManagement.php">Portal users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage existing user</li>
                </ol>
            </nav>
        </div>
        <!-- /Header section -->

        <!-- User modification form section -->
        <form class="col-sm-6 mx-auto" id="UserModifyForm" name="UserModifyForm" action="UserManagement.php" method="post">
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <input type="text" class="d-none" id="UserAccountID" name="UserAccountID" placeholder="ID" value="<?php echo htmlspecialchars($row['UserAccountID']); ?>" required readonly>
            <span><b>Modify existing user</b></span>
            <div class="form-row border">
                <div class="form-group col-md-3">
                    <label for="Username">Username:</label>
                    <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" value="<?php echo htmlspecialchars($row['Username']); ?>" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="Password">Password:</label>
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                </div>
                <div class="form-group col-md-3">
                    <label for="RPassword">Repeat:</label>
                    <input type="password" class="form-control" id="RPassword" name="RPassword" placeholder="Repeat">
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
                    <button type="submit" name="UserConfirmChange" id="UserConfirmChange" class="btn btn-sm btn-block btn-outline-success">Confirm changes</button>
                </div>
                <div class="form-group col-auto">
                    <a href="UserManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
                </div>
            </div>
        </form>
        <!-- /User modification  form section -->
        
        <!-- User deletion form section -->
        <form id="UserDeleteForm" name="UserConfirmDeleteForm" action="UserManagement.php" method="post">
            <div class="form-group col-auto text-center">
            <input type="text" class="d-none" id="UserAccountID" name="UserAccountID" placeholder="ID" value="<?php echo htmlspecialchars($row['UserAccountID']); ?>" required readonly>
            <button type="submit" name="UserConfirmDelete" id="UserConfirmDelete" class="btn btn-sm btn-outline-danger">Delete user</button>
            </div>
        </form>
        <!-- /User deletion form section -->
        <?php endwhile; ?>
    </div>
</div>