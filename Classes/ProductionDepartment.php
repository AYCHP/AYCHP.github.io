<?php 

class ProductionDepartment{

    function __construct(){

    }

    /* PRODUCTION DEPARTMENT */

    public function ProductionDepartmentDataRead(){
    
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductionDepartmentDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionDepartmentManagement.php");

    } /* End ProductionLineDataRead() */

    public function ProductionDepartmentDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionDepartmentID = (int)($_GET['ProductionDepartmentID']);
        $params = array($ProductionDepartmentID);
        $query = "EXEC Production.ProductionDepartmentDetailRead @ProductionDepartmentID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionDepartmentDetail.php");

    } /* End ReadData() */

    public function ProductionDepartmentDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Production].[ProductionDepartmentSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionDepartmentManagement.php");

    } /* End ProductionLineDataSearch() */

    public function ProductionDepartmentCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionDepartment = (string)trim($_POST['ProductionDepartment']);

        if(!empty($ProductionDepartment)){
            $ProductionDepartmentParams = array($ProductionDepartment);
            $ProductionDepartmentQuery = "EXEC Production.ProductionDepartmentCreate @ProductionDepartment = ?";
            $ProductionDepartmentStmt = sqlsrv_query($conn, $ProductionDepartmentQuery, $ProductionDepartmentParams);
            $ProductionDepartmentCreateResult = sqlsrv_execute($ProductionDepartmentStmt);
            if($ProductionDepartmentStmt) {
                $_SESSION['SuccessMessage'] = 'Production department has been created.';
            } else {
                $ProductionLineStmt['AlertMessage'] = 'An error occured, production department wasn\'t created.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }

    } /* End ProductionLineCreate() */

    public function ProductionDepartmentUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionDepartmentID = (int)$_POST['ProductionDepartmentID'];
        $ProductionDepartment = (string)trim($_POST['ProductionDepartment']);
        if(!empty($ProductionDepartment)){
            $ProductionDepartmentUpdateParams = array($ProductionDepartmentID,$ProductionDepartment);
            $ProductionDepartmentUpdateQuery = "EXEC Production.ProductionDepartmentUpdate @ProductionDepartmentID = ?, @ProductionDepartment = ?";
            $ProductionDepartmentUpdateStmt = sqlsrv_query($conn, $ProductionDepartmentUpdateQuery, $ProductionDepartmentUpdateParams);
            $ProductionDepartmentUpdateResult = sqlsrv_execute($ProductionDepartmentUpdateStmt);
            if($ProductionDepartmentUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'Production department has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production department wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ProductionLineCreate() */

    public function ProductionDepartmentDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionDepartmentID = (int)$_POST['ProductionDepartmentID'];

        if(!empty($ProductionDepartmentID)){
            $ProductionDepartmentDeleteParams = array($ProductionDepartmentID);
            $ProductionDepartmentDeleteQuery = "EXEC [Production].[ProductionDepartmentDelete] @ProductionDepartmentID = ?";
            $ProductionDepartmentDeleteStmt = sqlsrv_query($conn, $ProductionDepartmentDeleteQuery, $ProductionDepartmentDeleteParams);
            $ProductionDepartmentDeleteResult = sqlsrv_execute($ProductionDepartmentDeleteStmt);
            if($ProductionDepartmentDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Production department has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production department wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true)); 
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

}