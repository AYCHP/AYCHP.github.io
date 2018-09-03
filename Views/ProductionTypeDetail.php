<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- Production type modification form -->
<div class="container justify-content-md-center">
    <!-- Main body section -->
    <div class="mainContainer">

        <!-- Header section -->
        <div class="mainContainer-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ProductionTypeManagement.php">Production type</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage existing production type</li>
                </ol>
            </nav>
        </div>
        <!-- /Header section -->

        <!-- Production type modification form section -->
        <form class="col-sm-6 mx-auto" id="ProductionTypeModifyForm" name="ProductionTypeModifyForm" action="ProductionTypeManagement.php" method="post">
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <input type="text" class="d-none" id="ProductionTypeID" name="ProductionTypeID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductionTypeID']); ?>" required readonly>
            <span><b>Modify existing production type</b></span>
            <div class="form-row border justify-content-md-center">
                <div class="form-group col-md-8">
                    <label for="ProductionType">Production type name:</label>
                    <input type="text" class="form-control" id="ProductionType" name="ProductionType" placeholder="Production type" value="<?php echo htmlspecialchars($row['ProductionType']); ?>" required>
                </div>
            </div>
            <div class="form-row justify-content-md-center button-container">
                <div class="form-group col-auto">
                    <button type="button" class="btn btn-sm btn-block btn-outline-success" data-toggle="modal" data-target="#AlertModal">Confirm changes</button>
                </div>
                <div class="form-group col-auto">
                    <a href="ProductionTypeManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
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
                            Modifing existing production type will update all related mappings to this type. Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="ProductionTypeConfirmChange" id="ProductionTypeConfirmChange" class="btn btn-outline-success">Confirm changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </form>
        <!-- /Production type modification form section -->
        
        <!-- Production type deletion form section -->        
        <?php if($_SESSION['UserGroup'] == 'Superuser'): ?>
            <form id="ProductionTypeConfirmDeleteForm" name="ProductionTypeConfirmDeleteForm" action="ProductionTypeManagement.php" method="post">
                <div class="form-group col-auto text-center">
                <input type="text" class="d-none" id="ProductionTypeID" name="ProductionTypeID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductionTypeID']); ?>" required readonly>
                <button type="submit" name="ProductionTypeConfirmDelete" id="ProductionTypeConfirmDelete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Warning: Deleting existing production type will delete all related mappings to this type. Are you sure?')">Delete production type</button>
                </div>
            </form>
        <?php endif; ?>
        <!-- /Production type deletion form section -->
        <?php endwhile; ?>
    </div>
</div>