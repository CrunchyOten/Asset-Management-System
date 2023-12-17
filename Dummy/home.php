<?php 
session_start();
include "db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>

<!DOCTYPE html>
<html>

<head>
	<title>HOME PAGE</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  	<link rel="icon" type="image/png" href="img/icon.png">
</head>

<style>
.navcustom {
	background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(57, 196, 192));
}

.table-wrapper
{
    width: 100%;
    height: 400px;
    overflow: auto;
}

.table-wrapper2 {
	width: 100%;
    height: 340px;
    overflow: auto;
}

.table-wrapper3 {
	width: 100%;
    height: 350px;
    overflow: auto;
}

/* width */
::-webkit-scrollbar {
  width: 2px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 2px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: grey; 
  border-radius: 2px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: black; 
}
</style>	

<body>

<nav class="navbar navbar-expand-md navbar-light navcustom">
  	<a class="navbar-brand">Asset Management System</a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    		<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
    		<ul class="navbar-nav ml-auto">
      		<li class="nav-item">
        			<a class="nav-link" href="logout.php">Log Out</a>
      		</li>    
    		</ul>
  	</div>  
</nav>

<!---FOR ADMIN-->
<div class="container-fluid bg-image" style="background-image: url('img/bg2.png'); width: 100%;">
	<div class="row">
		<div class="col-sm-12">    
      		<?php if ($_SESSION['role'] == 'Admin') {?>
			<br><h4 style="color: white;">Hello!</h4><h3 style="color: white;"><?=$_SESSION['name']?></h3>
		</div>
	</div>
</div>

<!---CREATE NEW USER FUNCTION-->
<div class="container-fluid" style="margin-top:40px;">
	<form action="php/createU.php" method="post">
		<div class="row">
			<div class="col-sm-5">

				<h3>Create New User</h3><br>

				<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
				</div>
				<?php } ?>	

				<?php if (isset($_GET['created'])) { ?>
				<div class="alert alert-success" role="alert">
				<?= htmlspecialchars($_GET['created']); ?>
				</div>
				<?php } ?>	

				<label> Name </label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Complete Name" autocomplete="off"><br>

				<label> Username </label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Preferred Username" autocomplete="off"><br>

				<label> Password </label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off"><br>

				<label> User Type </label>	
				<select class="form-control" name="role">
					<option disabled>Please select..</option>
					<option>Supervisor</option>	
					<option>Admin</option>	
					<option>IT Staff</option>	
					<option>Agent</option>	
				</select><br>

				<button type="submit" class="btn btn-primary" name="create" style="width:100%; margin-bottom: 30px;">Create</button>			
	</form>
</div>

<!---USERS DATABASE TABLE-->
<div class="col-sm-7">				
	<?php include 'php/members.php';
      if (mysqli_num_rows($res) > 0) {?>

		<h3>User Accounts</h3><br>

		<?php if (isset($_GET['success'])) { ?>
		<div class="alert alert-success" role="alert">
			<?= htmlspecialchars($_GET['success']); ?>
		</div>
		<?php } ?>

		<?php if (isset($_GET['deleted'])) { ?>
		<div class="alert alert-success" role="alert">
			<?= htmlspecialchars($_GET['deleted']); ?>
		</div>
		<?php } ?>

		<div class="table-responsive table-wrapper">
			<table class="table text-center table table-striped table-bordered">
				<thead class="thead-dark">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">User Name</th>
						<th scope="col">Role</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				   	<tr>
				      	<th scope="row"><?=$i?></th>
				      	<td><?=$rows['name']?></td>
				      	<td><?=$rows['username']?></td>
				      	<td><?=$rows['role']?></td>
				      	<td><a href="updateusers.php?id=<?=$rows['id']?>" class="btn btn-success" style="margin-bottom: 10px;">Update</a>
				      		<a href="php/deleteU.php?id=<?=$rows['id']?>" class="btn btn-danger" style="margin-bottom: 10px;">&nbsp;Delete&nbsp;</a>
			      		</td>
				   	</tr>
				<?php $i++; }?>
				</tbody>
			</table>
		</div>		
		<?php }?>
	</div>
</div>

