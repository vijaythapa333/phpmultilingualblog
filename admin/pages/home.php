<div class="body">
	<?php 
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}
	?>
	<h2>WElcome to MLB CMS.</h2>
	<p>
		You'll Manage Everything from Here.
	</p>
</div>