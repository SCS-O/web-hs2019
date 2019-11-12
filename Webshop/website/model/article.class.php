<?php
class Article{
    private $PK_Article;
    private $Article_Name_DE;
    private $Article_Description_DE;
    private $Article_Name_FR;
    private $Article_Description_FR;
    private $Article_Name_EN;
    private $Article_Description_EN;
    private $Price;
    private $Picture_URL;

    public function getArticleName($lang) {
        if($lang === "de")
        {
            return $this->Article_Name_DE;
        }
        else if ($lang === "fr"){
            return $this->Article_Name_FR;
        }
        else{
            return $this->Article_Name_EN;
        }
    }
    
    public function getArticleDescription($lang) {
        if($lang === "de")
        {
            return $this->Article_Description_DE;
        }
        else if ($lang === "fr"){
            return $this->Article_Description_FR;
        }
        else{
            return $this->Article_Description_EN;
        }
    }

    public function __toString(){
        return sprintf("%s, %f", $this->Article_Name_EN, $this->Price);
    }
        

    static public function getArticles() {
        $Articles = array();
        $res = DB::doQuery("SELECT a.* FROM article a");
        if ($res) {
            while ($article = $res->fetch_object(get_class())) 
            {
                $articles[] = $article;
            }
        }
        return $articles;
    }

    static public function getArticleById($PK_Article) {
        $res = DB::doQuery("SELECT a.* FROM article a WHERE a.PK_Article = $PK_Article");
        if ($res) {
            if ($article = $res->fetch_object(get_class())) 
            {
                return $article;                    
            }
        }
        return null;
    }   
}