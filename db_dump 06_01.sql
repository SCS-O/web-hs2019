-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 02:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meme_shop`
--
CREATE DATABASE IF NOT EXISTS `meme_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `meme_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `PK_Account` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`PK_Account`, `FirstName`, `LastName`, `Address`, `City`, `Email`, `PasswordHash`) VALUES
(1, 'Marc1', 'Trittibach', 'Tannenweg 1', 'Solothurn', 'marc.trittibach@gmail.com', 'asdfdsafasdfsadf'),
(2, 'Simon', 'sterchi', 'asdf 1', '3000 Bern', 'foo.bar@test.com', 'asdfölksajdfsaödlkf');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `PK_Article` int(11) NOT NULL,
  `Article_Title` varchar(255) NOT NULL,
  `Article_Permalink` text DEFAULT NULL,
  `ArticleId` varchar(255) NOT NULL,
  `ArticleAuthor` text DEFAULT NULL,
  `ArticleCreationDate` varchar(255) NOT NULL,
  `ArticleSubreddit` text DEFAULT NULL,
  `Price` decimal(20,2) NOT NULL,
  `Picture_URL` text NOT NULL,
  `Thumbnail_URL` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`PK_Article`, `Article_Title`, `Article_Permalink`, `ArticleId`, `ArticleAuthor`, `ArticleCreationDate`, `ArticleSubreddit`, `Price`, `Picture_URL`, `Thumbnail_URL`) VALUES
(1, 'de_article1', 'lorem ipsum', 'fr_article1', 'lorem ipsum', 'en_article1', 'lorem ipsum', '12.50', 'https://i.redd.it/0k0ci565ls741.jpg', 'https://b.thumbs.redditmedia.com/I9h0SqSeX0zkwP4glEizxGJPpZGUCQ0d0Kdh3AcYTxs.jpg'),
(2, 'de_article12', 'lorem ipsum', 'fr_article12', 'lorem ipsum', 'en_article12', 'lorem ipsum', '44.50', 'https://i.imgur.com/99crufq.jpg', 'https://b.thumbs.redditmedia.com/ww18lr7BfuZ6A0lUTYmYkkKobHYUYBlL9rjUasefj6E.jpg'),
(3, 'de_article13', 'lorem ipsum3', 'fr_article13', 'lorem ipsum3', 'en_article13', 'lorem ipsum3', '14.50', 'https://i.redd.it/sriftyygcs741.jpg', 'https://b.thumbs.redditmedia.com/wNjFgwuwM0r8kraSBjrCn4NHJMhIWMRWSmbTo1hbqlo.jpg'),
(82, 'Hope yall had a merry Christmas.', '/r/teenagers/comments/efnnd1/hope_yall_had_a_merry_christmas/', 'efnnd1', 'RedninjaJ', '1577346130', 'teenagers', '59010.00', 'https://i.redd.it/mnji36ho8v641.png', 'https://b.thumbs.redditmedia.com/KkhNXyywW-6IasEkhT6kVPV_l3qHsyp2hKELh4yUCAE.jpg'),
(83, 'Boys have such low self esteem that a complement or a laugh is enough for them to develop a crush on a girl.', '/r/teenagers/comments/e7m4s3/boys_have_such_low_self_esteem_that_a_complement/', 'e7m4s3', 'satanscumrag', '1575792011', 'teenagers', '52071.00', 'https://www.reddit.com/r/teenagers/comments/e7m4s3/boys_have_such_low_self_esteem_that_a_complement/', 'self'),
(84, 'A kid played the pornhub opening on the drums during a little Christmas concert', '/r/teenagers/comments/eddymp/a_kid_played_the_pornhub_opening_on_the_drums/', 'eddymp', 'Tim1119s', '1576895332', 'teenagers', '49447.00', 'https://www.reddit.com/r/teenagers/comments/eddymp/a_kid_played_the_pornhub_opening_on_the_drums/', 'self'),
(85, 'I made a M&amp;M sorter with Lego. My first Lego Mindstorms project.', '/r/teenagers/comments/e5m076/i_made_a_mm_sorter_with_lego_my_first_lego/', 'e5m076', 'Toni_666', '1575429336', 'teenagers', '28703.00', 'https://v.redd.it/u594l2a2xg241', 'https://b.thumbs.redditmedia.com/KfsVE9OMTMZCG0oQQ9Ny8iS3g2Sqo40fum7z1EFsK_k.jpg'),
(86, 'dying from taking too much viagra must be a hard way to go', '/r/teenagers/comments/edu4in/dying_from_taking_too_much_viagra_must_be_a_hard/', 'edu4in', 'MiniTie93', '1576985179', 'teenagers', '28240.00', 'https://www.reddit.com/r/teenagers/comments/edu4in/dying_from_taking_too_much_viagra_must_be_a_hard/', 'self'),
(87, 'How to get a girlfriend: Advice from a girl.', '/r/teenagers/comments/e7wejb/how_to_get_a_girlfriend_advice_from_a_girl/', 'e7wejb', 'ScarletHawk110', '1575854422', 'teenagers', '25892.00', 'https://www.reddit.com/r/teenagers/comments/e7wejb/how_to_get_a_girlfriend_advice_from_a_girl/', 'self'),
(88, 'Almost 1 year out of recovery without even a sip. 1/1/20 here I come!', '/r/AdviceAnimals/comments/ecbnku/almost_1_year_out_of_recovery_without_even_a_sip/', 'ecbnku', 'snrbtz', '1576698983', 'AdviceAnimals', '43892.00', 'https://i.imgur.com/ZBG1lOI.jpg', 'https://b.thumbs.redditmedia.com/Q-Kr8T88nzWLk_CSjjglPf5so54V-9S___ezHVLzSxs.jpg'),
(89, 'Is this a new year\'s thing, or just a new party thing?', '/r/AdviceAnimals/comments/eirand/is_this_a_new_years_thing_or_just_a_new_party/', 'eirand', 'Brapwurst', '1577958142', 'AdviceAnimals', '14268.00', 'https://i.imgur.com/t0RU1e0.jpg', 'https://b.thumbs.redditmedia.com/OoGFf3FdHHON8kjVXKrdLSUmcfiC9GBE7c_ElF0uUAQ.jpg'),
(90, 'I was doing baby talk with the dog and saying \"Who\'s a pretty girl?\" \"Who\'s the prettiest girl in the house? \" I forgot my wife and daughter were in the room.', '/r/AdviceAnimals/comments/e9h1a2/i_was_doing_baby_talk_with_the_dog_and_saying/', 'e9h1a2', 'Finrod_the_awesome', '1576144727', 'AdviceAnimals', '12508.00', 'https://imgur.com/Yh5Ywlp', 'https://b.thumbs.redditmedia.com/VQV_nFEyGQHMmaAITXg_czFRDetEFcDt3YlQA_sZ0JI.jpg'),
(91, 'It\'s the fastest way to get a downvote out of me.', '/r/AdviceAnimals/comments/ehyvxe/its_the_fastest_way_to_get_a_downvote_out_of_me/', 'ehyvxe', 'isobane', '1577801182', 'AdviceAnimals', '11746.00', 'https://i.imgur.com/1Z3GlOD.png', 'https://b.thumbs.redditmedia.com/KG80hIIxJIVJ2CH1uT65SZdFfrOncrUkejy_VJYUqFs.jpg'),
(92, 'I\'m sure I\'ll only be haunted by this for a couple of decades.', '/r/AdviceAnimals/comments/edxbee/im_sure_ill_only_be_haunted_by_this_for_a_couple/', 'edxbee', 'AbsolutelyUnlikely', '1577000860', 'AdviceAnimals', '9098.00', 'https://i.redd.it/tqyfsp52q2641.png', 'https://a.thumbs.redditmedia.com/pp54GZmLPZAvBBFKweZjQti9T-OdNmLymSyHaqaoy50.jpg'),
(93, 'A big red bow in the driveway', '/r/AdviceAnimals/comments/eelgqz/a_big_red_bow_in_the_driveway/', 'eelgqz', 'Jerdarnella', '1577141175', 'AdviceAnimals', '6572.00', 'https://i.redd.it/6k7mi0z5be641.png', 'https://b.thumbs.redditmedia.com/HgYDCa4iWVStxmX19vUCayGkUspRS7oPUNoCqdv-xLw.jpg'),
(94, 'Must reset password every 30 days, can\'t be the same password as before, must have caps/lower case/number/special character, cannot be a word, etc...', '/r/AdviceAnimals/comments/egspen/must_reset_password_every_30_days_cant_be_the/', 'egspen', 'makenzie71', '1577579418', 'AdviceAnimals', '5369.00', 'https://i.imgur.com/MmOIqds.png', 'https://b.thumbs.redditmedia.com/SaiJWYJDL7FOTbyvmzr7HEp5VEYOxieMsj4oa4ZMm0w.jpg'),
(95, 'When Wednesday is a Holiday', '/r/AdviceAnimals/comments/eev15a/when_wednesday_is_a_holiday/', 'eev15a', 'xorian', '1577184822', 'AdviceAnimals', '3735.00', 'https://i.imgur.com/MvSyjPc.jpg', 'https://b.thumbs.redditmedia.com/W-zLVMsz9R7qbqZDm_Kq6QbvROBoq2DFTwIcIFb2Dgc.jpg'),
(96, 'I had a moment at the grocery store', '/r/AdviceAnimals/comments/ej0j59/i_had_a_moment_at_the_grocery_store/', 'ej0j59', 'Red_Squadr0n', '1578012071', 'AdviceAnimals', '3248.00', 'https://imgur.com/Cg4BLao', 'https://b.thumbs.redditmedia.com/bE4aj-jzOpuGjw3Z6814c5hqr3IzzGcSsWTMdLEbFDM.jpg'),
(97, 'Can\'t I just tip a $1 to be eligible rather than buy another item?...', '/r/AdviceAnimals/comments/eh9jz1/cant_i_just_tip_a_1_to_be_eligible_rather_than/', 'eh9jz1', 'fiercefoxx', '1577673563', 'AdviceAnimals', '2525.00', 'https://i.imgflip.com/3kpu3v.jpg', 'https://b.thumbs.redditmedia.com/nkSLwfs-Jm1UEA-P2fanxoe63R9DQRF8qORrSbTKVGw.jpg'),
(98, 'I photoshopped a magpie and a killer whale together', '/r/funny/comments/e8sg8m/i_photoshopped_a_magpie_and_a_killer_whale/', 'e8sg8m', 'DeJMan', '1576022447', 'funny', '108118.00', 'https://i.imgur.com/1cXF9mO.jpg', 'https://b.thumbs.redditmedia.com/zpv1Os4H2k32MTQl8FMOn7e2L6O1RKcdW-p2WN3k2jQ.jpg'),
(99, 'So, some guy decided to cosplay as Johnny Depp\'s character in a movie - ALL of them.', '/r/funny/comments/e7to2v/so_some_guy_decided_to_cosplay_as_johnny_depps/', 'e7to2v', 'bettorworse', '1575840305', 'funny', '95390.00', 'https://i.imgur.com/vaoijli.jpg', 'https://b.thumbs.redditmedia.com/A0OUqJPhHa_tai5Q6yxL7rw0LUsUgAFinaXvFOhC_cE.jpg'),
(100, 'My daughter fell asleep in the cart at the grocery store last night and she totally looked like a fallen viking warrior being sent out to sea.', '/r/funny/comments/egiuij/my_daughter_fell_asleep_in_the_cart_at_the/', 'egiuij', 'JephriB', '1577518700', 'funny', '66574.00', 'https://i.imgur.com/8NGui6D.jpg', 'https://b.thumbs.redditmedia.com/GicsLhhbexxqjVFoNyCS1B8LFpqpzcvQiQ3_6hxNW7E.jpg'),
(101, 'Trust me... I\'m a professional', '/r/funny/comments/eh7b57/trust_me_im_a_professional/', 'eh7b57', 'Thund3rbolt', '1577663044', 'funny', '55145.00', 'https://v.redd.it/3yx9zguqel741', 'https://b.thumbs.redditmedia.com/QWmKofBW6BuL5UtQH42RvX0-fGDdRMLFrxUSX2nQruI.jpg'),
(102, 'I taped my iPhone to my window to record a time-lapse of a beautiful sunset.......', '/r/funny/comments/e8d4bd/i_taped_my_iphone_to_my_window_to_record_a/', 'e8d4bd', 'stevemw', '1575941810', 'funny', '52004.00', 'https://v.redd.it/e3lea88m8n341', 'https://b.thumbs.redditmedia.com/suHG28KOgcPld2KVD3IllySm9-MFOVbjqLTftz7vEVQ.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `PK_Orders` int(11) NOT NULL,
  `FK_Account` int(11) NOT NULL,
  `OrderState` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`PK_Orders`, `FK_Account`, `OrderState`) VALUES
(1, 2, 'New'),
(2, 1, 'Completed'),
(3, 2, 'Completed'),
(4, 1, 'Completed'),
(5, 2, 'New'),
(6, 1, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `orders_article`
--

CREATE TABLE `orders_article` (
  `PK_Orders_Article` int(11) NOT NULL,
  `FK_Orders` int(11) NOT NULL,
  `FK_Article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_article`
--

INSERT INTO `orders_article` (`PK_Orders_Article`, `FK_Orders`, `FK_Article`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 3),
(4, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`PK_Account`),
  ADD UNIQUE KEY `PK_Account` (`PK_Account`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`PK_Article`),
  ADD UNIQUE KEY `PK_Article` (`PK_Article`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`PK_Orders`),
  ADD UNIQUE KEY `PK_Orders` (`PK_Orders`),
  ADD KEY `FK_Account` (`FK_Account`);

--
-- Indexes for table `orders_article`
--
ALTER TABLE `orders_article`
  ADD PRIMARY KEY (`PK_Orders_Article`),
  ADD UNIQUE KEY `PK_Orders_Article` (`PK_Orders_Article`),
  ADD KEY `FK_Orders` (`FK_Orders`),
  ADD KEY `FK_Article` (`FK_Article`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `PK_Account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `PK_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `PK_Orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_article`
--
ALTER TABLE `orders_article`
  MODIFY `PK_Orders_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Account` FOREIGN KEY (`FK_Account`) REFERENCES `account` (`PK_Account`);

--
-- Constraints for table `orders_article`
--
ALTER TABLE `orders_article`
  ADD CONSTRAINT `FK_Article` FOREIGN KEY (`FK_Article`) REFERENCES `article` (`PK_Article`),
  ADD CONSTRAINT `FK_Orders` FOREIGN KEY (`FK_Orders`) REFERENCES `orders` (`PK_Orders`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
