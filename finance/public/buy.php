<?php

    // configuration
    require("../includes/config.php"); 
    
	// if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        renderx("buy_form.php", ["title" => "Buy", "pagename" => "BUY STOCKS"]);
    }
    
	// else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // convert inputed symbol to uppercase
		$symbol = strtoupper($_POST["symbol"]);
		
		// lookup stock symbol
        $stock = lookup($_POST["symbol"]);    
        
		// select cash from Database
		$rows = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        
		// check if any field is empty
		if (empty($_POST["symbol"]) || empty($_POST["amount"]))
		{	
			redirect("buy.php");
		}
		
		// check sql command return value
		else if ($stock === false || $rows === false)
		{
			apologize("an error occured");
		}
		
		else if (empty($stock) || empty($rows))
		{
			apologize("Empty arrays!");
        }
		
		// check if user still has money
		else if ($rows[0]["cash"] == 0)
		{
			apologize("You have no money");
        }
        
		// format the price of the stock
		$stock["price"] = number_format($stock["price"], 2, '.', ' ');
		
		// Get the total amount to be spent in buying n number of shares
		$saleprice = ($stock["price"] * $_POST["amount"]);
        
		// checking if user has enough money to buy the shares
		if ($rows[0]["cash"] < $saleprice)
        {	
			apologize("Not enough money");
        }
        
		// check if user input is reasonable
		else if (preg_match("/^\d+$/", $_POST["amount"]) == false)
        {
			apologize("Please buy a reasonable amount");
        }
        
		else 
        {    
			// deduct amount for purchase
            query
			("
            UPDATE users
            SET cash = (cash - ?) 
            WHERE id = ?
            ", 
            $saleprice, $_SESSION["id"]
			);
            
            // add shares to portfolio
            query
			("
            INSERT INTO portfolios
            (id, symbol, shares) 
            VALUES(?, ?, ?)
            ON DUPLICATE KEY 
            UPDATE shares = shares + VALUES(shares)
            ", 
            $_SESSION["id"], $symbol, $_POST["amount"]
			);
            
            // add transaction to history
            query
			("
            INSERT INTO history 
            (id, Price, Symbol, Transaction, Shares, Period) 
            VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP)
            ", 
            $_SESSION["id"], $stock["price"], $symbol, "BUY", $_POST["amount"]
			);
            
			// inform users of their success
			congratulate("You've successfully bought some shares");
            
        }
        
    }    
?>    
