<?php

	//configuration
	require("../includes/config.php");

	//if user reached page via GET (as by clicking a link or via redirect)
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render("password_form.php",["title" => "Password"]);
	}

	//else if user reached page via POST (as by submitting a form via POST)
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		//make sure the form has been properly submitted
		if (empty($_POST["existing"]))
        {
            apologize("Enter your existing password.");
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

        //check if the existing password is correct
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["existing"], $row["hash"]) != $row["hash"])
            {
                apologize("That is not your current password.");
            }
        }

        query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["password"]), $_SESSION["id"]);

        redirect("index.php");
	}

?>