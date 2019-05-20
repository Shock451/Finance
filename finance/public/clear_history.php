<?php

	// configuration
    require("../includes/config.php"); 
	
	// deletes all history of user
	query("DELETE FROM history WHERE id = ?", $_SESSION["id"]);
	
	// redirect user to the homepage
	redirect("/");

?>