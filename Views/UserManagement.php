<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script src="Scripts/UserManagement.js"></script>

<div class="container MainContainer-User">

    <!-- Search container with navigation button to creation form -->
    <div class="MainContainer-Header">
        <a href="UserCreate.php" role="button" class="btn btn-sm btn-outline-secondary">Create new user</a>
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

    <!-- User data management table -->
    <?php if($exist != 0) : ?>
    <table class="table table-responsive-md table-sm table-striped table-hover" id="UserManagementTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Group</th>
                <th scope="col" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['UserAccountID'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['Username'])); ?>
                </td>
                <td class="col-auto text-center">
                    <?php echo htmlspecialchars(ucfirst($row['UserGroupDescription'])); ?>
                </td>
                <form action="UserDetail.php?UserAccountID=<?php echo htmlspecialchars(ucfirst($row['UserAccountID'])) ?>" id="UserModifyForm" name="UserModifyForm" method="post">
                <td class="col-auto text-center">
                    <input type="text" name="UserAccountID" value="<?php echo htmlspecialchars(ucfirst($row['UserAccountID'])) ?>" class="d-none"
                    />
                    <button type="submit" name="UserModify" id="UserModify" class="btn btn-sm btn-outline-secondary">Modify</button>
                </td>
                </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        No results found. Return to <a href="UserManagement.php">user management.</a>
    <?php endif; ?>
    <!-- User data management table -->
</div>
