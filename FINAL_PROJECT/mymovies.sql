-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 05:50 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymovies`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_ID` int(255) NOT NULL,
  `actorfirstname` varchar(50) NOT NULL,
  `actorlastname` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actor_ID`, `actorfirstname`, `actorlastname`, `role`) VALUES
(4, 'Ralph', 'Fiennes', 'Chef Slowik'),
(6, 'Angela', 'Basset', 'Ramonda'),
(7, 'Anya', 'Taylor-Joy', 'Margot'),
(8, 'Jenna', 'Ortega', 'Wednesday Addams'),
(9, 'Daisy', 'Ridley', 'Rey'),
(10, 'John', 'Boyega', 'Finn'),
(11, 'Tom', 'Cruise', 'Capt. Pete'),
(12, 'Timothee', 'Chalamet', 'Paul Atreides'),
(13, 'Gwendoline', 'Christie', 'Principal Larissa Weems'),
(14, 'Jennifer', 'Connely', 'Penny Benjamin'),
(15, 'Miles', 'Teller', 'Lt. Bradley'),
(16, 'Letitia', 'Wright', 'Shuri'),
(17, 'Lupita', 'Nyong\'o', 'Nakia'),
(18, 'Danai', 'Gurira', 'Okoye'),
(19, 'Winston', 'Duke', 'M\'Baku'),
(20, 'Macaulay ', 'Culkin', 'Kevin'),
(21, 'Joe', 'Pesci', 'Harry'),
(22, 'Daniel', 'Stern', 'Marv'),
(23, 'Arnold', 'Schwarzenegger', 'The Terminator'),
(24, 'Linda', 'Hamilton', 'Sarah Connor'),
(25, 'Arnold', 'Schwarzenegger', 'Trench'),
(26, 'Sylvester', 'Stallone', 'Barney Ross'),
(27, 'Jason', 'Statham', 'Lee Christmas');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `award_ID` int(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`award_ID`, `type`) VALUES
(1, 'Best Original Song'),
(2, 'Best Original Score'),
(3, 'Best Film'),
(4, 'Best Achievement in Film Editing'),
(5, 'Best Achievement in Sound Mixing'),
(6, 'Saturn Award'),
(7, 'Best Comedy'),
(8, 'Best Television Series'),
(9, 'Best Film'),
(10, 'Best Picture'),
(11, 'Best Supporting Actress'),
(12, 'Best Music'),
(13, 'Funniest Actor in a Motion Picture'),
(14, 'Best Sound'),
(15, 'Best Makeup'),
(16, 'Best Action Poster'),
(17, 'Best Action Sequence of the Year');

-- --------------------------------------------------------

--
-- Table structure for table `awardedfilm`
--

CREATE TABLE `awardedfilm` (
  `film_ID` int(255) NOT NULL,
  `award_ID` int(255) NOT NULL,
  `awardeddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `awardedfilm`
--