<!---FOR SUPERVISOR-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12"> 
      		<?php } else if ($_SESSION['role'] == 'Supervisor'){ ?>
			<br><h4 style="color: white;">Hello!</h4><h3 style="color: white;"><?=$_SESSION['name']?></h3>
		</div>
	</div>
</div>

<!---CREATE NEW ASSET FUNCTION-->
<div class="container-fluid" style="margin-top:40px;">
	<form action="php/createA.php" method="post">
		<div class="row">
			<div class="col-sm-5">

				<h3>Create New Asset</h3><br>

				<?php if (isset($_GET['createdAsset'])) { ?>
				<div class="alert alert-success" role="alert">
				<?= htmlspecialchars($_GET['createdAsset']); ?>
				</div>
				<?php } ?>

				<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
				</div>
				<?php } ?>		

				<label> Asset Type </label>
				<input type="text" class="form-control" id="device" name="device" placeholder="Type of Asset e.g (Laptop, Computer, Mouse, etc.)" autocomplete="off"><br>

				<label for="brand"> Asset Brand Name </label>
				<input type="text" class="form-control" id="brand" name="brand" placeholder="Name of the Asset Brand" autocomplete="off" oninput="this.value = this.value.toUpperCase();"><br>

				<label> Asset Specifications </label>
				<input type="text" class="form-control" id="specs" name="specs" placeholder="Asset Specifications" autocomplete="off"><br>

				<label> Asset Serial Number </label>
				<input type="text" class="form-control" id="serialno" name="serialno" placeholder="Input exact Serial Number" autocomplete="off" maxlength="7"><br>

				<button type="submit" class="btn btn-primary" name="create" style="width:100%; margin-bottom: 30px;">Create</button>			
	</form>
</div>

<div class="col-sm-7">			
	<?php include 'php/asset.php';
      if (mysqli_num_rows($res) > 0) {?>
                  
	<h3>List of Assets</h3><br>

	<?php if (isset($_GET['Assetupdated'])) { ?>
	<div class="alert alert-success" role="alert">
		<?= htmlspecialchars($_GET['Assetupdated']); ?>
	</div>
	<?php } ?>

	<div class="table-responsive table-wrapper2">
		<table class="table text-center table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Asset Type</th>
					<th scope="col">Brand Name</th>				
					<th scope="col">Specifications</th>
					<th scope="col">Serial Number</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
	<?php 
			$i =1;
				while ($rows = mysqli_fetch_assoc($res)) {?>
				<tr>
				    <th scope="row"><?=$i?></th>
				    <td><?=$rows['device']?></td>
				    <td><?=$rows['brand']?></td>				      
				    <td><?=$rows['specs']?></td>
				    <td><?=$rows['serialno']?></td>

				    <td><a href="updateAss.php?id=<?=$rows['id']?>" class="btn btn-success" style="margin-bottom: 10px;">Update</a>
				     		<a href="php/deleteAss.php?id=<?=$rows['id']?>" class="btn btn-danger" style="margin-bottom: 10px;"> Delete&nbsp;</a>
			     	</td>
				</tr>
	<?php $i++; }?>
			</tbody>
		</table>
	</div>		
	<?php }?>
</div>
</div>

<div>
</div>
	
