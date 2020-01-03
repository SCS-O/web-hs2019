<h2><?php echo $this->controller->getTranslation("checkout_page_introduction") ?></h2>

<section class="checkout-grid-layout">
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container">
        <div class="article-description"><?php echo($article->getArticleTitle()); ?></div>
        <div class="article-image"><img class="thumbnail" src="<?php echo($article->getArticleThumbnail()); ?>" alt="<?php echo $this->controller->getTranslation("img_not_found") ?>" /></div>
      </div>
      <?php
    }
  ?>
</section>