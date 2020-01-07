<form class="registration_form" action="index.php?action=register" method="post">
    <input type="text" name="firstName" value="<?php echo($account->getFirstName()); ?>"/>
    <input type="text" name="lastName" value="<?php echo($account->getLastName()); ?>"/>
    <input type="text" name="address" value="<?php echo($account->getAddress()); ?>"/>
    <input type="text" name="city" value="<?php echo($account->getCity()); ?>"/>
    <input type="text" name="email" value="<?php echo($account->getEmail()); ?>"/>
    <input type="submit" value="Register"/>
</form>