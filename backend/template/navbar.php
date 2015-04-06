<?php
    // Need to get the user's name from tbl_users
    
    // SESSION is already started.




?>

        <!-- Start top Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">CTS Remote Inventory System</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hi, <?php echo $_SESSION['userName']."!";?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                  </ul>
                </div>
            </div>
        </nav>
        <!-- End top Navbar -->