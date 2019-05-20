<?php

    // configuration
    require("../includes/config.php"); 

    // Get stock info from database
	$rows = query("SELECT symbol, shares FROM portfolios WHERE id = ?", $_SESSION["id"]);   
	$money = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);   
    
	// formatting cash to 2d.p for user
    $cash = number_format($money[0]["cash"], 2, '.', '');
	
	// array initialization to store results to be presented
	$positions = [];
    
	// variable to store the total of all stock prices
	$total = 0;
	
	foreach ($rows as $row)
    {
        // look for the latest stock information
		$stock = lookup($row["symbol"]);
		
		// formatting stock price to 2d.p for user
        $stock["price"] = number_format($stock["price"], '2', '.', '');
		
		// checking if stock exists
		if ($stock !== false)
        {
            // storing its data 
			$positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
            ];
			
			// calculating the total gradually
			$total = $total + $stock["price"];
		}
       
    }
    
	// formatting the total of stock prices for the user
	$total = number_format($total, 2, '.', '');
	
	// render portfolio 
    renderx("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "total" => $total, "pagename" => "PORTFOLIO", "cash" => $cash, "page" => "buy.php"]);
?>
