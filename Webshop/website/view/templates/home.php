<section class="main-grid-layout">
  <h2><?php echo $this->controller->getTranslation("hottest_memes") ?></h2>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container">
        <div class="article-description"><?php echo($article->getArticleName($language)); ?></div>
        <div class="article-image"><img class="thumbnail" src="<?php echo($article->getArticleThumbnail()); ?>" alt="<?php echo $this->controller->getTranslation("img_not_found") ?>" /></div>
        <div>
          <form class="order-article" method="post">
            <input type="hidden" name="article-id" value="<?php echo($article->getArticleId()); ?>"/>
            <input type="submit" value="<?php echo $this->controller->getTranslation("add_to_cart") ?>"/>
          </form>
        </div>
      </div>
      <?php
    }
  ?>
</section>