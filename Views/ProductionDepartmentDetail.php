<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- Production department modification form -->
<div class="container justify-content-md-center">
    <!-- Main body section -->  
    <div class="mainContainer">

        <!-- Header section -->
        <div class="mainContainer-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ProductionDepartmentManagement.php">Production departments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage existing production departments</li>
                </ol>
            </nav>
        </div>
        <!-- /Header section -->

        <!-- Production department modification form section -->
        <form class="col-sm-6 mx-auto" id="ProductDepartmentModifyForm" name="ProductDepartmentModifyForm" action="ProductionDepartmentManagement.php" method="post">
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <input type="text" class="d-none" id="ProductionDepartmentID" name="ProductionDepartmentID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductionDepartmentID']); ?>" required readonly>
            <span><b>Modify existing production department</b></span>
            <div class="form-row border justify-content-md-center">
                <div class="form-group col-md-8 justify-content-md-center">
                    <label for="ProductionDepartment">Production department name:</label>
                    <input type="text" class="form-control" id="ProductionDepartment" name="ProductionDepartment" placeholder="Production Department" value="<?php echo htmlspecialchars($row['ProductionDepartment']); ?>" required>
                </div>
            </div>
            <div class="form-row justify-content-md-center button-container">
                <div class="form-group col-auto">
                    <button type="button" class="btn btn-sm btn-block btn-outline-success" data-toggle="modal" data-target="#AlertModal">Confirm changes</button>
                </div>
                <div class="form-group col-auto">
                    <a href="ProductionDepartmentManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="AlertModal" tabindex="-1" role="dialog" aria-labelledby="AlertModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="AlertModalLabel">Warning!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Modifing existing production department will update all related mappings to this department. Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="ProductionDepartmentConfirmChange" id="ProductionDepartmentConfirmChange" class="btn btn-outline-success">Confirm changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </form>
        <!-- /Production department modification form section -->
        <!-- Production department deletion form section -->
        <?php if($_SESSION['UserGroup'] == 'Superuser'): ?>
            <form id="ProductionDepartmentConfirmDeleteForm" name="ProductionDepartmentConfirmDeleteForm" action="ProductionDepartmentManagement.php" method="post">
                <div class="form-group col-auto text-center">
                <input type="text" class="d-none" id="ProductionDepartmentID" name="ProductionDepartmentID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductionDepartmentID']); ?>" required readonly>
                <button type="submit" name="ProductionDepartmentConfirmDelete" id="ProductionDepartmentConfirmDelete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Warning: Deleting existing production department will delete all related mappings to this department. Are you sure?')">Delete production department</button>
                </div>
            </form>
        <?php endif; ?>
        <!-- /Production department deletion form section -->
        <?php endwhile; ?>
    </div>
</div>