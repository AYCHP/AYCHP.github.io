<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production type management";        // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/ProductionType.php");                  // Require production type specific class
    $ProductionType = new ProductionType();
    
    if (isset($_POST["ProductionTypeCreateConfirm"])) {     // If create production type post is received, call for production type creation function        
        $ProductionType->ProductionTypeCreate();            // Call for production type creation function
    }
    include_once 'Views/ProductionTypeCreate.php';          // Include correct view
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page 
}