<div id="clients" class="tab-pane fade in active">
	<h3>Clients of our System</h3>
<!-- 	<div class="ratio row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h4>Client&apos;s Gender Ratio</h4>
			<div id="pie"></div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h4>Active Client&apos;s Ratio</h4>
			<div id="pie"></div>
		</div>
	</div> -->
	<table class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Contact Number</th>
				<th>Address | Street N0.</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				include 'components/database.php';
				$conn = connectDB();
				if ($conn) {
					$sql = "SELECT * FROM clients, addresses WHERE clients.add_id=addresses.add_id;";
					$result = mysqli_query($conn, $sql);
					if ($result) {
						$num = mysqli_num_rows($result);
						echo "<br><h4>Total number of clients is: <b id='clients-num'>".$num."</b></h4>";
						for ($i=0; $i < $num; $i++) { 
							$row = mysqli_fetch_assoc($result);
							$add_id = $row['add_id'];
							$cid = $row['cid'];
							$dp = $row['src'];
							$fname = $row['firstname'];
							$lname = $row['lastname'];
							$email = $row['email'];
							$gender = $row['gender'];
							$contact = $row['contact'];
							$street = $row['street_no'];
							$town = $row['town'];
							$city = $row['city'];
							$state = $row['state'];
							echo "<tr id='for-".$cid."'>";
							echo "<td class='f-o-f-dp'><div class='user-dp user-dp-xs' style='background-image: url(\"".$dp."\");' onclick=\"changePicture('$dp', '$fname $lname', $cid)\"></div></td>";
							echo "<td class='c-fname'>".ucfirst($fname)."</td>";
							echo "<td class='c-lname'>".ucfirst($lname)."</td>";
							echo "<td class='c-email'><a onclick=\"clientMail('".$email."')\">".$email."</a></td>";
							echo "<td class='c-gender'>".ucfirst($gender)."</td>";
							echo "<td class='c-cont'>".$contact."</td>";
							echo "<td><a onclick=\"address('".$street."', '".$town."', '".$city."', '".$state."', $add_id)\">".$street."</a></td>";
							echo "<td class='text-center act'>";
								echo $row['active'] == 0 ? "<i class='fa fa-remove text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
							echo "</td>";
							echo "<td>";
								echo "<div class='dropdown'> <button class='btn btn-primary btn-xs btn-block dropdown-toggle' data-toggle='dropdown'> User <i class='fa fa-chevron-down fa-fw'></i> </button> <ul class='dropdown-menu dropdown-menu-right'> <li><a>";
									echo "<button class='btn btn-block btn-sm btn-primary' onclick=\"edit('".$fname."', '".$lname."', '".$email."', '".$gender."', '".$contact."', '".$dp."', '".$street."', '".$town."', '".$city."', '".$state."', $cid, $add_id)\"><i class='fa fa-pencil'></i> Edit</button> "; 
								echo "</a></li><li><a>";
									echo "<button class='btn btn-block btn-sm btn-danger' onclick=\"kickout('".$fname."', ".$cid.")\"><i class='fa fa-user-times'></i> Kickout</button> "; 
								echo "</a></li><li><a>";
									echo $row['active'] == 0
									? 
									"<button class='btn btn-block btn-sm btn-success' onclick=\"activate('".$fname."', ".$cid.");\"><i class='fa fa-check'></i> Activate</button>"
									:
									"<button class='btn btn-block btn-sm btn-warning' onclick=\"deactivate('".$fname."', ".$cid.");\"><i class='fa fa-remove'></i> Deactivate</button>"; 
								echo "</a></li><li id='adminMBtn-".$cid."'><a>";
									echo "<button class='btn btn-block btn-sm btn-info' onclick=\"makeAdmin('".$fname."', ".$cid.");\"><i class='fa fa-user-secret'></i> Make Admin</button>";
								echo "</a></li></ul> </div>";
							echo"</td>
							</tr>";
						}
					}
				}
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</div>
