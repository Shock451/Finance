<?php

    // configuration
    require("../includes/config.php"); 
	
	// Get all symbols to present to user
	$symbols = query("SELECT symbol FROM portfolios WHERE id = ?", $_SESSION["id"]);
	
	// if user got to the page via GET or REDIRECT
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
		// render form
		renderx("sell_form.php", ["title" => "Sell", "pagename" => "SELL STOCKS", "symbols" => $symbols, "page" => "buy.php"]);
	}
    
	// else if user got to the page via POST (or by filling a form)
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {      
		// look up stock's latest information
		$stock = lookup($_POST["symbol"]);
		
		// select all symbols and shares of the user from Database
        $rows = query("SELECT symbol, shares FROM portfolios WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);    
		
		// check if symbol is valid
		if (empty($stock))
		{
			apologize("You cannot sell that stock");
        }
		
		else
	    {
			// Get total price of purchase
			$saleprice = $rows[0]["shares"] * $stock["price"];
          
		    // Delete the shsres from the user's portfolio 
			query
			("
			DELETE FROM portfolios
			WHERE id = ? AND symbol = ?
			", 
			$_SESSION["id"], $_POST["symbol"]
			);

			// Update the user's cash by adding the money gained 
			query
			("
			UPDATE users SET 
			cash = (cash + ?) 
			WHERE id = ?
			", 
			$saleprice, $_SESSION["id"]
			);
          
			// add transaction to history
			query
			("
			INSERT INTO history 
			(id, Price, Symbol, Transaction, shares, Period) 
			VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP)
			", 
			$_SESSION["id"], $stock["price"], $_POST["symbol"], "SELL", $saleprice
			);
         
			// congratulate users on successfully selling their stock
			congratulate("You've sold your shares!");
        }
	}
?>
