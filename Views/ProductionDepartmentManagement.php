<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/ProductionDepartmentManagement.js"></script>

<div class="container MainContainer-ProductionDepartment">

    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="ProductionDepartmentCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new production department</a>
        <div class="float-right col-auto">
            <div id="TableSearchContainer"></div>
        </div>
    </div>
    <!-- /Search container with navigation button to creation form -->

    <!-- Alert message section -->
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
    <!-- /Alert message section -->

    <!-- Production department management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped" id="ProductionDepartmentManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Production department</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionDepartmentID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionDepartment'])); ?>
                </td>
                <td class="col-auto text-center">
                <form action="ProductionDepartmentDetail.php?ProductionDepartmentID=<?php echo htmlspecialchars(ucfirst($row['ProductionDepartmentID'])) ?>" id="ProductionDepartmentModifyForm" name="ProductionDepartmentModifyForm" method="post">
                
                    <input type="text" name="ProductionDepartmentID" value="<?php echo htmlspecialchars(ucfirst($row['ProductionDepartmentID'])) ?>" class="d-none"
                    />
                    <button type="submit" name="ProductionDepartmentModify" id="ProductionDepartmentModify" class="btn btn-sm btn-outline-secondary">Modify</button>
               
                </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        No results found. Return to <a href="ProductionDepartmentManagement.php">production department management.</a>
    <?php endif; ?>
    <!-- /Production department management table -->
</div>
