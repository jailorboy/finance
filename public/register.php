<?php

	//configuration
	require("../includes/config.php");

	//if user reached page via GET (as by clicking a link or via redirect)
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render("register_form.php",["title" => "Register"]);
	}

	//else if user reached page via POST (as by submitting a form via POST)
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		//make sure the form has been properly submitted
		if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
        	apologize("You must re-enter your password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
        	apologize("Your password does not match.");
        }


        //register new user
        $insert = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));

        //check if it goes into the database
        if ($insert === false)
        {
        	apologize("The username is already used.");
        }
        else
        {

                // remember that user's now logged in by storing user's ID in session
        		$rows = query("SELECT LAST_INSERT_ID() AS id");
                $_SESSION["id"] = $rows[0]["id"];


                // redirect to portfolio
                redirect("index.php");
        }
	}

?>