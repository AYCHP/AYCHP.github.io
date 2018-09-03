<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> <!-- HTML4 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the web application -->
    <title>CEP - Product management</title>
    
    <!-- Favicon -->
    <link href="/Assets/Img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    
    <!-- Meta data -->
    <meta name="description" content="Line Inspection Tool created for LV Drives factory">
    <meta name="author" content="Martin Onton">

    <!-- Include Bootstrap files -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Custom .css -->
    <link rel="stylesheet" href="Assets/Css/Custom.css">

    <!-- Data table -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.js"></script>
    
</head>

<body>
<header>
    <?php if(!isset($_SESSION)) { session_start();} ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">

            <!-- Brand -->
            <img src="/Assets/Img/*.svg"  width="60" height="22" style="margin-right: 2%;" alt="*">
            <!-- /Brand -->

            <!-- Collapse menu for responsive design -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- /Collapse menu for responsive design -->

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                <?php if(!empty($_SESSION['UserID'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php">Manage products</a>
                            <a class="dropdown-item" href="ProductCreate.php">Create new product</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Variables</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="ProductionBusinessUnitManagement.php">Production business units</a>
                            <a class="dropdown-item" href="ProductionGroupManagement.php">Production groups</a>
                            <a class="dropdown-item" href="ProductionDepartmentManagement.php">Production departments</a>
                            <a class="dropdown-item" href="ProductionLineManagement.php">Production lines</a>
                            <a class="dropdown-item" href="ProductionTypeManagement.php">Production types</a>
                        </div>
                    </li>
                    <?php if($_SESSION['UserGroup'] == 'Administrator'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Users</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="UserManagement.php">Manage users</a>
                            <a class="dropdown-item" href="UserCreate.php">Create user</a>
                            
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"><span style="font-size: 14px;">Logged in as: <?php echo $_SESSION['UserID']; ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="UserLogout.php"><span style="font-size: 14px;">Logout</span></a>
                    </li>
                </ul>
                <?php else: ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>