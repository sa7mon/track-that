<!--
		projects.php - View all projects 
		Created On: 2/24/15
		Created By: Dan
-->
<?php
    require_once('template/security.php');

	// If there's no view set, which one should we re-direct to?
	$DEFAULT_TAB = "active";
	
	if (!isset($_GET['view'])) {
		// There's no view parameter set in the address. Automatically re-direct to the default
		header('Location: projects.php?view='.$DEFAULT_TAB);
		die();
	}

	// Get the view to determine which tab should be active
	$activeTab = $_GET['view'];
?>
<head>
    <meta charset="UTF-8">
    <title>Inventory System - Projects</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/projects.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body>
	<?php 
		require_once("template/navbar.php"); 
		require_once("db/sql.php");
		require_once("template/includes.php");
	?>
	<div class="container-fluid"> <!-- container-fluid div should wrap everything under the top navbar -->
	    <div class="row">
	    	<!-- Output the sidebar from the template folder -->
	        <?php 
	        $sidebarActivePage = "projects-overview";
	        require_once("template/sidebar.php"); ?>
	        
			<div class="col-md-offset-2 maincontent">
				<!-- Page content goes here -->
				<h1 class="page-header">Projects</h1>

				<!-- Tabs here -->
				<ul class="nav nav-tabs">
					<li role="presentation" 
						<?php echo ($activeTab == "active" ? "class='active'" : "")?>>
						<a href="projects.php?view=active">Active</a>
					</li>
					<li role="presentation" 
						<?php echo ($activeTab == "inactive" ? "class='active'" : "")?>>
						<a href="projects.php?view=inactive">Inactive</a>
					</li>
					<li role="presentation" 
						<?php echo ($activeTab == "all" ? "class='active'" : "")?>>
						<a href="projects.php?view=all">All</a>
					</li>
					<li role="presentation" class="dropdown"> 
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							Edit<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li role="presentation"><a href="addproject.php" role="menuitem">Add New</a></li>
							<li role="presentation"><a href="editproject.php" role="menuitem">Change Status</a></li>
						</ul>
					</li>
				</ul>
				<!-- End of tabs -->
				<!-- Content of tab here -->
				<?php
					// Display content based on the view selected
					switch($activeTab) {
						case "active":
							?>
							<table id="viewActive" class="table table-striped">
								<tr>
									<th>Added</th>
									<th>Name</th>
									<th>Total Products</th>
								</tr>
								<?php
								// Execute query stored in sql.php
								$rsltActiveProjects = mysqli_query($conn, $qryGetActiveProjects);
								// Loop through the results
								while($row = mysqli_fetch_array($rsltActiveProjects)) {
									// Make a table row with each row.
									echo "<tr>\n\t";
									echo "<td>".formatTime($row['updated_on'])."</td>\n";
									echo "<td><a href='products.php?projid=".$row['proj_id']."'>".$row['proj_name']."</a></td>\n";
									echo "<td>".$row['productsPerProject']."</td>";
								}
								// Free the resultset to free up memory.
								mysqli_free_result($rsltActiveProjects);
								?>
							</table>
							<?php
							break;
						case "inactive":
							?>
							<table id="viewInactive" class="table table-striped">
								<tr>
									<th>Added</th>
									<th>Name</th>
									<th>Total Products</th>
								</tr>
								<?php
								// Execute query
								$rsltInactiveProjects = mysqli_query($conn, $qryGetInactiveProjects);

								//Loop through the results
								while($row = mysqli_fetch_array($rsltInactiveProjects)) {
									echo "<tr>\n\t";
									echo "<td>".formatTime($row['updated_on'])."</td>\n";
									echo "<td><a href='products.php?projid=".$row['proj_id']."'>".$row['proj_name']."</a></td>\n";
									echo "<td>".$row['productsPerProject']."</td>";
								}
								// Free the resultset to free up memory.
								mysqli_free_result($rsltInactiveProjects);
								?>
							</table>
							<?php
							break;
						case "all":
							?>
							<table id="viewAll" class="table table-striped">
								<tr>
									<th>Added</th>
									<th>Name</th>
									<th>Status</th>
									<th>Total Products</th>
								</tr>
								<?php
								// Execute query
								$rsltAllProjects = mysqli_query($conn, $qryGetAllProjects);
								// Loop through results
								while($row = mysqli_fetch_array($rsltAllProjects)) {
									echo "<tr>\n\t";
									echo "<td>".formatTime($row['updated_on'])."</td>\n";
									echo "<td><a href='products.php?projid=".$row['proj_id']."'>".$row['proj_name']."</a></td>\n";
									echo "<td>".$row['status']."</td>";
									echo "<td>".$row['productsPerProject']."</td>";
								}
								// Free the resultset to free up memory.
								mysqli_free_result($rsltAllProjects);
								?>
							</table>
							<?php
							break;
						default:
							//Something went wrong.
							echo "Something went wrong. Please go back to the home page and start over.";
					}
					// Close the connection to the database
					mysqli_close($conn);
				?>
			</div>
	    </div>
	</div>
	<?php require_once("template/footer.php"); ?>