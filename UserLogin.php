<?php if(!isset($_SESSION)) { session_start();}     // Start session when no sessions have been started ?>

<?php $title="CEP - Product portal user login";     // Title of the page

require("Classes/User.php");                        // Require UserClass.php to call registration function 

$User = new User();

if (isset($_POST["UserLogin"])) {                   // If login user post is received, call for user login function
    $User->UserLogin();
} ?>

<?php if(isset($_SESSION['UserID'])){
    header('Location: index.php');                  // In case user is logged in redirect to index page 
} else {
    include_once 'header.php';                      // Include correct view
    include_once 'Views/UserLogin.php';             // Include correct view    
}
