<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production line management";        // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in 
    require("Classes/ProductionLine.php");                  // Require production line specific class
    $ProductionLine = new ProductionLine();

    if (isset($_POST["ProductionLineConfirmDelete"])) {     // If deletion post is received, call for production line deletion function
        $ProductionLine->ProductionLineDelete();
    }
    if (isset($_POST["ProductionLineConfirmChange"])) {     // If change post is received, call for production line change function
        $ProductionLine->ProductionLineUpdate();
    }
    if (isset($_POST["ProductionLineDataSearch"])) {        // If search post is received, call for production line search function
        $ProductionLine->ProductionLineDataSearch();
    } else {
        $ProductionLine->ProductionLineDataRead();          // In any other cases, call for production line data retrieve function
    }
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}