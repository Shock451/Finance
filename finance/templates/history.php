<div>
	<table>
		<tr>
			<th>Transaction</th>
			<th>Symbol</th>		
			<th>Date/Time</th>
			<th>Shares</th>
			<th>Price</th>
		</tr>
		<?php foreach ($rows as $row): ?>
		<tr>
			<td><?=$row["Transaction"]?></td>
			<td><?=$row["Symbol"]?></td>
			<td><?=$row["Period"]?></td>
			<td><?=$row["Shares"]?></td>
			<td><?=$row["Price"]?></td>
		</tr>
		<?php endforeach ?>
	</table>
	<a href = "clear_history.php">Clear History</a>
</div>