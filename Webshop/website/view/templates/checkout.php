<h2><?php echo $this->controller->getTranslation("checkout_page_introduction") ?></h2>

<section class="checkout-grid-layout">
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container">
        <div class="article-description"><?php echo($article->getArticleTitle()); ?></div>
        <div class="article-image"><img class="thumbnail" src="<?php echo($article->getArticleThumbnail()); ?>" alt="<?php echo $this->controller->getTranslation("img_not_found") ?>" /></div>
        <div class="article-price"><?php echo($article->getArticlePrice()) ?></div>
      </div>
      <?php
    }
  ?>
</section>

<section class="total">
  <p><?php echo($this->controller->getTranslation("total_amount") . ": " .  $total); ?></p>    
</section>

<section class="checkout_confirm">
    <a href="index.php?action=confirm_checkout"><?php echo $this->controller->getTranslation("confirm_yes_purchase") ?></a><br />
    <a href="index.php?action=clear_cart_and_go_home"><?php echo $this->controller->getTranslation("confirm_no_empty_cart") ?></a>
</section>