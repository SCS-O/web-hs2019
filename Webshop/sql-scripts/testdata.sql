USE meme_shop;

INSERT INTO `account` (`PK_Account`, `FirstName`, `LastName`, `Address`, `City`, `Email`, `PasswordHash`) 
VALUES
(NULL, 'Marc', 'Trittibach', 'Tannenweg 1', 'Solothurn', 'marc.trittibach@gmail.com', 'asdfdsafasdfsadf'),
(NULL, 'Simon', 'sterchi', 'asdf 1', '3000 Bern', 'foo.bar@test.com', 'asdfölksajdfsaödlkf');

INSERT INTO `article` (`PK_Article`, `Article_Title`, `Article_Permalink`, `ArticleId`, `ArticleAuthor`, `ArticleCreationDate`, `ArticleSubreddit`, `Price`, `Picture_URL`, `Thumbnail_URL`)
VALUES 
(NULL, 'de_article1', 'lorem ipsum', 'fr_article1', 'lorem ipsum', 'en_article1', 'lorem ipsum', '12.5', 'foo.bar.com', 'foo.thumb.com');

INSERT INTO `orders` (`PK_Orders`, `FK_Account`, `OrderState`) VALUES (NULL, '2', 'ordered'), (NULL, '1', 'cancelled');

INSERT INTO `orders_article` (`PK_Orders_Article`, `FK_Orders`, `FK_Article`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 3),
(4, 2, 2);
