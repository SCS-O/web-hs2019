<form class="account_edit" action="index.php?action=admin_usersave" method="post">
    <input type="text" name="firstName" value="<?php echo($account->getFirstName()); ?>"/>
    <input type="text" name="lastName" value="<?php echo($account->getLastName()); ?>"/>
    <input type="text" name="address" value="<?php echo($account->getAddress()); ?>"/>
    <input type="text" name="city" value="<?php echo($account->getCity()); ?>"/>
    <input type="text" name="email" value="<?php echo($account->getEmail()); ?>"/>
    <input type="hidden" name="accountid" value="<?php echo($account->getAccountId()); ?>"/>
    <input type="submit" value="Save account(to be translated)"/>
</form>