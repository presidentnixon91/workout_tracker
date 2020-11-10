<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Check Records";
	$returnUrl = "update-record";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Update Record<?php print $SITE_TITLE;?></title>
</head>
<body id="update-record">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-update-record">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Update Record</h1>
					<div class="widget">
						
						<?php 
							require('includes/db.php');
							$datatable = $recordsTable;
							// Get ID from url
							$id=$_REQUEST['id'];

							// Set return URL
							$returnUrl = "check-records";
							if(isset($_REQUEST["returnUrl"])) {
								$returnUrl = $_REQUEST["returnUrl"];
							}

							// Find and set all values based on ID
							$sql="SELECT * FROM $datatable WHERE $recordsID=$id";
							$result = $conn->query($sql);
							// Use ID to get values for the other fields
							$row = $result->fetch_assoc();
							$ExerciseSelection = $row["Exercise"];
							$TimesCompleted = $row["TimesCompleted"];
							// Set percentages
							$p50 = $row["p50"];
							$p60 = $row["p60"];
							$p70 = $row["p70"];
							$p80 = $row["p80"];
							$p85 = $row["p85"];
							$p90 = $row["p90"];
							$p95 = $row["p95"];
							$p100 = $row["p100"];
						?>
						<h3>Update <?php echo $ExerciseSelection; ?> records</h3>
						<form class="form-md" action="includes/update-records-submit.php?id=<?php echo $id;?>&returnUrl=<?php echo $returnUrl;?>" method="post">
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 col-md-2 text-right">
										<label for="p50">12 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p50" name="p50" value="<?php echo $p50;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p50&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p60">8 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p60" name="p60" value="<?php echo $p60;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p60&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p70">6 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p70" name="p70" value="<?php echo $p70;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p70&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p80">5 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p80" name="p80" value="<?php echo $p80;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p80&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p85">4 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p85" name="p85" value="<?php echo $p85;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p85&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p90">3 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p90" name="p90" value="<?php echo $p90;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p90&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p95">2 Reps:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p95" name="p95" value="<?php echo $p95;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p95&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-2 text-right">
										<label for="p100">1 Rep:</label> 
									</div>
									<div class="col">
										<input class="form-control" step="0.01" type="number" id="p100" name="p100" value="<?php echo $p100;?>" />
									</div>
									<div class="col-xs-2">
										<?php 
											echo '<a title="Delete" href="includes/delete-record-submit.php?id=' . $row[$recordsID] . '&recordDelete=p100&returnUrl=update-record&recordUpdate=' . $id . '"><img width="15px" height="15px" src="/images/delete-icon.gif" alt="Trash can icon" /></a>';
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" value="Update" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>