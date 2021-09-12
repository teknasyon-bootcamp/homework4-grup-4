-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Sep 12, 2021 at 01:42 AM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group4`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` varchar(300) NOT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `published_at`) VALUES
(1, 'Post Title 1', 'Everything\'s not great in life, but we can still find beauty in it. There\'s nothing wrong with having a tree as a friend. It is a lot of fun.', '2021-09-09 13:33:41'),
(2, 'Post Title 2', 'This is the time to get out all your flustrations, much better than kicking the dog around the house or taking it out on your spouse. When you do it your way you can go anywhere you choose. Just pretend you are a whisper floating across a mountain.', '2021-09-09 13:51:31'),
(3, 'Post Title 3', 'Let that brush dance around there and play. If you didn\'t have baby clouds, you wouldn\'t have big clouds. I\'m gonna start with a little Alizarin crimson and a touch of Prussian blue When things happen - enjoy them. They\'re little gifts. And right there you got an almighty cloud.', '2021-09-10 11:11:02'),
(4, 'Post Title 4', 'Talent is a pursued interest. That is to say, anything you practice you can do. Clouds are free they come and go as they please. We might as well make some Almighty mountains today as well, what the heck. Let your imagination be your guide.', '2021-09-12 01:08:04'),
(5, 'Post Title 5', 'If I paint something, I don\'t want to have to explain what it is. We don\'t make mistakes we just have happy little accidents. Mix your color marbly don\'t mix it dead.', '2021-09-12 01:08:44'),
(6, 'Post Title 6', 'We artists are a different breed of people. We\'re a happy bunch. These little son of a guns hide in your brush and you just have to push them out. Let\'s put a touch more of the magic here.', '2021-09-12 01:09:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD UNIQUE KEY `id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
