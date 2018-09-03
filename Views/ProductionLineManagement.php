<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/ProductionLineManagement.js"></script>

<div class="container MainContainer-ProductionLine">

    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="ProductionLineCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new production line</a>
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

    <!-- Production line management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped" id="ProductionLineManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Production line</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionLineID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionLine'])); ?>
                </td>
                <td class="col-auto text-center">
                <form action="ProductionLineDetail.php?ProductionLineID=<?php echo htmlspecialchars(ucfirst($row['ProductionLineID'])) ?>" id="ProductionLineModifyForm" name="ProductionLineModifyForm" method="post">
                    <input type="text" name="ProductionLineID" value="<?php echo htmlspecialchars(ucfirst($row['ProductionLineID'])) ?>" class="d-none"
                    />
                    <button type="submit" name="ProductionLineModify" id="ProductionLineModify" class="btn btn-sm btn-outline-secondary">Modify</button>
                </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        No results found. Return to <a href="ProductionLineManagement.php">production line management.</a>
    <?php endif; ?>
    <!-- /Production line management table -->
</div>
