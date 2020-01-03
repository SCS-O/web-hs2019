#CREATE DATABASE meme_shop;
#DROP DATABASE meme_shop;

#DROP TABLE orders_article;
#DROP TABLE article;
#DROP TABLE order;
#DROP TABLE account;

#USE meme_shop;

CREATE TABLE account (
    PK_Account int NOT NULL AUTO_INCREMENT,
    FirstName varchar(100) NOT NULL, 
    LastName varchar(100) NOT NULL, 
    Address varchar(255) NOT NULL,
    City varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    PasswordHash varchar(255) NOT NULL, 
    UNIQUE(PK_Account),
    PRIMARY KEY (PK_Account)
);

CREATE TABLE orders(
    PK_Orders int NOT NULL AUTO_INCREMENT,
    FK_Account int NOT NULL,
    OrderState varchar(255) NOT NULL,
    UNIQUE(PK_Orders),
    PRIMARY KEY (PK_Orders),
    CONSTRAINT FK_Account FOREIGN KEY (FK_Account) REFERENCES account(PK_Account)
);


CREATE TABLE article(
    PK_Article int NOT NULL AUTO_INCREMENT,
    Article_Title varchar(255) NOT NULL,
    Article_Permalink TEXT(2048),
    ArticleId varchar(255) NOT NULL,
    ArticleAuthor TEXT(2048),
    ArticleCreationDate varchar(255) NOT NULL,
    ArticleSubreddit TEXT(2048),
    Price DECIMAL(20,2) NOT NULL,
    Picture_URL TEXT(2048) NOT NULL,
    Thumbnail_URL TEXT(2048) NOT NULL,
    UNIQUE(PK_Article),
    PRIMARY KEY (PK_Article)
);


CREATE TABLE orders_article(
    PK_Orders_Article int NOT NULL AUTO_INCREMENT,
    FK_Orders int NOT NULL,
    FK_Article int NOT NULL,
    UNIQUE(PK_Orders_Article),
    PRIMARY KEY (PK_Orders_Article),
    CONSTRAINT FK_Orders FOREIGN KEY (FK_Orders) REFERENCES orders(PK_Orders),
    CONSTRAINT FK_Article FOREIGN KEY (FK_Article) REFERENCES article(PK_Article)
);