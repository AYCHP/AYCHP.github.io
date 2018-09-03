<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product portal user management";    // Title of the page

if(isset($_SESSION['UserID']) && $_SESSION['UserGroup'] == 'Administrator'){    // Check that user is logged in and is from Admin group
    require("Classes/User.php");                        // Require user specific class
    $User = new User();

    if (isset($_POST["UserConfirmDelete"])) {           // If deletion post is received, call for user deletion function  
        $User->UserDelete();
    }
    if (isset($_POST["UserConfirmChange"])) {           // If change post is received, call for user change function
        $User->UserUpdate();
    }
    if (isset($_POST["UserDataSearch"])) {              // If search post is received, call for user search function
        $User->UserDataSearch();
    } else {
        $User->UserDataRead();                          // In any other cases, call for user data retrieve function     
    }
} else {
    header('Location: index.php');                  // In case user is not logged in redirect to login page                                                    
}