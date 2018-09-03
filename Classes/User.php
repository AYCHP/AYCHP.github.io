<?php 

class User{

    function __construct(){
    }

    /* PRODUCTION LINE */

    public function UserLogin(){
        // Require credentials for DB connection.
        require ("Configuration/DbConnectPM.php");
        
        // Begin SQL transaction.
        if ( sqlsrv_begin_transaction( $conn ) === false ) {
            die( print_r( sqlsrv_errors(), true ));
            $_SESSION['AlertMessage'] = 'Connection error.';
        }
        
        // User input from Login Form(login.php).
        $Username = (string)trim(strtoupper($_POST['Username']));   //Username
        $UserPassword = trim($_POST['UserPassword']);   //Password

        // Check that both e-mail and password fields are filled with values.
        if(!empty($Username && $UserPassword)){

            /* Query the username from DB, if response is greater than 0 it means that users exists & 
            *  we continue to compare the password hash provided by the user side with the DB data. 
            */
            $UserLoginParams = array($Username);
            $UserLoginQuery = "EXEC Users.UserLogin @Username = ?";
            $UserLoginStmt = sqlsrv_query($conn, $UserLoginQuery, $UserLoginParams);
            $UserLoginResult = sqlsrv_execute($UserLoginStmt);
            $row = sqlsrv_fetch_array($UserLoginStmt);
            $exist = sqlsrv_has_rows($UserLoginStmt);
            if ($exist == 1) {
                if (password_verify($UserPassword, $row['Password'])) {
                    $_SESSION['UserID'] = $row['Username'];
                    $_SESSION['UserGroup'] = $row['UserGroupDescription'];
                    header('Location: index.php');
                } else {
                    $_SESSION['AlertMessage'] = 'Username or password doesn\'t exist.';
                }
            } else {
                $_SESSION['AlertMessage'] = 'Username or password doesn\'t exist.';
            }
        }
    }   /* End Login() */

    public function UserDataRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');
        
        $query = "EXEC Users.UserDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/UserManagement.php");

    } /* End UserDataRead() */

    public function UserDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');

        $UserID = (int)($_GET['UserAccountID']);
        $params = array($UserID);
        $query = "EXEC [Users].UserDetailRead @UserAccountID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/UserDetail.php");

    } /* End ReadData() */

    public function UserDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Users].[UserSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/UserManagement.php");

    } /* End UserDataSearch() */

    public function UserCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');

        $User = (string)trim(strtoupper($_POST['Username']));
        $Password = (string)trim($_POST['Password']);
        $RPassword = (string)trim($_POST['RPassword']);
        $UserGroup = (string)trim($_POST['UserGroup']);

        if($Password===$RPassword){
            // Password is hashed.
            $hashed = password_hash($Password, PASSWORD_DEFAULT);

            if(!empty($User)){
                $UserParams = array($User,$hashed,$UserGroup);
                $UserQuery = "EXEC Users.UserCreate @Username = ?, @UserPassword = ?, @UserGroup = ?";
                $UserStmt = sqlsrv_query($conn, $UserQuery, $UserParams);
                $UserCreateResult = sqlsrv_execute($UserStmt);
                if($UserStmt) {
                    $_SESSION['SuccessMessage'] = 'User has been created.';
                } else {
                    $UserStmt['AlertMessage'] = 'An error occured, user wasn\'t created.';
                    die( print_r( sqlsrv_errors(), true));  
                }
            } else {
                $_SESSION['AlertMessage'] = 'Please fill all required data.';
            }
        }

    } /* End UserCreate() */

    public function UserUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');

        $UserID = (int)$_POST['UserAccountID'];
        $User = (string)trim($_POST['Username']);
        $Password = (string)trim($_POST['Password']);
        $RPassword = (string)trim($_POST['RPassword']);
        $UserGroup = (string)trim($_POST['UserGroup']);

        if(!empty($Password && $RPassword)){
            if($Password===$RPassword){
                // Password is hashed.
                $hashed = password_hash($Password, PASSWORD_DEFAULT);
    
                if(!empty($UserID)){
                    $UserUpdateParams = array($UserID,$User,$hashed,$UserGroup);
                    $UserUpdateQuery = "EXEC Users.UserUpdate @UserAccountID = ?, @Username = ?, @UserPassword = ?, @UserGroup = ?";
                    $UserUpdateStmt = sqlsrv_query($conn, $UserUpdateQuery, $UserUpdateParams);
                    $UserUpdateResult = sqlsrv_execute($UserUpdateStmt);
                    if($UserUpdateStmt) {
                        $_SESSION['SuccessMessage'] = 'User has been modified.';
                    } else {
                        $_SESSION['AlertMessage'] = 'An error occured, user wasn\'t modified.';
                        die( print_r( sqlsrv_errors(), true));  
                    }
                } else {
                    $_SESSION['AlertMessage'] = 'Please fill all required data.';
                }
            } 
        } else {
            $UserUpdateParams = array($UserID,$User,$UserGroup);
            $UserUpdateQuery = "EXEC Users.UserGroupUpdate @UserAccountID = ?, @Username = ?, @UserGroup = ?";
            $UserUpdateStmt = sqlsrv_query($conn, $UserUpdateQuery, $UserUpdateParams);
            $UserUpdateResult = sqlsrv_execute($UserUpdateStmt);
            if($UserUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'User has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, user wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        }
       
    } /* End UserCreate() */

    public function UserDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');

        $UserID = (int)$_POST['UserAccountID'];

        if(!empty($UserID)){
            $UserDeleteParams = array($UserID);
            $UserDeleteQuery = "EXEC [Users].[UserDelete] @UserAccountID = ?";
            $UserDeleteStmt = sqlsrv_query($conn, $UserDeleteQuery, $UserDeleteParams);
            $UserDeleteResult = sqlsrv_execute($UserDeleteStmt);
            if($UserDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'User has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, user wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true));  
                
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

    public function UserGroupGetData(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectPM.php');
        
        $query = "SELECT DISTINCT [UserGroupDescription] FROM [Users].[UserGroup]" ;
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
            echo '<option value="' . $row['UserGroupDescription'] . '">' . $row['UserGroupDescription'] . '</option>';
        }

    } /* End ProductionLineGetData() */

    

    /* END PRODUCTION LINE */

}