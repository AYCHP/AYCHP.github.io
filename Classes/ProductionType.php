<?php 

class ProductionType{

    function __construct(){

    }

    /* PRODUCTION Group */

    public function ProductionTypeDataRead(){
    
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductionTypeDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionTypeManagement.php");

    } /* End ProductionLineDataRead() */

    public function ProductionTypeDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionTypeID = (int)($_GET['ProductionTypeID']);
        $params = array($ProductionTypeID);
        $query = "EXEC Production.ProductionTypeDetailRead @ProductionTypeID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionTypeDetail.php");

    } /* End ReadData() */

    public function ProductionTypeDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Production].[ProductionTypeSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionTypeManagement.php");

    } /* End ProductionLineDataSearch() */

    public function ProductionTypeCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionType = (string)trim($_POST['ProductionType']);

        if(!empty($ProductionType)){
            $ProductionTypeParams = array($ProductionType);
            $ProductionTypeQuery = "EXEC Production.ProductionTypeCreate @ProductionType = ?";
            $ProductionTypeStmt = sqlsrv_query($conn, $ProductionTypeQuery, $ProductionTypeParams);
            $ProductionTypeCreateResult = sqlsrv_execute($ProductionTypeStmt);
            if($ProductionTypeStmt) {
                $_SESSION['SuccessMessage'] = 'Production type has been created.';
            } else {
                $ProductionLineStmt['AlertMessage'] = 'An error occured, production type wasn\'t created.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }

    } /* End ProductionLineCreate() */

    public function ProductionTypeUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionTypeID = (int)$_POST['ProductionTypeID'];
        $ProductionType = (string)trim($_POST['ProductionType']);
        if(!empty($ProductionType)){
            $ProductionTypeUpdateParams = array($ProductionTypeID,$ProductionType);
            $ProductionTypeUpdateQuery = "EXEC Production.ProductionTypeUpdate @ProductionTypeID = ?, @ProductionType = ?";
            $ProductionTypeUpdateStmt = sqlsrv_query($conn, $ProductionTypeUpdateQuery, $ProductionTypeUpdateParams);
            $ProductionTypeUpdateResult = sqlsrv_execute($ProductionTypeUpdateStmt);
            if($ProductionTypeUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'Production type has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production type wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ProductionLineCreate() */

    public function ProductionTypeDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionTypeID = (int)$_POST['ProductionTypeID'];

        if(!empty($ProductionTypeID)){
            $ProductionTypeDeleteParams = array($ProductionTypeID);
            $ProductionTypeDeleteQuery = "EXEC [Production].[ProductionTypeDelete] @ProductionTypeID = ?";
            $ProductionTypeDeleteStmt = sqlsrv_query($conn, $ProductionTypeDeleteQuery, $ProductionTypeDeleteParams);
            $ProductionTypeDeleteResult = sqlsrv_execute($ProductionTypeDeleteStmt);
            if($ProductionTypeDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Production type has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production type wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true)); 
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

}