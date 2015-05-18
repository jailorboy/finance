<?php

	// configuration
	require("../includes/config.php"); 

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//render the sell form
		render("buy_form.php");
	}
	
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["symbol"]))
		{
			apologize("You need to enter the trading symbol of the stock you want to buy.");
		}
		else if (empty($_POST["number"]))
		{
			apologize("Enter the number of shares you want to buy.");
		}
		else if ($_POST["number"] <= 0)
		{
			apologize("That is a nonsensical number.");
		}

		$share = lookup($_POST["symbol"]);

		if ($share == false)
		{
			apologize("The company does not exist.");
		}

		$cost = $share["price"] * $_POST["number"];

		$rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

		if ($cost > $rows[0]["cash"])
		{
			apologize("You don't have the money.");
		}

		query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
		query("INSERT INTO stock_table (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)",
		 $_SESSION["id"], $share["symbol"],$_POST["number"] );
		query("INSERT INTO history (id, symbol, action, number, price) VALUES (?,?,?,?,?)",$_SESSION["id"],$share["symbol"], "Bought",
			$_POST["number"],$share["price"]);  

		redirect("index.php");
	}
?>