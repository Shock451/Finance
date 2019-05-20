<?php

    // configuration
    require("../includes/config.php"); 
	
	// if user reached page via GET (as by clicking a link or via redirect)
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		renderx("deposit_form.php", ["title" => "Deposit", "pagename" => "DEPOSIT CASH"] );
	}
	
	// if user reached page via POST (or by filling forms)
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {	
		// check if inputed cash is reasonable
		if (preg_match("/^\d+$/", $_POST["cash"]) == false)
		{	
			apologize("Enter a reasonable amount");
		}
		
		// check if wasteful user deposits too much money
		else if ($_POST["cash"] > 100000)
		{	
			apologize("You're a thief! That's too much bruh");
		}
		
		else
		{
			// deposit cash into Database
			query
			("
			UPDATE users
			SET cash = (cash + ?) 
			WHERE id = ?
			", 
			$_POST["cash"], $_SESSION["id"]
			);		
			
			// add transaction to history
			query
			("
			INSERT INTO history 
			(id, Transaction, Period, Price, Symbol, Shares) 
			VALUES(?, ?, CURRENT_TIMESTAMP, ?, ?, ?)
			", 
			$_SESSION["id"], "DEPOSIT", $_POST["cash"], '', ''
			);
		
			// redirect user to the homepage
			redirect("/");	
		}
	}	
?>	