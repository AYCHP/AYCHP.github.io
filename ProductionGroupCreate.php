<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP production group management";         // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/ProductionGroup.php");                 // Require production group specific class
    $ProductionGroup = new ProductionGroup();

    if (isset($_POST["ProductionGroupCreateConfirm"])) {    // If create production group post is received, call for production group creation function
        $ProductionGroup->ProductionGroupCreate();          // Call for production group creation function    
    }
    include_once 'Views/ProductionGroupCreate.php';         // Include correct view
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page 
}