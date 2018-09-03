<?php 

class ProductionGroup{

    function __construct(){

    }

    /* PRODUCTION Group */

    public function ProductionGroupDataRead(){
    
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductionGroupDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionGroupManagement.php");

    } /* End ProductionLineDataRead() */

    public function ProductionGroupDetailRead(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionGroupID = (int)($_GET['ProductionGroupID']);
        $params = array($ProductionGroupID);
        $query = "EXEC Production.ProductionGroupDetailRead @ProductionGroupID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionGroupDetail.php");

    } /* End ReadData() */

    public function ProductionGroupDataSearch(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%'); 
        
        $params = array($SearchTag);
        $query = "EXEC [Production].[ProductionGroupSearchData] @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductionGroupManagement.php");

    } /* End ProductionLineDataSearch() */

    public function ProductionGroupCreate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionGroup = (string)trim($_POST['ProductionGroup']);

        if(!empty($ProductionGroup)){
            $ProductionGroupParams = array($ProductionGroup);
            $ProductionGroupQuery = "EXEC Production.ProductionGroupCreate @ProductionGroup = ?";
            $ProductionGroupStmt = sqlsrv_query($conn, $ProductionGroupQuery, $ProductionGroupParams);
            $ProductionGroupCreateResult = sqlsrv_execute($ProductionGroupStmt);
            if($ProductionGroupStmt) {
                $_SESSION['SuccessMessage'] = 'Production group has been created.';
            } else {
                $ProductionLineStmt['AlertMessage'] = 'An error occured, production group wasn\'t created.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }

    } /* End ProductionLineCreate() */

    public function ProductionGroupUpdate(){
        
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionGroupID = (int)$_POST['ProductionGroupID'];
        $ProductionGroup = (string)trim($_POST['ProductionGroup']);
        if(!empty($ProductionGroup)){
            $ProductionGroupUpdateParams = array($ProductionGroupID,$ProductionGroup);
            $ProductionGroupUpdateQuery = "EXEC Production.ProductionGroupUpdate @ProductionGroupID = ?, @ProductionGroup = ?";
            $ProductionGroupUpdateStmt = sqlsrv_query($conn, $ProductionGroupUpdateQuery, $ProductionGroupUpdateParams);
            $ProductionGroupUpdateResult = sqlsrv_execute($ProductionGroupUpdateStmt);
            if($ProductionGroupUpdateStmt) {
                $_SESSION['SuccessMessage'] = 'Production group has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production group wasn\'t modified.';
                die( print_r( sqlsrv_errors(), true));  
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ProductionLineCreate() */

    public function ProductionGroupDelete(){
        // Require credentials for DB connection.
        require ('Configuration/DbConnectCEP.php');

        $ProductionGroupID = (int)$_POST['ProductionGroupID'];

        if(!empty($ProductionGroupID)){
            $ProductionGroupDeleteParams = array($ProductionGroupID);
            $ProductionGroupDeleteQuery = "EXEC [Production].[ProductionGroupDelete] @ProductionGroupID = ?";
            $ProductionGroupDeleteStmt = sqlsrv_query($conn, $ProductionGroupDeleteQuery, $ProductionGroupDeleteParams);
            $ProductionGroupDeleteResult = sqlsrv_execute($ProductionGroupDeleteStmt);
            if($ProductionGroupDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Production group has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, production group wasn\'t deleted.';
                die( print_r( sqlsrv_errors(), true)); 
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

}