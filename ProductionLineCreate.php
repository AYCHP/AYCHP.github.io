<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production line management";        // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/ProductionLine.php");                  // Require production line specific class
    $ProductionLine = new ProductionLine();

    if (isset($_POST["ProductionLineCreateForm"])) {        // If create production line post is received, call for production line creation function  
        $ProductionLine->ProductionLineCreate();            // Call for production line creation function
    }
    include_once 'Views/ProductionLineCreate.php';          // Include correct view
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page 
}
