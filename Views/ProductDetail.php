<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- Product modification form -->
<div class="container justify-content-md-center">
    <!-- Main body section -->
    <div class="mainContainer">

        <!-- Header section -->
        <div class="mainContainer-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ProductManagement.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage existing product</li>
                </ol>
            </nav>
        </div>
        <!-- /Header section -->

        <!-- Product modification form section -->
        <form class="col-sm-8 mx-auto" id="ProductConfirmForm" name="ProductConfirmForm" action="ProductManagement.php" method="post">
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <input type="text" class="d-none" id="ProductID" name="ProductID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductID']); ?>" required readonly>
            <span><b>Product</b>:</span>
            <div class="form-row border">
                <div class="form-group col-md-3">
                    <label for="ProfitCenter">Profit center<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ProfitCenter" name="ProfitCenter" placeholder="Profit center" value="<?php echo htmlspecialchars($row['ProfitCenter']); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="FrameSize">Frame</label>
                    <input type="text" class="form-control" id="FrameSize" name="FrameSize" placeholder="Frame" value="<?php echo htmlspecialchars($row['FrameSize']); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="TaskListGroup">Routing</label>
                    <input type="text" class="form-control" id="TaskListGroup" name="TaskListGroup" placeholder="Routing" value="<?php echo htmlspecialchars($row['RoutingGroup']); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="GroupCounter">Counter</label>
                    <input type="text" class="form-control" id="GroupCounter" name="GroupCounter" placeholder="Counter" value="<?php echo htmlspecialchars($row['GroupCounter']); ?>">
                </div>
            </div>
            <span><b>Structure</b>:</span>
            <div class="form-row border">
                <div class="form-group col-md-3">
                    <label for="ProductionBusinessUnit">BU<span class="text-danger">*</span></label>
                    <select id="ProductionBusinessUnit" id="ProductionBusinessUnit" name="ProductionBusinessUnit" class="form-control" required>
                        <option value = <?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnit'])); ?>><?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnit'])); ?></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionBusinessUnitGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="ProductionGroup">PG<span class="text-danger">*</span></label>
                    <select id="ProductionGroup" id="ProductionGroup" name="ProductionGroup" class="form-control" required>
                        <option value = <?php echo htmlspecialchars(ucfirst($row['ProductionGroup'])); ?>><?php echo htmlspecialchars(ucfirst($row['ProductionGroup'])); ?></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionGroupGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="ProductionDepartment">Department<span class="text-danger">*</span></label>
                    <select id="ProductionDepartment" id="ProductionDepartment" name="ProductionDepartment" class="form-control" required>
                        <option value = <?php echo htmlspecialchars(ucfirst($row['ProductionDepartment'])); ?>><?php echo htmlspecialchars(ucfirst($row['ProductionDepartment'])); ?></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionDepartmentGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="ProductionLine">Line<span class="text-danger">*</span></label>
                    <select id="UserGroup" id="ProductionLine" name="ProductionLine" name="ProductionLine" class="form-control" required>
                        <option value = <?php echo htmlspecialchars(ucfirst($row['ProductionLine'])); ?>><?php echo htmlspecialchars(ucfirst($row['ProductionLine'])); ?></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionLineGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="ProductionType">Type<span class="text-danger">*</span></label>
                    <select id="ProductionType" id="ProductionType" name="ProductionType" class="form-control" required>
                        <option value = <?php echo htmlspecialchars(ucfirst($row['ProductionType'])); ?>><?php echo htmlspecialchars(ucfirst($row['ProductionType'])); ?></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionTypeGetData(); 
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-md-center button-container">
                <div class="form-group col-auto">
                    <button type="button" class="btn btn-sm btn-block btn-outline-success" data-toggle="modal" data-target="#AlertModal">Confirm changes</button>
                </div>
                <div class="form-group col-auto">
                    <a href="ProductManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
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
                            Modifing existing product will update all related mappings to this product. Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="ProductConfirmChange" id="ProductConfirmChange" class="btn btn-outline-success">Confirm changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </form>
        <!-- /Product modification form section -->

        <!-- Product deletion form section -->
        <?php if($_SESSION['UserGroup'] == 'Superuser'): ?>
        <form id="ProductConfirmDeleteForm" name="ProductConfirmDeleteForm" action="ProductManagement.php" method="post">
            <div class="form-group col-auto text-center">
                <input type="text" class="d-none" id="ProductID" name="ProductID" placeholder="ID" value="<?php echo htmlspecialchars($row['ProductID']); ?>" required readonly>
                <button type="submit" name="ProductConfirmDelete" id="ProductConfirmDelete" class="btn btn-sm  btn-outline-danger mx-auto" onclick="return confirm('Are you sure?')">Delete product</button>
            </div>
        </form>
        <?php endif; ?>
        <!-- /Product deletion form section -->   
        <?php endwhile; ?>
    </div>
</div>
<!-- /Product modification form -->