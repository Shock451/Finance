<div>
    <?php if (empty($positions)): ?>
	<h3>
	    You have an empty Portfolio. <a href ="<?=htmlspecialchars($page)?>">Buy</a> some stocks, Maybe?
	</h3>
	
	<?php else: ?>
	<table>
		<tr>
			<th>Name</th>
			<th>Symbol</th>		
			<th>Shares</th>
			<th>Price</th>
		</tr>
    <?php foreach ($positions as $position): ?>
	<tr>
		<td><?=htmlspecialchars($position["name"])?></td>
		<td><?=htmlspecialchars($position["symbol"])?></td>
		<td><?=htmlspecialchars($position["shares"])?></td>
		<td><?=htmlspecialchars($position["price"])?></td>
	</tr>
	<?php endforeach ?>
	</table>
	<table>
		<tr>
			<th>Total</th> <td/><td/>		
			<td>$<?=htmlspecialchars($total)?> </td>
		</tr>
	</table>
	
	<?php endif ?>
	<table>
		<th>Cash</th><th/><th/>
		<td>$<?=htmlspecialchars($cash)?></td>
	</table>
</div>	