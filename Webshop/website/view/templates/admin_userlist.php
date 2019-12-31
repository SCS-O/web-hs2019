<table class="account-table">
  <?php
      foreach ($accounts as $account)
      {
        ?>
        <tr>
          <td><?php echo($account->getName()); ?></td>
          <td>
            <form class="account-list" action="index.php?action=admin_useredit" method="post">
              <input type="hidden" name="accountid" value="<?php echo($account->getAccountId()); ?>"/>
              <input type="submit" value="Edit account(to be translated)"/>
            </form>
          </td>
      </tr>
        <?php
      }
    ?>
  </table>