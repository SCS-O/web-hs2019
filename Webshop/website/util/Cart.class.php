<?php
/*
 * Adopted from topic 10 by Philipp Locher
 */
class Cart {

	// product id
	private $articles = [];

	public function addItem($articleId) {
        $this->articles[$articleId] = Article::getArticleById($articleId);
	}

	public function removeItem($articleId) {
		unset($this->articles[$articleId]);
	}

	public function getItems() {
		return $this->articles;
	}

	public function isEmpty() {
		return count($this->articles) == 0;
	}

	public function getTotal() {
		$total = 0;
		foreach($this->articles as $article) {
			$p =  $article->getArticlePrice();
			$total += $p;
		}
		return $total;
	}

	public function render($language) {
		if ($this->isEmpty()) {
			echo "<div class=\"cart empty\">[Empty Cart]</div>";
		} else {
			echo "<div class=\"cart\"><table>";
			echo "<tr><th>Meme</th></tr>";
			foreach($this->articles as $article) {
				echo "<tr><td>".$article->getArticleName($language)."</td></tr>";
			}
			echo "<tr><th>TOTAL</th><th>".$this->getTotal()."</th></tr>";
			echo "</table></div>";
		}
	}

}
