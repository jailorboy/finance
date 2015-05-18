<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	//render the sell form
    	render("sell_form.php");
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	//validate
    	if (empty($_POST["symbol"]))
    	{
    		apologize("You must enter a valid trading symbol.");
    	}

    	$rows = query("SELECT * FROM stock_table WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);

    	if ($rows == false)
    	{
    		apologize("You must enter a valid trading symbol.");
	    }
	    //lookup
    	$yahoo = lookup($rows[0]["symbol"]);

    	//calculate the total value of the sold shares
    	$value = $yahoo["price"] * $rows[0]["shares"];

    	query("DELETE FROM stock_table WHERE id = ? AND symbol = ?",$_SESSION["id"], $_POST["symbol"] );
    	query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"] );
        query("INSERT INTO history (id, symbol, action, number, price) VALUES (?,?,?,?,?)",$_SESSION["id"],$rows[0]["symbol"], "Sold",
            $rows[0]["shares"],$yahoo["price"]);

    	redirect("index.php");

    }

?>