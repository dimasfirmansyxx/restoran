<?php 
	include 'config/functions.php';
	$myfunc = new functions();
	$myfunc->set_title("Login");

	include 'config/templates/header.php';

	if ( isset($_POST['login']) ) {
		$myfunc->login_check($_POST);
	}

?>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-dark text-white text-center">
				Login
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'config/templates/footer.php';
?>