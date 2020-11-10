<div class="row">
	<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
		<div id="check-records-content" class="widget">
		<?php 

			if(empty($returnUrl)) {
				$returnUrl = "check-records";
			}

			// Pull records using exercises
			//$recordsTable = "records_dn";
			$recordsSql="SELECT * FROM $recordsTable WHERE Exercise='$Exercise'";
			$recordsResult = $conn->query($recordsSql);
			$recordsRow = $recordsResult->fetch_assoc();

			// Set percentages
			$r20 = $recordsRow["r20"];
			$r15 = $recordsRow["r15"];
			$p50 = $recordsRow["p50"];
			$p65 = $recordsRow["p65"];
			$p70 = $recordsRow["p70"];
			$p80 = $recordsRow["p80"];
			$p85 = $recordsRow["p85"];
			$p90 = $recordsRow["p90"];
			$p95 = $recordsRow["p95"];
			$p100 = $recordsRow["p100"];

			// Calculate other percentages based on any records found
			if((empty($p50)) && (empty($p65)) && (empty($p70)) && (empty($p80)) && (empty($p85)) && (empty($p90)) && (empty($p95)) && (empty($p100))) {
				$recordFound = false;
				$percentFound = false;
			} else {
				$recordFound = true;
				$percentFound = true;
			}
			if(!empty($r20) || (!empty($r15))) {
				$recordFound = true;
			}
			// Set the 1 percent
			if(!empty($p100)) {
				$p1 = $p100 / 100;
			}
			if(!empty($p95)) {
				$p2 = $p95 / 95;
				if(empty($p1) || $p2 > $p1) {
					$p1 = $p2;
				}
			}
			if(!empty($p90)) {
				$p3 = $p90 / 90;
				if(empty($p1) || $p3 > $p1) {
					$p1 = $p3;
				}
			}
			if(!empty($p85)) {
				$p4 = $p85 / 85;
				if(empty($p1) || $p4 > $p1) {
					$p1 = $p4;
				}
			}
			if(!empty($p80)) {
				$p5 = $p80 / 80;
				if(empty($p1) || $p5 > $p1) {
					$p1 = $p5;
				}
			}
			if(!empty($p70)) {
				$p6 = $p70 / 70;
				if(empty($p1) || $p6 > $p1) {
					$p1 = $p6;
				}
			}
			if(!empty($p65)) {
				$p7 = $p65 / 65;
				if(empty($p1) || $p7 > $p1) {
					$p1 = $p7;
				}
			}
			if(!empty($p50)) {
				$p8 = $p50 / 50;
				if(empty($p1) || $p8 > $p1) {
					$p1 = $p8;
				}
			}
			if($percentFound) {
				// Find the highest 1 percent from all records
				for($i = 1; $i < 9; $i++) {
					if(isset($p[$i])) {
						if($p[$i] > $p1) {
							$p1 = $p[$i];
						}
					}
					$i++;
				}
				// Calculate 101 percent
				$p101 = ceil($p1 * 101);
			}

			// Display exercise records
			echo '<h3>'.$Exercise.' records</h3>';
			if(!$recordFound) {
				echo '<p>No records found.</p>';
			} else {
				echo '<ul>';
				if(!empty($r20)) {
					echo '<li>20 reps record: ' . $r20 . '</li>';
				}
				if(!empty($r15)) {
					echo '<li>15 reps record: ' . $r15 . '</li>';
				}
				if(!empty($p50)) {
					echo '<li>12 reps record: ' . $p50 . '</li>';
				}
				if(!empty($p65)) {
					echo '<li>8 reps record: ' . $p65 . '</li>';
				}
				if(!empty($p70)) {
					echo '<li>6 reps record: ' . $p70 . '</li>';
				}
				if(!empty($p80)) {
					echo '<li>5 reps record: ' . $p80 . '</li>';
				}
				if(!empty($p85)) {
					echo '<li>4 reps record: ' . $p85 . '</li>';
				}
				if(!empty($p90)) {
					echo '<li>3 reps record: ' . $p90 . '</li>';
				}
				if(!empty($p95)) {
					echo '<li>2 reps record: ' . $p95 . '</li>';
				}
				if(!empty($p100)) {
					echo '<li>1 reps record: ' . $p100 . '</li>';
				}
				echo '</ul>';
				echo '<p><a title="Edit" href="update-record.php?id=' . $recordsRow[$recordsID] . '&returnUrl=' . $returnUrl . '">Edit records</a>';
			?>
		</div>
	</div>
	<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
		<div id="percentageEstimates" class="widget">
			<?php 
				echo '<h3>Percentage estimates</h3><ul>';
				$p50 = (($p1 * 50) * 4);
				$p50 = floor($p50);
				$p50 = $p50 / 4;
				echo '<li>12 reps (50%): ' . $p50 . '</li>';
				$p65 = (($p1 * 65) * 4);
				$p65 = floor($p65);
				$p65 = $p65 / 4;
				echo '<li>8 reps (65%): ' . $p65 . '</li>';
				$p70 = (($p1 * 70) * 4);
				$p70 = floor($p70);
				$p70 = $p70 / 4;
				echo '<li>6 reps (70%): ' . $p70 . '</li>';
				$p80 = (($p1 * 80) * 4);
				$p80 = floor($p80);
				$p80 = $p80 / 4;
				echo '<li>5 reps (80%): ' . $p80 . '</li>';
				$p85 = (($p1 * 85) * 4);
				$p85 = floor($p85);
				$p85 = $p85 / 4;
				echo '<li>4 reps (85%): ' . $p85 . '</li>';
				$p90 = (($p1 * 90) * 4);
				$p90 = floor($p90);
				$p90 = $p90 / 4;
				echo '<li>3 reps (90%): ' . $p90 . '</li>';
				$p95 = (($p1 * 95) * 4);
				$p95 = floor($p95);
				$p95 = $p95 / 4;
				echo '<li>2 reps (95%): ' . $p95 . '</li>';
				$p100 = (($p1 * 100) * 4);
				$p100 = floor($p100);
				$p100 = $p100 / 4;
				echo '<li>1 rep (100%): ' . $p100 . '</li>';
				echo '<li>101%: ' . $p101 . '</li>';
				echo '</ul>';
			}
			?>
		</div>
	</div>
</div>