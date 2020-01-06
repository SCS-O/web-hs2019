<?php
class Order{
    private $PK_Orders;
    private $FK_Account;
    private $OrderState;
    private $ArticleList = [];
    
    public function getOrderId(){
        return $this->PK_Orders;
    }

    public function getOrderState(){
        return $this->OrderState;
    }

    public function getOrdererAccount(){
        return $this->FK_Account;
    }

    public function getOrderArticles(){
        return $this->ArticleList;
    }
    
    public function getArticles()
    {
        $articles = array();

        $res = DB::doQuery(sprintf(
            "SELECT a.* FROM orders o
            INNER JOIN orders_article oa on o.PK_Orders = oa.FK_Orders
            INNER JOIN article a on a.PK_Article = oa.FK_Article 
            WHERE o.PK_Orders = %d",
            mysqli_real_escape_string(DB::getInstance(), $this->PK_Orders)));
        
        if ($res) {
            while ($article = $res->fetch_object("Article")) 
            {
                $articles[] = $article;
            }
        }
        return $articles;
    }

    static public function newOrder($articles, $account)
    {    
        $res = DB::doQuery(sprintf("INSERT INTO orders(FK_Account, OrderState)
        VALUES('%d', 'Completed');", 
            mysqli_real_escape_string(DB::getInstance(), $account->getAccountId())
        ));
        if ($res) {    
            //newly created order id https://www.w3schools.com/php/php_mysql_insert_lastid.asp
            $last_id = mysqli_insert_id(DB::getInstance());
            
            foreach($articles as $article){
                DB::doQuery(sprintf(
                    "INSERT INTO orders_article(FK_Orders, FK_Article)
                    VALUES('%d', '%d');", 
                    $last_id, 
                    mysqli_real_escape_string(DB::getInstance(), $article->getArticleId())
                ));
            }
        }
        
        $orderInstance = new self();

        $orderInstance->PK_Orders = $last_id;
        $orderInstance->FK_Account = $account->getAccountId();
        $orderInstance->OrderState = 'Completed';
        return  $orderInstance;
    }

    //maybe this function shouldn't exist, as we load almost the whole db. 
    static public function getOrders() {
        $orders = array();
        $res = DB::doQuery("SELECT o.PK_Orders as PK_Orders, o.FK_Account, o.OrderState FROM orders o");
        if ($res) {
            while ($order = $res->fetch_object(get_class())) 
            {
                $orders[] = $order;

                $order->FK_Account = Account::getAccountById($order->FK_Account);
                
                //load articles of order            
                $resArticles = DB::doQuery("SELECT FK_Article FROM orders_article where FK_Orders = $order->PK_Orders");

                while ($article_row = $resArticles->fetch_assoc()) {
                    array_push($order->ArticleList, Article::getArticleById($article_row["FK_Article"]));
                }
            }
        }
        return $orders;
    }
    
    //maybe this function shouldn't exist, as we load almost the whole db. 
    static public function getOrderById($orderId) {
        $orders = array();
        $res = DB::doQuery(sprintf("SELECT o.PK_Orders as PK_Orders, o.FK_Account, o.OrderState FROM orders o WHERE o.PK_orders = %s", 
            mysqli_real_escape_string(DB::getInstance(), $orderId)));
        if ($res) {
            
            $order = $res->fetch_assoc();
                        
            $orderInstance = new self();    
            $orderInstance->PK_Orders = $order['PK_Orders'];
            $orderInstance->FK_Account = $order['FK_Account'];
            $orderInstance->OrderState = $order['OrderState'];
            return  $orderInstance;
        }
        return null;
    }
}