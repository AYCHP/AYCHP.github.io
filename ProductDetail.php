<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product details";                   // Title of the page

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/Product.php");                         // Require product specific class
    $Product = new Product();

    $Product->ProductDetailRead();                          // Call for product data retrieve function
} else {    
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}