<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production department details";     // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in  
    require("Classes/ProductionDepartment.php");            // Require production department specific class
    $ProductionDepartment = new ProductionDepartment();

    $ProductionDepartment->ProductionDepartmentDetailRead();// Call for production department data retrieve function
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}