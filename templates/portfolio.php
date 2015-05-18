<div>
	<h3> Available Cash: $<?= number_format($cash, 2) ?> </h3>
</div>

<div class = "text-right">
	<a href = "history.php"> View Your Transaction History </a>
</div>
<br>
<div>
	<table  class="table table-striped table-bordered table-condensed">
		<tr class = "info">
		<td>Trading Symbol</td>
		<td>Number of Shares</td>
		<td>Price per Share</td>
		</tr>
		<?php
			foreach($positions as $position)
			{
				print("<tr>");
				print("<td> ".$position["symbol"]."</td>");
				print("<td> ".number_format($position["shares"])."</td>");
				print("<td> $".number_format($position["price"],2)."</td>");
				print("</tr>");
			}
		?>
	</table>
<br>
<br>
</div>

<div >
	<a href = "sell.php" class = "btn btn-default" role = "button"><p class = "text-success"> Sell </p></a>
	<a href = "quote.php" class = "btn btn-default" role = "button"> <p class = "text-info"> Search </p></a>
	<a href = "buy.php" class = "btn btn-default" role = "button"> <p class = "text-warning"> Buy </p></a>
</div>

<br>
<br>

<div class = "text-left">
	<a href = "password.php"> <small>Change your password</small> </a>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
