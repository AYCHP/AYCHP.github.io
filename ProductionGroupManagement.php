<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production group management";       // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in 
    require("Classes/ProductionGroup.php");             // Require production group specific class
    $ProductionGroup = new ProductionGroup();           

    if (isset($_POST["ProductionGroupConfirmDelete"])) {    // If deletion post is received, call for production group deletion function
        $ProductionGroup->ProductionGroupDelete();
    }
    if (isset($_POST["ProductionGroupConfirmChange"])) {    // If change post is received, call for production group change function
        $ProductionGroup->ProductionGroupUpdate();
    }
    if (isset($_POST["ProductionGroupDataSearch"])) {       // If search post is received, call for production group search function
        $ProductionGroup->ProductionGroupDataSearch();
    } else {
        $ProductionGroup->ProductionGroupDataRead();        // In any other cases, call for production group data retrieve function
    }
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}