INSERT INTO `awardedfilm` (`film_ID`, `award_ID`, `awardeddate`) VALUES
(2, 2, '2022-11-17'),
(2, 3, '2022-11-18'),
(3, 7, '2023-01-03'),
(3, 8, '2023-01-01'),
(4, 4, '2022-07-14'),
(4, 5, '2019-08-14'),
(5, 6, '2022-07-29'),
(5, 9, '2023-01-03'),
(7, 10, '2023-01-02'),
(7, 11, '2023-01-03'),
(9, 12, '1991-01-08'),
(9, 13, '1991-02-01'),
(10, 14, '1992-01-02'),
(10, 15, '1992-01-02'),
(11, 16, '2015-01-08'),
(11, 17, '2014-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `castandcrew`
--

CREATE TABLE `castandcrew` (
  `actor_ID` int(255) NOT NULL,
  `film_ID` int(255) NOT NULL,
  `director` varchar(50) DEFAULT NULL,
  `writer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `castandcrew`
--

INSERT INTO `castandcrew` (`actor_ID`, `film_ID`, `director`, `writer`) VALUES
(4, 2, 'Mark Mylod', 'Seth Reiss'),
(7, 2, 'Mark Mylod', 'Seth Reiss'),
(8, 3, 'Tim Burton', 'Charles Addams'),
(9, 4, 'J. J. Abrams', 'Lawrence Kasdan'),
(10, 4, 'J. J. Abrams', 'Lawrence Kasdan'),
(11, 5, 'Joseph Kosinski', 'Jim Cash'),
(13, 3, 'Tim Burton', 'Charles Addams'),
(14, 5, 'Joseph Kosinski', 'Jim Cash'),
(15, 5, 'Joseph Kosinski', 'Jim Cash'),
(16, 7, 'Ryan Coogler', 'Joe Robert Cole'),
(17, 7, 'Ryan Coogler', 'Joe Robert Cole'),
(18, 7, 'Ryan Coogler', 'Joe Robert Cole'),
(19, 7, 'Ryan Coogler', 'Joe Robert Cole'),
(20, 9, 'Chris Columbus', 'John Hughes'),
(21, 9, 'Chris Columbus', 'John Hughes'),
(22, 9, 'Chris Columbus', 'John Hughes'),
(23, 10, 'James Cameron', 'William Wisher'),
(24, 10, 'James Cameron', 'William Wisher'),
(25, 11, 'Patrick Hughes', 'Sylvester Stallone'),
(26, 11, 'Patrick Hughes', 'Sylvester Stallone'),
(27, 11, 'Patrick Hughes', 'Sylvester Stallone');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_ID` int(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `releasedate` date NOT NULL,
  `origin` varchar(20) NOT NULL,
  `language` varchar(20) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_ID`, `title`, `releasedate`, `origin`, `language`, `genre`) VALUES
(2, 'The Menu', '2022-11-18', 'US', 'English', 'Thriller'),
(3, 'Wednesday', '2022-11-23', 'US', 'English', 'Comedy'),
(4, 'Star Wars: The Force Awakens', '2015-12-18', 'US', 'English', 'Sci-Fi'),
(5, 'Top Gun: Maverick', '2022-05-27', 'US', 'English', 'Action'),
(7, 'Black Panther', '2022-11-11', 'US', 'English', 'Action'),
(9, 'Home alone', '1993-04-16', 'US', 'English', 'Comedy'),
(10, 'Teminator 2: Judgement Day', '1991-07-03', 'US', 'English', 'Action'),
(11, 'The Expendables 3', '2014-08-22', 'France', 'English', 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `user_ID` int(255) NOT NULL,
  `film_Id` int(255) NOT NULL,
  `watcheddate` date DEFAULT NULL,
  `grade` int(10) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`user_ID`, `film_Id`, `watcheddate`, `grade`, `comment`) VALUES
(1, 2, '2023-01-02', 10, 'very good'),
(1, 4, '2023-01-03', 8, 'When I go to the movies, I aim to experience one thing: escapism. Even if it\'s for only two hours, I like to occasionally escape this often unfair world we all live in and lose myself in a fictional adventure. And I think I speak for both the young and the young at heart when I say that Star Wars has brought escapism to audiences all over the globe and for many generations over the past 40 years.'),
(1, 5, '2023-01-03', 9, 'What an excellent sequel - I, in fact, like it more than its predecessor.\r\n\r\n\'Top Gun: Maverick\' is fantastic, simply put. I was expecting it to be good, but it\'s actually much more enjoyable than I had anticipated. The callbacks to the original are expertly done, the new characters are strong/well cast, it has plenty of meaning, music is fab and the action is outstanding - the aerial stuff is sensational.'),
(1, 7, '2023-01-03', 6, 'I never thought the original Black Panther was anywhere near being the best solo Marvel movie, but I did enjoy it and T\'Challa\'s character throughout his appearances. With that being said, when Chadwick Boseman sadly passed, I accepted that this franchise was doomed. I always believed that recasting T\'Challa was the only way to go. It would\'ve been incredibly hard to find a good replacement, but the character is very important to the Marvel universe. It is also simply too soon to pass the mantle'),
(1, 10, '2023-01-03', 5, 'Very bad film!'),
(1, 11, '2023-01-03', 7, 'If you\'re thinking of watching \'The Expendables 3,\' then \'part 3\' is a kind of odd place to start any franchise. Therefore, I would generally recommend starting with part 1 and going from there. However, in case you\'re in any wonder as to what it\'s all about, it\'s basically an ensemble cast (led by Sly Stallone) of all the biggest (and best?) action stars of the eighties (plus Jason Statham thrown in for good measure).'),
(2, 3, '2022-12-04', 5, 'Very bad film'),
(2, 4, '2023-01-03', 4, 'Very bad movie'),
(2, 5, '2023-01-03', 10, 'I was reluctantly dragged into the theater, thinking that they didn\'t need to make a Top Gun 2 and that the first one was where that story needed to end.\r\nI could write a couple paragraphs to summarize my feelings after walking out of the theater, but I\'m going to leave it with just one sentence.\r\nI was wrong.'),
(3, 2, '2022-11-22', 9, 'This is a movie that plays on something everyone has come across in their lives: obsession. The movie starts out as a seemingly eerie thriller/suspense type movie with weird and unique quirks, but slowly devolves into something much more wild and very obv'),
(4, 2, '2022-12-06', 8, 'good  but bad'),
(4, 3, '2022-12-06', 9, 'So I thought this was going to be God awful like most Netflix adaptations, but I found myself laughing and appreciating the camerawork, the clothes, the colors, the acting etc. The way everything is colorful and vibrant while Wednesday is just colorless and unemotional makes Wednesday stick out so much from being so out of place. You almost can feel how much she dislikes almost everything. She\'s smart, witty, and honestly kind of scary. Catherine Zeta Jones made me a believer in her from her per'),
(4, 7, '2023-01-03', 8, 'Phase 4\'s MCU comes to a close with Black Panther: Wakanda Forever. It\'s been a truly inconsistent run of films. There was the good (Shang-Chi, Spider-Man, some of Dr. Strange 2), the eh (other parts of Dr. Strange 2, Black Widow and Eternals), and the ugly (Thor 4, which is easily the worst MCU movie so far). If this movie had been bad, it might have been enough to make me bail on keeping up with the MCU\'s movies, and truth be told, I\'ve already bailed on the Disney+ series\', because WandaVisio'),
(4, 9, '2023-01-03', 10, 'Seen this classic so many times and never ceases to get old. With a bunch of great scenery, adorableness, original vibes, and comedy! Macaulay Culkin shined so much, he deserved the millions earned for his role. I love how Joe Pesci went from Scorsese films where he swore so much where as in this he had to bite his tongue. John Hughe was a gifted writer that helmed some gems!'),
(4, 11, '2023-01-03', 6, 'Okay fine The Expendables franchise isn\'t a complete failure in my eyes, this is by far the best one and three movies in shows potential.'),
(10, 9, '2023-01-03', 10, '\'Home Alone\' has succeeded in establishing itself as a Christmas tradition, spawning off three sequels (including a made-for-television flop), and a whole franchise in and of it.\r\n\r\nMacaulay Culkin plays Kevin McCallister, the average American child. He has an attitude almost expected of a Chris Columbus film from the eighties. He lives with a large family, which, right now, being around Christmas time, is about quadrupled, flooded by relatives\' children, all of whom pick on poor, poor Kevin (sy'),
(10, 10, '2023-01-03', 10, 'And yes, I\'d consider this more of an action film than Sci/fi since it takes place in contemporary times and locations. Nowadays, it can be hard to distinguish an action film from a video game. In fact there is one coming out soon that appears to be both. I guess studios these days feel that kids need something to see while resting their fingers after long days of playing their Nintendos/Playstations/whatever. So they come up with all of these PG-13 action films that are often mere meditations o'),
(11, 4, '2023-01-03', 7, 'This film really is nothing more than an Advertisement. I\'ll admit the first time I saw it at the movies I thought it was pretty good, and i watched it another two times with friends and family over the course of a month before it finally left theatres.\r\nBut after seeing it again, I realised something is off, something is not right about this movie.\r\nIt\'s completely hollow with nothing beyond its visuals\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `firstname`, `lastname`, `username`, `email`, `phone`, `password`) VALUES
(1, 'Vlad', 'Iacob', 'vladiacob1', 'iacobvlad33@yahoo.com', '0725131571', '58edb3e78576324f761ca16568de4665'),
(2, 'Andrei1', 'ionescu1', 'andreiionescu1', 'ionescuandrei@gmail.com', '928274621e', '1c2185a33810d3cff9b470ee808a48fa'),
(3, 'Florin', 'Popescu', 'florinpopescu', 'florinpopescu@gmail.com', '123456', '06bd03f639e21ce30382dfb9af29db9e'),
(4, 'Vasile', 'Georgescu', 'vasilegeorgescu1', 'vasilegeorgescu@gmail.com', '8372930', '02008a034567ef7ddb25bf79465d5fa7'),
(5, 'Ion', 'Stefanescu', 'ionsteafnescu', 'ionsteafnescu@gmail.com', '928461818', 'b5a40f483055f4ce50a3c06f460e13ba'),
(6, 'Viorel', 'Sandu', 'viorelsandu', 'viorelsandu@gmail.com', '018373618', 'f23df1bd505c6658cb8af46e23e516da'),
(7, 'Marian', 'Marinescu', 'marianmarinescu', 'marianmarinescu@gmail.com', '07261338276', '4753660ac50f559d3cc6ce629fba2037'),
(8, 'ion', 'ionescu', 'ionionescu', 'ionionescu@gmail.com', '3027817100', 'b5a40f483055f4ce50a3c06f460e13ba'),
(9, 'admin', 'admin', 'admin', 'admin@admin.ro', '0837271', '0192023a7bbd73250516f069df18b500'),
(10, 'Ioana', 'Anghelescu', 'ioananghelescu', 'ioananghelescu@gmail.com', '0281288926', 'e25fde6a6c1762f073d7131b8020b8e7'),
(11, 'Andreea', 'Andreescu', 'andreea123', 'andreea123@gmail.com', '07362718', '25ada33c1367d626bcd04cb53acf7c75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_ID`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`award_ID`);

--
-- Indexes for table `awardedfilm`
--
ALTER TABLE `awardedfilm`
  ADD PRIMARY KEY (`film_ID`,`award_ID`),
  ADD KEY `award_ID` (`award_ID`);

--
-- Indexes for table `castandcrew`
--
ALTER TABLE `castandcrew`
  ADD PRIMARY KEY (`actor_ID`,`film_ID`),
  ADD KEY `castandcrew_ibfk_2` (`film_ID`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`user_ID`,`film_Id`),
  ADD KEY `review_ibfk_2` (`film_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `actor_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `award_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awardedfilm`
--
ALTER TABLE `awardedfilm`
  ADD CONSTRAINT `awardedfilm_ibfk_1` FOREIGN KEY (`film_ID`) REFERENCES `film` (`film_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `awardedfilm_ibfk_2` FOREIGN KEY (`award_ID`) REFERENCES `award` (`award_ID`);

--
-- Constraints for table `castandcrew`
--
ALTER TABLE `castandcrew`
  ADD CONSTRAINT `castandcrew_ibfk_1` FOREIGN KEY (`actor_ID`) REFERENCES `actor` (`actor_ID`),
  ADD CONSTRAINT `castandcrew_ibfk_2` FOREIGN KEY (`film_ID`) REFERENCES `film` (`film_ID`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`film_Id`) REFERENCES `film` (`film_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
