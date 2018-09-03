<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- Production BusinessUnit create form -->
<div class="container justify-content-md-center">
    <div class="container">
        <!-- Main body section -->
        <div class="mainContainer">

            <!-- Header section -->
            <div class="mainContainer-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="ProductionBusinessUnitManagement.php">Production business units</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Define new production business unit</li>
                    </ol>
                </nav>
            </div>
            <!-- /Header section -->

            <!-- Production BusinessUnit create form section -->
            <form class="col-sm-6 mx-auto" id="ProductionBusinessUnitCreateForm" name="ProductionBusinessUnitCreateForm" action="ProductionBusinessUnitCreate.php" method="post">
                <span><b>Define new production business unit</b></span>
                <div class="form-row border justify-content-md-center">
                    <div class="form-group col-md-6">
                        <label for="ProductionBusinessUnit">Production business unit name:</label>
                        <input type="text" class="form-control" id="ProductionBusinessUnit" name="ProductionBusinessUnit" placeholder="Production business unit">
                    </div>
                </div>
                <div class="form-row justify-content-md-center button-container">
                    <div class="form-group col-auto">
                        <button type="submit" name="ProductionBusinessUnitCreateConfirm" id="ProductionBusinessUnitCreateConfirm" class="btn btn-sm btn-block btn-outline-success" onclick="return confirm('Are you sure?')">Create production business unit</button>
                    </div>
                    <div class="form-group col-auto">
                        <a href="ProductionBusinessUnitManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
                    </div>
                </div>
            </form>
            <!-- Production BusinessUnit create form section -->
            
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
</div>
<!-- /Production BusinessUnit create form -->