<?php

    // configuration
    require("../includes/config.php"); 

	// selecting things required to present history
    $rows = query("SELECT Price, Symbol, Transaction, Period, Shares FROM history WHERE id = ?", $_SESSION["id"]);
    
	// checking whether there's any history
	if (empty($rows))
    apologize("No history");
    
	else
	{
		// render form
		renderx("history.php", ["title" => "History", "rows" => $rows, "pagename" => "HISTORY"]);  
	}
?>        
