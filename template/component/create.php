<div class="container">
    <?php
    if(isset($_SESSION['url'])) :
    ?>
    <div class="alert alert-success">File created: <?php echo $_SESSION['url']; ?></div>
    <?php unset($_SESSION['url']);endif; ?>
	<div class="page-header">
		<h1>Create Ad File</h1>
	</div>
	<p class="lead">Please input links for PC &amp; Mobile</p>
	<form action="<?php echo BASE_URL; ?>/index.php?action=create" method="POST">
		<div class="form-group">
			<label for="mobile_link">Mobile Links (cho link Mobidea vào đây)</label>
			<textarea class="form-control" rows="5" id="mobile_link" name="mobile_link"></textarea>
		</div>
		<div class="form-group">
			<label for="pc_link">PC Links</label>
			<textarea class="form-control" rows="5" id="pc_link" name="pc_link"></textarea>
		</div>
		<!-- Button -->
		<div class="form-group">
			<button id="create" name="create" class="btn btn-primary">Create</button>
		</div>
	</form>
</div>