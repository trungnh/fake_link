<div class="container">

	<form class="form-signin" method="POST" action="<?php echo BASE_URL; ?>/index.php?action=login">
		<h2 class="form-signin-heading">Please sign in</h2>
		<label for="input_username" class="sr-only">Username</label>
		<input type="text" id="input_username" class="form-control" placeholder="Username" required="" autofocus="" name="username">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>

</div> <!-- /container -->