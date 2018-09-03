<?php 

class ProductionBusinessUnit{

    function __construct(){

    }

    /* PRODUCTION BusinessUnit */

    public function ProductionBusinessUnitDataRead(){
    
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductionBusinessUnitDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionBusinessUnitManagement.php");

    } /* End ProductionLineDataRead() */

    public function ProductionBusinessUnitDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionBusinessUnitID = (int)($_GET['ProductionBusinessUnitID']);
        $params = array($ProductionBusinessUnitID);
        $query = "EXEC Production.ProductionBusinessUnitDetailRead @ProductionBusinessUnitID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionBusinessUnitDetail.php");

    } /* End ReadData() */

    public function ProductionBusinessUnitDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Production].[ProductionBusinessUnitSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionBusinessUnitManagement.php");

    } /* End ProductionLineDataSearch() */

    public function ProductionBusinessUnitCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionBusinessUnit = (string)trim($_POST['ProductionBusinessUnit']);

        if(!empty($ProductionBusinessUnit)){
            $ProductionBusinessUnitParams = array($ProductionBusinessUnit);
            $ProductionBusinessUnitQuery = "EXEC Production.ProductionBusinessUnitCreate @ProductionBusinessUnit = ?";
            $ProductionBusinessUnitStmt = sqlsrv_query($conn, $ProductionBusinessUnitQuery, $ProductionBusinessUnitParams);
            $ProductionBusinessUnitCreateResult = sqlsrv_execute($ProductionBusinessUnitStmt);
            if($ProductionBusinessUnitStmt) {
                $_SESSION['SuccessMessage'] = 'Production business unit has been created.';
            } else {
                $ProductionLineStmt['AlertMessage'] = 'An error occured, production business unit wasn\'t created.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }

    } /* End ProductionLineCreate() */

    public function ProductionBusinessUnitUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionBusinessUnitID = (int)$_POST['ProductionBusinessUnitID'];
        $ProductionBusinessUnit = (string)trim($_POST['ProductionBusinessUnit']);
        if(!empty($ProductionBusinessUnit)){
            $ProductionBusinessUnitUpdateParams = array($ProductionBusinessUnitID,$ProductionBusinessUnit);
            $ProductionBusinessUnitUpdateQuery = "EXEC Production.ProductionBusinessUnitUpdate @ProductionBusinessUnitID = ?, @ProductionBusinessUnit = ?";
            $ProductionBusinessUnitUpdateStmt = sqlsrv_query($conn, $ProductionBusinessUnitUpdateQuery, $ProductionBusinessUnitUpdateParams);
            $ProductionBusinessUnitUpdateResult = sqlsrv_execute($ProductionBusinessUnitUpdateStmt);
            if($ProductionBusinessUnitUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'Production business unit has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production business unit wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ProductionLineCreate() */

    public function ProductionBusinessUnitDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionBusinessUnitID = (int)$_POST['ProductionBusinessUnitID'];

        if(!empty($ProductionBusinessUnitID)){
            $ProductionBusinessUnitDeleteParams = array($ProductionBusinessUnitID);
            $ProductionBusinessUnitDeleteQuery = "EXEC [Production].[ProductionBusinessUnitDelete] @ProductionBusinessUnitID = ?";
            $ProductionBusinessUnitDeleteStmt = sqlsrv_query($conn, $ProductionBusinessUnitDeleteQuery, $ProductionBusinessUnitDeleteParams);
            $ProductionBusinessUnitDeleteResult = sqlsrv_execute($ProductionBusinessUnitDeleteStmt);
            if($ProductionBusinessUnitDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Production business unit has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production business unit wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true)); 
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

}