<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/ProductManagement.js"></script>

<div class="container MainContainer">
    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="ProductCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new product</a>
        <div class="float-right col-auto">
            <div id="TableSearchContainer"></div>
        </div>
    </div>
    <!-- /Search container with navigation button to creation form -->

    <!-- Alert message section -->
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
        <?php elseif(!empty($_SESSION['SuccessMessage'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <center>
                    <?php echo htmlentities($_SESSION['SuccessMessage']) ?>
                </center>
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php unset($_SESSION['SuccessMessage']); ?>
        </div>
        <?php endif; ?>
    </section>
    <!-- /Alert message section -->

    <!-- Product data management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped table-hover" id="DataManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Profit center</th>
                <th scope="col" class="text-center">Frame size</th>
                <th scope="col" class="text-center">Routing</th>
                <th scope="col" class="text-center">Counter</th>
                <th scope="col" class="text-center">BU</th>
                <th scope="col" class="text-center">PG</th>
                <th scope="col" class="text-center">Department</th>
                <th scope="col" class="text-center">Line</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProfitCenter'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['FrameSize'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['RoutingGroup'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['GroupCounter'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionBusinessUnit'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionGroup'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionDepartment'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionLine'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['ProductionType'])); ?>
                </td>
                <td class="col-auto text-center">
                    <form action="ProductDetail.php?ProductID=<?php echo $row['ProductID']; ?>" target="_self" id="ProductModifyForm" name="ProductModifyForm"
                        method="post">
                        <input type="text" name="ProductID" value="<?php echo htmlspecialchars(ucfirst($row['ProductID'])) ?>" class="d-none" />
                        <button type="submit" name="ProductModify" id="ProductModify" class="btn btn-sm btn-block btn-outline-secondary">Modify</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?> No results found. Return to
    <a href="ProductManagement.php">product management.</a>
    <?php endif; ?>
    <!-- /Product data management table -->
</div>