<section class="main-grid-layout">
  <h2>Meme overview</h2>
  <table>
      <tr>
        <th><?php echo $this->controller->getTranslation("article_name_de") ?></th>
        <th><?php echo $this->controller->getTranslation("article_name_fr") ?></th>
        <th><?php echo $this->controller->getTranslation("article_name_en") ?></th>        
      </tr>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <tr class="article-row">
        <td><?php echo($article->getArticleName('de-CH')); ?></td>
        <td><?php echo($article->getArticleName('fr-CH')); ?></td>
        <td><?php echo($article->getArticleName('en-US')); ?></td>
      </tr>
      <?php
    }
  ?>
  </table>
</section>