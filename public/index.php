<?php

    // configuration
    require("../includes/config.php"); 

    //pass positions
    $rows = query("SELECT * FROM stock_table WHERE id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {
    	$stock = lookup($row["symbol"]);
    	if ($stock !== false)
    	{
    		$positions[] = [
    		"name" => $stock["name"],
    		"price"=>$stock["price"],
    		"shares"=>$row["shares"],
    		"symbol"=>$row["symbol"]
    		];
    	}
    }

    //cash
    $selection = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $selection[0]["cash"];


    // render portfolio
    render("portfolio.php", ["positions" => $positions, "cash" => $cash, "title" => "Portfolio"]);

?>
