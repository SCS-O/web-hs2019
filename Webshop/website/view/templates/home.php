    <h1>Example account access</h1>
    <?php
    
      $accounts = Account::getAccounts();
      foreach ($accounts as $account)
      {
        echo("<p>" . $account . "</p>");
      }
    ?>

    <h1>Example article access</h1>
    <?php
    
      $articles = Article::getArticles();
      foreach ($articles as $article)
      {
        echo("<p>" . $article . "</p>");
      }
    ?>
    <h2>single article with loalization</h2>

    <?php
    
      $article3 = Article::getArticleById(3);
      echo("<p>" . $article3->getArticleName("fr") . "<br />" . $article3->getArticleDescription("fr") . "</p>");
    ?>

    <h1>Example order access</h1>
    <?php
      $orders = Order::getOrders();
      foreach ($orders as $order)
      {
        echo("<p>OrderId: " . $order->getOrderId() . "</p>");
        echo("<p>" . $order->getOrdererAccount()->getName() . "</p>");
        
        foreach($order->getOrderArticles() as $article)
        {
          echo ("Article: " . $article . "<br / >");
        }
        
      }
    ?>