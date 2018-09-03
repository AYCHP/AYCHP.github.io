<?php 

class ProductionLine{

    function __construct(){

    }

    /* PRODUCTION LINE */

    public function ProductionLineDataRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductionLineDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionLineManagement.php");

    } /* End ProductionLineDataRead() */

    public function ProductionLineDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionLineID = (int)($_GET['ProductionLineID']);
        $params = array($ProductionLineID);
        $query = "EXEC Production.ProductionLineDetailRead @ProductionLineID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionLineDetail.php");

    } /* End ReadData() */

    public function ProductionLineDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Production].[ProductionLineSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionLineManagement.php");

    } /* End ProductionLineDataSearch() */

    public function ProductionLineCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionLine = (string)trim($_POST['ProductionLine']);

        if(!empty($ProductionLine)){
            $ProductionLineParams = array($ProductionLine);
            $ProductionLineQuery = "EXEC Production.ProductionLineCreate @ProductionLine = ?";
            $ProductionLineStmt = sqlsrv_query($conn, $ProductionLineQuery, $ProductionLineParams);
            $ProductCreateResult = sqlsrv_execute($ProductionLineStmt);
            if($ProductionLineStmt) {
                $_SESSION['SuccessMessage'] = 'Production line has been created.';
            } else {
                $ProductionLineStmt['AlertMessage'] = 'An error occured, production line wasn\'t created.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }

    } /* End ProductionLineCreate() */

    public function ProductionLineUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionLineID = (int)$_POST['ProductionLineID'];
        $ProductionLine = (string)trim($_POST['ProductionLine']);
        if(!empty($ProductionLine)){
            $ProductionLineUpdateParams = array($ProductionLineID,$ProductionLine);
            $ProductionLineUpdateQuery = "EXEC Production.ProductionLineUpdate @ProductionLineID = ?, @ProductionLine = ?";
            $ProductionLineUpdateStmt = sqlsrv_query($conn, $ProductionLineUpdateQuery, $ProductionLineUpdateParams);
            $ProductUpdateResult = sqlsrv_execute($ProductionLineUpdateStmt);
            if($ProductionLineUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'Production line has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production line wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ProductionLineCreate() */

    public function ProductionLineDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionLineID = (int)$_POST['ProductionLineID'];

        if(!empty($ProductionLineID)){
            $ProductionLineDeleteParams = array($ProductionLineID);
            $ProductionLineDeleteQuery = "EXEC [Production].[ProductionLineDelete] @ProductionLineID = ?";
            $ProductionLineDeleteStmt = sqlsrv_query($conn, $ProductionLineDeleteQuery, $ProductionLineDeleteParams);
            $ProductionLineDeleteResult = sqlsrv_execute($ProductionLineDeleteStmt);
            if($ProductionLineDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Production line has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production line wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true));  
                
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

    /* END PRODUCTION LINE */
}