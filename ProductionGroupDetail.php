<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production group details";          // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in  
    require("Classes/ProductionGroup.php");                 // Require production group specific class
    $ProductionGroup = new ProductionGroup();

    $ProductionGroup->ProductionGroupDetailRead();          // Call for production group data retrieve function
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}