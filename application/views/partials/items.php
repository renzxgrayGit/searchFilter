<?php 	foreach($items as $item) {	?>
            <tr>
                <td><?= $item['item_name']?></td>
                <td><?= $item['number_stock']?></td>
                <td>$<?= $item['price']?></td>
                <td><?= $item['created_at']?></td>
            </tr>
<?php 	} 	?>
