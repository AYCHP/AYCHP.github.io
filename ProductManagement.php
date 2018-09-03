<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product management";                // Title of the page    

if(isset($_SESSION['UserID'])){                         // Check that user is logged in
    require("Classes/Product.php");                         // Require product specific class
    $Product = new Product();
    if (isset($_POST["ProductCreateConfirm"])) {            // If creation post is received, call for product creation function
        $Product->ProductCreate();
    }
    if (isset($_POST["ProductConfirmDelete"])) {            // If deletion post is received, call for product deletion function
        $Product->ProductDelete();
    }
    if (isset($_POST["ProductConfirmChange"])) {            // If change post is received, call for product change function
        $Product->ProductUpdate();
    }
    if (isset($_POST["DataSearch"])) {                      // If search post is received, call for product search function
        $Product->ProductDataSearch();
    } else {
        $Product->ProductDataRead();                        // In any other cases, call for product data retrieve function    
    }
} else {
    header('Location: UserLogin.php');                  // In case user is not logged in redirect to login page
}