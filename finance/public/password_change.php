<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
		// render form to change password
		renderx("password_change.php", ["title" => "Change password", "pagename" => "CHANGE PASSWORD"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Get user info
		$userinfo = query("SELECT hash FROM users WHERE id = ?", $_SESSION["id"]);
        
        // compare inputed password with the one in the Database
		if (crypt($_POST["oldpassword"], "itsola") !== $userinfo[0]["hash"])
        {
            apologize("Incorrect Old password");
        
        }
        
		// if user did not entera password or confirmation password
		else if (empty($_POST["password"]) || empty($_POST["confirmation"]))
        {
			apologize("You must fill the forms");
        }
		// if password and confirmation do not match
		else if ($_POST["password"] !== $_POST["confirmation"])
        {
			apologize("Passwords don't match");
        }
        
		else
        {	query
			("
			UPDATE users
			SET hash = ? 
			WHERE id = ?
			", 
			crypt($_POST["password"], "itsola"), $_SESSION["id"]
			);
      
			// inform user of their successful password change
			congratulate("Your Password has been changed");
		}
	}
?>    
