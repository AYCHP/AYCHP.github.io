<?php if(isset($_SESSION['UserID'])){   include_once 'Header.php'; } ?>

<!-- Production type create form -->
<div class="container justify-content-md-center">
    <div class="container">
        <!-- Main body section -->
        <div class="mainContainer">

            <!-- Header section -->
            <div class="mainContainer-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="ProductionTypeManagement.php">Production type</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Define new production type</li>
                    </ol>
                </nav>
            </div>
            <!-- /Header section -->

            <!-- Production type create form section -->
            <form class="col-sm-6 mx-auto" id="ProductionTypeCreateForm" name="ProductionTypeCreateForm" action="ProductionTypeCreate.php" method="post">
                <span><b>Define new production type</b></span>
                <div class="form-row border justify-content-md-center">
                    <div class="form-group col-md-6">
                        <label for="ProductionType">Production type name:</label>
                        <input type="text" class="form-control" id="ProductionType" name="ProductionType" placeholder="Production type">
                    </div>
                </div>
                <div class="form-row justify-content-md-center button-container">
                    <div class="form-group col-auto">
                        <button type="submit" name="ProductionTypeCreateConfirm" id="ProductionTypeCreateConfirm" class="btn btn-sm btn-block btn-outline-success" onclick="return confirm('Are you sure?')">Create production type</button>
                    </div>
                    <div class="form-group col-auto">
                        <a href="ProductionTypeManagement.php" role="button" class="btn btn-sm btn-block  btn-outline-warning">Cancel changes</a>
                    </div>
                </div>
            </form>
            <!-- /Production type create form section -->
            
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
<!-- /Production type create form -->