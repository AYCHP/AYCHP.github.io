<?php if(!isset($_SESSION)) { session_start();}             // Start session when no sessions have been started ?>

<?php $title="CEP - Production department management";      // Title of the page

if(isset($_SESSION['UserID'])){                             // Check that user is logged in
    require("Classes/ProductionDepartment.php");
    $ProductionDepartment = new ProductionDepartment();         // Require production department specific class

    if (isset($_POST["ProductionDepartmentCreateConfirm"])) {   // If create production department post is received, call for production department creation function  
        $ProductionDepartment->ProductionDepartmentCreate();    // Call for production department creation function
    }
    include_once 'Views/ProductionDepartmentCreate.php';        // Include correct view
} else {
    header('Location: UserLogin.php');                      // In case user is not logged in redirect to login page 
}
