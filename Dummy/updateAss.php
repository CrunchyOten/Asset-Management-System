<?php include 'php/updateAss.php'; ?>
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
	<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
		<form class="border shadow p-4 rounded" action="php/updateReq.php" method="post" style="width: 600px; background-color: white">
           
		   	<h4 class="text-center p-3">IT Staff Management</h4><hr>

		   	<?php if (isset($_GET['error'])) { ?>
		   	<div class="alert alert-danger" role="alert">
				<?= htmlspecialchars($_GET['error']); ?>
				</div>
		   	<?php } ?>		   	

		   	<div class="mb-3">
		     	<label for="agent">Asset Type</label>
		     	<input type="text" class="form-control" id="device" name="device" value="<?= htmlspecialchars($row['device']); ?>" autocomplete="off">
		   	</div>

		   	<div class="mb-3">
		     	<label for="device">Asset Brand Name</label>
		     	<input type="text" class="form-control" id="brand" name="brand" value="<?= htmlspecialchars($row['brand']); ?>" autocomplete="off">
		   	</div>

		   	<div class="mb-3">
		     	<label for="device">Asset Specifications</label>
		     	<input type="text" class="form-control" id="specs" name="specs" value="<?= htmlspecialchars($row['specs']); ?>" autocomplete="off">
		   	</div>

			<div class="mb-3">
    			<label for="daterel">Asset Serial Number</label>
    			<input type="text" class="form-control" id="daterel" name="daterel" value="<?= htmlspecialchars($row['serialno']); ?>">
			</div>

			<div class="mb-1">
		   		<label class="form-label">Status:</label>
			</div>

			<select class="form-control" name="status" aria-label="Default select example" value="<?= htmlspecialchars($row['status']); ?>">
				<option disabled> Please select..</option>
				<option selected value="Available">Available</option>
				<option value="Deployed">Deployed</option>
			</select><br>

			<!-- Add a hidden input field for the user ID -->
			<input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

		 	<button type="submit" class="btn btn-success" name="update" style="width:100%; margin-bottom:5px;">Update</button>
		 	<a href="home.php" style="width: 100%" class="btn btn-secondary">Back</a>
		   
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					var serialnoInput = document.getElementById("serialno");
					serialnoInput.addEventListener("input", function(e) {
						this.value = this.value.replace(/\D/g, ''); // Allow only numeric values
					});
				});
			</script>
	   </form>
	</div>
</body>

</html>