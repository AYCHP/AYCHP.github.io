<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/ProductionBusinessUnitManagement.js"></script>

<div class="container MainContainer-ProductionBusinessUnit">

    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="ProductionBusinessUnitCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new production business unit</a>
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

    <!-- Production BusinessUnit management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped" id="ProductionBusinessUnitManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Production business unit</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnitID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnit'])); ?>
                </td>
                <td class="col-auto text-center">
                <form action="ProductionBusinessUnitDetail.php?ProductionBusinessUnitID=<?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnitID'])) ?>" id="ProductionBusinessUnitModifyForm" name="ProductionBusinessUnitModifyForm" method="post">
                
                    <input type="text" name="ProductionBusinessUnitID" value="<?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnitID'])) ?>" class="d-none"
                    />
                    <button type="submit" name="ProductionBusinessUnitModify" id="ProductionBusinessUnitModify" class="btn btn-sm btn-outline-secondary">Modify</button>
               
                </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        No results found. Return to <a href="ProductionBusinessUnitManagement.php">production business unit management.</a>
    <?php endif; ?>
    <!-- /Production BusinessUnit management table -->
</div>
