<?php

    // configuration
    require("../includes/config.php"); 
	
	// if user reached page via GET
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		// else render form
		renderx("quote_form.php", ["title" => "Quote", "pagename" => "GET QUOTE"] );
	}
	
    // else if user reached page via POST (as by submitting a form via POST)
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {	
		// render quote_form
		if (empty($_POST["symbol"]))
		{
			renderx("quote_form.php", ["title" => "Quote search"]);
		}
		// if user actually inputed a symbol
		else if (!empty($_POST["symbol"]))
		{
			// look up symbol for the latest stock information
			$stock = lookup($_POST["symbol"]);
			
			// check if stock is false
			if ($stock === false)
			{
				apologize("Quote not found");
			}       
			
			// else
			else
			{
				// format price to 2d.p for user to easily understandand
				$stock["price"] = number_format($stock["price"], 2, '.', '');
				
				// convert the stock symbol to uppercase for user
				$stock["symbol"] = strtoupper($stock["symbol"]);
				
				// render form
				renderx("stock_price.php", ["title" => "Stock info", "stock" => $stock, "pagename" => "STOCK INFO"]);
       
			}  
		}
	}
?>
