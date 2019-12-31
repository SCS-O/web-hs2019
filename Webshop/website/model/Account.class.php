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

    public function getLastName() {
        return $this->LastName;
    }

    public function getAddress() {
        return $this->Address;
    }

    public function getCity() {
        return $this->City;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function __toString(){
        return sprintf("%d) %s, %s, %s, %s", $this->PK_Account, $this->getName(), $this
        ->Address, $this->City, $this->Email);
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
        $res = DB::doQuery("SELECT a.* FROM account a WHERE a.PK_Account = $PK_Account");
        if ($res) {
            if ($account = $res->fetch_object(get_class())) 
            {
                return $account;                    
            }
        }
        return null;
    }
}