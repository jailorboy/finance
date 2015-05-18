<?php

	// configuration
    require("../includes/config.php"); 

    //pass positions
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {   	
    		$positions[] = [
    		"id" => $row["id"],
    		"symbol"=>$row["symbol"],
    		"action"=>$row["action"],
    		"number"=>$row["number"],
    		"price"=>$row["price"],
    		"time"=>$row["time"]
    		];
    }

    render("history.php", ["positions" => $positions]);

    
?>