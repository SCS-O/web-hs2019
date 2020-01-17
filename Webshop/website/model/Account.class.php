<?php
class Account{
    private $PK_Account;
    private $FirstName;
    private $LastName;
    private $Address;
    private $City;
    private $Email;
    private $PasswordHash;

    public function getName() {
        return $this->FirstName . " " . $this->LastName;
    }

    public function getAccountId() {
        return $this->PK_Account;
    }

    public function getFirstName() {
        return $this->FirstName;
    }

    public function setFirstName($firstName) {
       $this->FirstName = $firstName;
    }

    public function getLastName() {
        return $this->LastName;
    }

    public function setLastName($lastName) {
       $this->LastName = $lastName;
    }

    public function getAddress() {
        return $this->Address;
    }

    public function setAddress($address) {
       $this->Address = $address;
    }

    public function getCity() {
        return $this->City;
    }

    public function setCity($city) {
       $this->City = $city;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($email) {
        $this->Email = $email;
     }
 
     public function getPasswordHash() {
        return $this->PasswordHash;
    }

    public function setPasswordHash($passwordHash) {
        $this->PasswordHash = $passwordHash;
     }
 
    public function __toString(){
        return sprintf("%d) %s, %s, %s, %s", $this->PK_Account, $this->getName(), $this
        ->Address, $this->City, $this->Email);
    }
        
    public function saveObject()
    {
        if($this->PK_Account !== null)
        {
            $res = DB::doQuery(sprintf("UPDATE account
                SET FirstName = '%s', LastName = '%s', Address = '%s', City = '%s', Email = '%s', PasswordHash = '%s'
                WHERE PK_Account = %d", 
                    mysqli_real_escape_string(DB::getInstance(), $this->FirstName), 
                    mysqli_real_escape_string(DB::getInstance(), $this->LastName), 
                    mysqli_real_escape_string(DB::getInstance(), $this->Address), 
                    mysqli_real_escape_string(DB::getInstance(), $this->City), 
                    mysqli_real_escape_string(DB::getInstance(), $this->Email), 
                    mysqli_real_escape_string(DB::getInstance(), $this->PasswordHash), 
                    mysqli_real_escape_string(DB::getInstance(), $this->PK_Account))
                );
        }
        else{
            $res = DB::doQuery(sprintf("INSERT INTO account(`FirstName`, `LastName`, `Address`, `City`, `Email`, `PasswordHash`)
            VALUES('%s', '%s', '%s', '%s', '%s', '%s');", 
                mysqli_real_escape_string(DB::getInstance(), $this->FirstName), 
                mysqli_real_escape_string(DB::getInstance(), $this->LastName), 
                mysqli_real_escape_string(DB::getInstance(), $this->Address), 
                mysqli_real_escape_string(DB::getInstance(), $this->City), 
                mysqli_real_escape_string(DB::getInstance(), $this->Email), 
                mysqli_real_escape_string(DB::getInstance(), $this->PasswordHash)
            ));
            return $res;
        }
    }

    public function getOrders()
    {
        $orders = array();
        $res = DB::doQuery(sprintf(
            "SELECT o.* FROM orders o 
            INNER JOIN account a on a.PK_Account = o.FK_Account AND a.PK_Account = %d",
            mysqli_real_escape_string(DB::getInstance(), $this->PK_Account)));
        
        if ($res) {
            while ($order = $res->fetch_object("Order")) 
            {
                $orders[] = $order;
            }
        }
        return $orders;
    }

    static public function getAccounts() {
        $accounts = array();
        $res = DB::doQuery("SELECT a.* FROM account a");
        if ($res) {
            while ($account = $res->fetch_object(get_class())) 
            {
                $accounts[] = $account;
            }
        }
        return $accounts;
    }

    static public function getAccountById($PK_Account) {
        $res = DB::doQuery("SELECT a.* FROM account a WHERE a.PK_Account = " . mysqli_real_escape_string(DB::getInstance(), $PK_Account));
        if ($res) {
            if ($account = $res->fetch_object(get_class())) 
            {
                return $account;                    
            }
        }
        return null;
    }

    static public function getAccountByEmail($email)
    {
        $res = DB::doQuery("SELECT a.* FROM account a WHERE a.Email like '" . mysqli_real_escape_string(DB::getInstance(), $email) . "'");
        if ($res) {
            if ($account = $res->fetch_object(get_class())) 
            {
                return $account;
            }
        }
        return null;
    }

    static public function isAccount($PK_Account){
        $res = DB::doQuery("SELECT a.* FROM account a WHERE a.PK_Account = " . mysqli_real_escape_string(DB::getInstance(), $PK_Account));
        if ($res) {
            if ($account = $res->fetch_object(get_class())) 
            {
                return TRUE;                    
            }
        }
        return FALSE;
    }

    public function checkCredentials($login, $pw)
    {
        if ($login == $this->Email && $pw == $this->PasswordHash){
            return TRUE;
        }
        else{
            return false;
        }
    }
}