<?php //Orders status New ?>
<h2><?php echo $this->controller->getTranslation("status_new_orders") ?></h2>
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
    if($order->orderState == "New")
    {
        ?>
        <tr class="article-row">
        <td><?php echo($order->order_id); ?></td>
        <td><?php echo $this->controller->getTranslation("order_state_new") ?></td>
        <td><?php echo($order->articleCount)?></td>
        <td><?php echo($order->totalAmount)?></td>
        </tr>
        <?php
    }
}
?>
</table>

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
    if($order->orderState == "Completed")
    {
        ?>
        <tr class="article-row">
        <td><?php echo($order->order_id); ?></td>
        <td><?php echo $this->controller->getTranslation("order_state_completed") ?></td>
        <td><?php echo($order->articleCount)?></td>
        <td><?php echo($order->totalAmount)?></td>
        </tr>
        <?php
    }
}
?>
</table>
