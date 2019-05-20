<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register", "pagename" => "REGISTER"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// if user does not input a username and a password        
		if (empty($_POST["username"]) && empty($_POST["password"]))
	    {
            apologize("You must provide your username and password.");
        }
		
		// if user does not input a username
		else if (empty($_POST["username"]))
		{
			apologize("You must provide your username");
		}
		
		// if user does not input a password
		else if (empty($_POST["password"]))
		{
			apologize("You must provide your password.");
    	}
		
		// if password and confirmation don't match.
		else if ($_POST["password"] !== $_POST["confirmation"])
		{
			apologize("Passwords don't match.");
		}
        
		// Storing user's information into the Database
		$row = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"], "itsola"));
        
		// some error checking
		if ($row === false)
		{
			apologize("An error occured. You!");
		}
		
		else 
		{
			$rows = query("SELECT LAST_INSERT_ID() AS id");
			$id = $rows[0]["id"];
			$_SESSION["id"] = $id;		    
            congratulate("You're Registered");		
		}    
	}
?>
