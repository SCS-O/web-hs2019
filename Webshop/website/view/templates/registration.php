<form class="account_edit" action="index.php?action=register" method="post">
    <input type="text" name="firstName" value="<?php echo $this->controller->getTranslation("first_name");?>"/>
    <input type="text" name="lastName" value="<?php echo $this->controller->getTranslation("last_name");?>"/>
    <input type="text" name="address" value="<?php echo $this->controller->getTranslation("address");?>"/>
    <input type="text" name="city" value="<?php echo $this->controller->getTranslation("city");?>"/>
    <input type="text" name="email" value="<?php echo $this->controller->getTranslation("email");?>"/>
    <input type="text" name="passwordHash" value="<?php echo $this->controller->getTranslation("password");?>"/>
    <input type="submit" value="<?php echo $this->controller->getTranslation("register");?>"/>
</form>