<div>
	<table  class="table table-striped table-bordered table-condensed">
		<tr class = "info">
		<td>Trading Symbol</td>
		<td>Action</td>
		<td>Number of Shares</td>
		<td>Price per Share</td>
		<td>Time of Transaction</td>
		</tr>
		<?php
			foreach($positions as $position)
			{
				print("<tr>");
				print("<td> ".$position["symbol"]."</td>");
				print("<td>".$position["action"]."</td>");
				print("<td> ".number_format($position["number"])."</td>");
				print("<td> $".number_format($position["price"],2)."</td>");
				print("<td>".$position["time"]."</td>");
				print("</tr>");
			}
		?>
	</table>
<br>
<br>
</div>

<div>
	<a href = "index.php"> Go Back </a>
</div>