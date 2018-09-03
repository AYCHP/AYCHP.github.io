<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Production type details";           // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in                     
    require("Classes/ProductionType.php");                  // Require production type specific class
    $ProductionType = new ProductionType();
    
    $ProductionType->ProductionTypeDetailRead();            // Call for production type data retrieve function
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}