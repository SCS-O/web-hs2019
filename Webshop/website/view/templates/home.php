<section class="main-grid-layout">
  <h2>Hottest_Memes (tranlate)</h2>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container">
        <div class="article-description"><?php echo($article->getArticleName($language)); ?></div>
        <div class="article-image"><img class="thumbnail" src="<?php echo($article->getArticleThumbnail()); ?>" alt="Bild kaputt" /></div>
        <div>
          <form class="order-article" method="post">
            <input type="hidden" name="article-id" value="<?php echo($article->getArticleId()); ?>"/>
            <input type="submit" value="Add to cart (to be translated)"/>
          </form>
        </div>
      </div>
      <?php
    }
  ?>
</section>