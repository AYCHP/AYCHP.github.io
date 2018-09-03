<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production business unit details";     // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in  
    require("Classes/ProductionBusinessUnit.php");            // Require production BusinessUnit specific class
    $ProductionBusinessUnit = new ProductionBusinessUnit();

    $ProductionBusinessUnit->ProductionBusinessUnitDetailRead();// Call for production BusinessUnit data retrieve function
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}