<?php 

class Product
{
    public function __construct()
    {
    }

    /*  Function DataRead()
     *  Query error data from Linetool.ErrorData database table according to ID and output data to data_view.php.
     */
    public function ProductDataRead()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');
        
        $query = "EXEC Production.ProductDataRead";
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductManagement.php");
    } /* End ReadData() */

    /*  Function ProductDetailREad()
     *
     */
    public function ProductDetailRead()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');

        $ProductID = (int)($_GET['ProductID']);
        $params = array($ProductID);
        $query = "EXEC Production.ProductDetailRead @ProductID = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductDetail.php");
    } /* End ReadData() */

    /*  Function DataRead()
     *  Query error data from Linetool.ErrorData database table according to ID and output data to data_view.php.
     */
    public function ProductDataSearch()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');

        $SearchTag = (string)trim('%'.$_POST['SearchTag'].'%');
        $params = array($SearchTag);
        $query = "EXEC Production.ProductSearchData @SearchTags = ?";
        $stmt = sqlsrv_query($conn, $query, $params);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        include("Views/ProductManagement.php");
    } /* End ReadData() */

    public function ProductCreate()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');

        $ProfitCenter = (string)trim($_POST['ProfitCenter']);
        $FrameSize = (string)trim($_POST['FrameSize']);
        $TaskListGroup =  (string)trim($_POST['TaskListGroup']);
        $GroupCounter =  (string)trim($_POST['GroupCounter']);
        $ProductionBusinessUnit = (string)trim($_POST['ProductionBusinessUnit']);
        $ProductionGroup = (string)trim($_POST['ProductionGroup']);
        $ProductionDepartment = (string)trim($_POST['ProductionDepartment']);
        $ProductionLine = (string)trim($_POST['ProductionLine']);
        $ProductionType = (string)trim($_POST['ProductionType']);

        if ($FrameSize == '') {
            $FrameSize = null;
        };
        if ($TaskListGroup == '') {
            $TaskListGroup = null;
        };
        if ($GroupCounter=='') {
            $GroupCounter = null;
        };
        if ($ProductionBusinessUnit=='') {
            $ProductionBusinessUnit = null;
        };
        if ($ProductionGroup=='') {
            $ProductionGroup = null;
        };
        if ($ProductionDepartment=='') {
            $ProductionDepartment = null;
        };
        if ($ProductionLine=='') {
            $ProductionLine = null;
        };
        if ($ProductionType=='') {
            $ProductionType = null;
        };
        
        if (!empty($ProfitCenter)) {
            $params = array($ProfitCenter, $FrameSize, $TaskListGroup, $GroupCounter);
            $query = "EXEC [Production].[ProductValidate] @ProfitCenter = ?, @FrameSize = ?, @RoutingGroup = ?, @GroupCounter = ?";
            $stmt = sqlsrv_query($conn, $query, $params);
            $result = sqlsrv_execute($stmt);
            $exist = sqlsrv_has_rows($stmt);
            if ($exist != 0) {
                $_SESSION['AlertMessage'] = 'This product already exists.';
            } else {
                $ProductCreateParams = array($ProfitCenter, $FrameSize, $TaskListGroup, $GroupCounter, $ProductionBusinessUnit, $ProductionGroup, $ProductionDepartment, $ProductionLine, $ProductionType);
                $ProductCreateQuery = "EXEC [Production].[ProductCreate] @ProfitCenter = ?, @FrameSize = ?, @TaskListGroup = ?, @GroupCounter = ?,
                @ProductionBusinessUnit = ?, @ProductionGroup = ?, @ProductionDepartment = ?, @ProductionLine = ?, @ProductionType = ?";
                $ProductCreateStmt = sqlsrv_query($conn, $ProductCreateQuery, $ProductCreateParams);
                $ProductCreateResult = sqlsrv_execute($ProductCreateStmt);
                if ($ProductCreateStmt) {
                    $_SESSION['SuccessMessage'] = 'Product has been created.';
                } else {
                    $_SESSION['AlertMessage'] = 'An error occured, product wasn\'t created.';
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    } /* End ReadData() */
    

    public function ProductUpdate()
    {

        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');

        $ProductID = (int)trim($_POST['ProductID']);
        $ProfitCenter = (string)trim($_POST['ProfitCenter']);
        $FrameSize = (string)trim($_POST['FrameSize']);
        $TaskListGroup =  (string)trim($_POST['TaskListGroup']);
        $GroupCounter =  (string)trim($_POST['GroupCounter']);
        $ProductionBusinessUnit = (string)trim($_POST['ProductionBusinessUnit']);
        $ProductionGroup = (string)trim($_POST['ProductionGroup']);
        $ProductionDepartment = (string)trim($_POST['ProductionDepartment']);
        $ProductionLine = (string)trim($_POST['ProductionLine']);
        $ProductionType = (string)trim($_POST['ProductionType']);

        // Convert blank values to NULL for SQL
        if ($FrameSize == '') {
            $FrameSize = null;
        }
        if ($TaskListGroup == '') {
            $TaskListGroup = null;
        }
        if ($GroupCounter=='') {
            $GroupCounter = null;
        }
        if ($ProductionBusinessUnit=='') {
            $ProductionBusinessUnit = null;
        };
        if ($ProductionGroup=="") {
            $ProductionGroup = null;
        }
        if ($ProductionDepartment=="") {
            $ProductionDepartment = null;
        }
        if ($ProductionLine=="") {
            $ProductionLine = null;
        }
        if ($ProductionType=="") {
            $ProductionType = null;
        }

        if (!empty($ProfitCenter)) {
            $params = array($ProductID, $ProfitCenter, $FrameSize, $TaskListGroup, $GroupCounter, $ProductionBusinessUnit, $ProductionGroup, $ProductionDepartment, $ProductionLine, $ProductionType);
            $query = "EXEC Production.ProductUpdate @ProductID = ?, @ProfitCenter = ?, @FrameSize = ?, @TaskListGroup = ?, @GroupCounter = ?,
            @ProductionBusinessUnit = ?, @ProductionGroup = ?, @ProductionDepartment = ?, @ProductionLine = ?, @ProductionType = ?";
            $stmt = sqlsrv_query($conn, $query, $params);
            $ProductionLineExists = sqlsrv_execute($stmt);
            $exist = sqlsrv_has_rows($stmt);
            if ($stmt) {
                $_SESSION['SuccessMessage'] = 'Product has been modified.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, product wasn\'t modified.';
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

    public function ProductDelete()
    {
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');

        $ProductID = (int)trim($_POST['ProductID']);

        if (!empty($ProductID)) {
            $ProductDeleteParams = array($ProductID);
            $ProductDeleteQuery = "EXEC [Production].[ProductDelete] @ProductID = ?";
            $ProductDeleteStmt = sqlsrv_query($conn, $ProductDeleteQuery, $ProductDeleteParams);
            $ProductDeleteResult = sqlsrv_execute($ProductDeleteStmt);
            if ($ProductDeleteStmt) {
                $_SESSION['SuccessMessage'] = 'Product has been deleted.';
            } else {
                $_SESSION['AlertMessage'] = 'An error occured, product wasn\'t deleted.';
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            $_SESSION['AlertMessage'] = 'Please fill all required data.';
        }
    }

     /* PRODUCTION BU */

     public function ProductionBusinessUnitGetData()
     {
     
         // Require credentials for DB connection.
         require('Configuration/DbConnectCEP.php');
     
         $query = "SELECT DISTINCT [ProductionBusinessUnitID],[ProductionBusinessUnit]
         FROM [Production].[ProductionBusinessUnit]" ;
         $stmt = sqlsrv_query($conn, $query);
         $result = sqlsrv_execute($stmt);
         $exist = sqlsrv_has_rows($stmt);
         
         while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
             echo '<option value="' . $row['ProductionBusinessUnit'] . '">' . $row['ProductionBusinessUnit'] . '</option>';
         }
     } /* End ProductionLineDataRead() */
 
     /* END PRODUCTION BU */


    /* PRODUCTION PG */

    public function ProductionGroupGetData()
    {
    
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');
    
        $query = "SELECT DISTINCT [ProductionGroupID],[ProductionGroup]
        FROM [Production].[ProductionGroup]" ;
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $row['ProductionGroup'] . '">' . $row['ProductionGroup'] . '</option>';
        }
    } /* End ProductionLineDataRead() */

    /* END PRODUCTION PG */

    /* PRODUCTION DEPARTMENT */

    

    public function ProductionDepartmentGetData()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');
        
        $query = "SELECT DISTINCT [ProductionDepartmentID],[ProductionDepartment]
        FROM [Production].[ProductionDepartment]" ;
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $row['ProductionDepartment'] . '">' . $row['ProductionDepartment'] . '</option>';
        }
    } /* End ProductionLineGetData() */

    

    /* END PRODUCTION DEPARTMENT */

    public function ProductionLineGetData()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');
        
        $query = "SELECT DISTINCT [ProductionLine] FROM [Production].[ProductionLine]" ;
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $row['ProductionLine'] . '">' . $row['ProductionLine'] . '</option>';
        }
    } /* End ProductionLineGetData() */

    public function ProductionTypeGetData()
    {
        
        // Require credentials for DB connection.
        require('Configuration/DbConnectCEP.php');
        
        $query = "SELECT DISTINCT [ProductionType] FROM [Production].[ProductionType]" ;
        $stmt = sqlsrv_query($conn, $query);
        $result = sqlsrv_execute($stmt);
        $exist = sqlsrv_has_rows($stmt);
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $row['ProductionType'] . '">' . $row['ProductionType'] . '</option>';
        }
    } /* End ProductionLineGetData() */
}
