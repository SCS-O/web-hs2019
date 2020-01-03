<table class="account-table">
  <tr>
    <th><?php echo $this->controller->getTranslation("name") ?></th>
    <th><?php echo $this->controller->getTranslation("email") ?></th>
    <th></td>
  </tr>
  <?php
      foreach ($accounts as $account)
      {
        ?>
        <tr>
          <td><?php echo($account->getName()); ?></td>
          <td><?php echo($account->getEmail()); ?></td>
          <td>
            <form class="account-list" action="index.php?action=admin_useredit" method="post">
              <input type="hidden" name="accountid" value="<?php echo($account->getAccountId()); ?>"/>
              <input type="submit" value="<?php echo $this->controller->getTranslation("button_edit_account") ?>"/>
            </form>
          </td>
      </tr>
        <?php
      }
    ?>
  </table>