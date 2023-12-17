<?php include 'php/updateU.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Update User Account</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
body {
	background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("img/bg1.jpg");
	background-size: cover;
}
</style>

<body>
	<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
		<form class="border shadow p-3 rounded" action="php/updateU.php" method="post" style="width: 450px; background-color: white;">
            
		   	<h4 class="text-center p-3">UPDATE USER</h4><hr>
		   	<?php if (isset($_GET['error'])) { ?>
		   	<div class="alert alert-danger" role="alert">
				<?= htmlspecialchars($_GET['error']); ?>
				</div>
		   	<?php } ?>

		   	<div class="mb-3">
		     	<label for="username">User Name</label>
		     	<input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($row['username']); ?>">
		   	</div>

		  	<div class="mb-3">
		     	<label for="password">Password</label>
		     	<input type="password" class="form-control" id="password" name="password" placeholder="Re-type Password">
		  	</div>

		  	<div class="mb-3">
		     	<label for="name">Name</label>
		     	<input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($row['name']); ?>">
		  	</div>

			<!-- Add a hidden input field for the user ID -->
			<input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

		 	<button type="submit" class="btn btn-success" name="update" style="width: 100%; margin-bottom:5px;">Update</button>
		   	<a href="home.php" style="width: 100%" class="btn btn-secondary">Back</a>
	   </form>
	</div>
</body>

</html>