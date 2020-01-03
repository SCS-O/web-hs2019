<?php
class Article{
    private $PK_Article = null;
    private $Article_Title;
    private $Article_Permalink;
    private $ArticleId;
    private $ArticleAuthor;
    private $ArticleCreationDate;
    private $ArticleSubreddit;
    private $Price;
    private $Picture_URL;
    private $Thumbnail_URL;

    //https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
    public static function create($Article_Title, $Article_Permalink, $ArticleId, $ArticleAuthor, $ArticleCreationDate, $ArticleSubreddit, $Price, $Picture_URL, $Thumbnail_URL)
    {
        $instance = new self();

        $instance->Article_Title = $Article_Title;
        $instance->Article_Permalink = $Article_Permalink;
        $instance->ArticleId = $ArticleId;
        $instance->ArticleAuthor = $ArticleAuthor;
        $instance->ArticleCreationDate = $ArticleCreationDate;
        $instance->ArticleSubreddit = $ArticleSubreddit;
        $instance->Price = $Price;
        $instance->Picture_URL = $Picture_URL;
        $instance->Thumbnail_URL = $Thumbnail_URL;

        return $instance;
    }

    public function getArticleTitle() {

        return $this->Article_Title;
   }

    public function getArticleRedditId(){
        return $this->ArticleId;
    }

    public function getArticleCreationDate() {
        return $this->ArticleCreationDate;
    }
    
    public function getArticlePermalink() {
        return $this->Article_Permalink;
    }
    
    public function getArticleAuthor() {
        return $this->ArticleAuthor;
    }
    
    public function getArticleSubreddit() {
        return $this->ArticleSubreddit;
    }
    
    public function getArticlePrice() {
        return $this->Price;
    }

    //Only use this after the meme has been sold
    public function getArticlePicture() {
        return $this->Picture_URL;
    }
    
    public function getArticleThumbnail() {
        return $this->Thumbnail_URL;
    }

    public function getArticleId() {
        return $this->PK_Article;
    }
       
    public function __toString(){
        return sprintf("%s, %f", $this->ArticleCreationDate, $this->Price);
    }        

    static public function getArticles($default=50) {
        $Articles = array();
        
        $res = DB::doQuery(sprintf("SELECT a.* FROM article a order by a.ArticleCreationDate desc LIMIT %d", $default));
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
    
    public function saveObject()
    {
        if(isset($this->PK_Account) && $this->PK_Account !== null)
        {
            $res = DB::doQuery(sprintf("UPDATE article
                SET Article_Title = '%s', Article_Permalink = '%s', ArticleId = '%s', ArticleAuthor, ArticleCreationDate = '%s', ArticleSubreddit = '%s', Price = %d, Picture_URL = '%s', Thumbnail_URL = '%s'
                WHERE PK_Article = %d", 
                mysqli_real_escape_string(DB::getInstance(), $this->Article_Title), 
                mysqli_real_escape_string(DB::getInstance(), $this->Article_Permalink), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleId), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleAuthor), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleCreationDate), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleSubreddit), 
                mysqli_real_escape_string(DB::getInstance(), $this->Price), 
                mysqli_real_escape_string(DB::getInstance(), $this->Picture_URL), 
                mysqli_real_escape_string(DB::getInstance(), $this->Thumbnail_URL), 
                $this->PK_Article
                ));
        }
        else{
            $res = DB::doQuery(sprintf("INSERT INTO article(Article_Title, Article_Permalink, ArticleId, ArticleAuthor, ArticleCreationDate, ArticleSubreddit, Price, Picture_URL, Thumbnail_URL)
            VALUES('%s', '%s', '%s', '%s', '%s', '%s', %d,'%s', '%s');", 
                mysqli_real_escape_string(DB::getInstance(), $this->Article_Title), 
                mysqli_real_escape_string(DB::getInstance(), $this->Article_Permalink), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleId), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleAuthor), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleCreationDate), 
                mysqli_real_escape_string(DB::getInstance(), $this->ArticleSubreddit), 
                mysqli_real_escape_string(DB::getInstance(), $this->Price), 
                mysqli_real_escape_string(DB::getInstance(), $this->Picture_URL), 
                mysqli_real_escape_string(DB::getInstance(), $this->Thumbnail_URL)
            ));
        }
    }
    
    //check if reddit id is already in DB 
    static public function isArticle($ArticleId){
        $res = DB::doQuery("SELECT a.ArticleId FROM article a WHERE a.ArticleId = '" . mysqli_real_escape_string(DB::getInstance(), $ArticleId) . "';");
        if ($res) {
            if ($account = $res->fetch_object(get_class())) 
            {
                return TRUE;                    
            }
        }
        return FALSE;
    }
}