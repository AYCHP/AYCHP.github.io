<?php if(!isset($_SESSION)) { session_start();}             // Start session when no sessions have been started ?>

<?php $title="CEP - Production business unit management";      // Title of the page

if(isset($_SESSION['UserID'])){                             // Check that user is logged in
    require("Classes/ProductionBusinessUnit.php");
    $ProductionBusinessUnit = new ProductionBusinessUnit();         // Require production BusinessUnit specific class

    if (isset($_POST["ProductionBusinessUnitCreateConfirm"])) {   // If create production BusinessUnit post is received, call for production BusinessUnit creation function  
        $ProductionBusinessUnit->ProductionBusinessUnitCreate();    // Call for production BusinessUnit creation function
    }
    include_once 'Views/ProductionBusinessUnitCreate.php';        // Include correct view
} else {
    header('Location: UserLogin.php');                      // In case user is not logged in redirect to login page 
}
