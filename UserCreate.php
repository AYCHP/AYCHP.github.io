<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product portal user creation";    // Title of the page

if(isset($_SESSION['UserID']) && $_SESSION['UserGroup'] == 'Administrator'){    // Check that user is logged in and is from Admin group
    require("Classes/User.php");                            // Require user specific class
    $User = new User();
    if (isset($_POST["UserCreateConfirm"])) {               // If create user post is received, call for user creation function
        $User->UserCreate();                                // Call for user creation function
    }
    include_once 'Views/UserCreate.php';                    // Include correct view
} else {
    header('Location: index.php');                      // In case user is not logged in redirect to login page 
}