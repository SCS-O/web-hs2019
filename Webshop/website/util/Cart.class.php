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
	
	public function clear() {
		$this->articles = [];
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

	public function render($controller) {
		if ($this->isEmpty()) {
			echo "<div class=\"cart empty\">" . $controller->getTranslation("cart_emtpy") . "</div>";
		} else {
			echo "<div class=\"cart\"><table>";
			echo "<tr><th>". $controller->getTranslation("cart_title") ."</th></tr>";
			foreach($this->articles as $article) {
				echo "<tr><td>".$article->getArticleTitle()."</td></tr>";
			}
			echo "<tr><th>". $controller->getTranslation("cart_total") ."</th><th>".$this->getTotal()."</th></tr>";
			echo "</table></div>";
			echo ("<a href=\"/index.php?action=checkout\">" . $controller->getTranslation("checkout_link") . "</a>");
		}
	}

}
