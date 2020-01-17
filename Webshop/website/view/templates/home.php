<section class="main-grid-layout">
  <?php
    if($hasMemes)
    {
  ?>
  <h2><?php echo $this->controller->getTranslation("hottest_memes") ?></h2>
  <?php
    foreach ($articles as $article)
    {
      ?>
      <div class="article-container">
        <div class="article-description"><?php echo($article->getArticleTitle()); ?></div>
        <div class="article-image"><img class="thumbnail" src="<?php echo($article->getArticleThumbnail()); ?>" alt="<?php echo $this->controller->getTranslation("img_not_found") ?>" /></div>
        <div>
        
        <!-- for some reason js in head doesn't work but if put here, ajax call works -->
        <script>$(function(){
				$('.order-article').submit(function(e){
					e.preventDefault();
					//AJAX
					$.ajax({
						url: '/index.php?action=ajax_cart',
						type: 'POST',
						data: $(this).serialize(),
						success: function(response) {
							$('section.cart-holder').empty().append(response);
						},
						error: function() {
							console.log("Uppppsssss....");
						}
					});
				});
			});</script>

          <form class="order-article" method="post">
            <input type="hidden" name="article-id" value="<?php echo($article->getArticleId()); ?>"/>
            <input type="submit" value="<?php echo $this->controller->getTranslation("add_to_cart") ?>"/>
          </form>
        </div>
      </div>
      <?php
    }
  }
  else{
    ?>
      <p class="memeless"><?php echo $this->controller->getTranslation("memeless_shop") ?></p>
    <?php
  }
  ?>
</section>