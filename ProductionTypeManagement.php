<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production type management";        // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in 
    require("Classes/ProductionType.php");                  // Require production type specific class
    $ProductionType = new ProductionType();

    if (isset($_POST["ProductionTypeConfirmDelete"])) {     // If deletion post is received, call for production type deletion function
        $ProductionType->ProductionTypeDelete();
    }
    if (isset($_POST["ProductionTypeConfirmChange"])) {     // If change post is received, call for production type change function
        $ProductionType->ProductionTypeUpdate();
    }
    if (isset($_POST["ProductionTypeDataSearch"])) {        // If search post is received, call for production type search function
        $ProductionType->ProductionTypeDataSearch();
    } else {
        $ProductionType->ProductionTypeDataRead();          // In any other cases, call for production type data retrieve function
    }
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}