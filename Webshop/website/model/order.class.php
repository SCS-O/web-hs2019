<?php
class Order{
    private $PK_Order;
    private $FK_Account;
    private $OrdererAccount;
    private $OrderState;
    private $ArticleList = [];
    
    public function getOrderId(){
        return $this->PK_Order;
    }

    public function getOrdererAccount(){
        return $this->OrdererAccount;
    }

    public function getOrderArticles(){
        return $this->ArticleList;
    }

    //maybe this function shouldn't exist, as we load almost the whole db. 
    static public function getOrders() {
        $orders = array();
        $res = DB::doQuery("SELECT o.PK_Orders as PK_Order, o.FK_Account, o.OrderState FROM orders o");
        if ($res) {
            while ($order = $res->fetch_object(get_class())) 
            {
                $orders[] = $order;

                $order->OrdererAccount = Account::getAccountById($order->FK_Account);
                
                //load articles of order            
                $resArticles = DB::doQuery("SELECT FK_Article FROM orders_article where FK_Orders = $order->PK_Order");

                while ($article_row = $resArticles->fetch_assoc()) {
                    array_push($order->ArticleList, Article::getArticleById($article_row["FK_Article"]));
                }
            }
        }
        return $orders;
    }
}