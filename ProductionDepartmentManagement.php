<?php if(!isset($_SESSION)) { session_start();}             // Start session when no sessions have been started ?>

<?php $title="CEP - Production department management";      // Title of the page

if(isset($_SESSION['UserID'])){                             // Check that user is logged in
    require("Classes/ProductionDepartment.php");                // Require production group specific class
    $ProductionDepartment = new ProductionDepartment();

    if (isset($_POST["ProductionDepartmentConfirmDelete"])) {   // If deletion post is received, call for production department deletion function
        $ProductionDepartment->ProductionDepartmentDelete();
    }
    if (isset($_POST["ProductionDepartmentConfirmChange"])) {   // If change post is received, call for production department change function
        $ProductionDepartment->ProductionDepartmentUpdate();
    }
    if (isset($_POST["ProductionDepartmentDataSearch"])) {      // If search post is received, call for production department search function
        $ProductionDepartment->ProductionDepartmentDataSearch();
    } else {
        $ProductionDepartment->ProductionDepartmentDataRead();  // In any other cases, call for production department data retrieve function
    }
} else {
    header('Location: UserLogin.php');                      // In case user is not logged in redirect to login page
}