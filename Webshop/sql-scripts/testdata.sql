USE meme_shop;

INSERT INTO `account` (`PK_Account`, `FirstName`, `LastName`, `Address`, `City`, `Email`, `PasswordHash`) 
VALUES
(NULL, 'Marc', 'Trittibach', 'Tannenweg 1', 'Solothurn', 'marc.trittibach@gmail.com', 'asdfdsafasdfsadf'),
(NULL, 'Simon', 'sterchi', 'asdf 1', '3000 Bern', 'foo.bar@test.com', 'asdfölksajdfsaödlkf');

INSERT INTO `article` (`PK_Article`, `Article_Name_DE`, `Article_Description_DE`, `Article_Name_FR`, `Article_Description_FR`, `Article_Name_EN`, `Article_Description_EN`, `Price`, `Picture_URL`)
VALUES 
(NULL, 'de_article1', 'lorem ipsum', 'fr_article1', 'lorem ipsum', 'en_article1', 'lorem ipsum', '12.5', 'foo.bar.com');

INSERT INTO `orders` (`PK_Orders`, `FK_Account`, `OrderState`) VALUES (NULL, '2', 'ordered'), (NULL, '1', 'cancelled');