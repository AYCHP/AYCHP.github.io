<?php if(!isset($_SESSION)) { session_start();}         // Start session when no sessions have been started ?>

<?php $title="CEP - Product portal user detail";        // Title of the page

if(isset($_SESSION['UserID']) && $_SESSION['UserGroup'] == 'Administrator'){    // Check that user is logged in and is from Admin group
    require("Classes/User.php");                            // Require user specific class
    $User = new User();

    $User->UserDetailRead();                                // Call for user data retrieve function
} else {
    header('Location: index.php');                      // In case user is not logged in redirect to login page    
}