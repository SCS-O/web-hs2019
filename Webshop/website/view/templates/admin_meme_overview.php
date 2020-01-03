<section class="meme_suggestions">
    <p><?php echo $this->controller->getTranslation("add_articles_form") ?></p>
    <form action="index.php?action=addMemes" method="post">
    <!-- according to the following website, those are the best 10 meme-subreddits:
      https://filmora.wondershare.com/meme/funny-subreddits-to-find-memes.html -->
      <select name="subreddit">
        <option value="AdviceAnimals">AdviceAnimals</option>
        <option value="MemeEconomy">MemeEconomy</option>
        <option value="ComedyCemetery">ComedyCemetery</option>
        <option value="memes">memes</option>
        <option value="dankmemes">dankmemes</option>
        <option value="PrequelMemes">PrequelMemes</option>
        <option value="terriblefacebookmemes">terriblefacebookmemes</option>
        <option value="PewdiepieSubmissions">PewdiepieSubmissions</option>
        <option value="funny">funny</option>
        <option value="teenagers">teenagers</option>
      </select>
      <input type="submit" value="<?php echo $this->controller->getTranslation("import") ?>" />
    </form>
</section>

<section class="main-grid-layout">
  <h2>Meme overview</h2>
  <table>
      <tr>
        <th><?php echo $this->controller->getTranslation("article_title") ?></th>
        <th><?php echo $this->controller->getTranslation("article_subreddit") ?></th>
        <th><?php echo $this->controller->getTranslation("article_autor") ?></th>        
        <th><?php echo $this->controller->getTranslation("price") ?></th>        
      </tr>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <tr class="article-row">
        <td><?php echo($article->getArticleTitle()); ?></td>
        <td><?php echo($article->getArticleSubreddit()); ?></td>
        <td><?php echo($article->getArticleAuthor()); ?></td>
        <td><?php echo($article->getArticlePrice()); ?></td>
      </tr>
      <?php
    }
  ?>
  </table>
</section>