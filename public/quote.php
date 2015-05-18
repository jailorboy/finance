<?php
	// configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//render the sell form
		render("quote_form.php");
	}
	
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$symbol = $_POST["symbol"];

		$s = lookup($symbol);

		if ($s == false)
		{
			apologize("The company does not exist.");
		}

		render("quote.php", ["s" => $s]);
	}

?>

