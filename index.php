<?php if(!isset($_SESSION)) { session_start();}     // Start session when no sessions have been started ?>
<?php if(!empty($_SESSION['UserID'])):header('Location: ProductManagement.php')     // In case user is logged in redirect to product management page ?>
<?php else:  header('Location: UserLogin.php');     // In case user is not logged in redirect to login page  ?>
<?php endif; ?>