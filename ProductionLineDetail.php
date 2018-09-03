<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production line details";           // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in  
    require("Classes/ProductionLine.php");                  // Require production line specific class
    $ProductionLine = new ProductionLine();

    $ProductionLine->ProductionLineDetailRead();            // Call for production line data retrieve function
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}