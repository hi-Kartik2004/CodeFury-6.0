-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2023 at 08:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mental_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `email`, `score`, `created_at`) VALUES
(6, 'kudlu2004@gmail.com', 10, '2023-09-23 09:07:00'),
(7, 'kudlu2004@gmail.com', 20, '2023-09-23 15:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `comment` varchar(400) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `comment_id`, `created_at`) VALUES
(8, 'test', 'kudlu2004@gmail.com', 'My first comment on post id 25', 25, '2023-09-23 18:17:41'),
(9, 'test', 'kudlu2004@gmail.com', 'Seems like this was inserted from phpMyAdmin :)\r\n', 24, '2023-09-23 18:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `post` varchar(3000) NOT NULL,
  `email` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `post`, `email`, `created_at`) VALUES
(21, 'test', '<h5>You can also add images to your post, just wow!</h5>\n<img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHDLX7M64ynCaU-MM1MmnLLadjOnAaEKbszBFebnGAOKjR8sMKFtY6c4NTv8n_b4eZkKU&usqp=CAU\" alt=\"temp\">', 'kudlu2004@gmail.com', '2023-09-23 16:48:09'),
(22, 'test', 'testing ', 'kudlu2004@gmail.com', '2023-09-23 16:48:22'),
(23, 'test', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem facilis qui soluta expedita, natus eum exercitationem aut cumque reiciendis voluptas tenetur officia maxime corporis ipsam voluptate nostrum veritatis architecto unde iusto id quas voluptates beatae, numquam explicabo? Accusamus quisquam velit illo pariatur nulla. Excepturi tempora illum perspiciatis nobis exercitationem vero dolore nisi! Tempora aspernatur veritatis aliquid fugit fugiat consequatur corrupti laboriosam architecto iure dolor expedita nemo, ut officiis perspiciatis suscipit quaerat ipsam inventore? Quam repudiandae placeat iusto beatae non eum possimus quidem, ea cupiditate sunt vero vitae modi saepe autem! Inventore sed dolorem cumque error facilis vero commodi iure repellendus quae nulla rem qui, molestias non debitis illum quaerat! Aliquid voluptatum perferendis omnis nostrum magni doloremque repellat dignissimos rerum. Eos laborum suscipit adipisci a facilis? Amet, laborum itaque, dolorem excepturi quisquam repellendus velit, optio eius nostrum maxime libero! Sapiente vero ipsam corrupti eaque blanditiis. Sint quaerat quas expedita. Quis earum asperiores deleniti tempore excepturi rem amet dolorum nisi velit cumque magnam, suscipit natus ratione reprehenderit similique ex quia sed odio eaque. Vitae, maxime temporibus impedit ullam ad, voluptatibus beatae laborum fugiat quia aut aliquid animi aliquam provident obcaecati maiores quae commodi quibusdam! Dolore, magni aliquid eum sunt earum at a ipsa deleniti rerum quisquam fugiat quo ex doloremque cupiditate sapiente doloribus expedita officiis. Perferendis voluptate odio nobis optio quos aspernatur harum inventore, ex, corrupti facilis unde culpa eum reiciendis labore. Illum, quos et, inventore doloribus, expedita sint necessitatibus vero quo minus consectetur distinctio architecto voluptatibus odio dicta velit. Itaque nam, voluptas fugit dolore non optio ab. Inventore ipsam quod ratione delectus, illum expedita blanditiis dignissimos fuga mollitia. Aliquid unde, accusamus fuga ullam nisi optio iure earum quidem ducimus, alias placeat laborum totam. Ab maxime odit, eaque architecto molestias laborum iure reprehenderit voluptas fuga et. Corporis soluta, nesciunt eligendi eos excepturi quod nobis, aliquid laudantium architecto nam ad perferendis facere, hic illo culpa facilis dolores et asperiores voluptates cumque ea beatae odit? Laboriosam, quasi necessitatibus, ab qui reprehenderit laudantium ipsam, ipsa ipsum nisi perferendis ad rerum veniam mollitia accusamus voluptatibus exercitationem aspernatur alias saepe sunt? Aspernatur ea illum repellendus ad molestiae numquam, neque explicabo voluptates. Sunt impedit eos officiis nihil perspiciatis odit optio itaque tenetur ad iure sit alias incidunt illum eligendi nisi sequi labore, quam earum. Cumque, illum. Distinctio quis ad molestiae eligendi deleniti explicabo, minima inventore vero rerum dolores perspiciatis sit voluptates nisi accusamus magnam fugit assumenda? Asperi', 'kudlu2004@gmail.com', '2023-09-23 16:48:43'),
(24, 'Added from SQL', 'Added from SQL', 'sql@gmail.com', '2023-09-23 17:02:32'),
(25, 'test', '1212', 'kudlu2004@gmail.com', '2023-09-23 17:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip` varchar(100) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT 0,
  `connect` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `created_at`, `updated_at`, `ip`, `auth`, `connect`) VALUES
(9, 'test', 'raja', 'kudlu2004@gmail.com', 123, '12', '2023-06-07 08:43:59', '2023-09-23 23:31:23', '::1', 1, '1'),
(10, 'temp', 'mail', 'varidem577@bookspre.com', NULL, '12', '2023-09-23 06:27:27', '2023-09-23 12:00:58', '::1', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `access_type` varchar(100) NOT NULL DEFAULT 'Login',
  `ip` varchar(256) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `email`, `updated_at`, `access_type`, `ip`, `status`) VALUES
(1, 'kudlu2004@gmail.com', '2023-09-23 09:54:31', 'Login', '::1', 0),
(2, 'kudlu2004@gmail.com', '2023-09-23 11:45:01', 'Login', '::1', 0),
(3, 'varidem577@bookspre.com', '2023-09-23 12:00:58', 'Login', '::1', 0),
(4, 'kudlu2004@gmail.com', '2023-09-23 14:13:56', 'Login', '::1', 0),
(5, 'kudlu2004@gmail.com', '2023-09-23 19:12:45', 'Login', '::1', 0),
(6, 'kudlu2004@gmail.com', '2023-09-23 23:30:59', 'Login', '::1', 0),
(7, 'kudlu2004@gmail.com', '2023-09-23 23:31:23', 'Login', '::1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
