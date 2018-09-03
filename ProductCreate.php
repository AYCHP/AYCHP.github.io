<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product management";                // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/Product.php");                         // Require product specific class
    $Product = new Product();

    if (isset($_POST["ProductCreateConfirm"])) {            // If create product post is received, call for product creation function
        $Product->ProductCreate();                          // Call for product creation function
    }
    include_once 'Views/ProductCreate.php';                 // Include correct view
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page 
}  