<!---FOR IT STAFF-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12"> 
      		<?php } else if ($_SESSION['role'] == 'IT Staff'){ ?>
			<br><h4 style="color: white;">Hello!</h4><h3 style="color: white;"><?=$_SESSION['name']?></h3>
		</div>
	</div>
</div>

<div class="container-fluid">			
	<?php include 'php/reqdev.php';
      if (mysqli_num_rows($res) > 0) {?>
                  
	<br><br><h3>IT Staff Management</h3><br>

	<?php if (isset($_GET['updated'])) { ?>
	<div class="alert alert-success" role="alert">
		<?= htmlspecialchars($_GET['updated']); ?>
	</div>
	<?php } ?>

	<div class="table-responsive table-wrapper2">
		<table class="table text-center table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Asset</th>				
					<th scope="col">Asset Brand</th>
					<th scope="col">Specifications</th>
					<th scope="col">Serial Number</th>
					<th scope="col">Date Requested</th>
					<th scope="col">Date Released</th>										
					<th scope="col">Status</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
	<?php 
			$i =1;
				while ($rows = mysqli_fetch_assoc($res)) {?>
				<tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['agent']?></td>
				      <td><?=$rows['device']?></td>				      
				      <td><?=$rows['brand']?></td>
				      <td><?=$rows['specs']?></td>
				      <td><?=$rows['serialno']?></td>
				      <td><?=$rows['currentdate']?></td>
				      <td><?=$rows['daterel']?></td>
				      <td><?=$rows['status']?></td>

				      <td><a href="updatereqdev.php?id=<?=$rows['id']?>" class="btn btn-success" style="margin-bottom: 10px;">Update</a>
				      	<a href="php/deleteReq.php?id=<?=$rows['id']?>" class="btn btn-danger" style="margin-bottom: 10px;"> Delete&nbsp;</a>
			      	</td>
				</tr>
	<?php $i++; }?>
			</tbody>
		</table>
	</div>		
	<?php }?>
</div>
</div>

	</div>
</div>

<!---FOR AGENT-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
		<?php } else { ?>
      	<br><h4 style="color: white;">Hello!</h4><h3 style="color: white;"><?=$_SESSION['name']?></h3>
		</div>
	</div>
</div>

<div class="container-fluid" style="margin-top:40px;">
	<form action="php/createReq.php" method="post">
		<div class="row">
			<div class="col-sm-5">

				<h3>Request Asset</h3><br>

				<?php if (isset($_GET['requested'])) { ?>
				<div class="alert alert-success" role="alert">
				<?= htmlspecialchars($_GET['requested']); ?>
				</div>
				<?php } ?>

				<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
				</div>
				<?php } ?>		

				<label> Asset Type </label>
				<select class="form-control" name="device">
    				<option disabled selected>Select Asset Type</option>

    				<?php
    				// Include the database connection
    				include "../db_conn.php";

    				// Fetch distinct device types from the database
    				$query = "SELECT DISTINCT device FROM asset";
    				$result = mysqli_query($conn, $query);

    				// Check if there are rows in the result
    				if (mysqli_num_rows($result) > 0) {
        			// Loop through the rows and populate the dropdown
        			while ($row = mysqli_fetch_assoc($result)) {
            		echo '<option value="' . $row['device'] . '">' . $row['device'] . '</option>';
        					}
    					}
    				?>
				</select><br>

				<input type="text" class="form-control" id="status" name="status" value="Pending" hidden>

				<button type="submit" class="btn btn-primary" name="create" style="width:100%; margin-bottom: 30px;">Request</button>
			</div>
	</form>

<div class="col-sm-7">	
		<?php include 'php/reqdev.php';
         if (mysqli_num_rows($res) > 0) {?>
                  
			<h3>Agent Request Management</h3><br>			

	<div class="table-responsive table-wrapper3">
		<table class="table text-center table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Asset</th>
					<th scope="col">Date Requested</th>
					<th scope="col">Date Released</th>
					<th scope="col">Asset Brand</th>
					<th scope="col">Specifications</th>
					<th scope="col">Serial Number</th>										
					<th scope="col">Status</th>
				</tr>
			</thead>

			<tbody>
		<?php 
				$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				   <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['agent']?></td>
				      <td><?=$rows['device']?></td>
				      <td><?=$rows['currentdate']?></td>
				      <td><?=$rows['daterel']?></td>
				      <td><?=$rows['brand']?></td>
				      <td><?=$rows['specs']?></td>
				      <td><?=$rows['serialno']?></td>
				      <td><?=$rows['status']?></td>
				   </tr>
		<?php $i++; }?>
			</tbody>
		</table>
	</div>

	<?php }?>
    <?php } ?>
</div>

</div>
</div>

<!-- Footer -->
<footer class="page-footer font-small blue">

<!-- Copyright -->
  	<div class="text-center d-flex justify-content-center align-items-center" style="height: 90px; margin-top: 30px;">
    	<span>©2023 BSEMC Asset Management System</span>
  	</div>
<!-- Copyright -->
</footer>

</body>

</html>

<?php }else{
	header("Location: index.php");
} ?>