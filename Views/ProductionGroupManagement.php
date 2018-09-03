<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/ProductionGroupManagement.js"></script>

<div class="container MainContainer-ProductionGroup">

    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="ProductionGroupCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new production group</a>
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

    <!-- Production group management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped" id="ProductionGroupManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Production group</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionGroupID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionGroup'])); ?>
                </td>
                <td class="col-auto text-center">
                <form action="ProductionGroupDetail.php?ProductionGroupID=<?php echo htmlspecialchars(ucfirst($row['ProductionGroupID'])) ?>" id="ProductionGroupModifyForm" name="ProductionGroupModifyForm" method="post">
                    <input type="text" name="ProductionGroupID" value="<?php echo htmlspecialchars(ucfirst($row['ProductionGroupID'])) ?>" class="d-none"
                    />
                    <button type="submit" name="ProductionGroupModify" id="ProductionGroupModify" class="btn btn-sm btn-outline-secondary">Modify</button>
                </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        No results found. Return to <a href="ProductionGroupManagement.php">production group management.</a>
    <?php endif; ?>
    <!-- /Production group management table -->
</div>
