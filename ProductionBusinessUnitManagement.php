<?php if(!isset($_SESSION)) { session_start();}             // Start session when no sessions have been started ?>

<?php $title="CEP - Production business unit management";      // Title of the page

if(isset($_SESSION['UserID'])){                             // Check that user is logged in
    require("Classes/ProductionBusinessUnit.php");                // Require production group specific class
    $ProductionBusinessUnit = new ProductionBusinessUnit();

    if (isset($_POST["ProductionBusinessUnitConfirmDelete"])) {   // If deletion post is received, call for production BusinessUnit deletion function
        $ProductionBusinessUnit->ProductionBusinessUnitDelete();
    }
    if (isset($_POST["ProductionBusinessUnitConfirmChange"])) {   // If change post is received, call for production BusinessUnit change function
        $ProductionBusinessUnit->ProductionBusinessUnitUpdate();
    }
    if (isset($_POST["ProductionBusinessUnitDataSearch"])) {      // If search post is received, call for production BusinessUnit search function
        $ProductionBusinessUnit->ProductionBusinessUnitDataSearch();
    } else {
        $ProductionBusinessUnit->ProductionBusinessUnitDataRead();  // In any other cases, call for production BusinessUnit data retrieve function
    }
} else {
    header('Location: UserLogin.php');                      // In case user is not logged in redirect to login page
}