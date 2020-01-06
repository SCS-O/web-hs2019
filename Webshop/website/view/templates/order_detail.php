<section class="order detail">
  <h2><?php echo $this->controller->getTranslation("order_detail") ?></h2>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container-full picture">
        <div class="article-description"><?php echo($article->getArticleTitle()); ?></div>
        <div class="article-image"><img class="picture" src="<?php echo($article->getArticlePicture()); ?>" alt="<?php echo $this->controller->getTranslation("img_not_found") ?>" /></div>
      </div>
      <?php
    }
  ?>
</section>