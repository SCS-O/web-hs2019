<form class="account_edit" action="index.php?action=register" method="post">
    <input type="text" name="firstName" value="<?php echo $this->controller->getTranslation("first_name");?>" required maxlength="15" autofocus/>
    <input type="text" name="lastName" value="<?php echo $this->controller->getTranslation("last_name");?>" required maxlength="20"/>
    <input type="text" name="address" value="<?php echo $this->controller->getTranslation("address");?>" required maxlength="25"/>
    <input type="text" name="city" value="<?php echo $this->controller->getTranslation("city");?>" required maxlength="15"/>
    <input type="email" name="email" value="<?php echo $this->controller->getTranslation("email");?>" required maxlength="35" title="jane@provider.com"/>
    <input type="password" name="passwordHash" value="<?php echo $this->controller->getTranslation("password");?>" required minlength="5" maxlength="150"/>
    <input type="submit" value="<?php echo $this->controller->getTranslation("register");?>"/>
</form>
