<?php
	// To encrypt user passwords
		echo password_hash($_GET['password'], PASSWORD_DEFAULT);
?>