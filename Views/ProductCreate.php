<?php if(isset($_SESSION['UserID'])){ include_once 'Header.php';} ?>
<script>
function validateForm() {
    var x = document.forms["ProductCreateForm"]["ProfitCenter"].length;
    if (x != 6) {
        alert("Profit center must equal 6 characters.");
        return false;
    }
}
</script>

<!-- Product create form -->
<div class="container justify-content-md-center">
    <!-- Main body section -->
    <div class="mainContainer">

        <!-- Header section -->
        <div class="mainContainer-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ProductManagement.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Define new product</li>
                </ol>
            </nav>
        </div>
        <!-- /Header section -->

        <!-- Product create form section -->
        <form class="col-sm-8 mx-auto" id="ProductCreateForm" name="ProductCreateForm" action="ProductManagement.php" method="post">
            <span><b>Define product</b>:</span>
            <div class="form-row border">
                <div class="form-group col-md-3">
                    <label for="ProfitCenter">Profit center<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ProfitCenter" name="ProfitCenter" placeholder="Profit center" required autocomplete="off">
                </div>
                <div class="form-group col-md-3">
                    <label for="FrameSize">Frame</label>
                    <input type="text" class="form-control" id="FrameSize" name="FrameSize" placeholder="Frame" autocomplete="off">
                </div>
                <div class="form-group col-md-3">
                    <label for="TaskListGroup">Routing</label>
                    <input type="text" class="form-control" id="TaskListGroup" name="TaskListGroup" placeholder="Routing" autocomplete="off">
                </div>
                <div class="form-group col-md-3">
                    <label for="GroupCounter">Counter</label>
                    <input type="text" class="form-control" id="GroupCounter" name="GroupCounter" placeholder="Counter" autocomplete="off">
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
                        <option></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionDepartmentGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="ProductionLine">Line<span class="text-danger">*</span></label>
                    <select id="UserGroup" id="ProductionLine" name="ProductionLine" name="ProductionLine" class="form-control" required>
                        <option></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionLineGetData(); 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="ProductionType">Type<span class="text-danger">*</span></label>
                    <select id="ProductionType" name="ProductionType" class="form-control" required>
                        <option></option>
                        <?php 
                        $Product = new Product();
                        $Product->ProductionTypeGetData(); 
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-md-center button-container">
                <div class="form-group col-auto">
                    <button type="submit" name="ProductCreateConfirm" id="ProductCreateConfirm" class="btn btn-sm btn-block btn-outline-success">Create product</button>
                </div>
                <div class="form-group col-auto">
                    <a href="ProductManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
                </div>
            </div>
        </form>
        <!-- /Product create form section -->

        <!-- Alert section -->
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
        <!-- /Alert section -->
    </div>
</div>
<!-- /Product create form -->