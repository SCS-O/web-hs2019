<?php //Orders status Completed ?>
<h2><?php echo $this->controller->getTranslation("status_completed_orders") ?></h2>
<table>
    <tr>
        <th><?php echo $this->controller->getTranslation("order_id") ?></th>
        <th><?php echo $this->controller->getTranslation("order_state") ?></th>
        <th><?php echo $this->controller->getTranslation("article_count") ?></th>      
        <th><?php echo $this->controller->getTranslation("total_amount") ?></th>         
    </tr>
<?php
foreach ($orders as $order)
{
        ?>
        <tr class="article-row">
        <td><?php echo($order->order_id); ?></td>
        <td><a href="index.php?action=order_detail&orderId=<?php echo($order->order_id); ?>"><?php echo $this->controller->getTranslation("order_state_completed") ?></a></td>
        <td><?php echo($order->articleCount)?></td>
        <td><?php echo($order->totalAmount)?></td>
        </tr>
        <?php
}
?>
</table>
