-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 12:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landingdashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'AustineTest@Ganlaxmine.com', '$2y$10$zcEKGhhKVMkwKimsHwz8heDc4MwYnhNFzlW3.wBDR8GsqBPXw82Va'),
(2, 'AustineTest@Ganlaxmine.com', '$2y$10$Uzorlpk4Pm8TGPDHWugV1OxEqLMnUyNGuzyR1oPsvVLgT7PYUvM/K');

-- --------------------------------------------------------

--
-- Table structure for table `businessinfoimage`
--

CREATE TABLE `BusinessInfoImage` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businessinfoimage`
--

INSERT INTO `BusinessInfoImage` (`id`, `heading`, `text`, `image`) VALUES
(1, 'Make your Business Better. Grow your Business', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt finibus tortor. Donec lobortis augue sed ante molestie, vitae maximus nunc semper.\r\n\r\nCoder-Test overcomes challenges, achieves results, and adds value to our clients and partners. Take a look at some of our clients\' success stories. Take a look at some of our clients\' success stories.', '/images/7c75f154499549c.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `businessinfolist`
--

CREATE TABLE `BusinessInfoList` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businessinfolist`
--

INSERT INTO `BusinessInfoList` (`id`, `text`) VALUES
(2, 'Nunc scelerisque urna nec quam efficitur semper.'),
(3, 'Ut eu lectus non massa rhoncus elementum.');

-- --------------------------------------------------------

--
-- Table structure for table `editheadingtexts`
--

CREATE TABLE `editHeadingTexts` (
  `id` int(10) UNSIGNED NOT NULL,
  `h1` varchar(255) NOT NULL,
  `playButtonLink` varchar(255) NOT NULL,
  `subH1` varchar(255) NOT NULL,
  `getStartedLink` varchar(255) NOT NULL,
  `headingMessageText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editheadingtexts`
--

INSERT INTO `editHeadingTexts` (`id`, `h1`, `playButtonLink`, `subH1`, `getStartedLink`, `headingMessageText`) VALUES
(1, 'Design Products<br/> Deliver Experience', '#', 'A full-service digital marketing firm that specialises in human-centered experiences.<br/> We bring companies and people together.', 'https://wa.me/08072999853', 'We Design Digital Solutions\r\nFor Brands, Companies & Startups.');

-- --------------------------------------------------------

--
-- Table structure for table `getsolutiontext`
--

CREATE TABLE `GetSolutionText` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `getsolutiontextlist`
--

CREATE TABLE `GetSolutionTextList` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `percent` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headingslidecontainers`
--

CREATE TABLE `headingSlideContainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `iconImage` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `clickRedir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headingslidecontainers`
--

INSERT INTO `headingSlideContainers` (`id`, `iconImage`, `name`, `clickRedir`) VALUES
(8, '/images/ac7d1a9ce0ec06b.png', 'Web development', 'sdsd..dsd'),
(9, '/images/b5a10896a4a00cc.png', 'Web design', 'sdsd..dsd'),
(10, '/images/a30dec415d618a7.png', 'SEO Optimization', 'https:example.com'),
(11, '/images/0e429b7ded27372.png', 'UI/UX Design', 'example.com');

-- --------------------------------------------------------

--
-- Table structure for table `latestprojects`
--

CREATE TABLE `LatestProjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `subHeading` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latestprojects`
--

INSERT INTO `LatestProjects` (`id`, `heading`, `subHeading`) VALUES
(1, 'Our latest projects', 'Coder-Test overcomes challenges, achieves results, and adds value to our clients and partners. Take a look at some of our clients\' success stories. Take a look at some of our clients\' success stories.');

-- --------------------------------------------------------

--
-- Table structure for table `latestprojectslist`
--

CREATE TABLE `LatestProjectsList` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `subHeading` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latestprojectslist`
--

INSERT INTO `LatestProjectsList` (`id`, `image`, `heading`, `subHeading`) VALUES
(1, '/images/62ec5d4d65a21f8.jpg', 'Web app', 'React'),
(2, '/images/c58254d8dbdf7e9.jpg', 'Palmpay ', 'Fluter'),
(3, '/images/607f720034a6ab2.jpg', 'Web app', 'React'),
(4, '/images/aacca9de4370ffd.jpg', 'Mobile App', 'React');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `hashTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `name`, `hashTag`) VALUES
(2, 'About Us', 'AboutUs'),
(3, 'Services', 'Services'),
(4, 'Portfolio', 'Portfolio'),
(5, 'Blogs', 'Blogs'),
(6, 'Contact Us', 'ContactUs'),
(7, 'Developer ', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `ourinfo`
--

CREATE TABLE `OurInfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `YearsOfExperience` varchar(255) NOT NULL,
  `talentedTeam` varchar(255) NOT NULL,
  `projectsDelivered` varchar(255) NOT NULL,
  `countriesServed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ourinfo`
--

INSERT INTO `OurInfo` (`id`, `YearsOfExperience`, `talentedTeam`, `projectsDelivered`, `countriesServed`) VALUES
(1, '6', '90', '150', '12');

-- --------------------------------------------------------

--
-- Table structure for table `pageinfo`
--

CREATE TABLE `pageInfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pageinfo`
--

INSERT INTO `pageInfo` (`id`, `logo`, `name`) VALUES
(7, '/images/b0e15808503348b.svg', 'Blueket');

-- --------------------------------------------------------

--
-- Table structure for table `servicesweprovide`
--

CREATE TABLE `ServicesWeProvide` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `subHeading` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicesweprovide`
--

INSERT INTO `ServicesWeProvide` (`id`, `heading`, `subHeading`) VALUES
(1, 'Services We Provide', 'Coder-Test overcomes challenges, achieves results, and adds value to our clients and partners. Take a look at some of our clients\' success stories.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `subnavigations`
--

CREATE TABLE `subNavigations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hashTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subnavigations`
--

INSERT INTO `subNavigations` (`id`, `name`, `url`, `hashTag`) VALUES
(1, 'Contact Austine Samuel', 'https://wa.me/08072999853', 'Developer'),
(2, 'About Page 1', '#', 'AboutUs'),
(3, 'About Page 2', '#', 'AboutUs'),
(4, 'Service 1', '#', 'Services'),
(5, 'Service 2', '#', 'Services'),
(6, 'Service 3', '#', 'Services'),
(7, 'Portfolio 1', '#', 'Portfolio'),
(8, 'Portfolio 2', '#', 'Portfolio'),
(9, 'Portfolio 3', '#', 'Portfolio'),
(10, 'Blogs 1', '#', 'Blogs'),
(11, 'Blogs 2', '#', 'Blogs'),
(12, 'Contact Us 1', '#', 'ContactUs'),
(13, 'Contact Us 2', '#', 'ContactUs'),
(14, 'Contact Us 3', '#', 'ContactUs'),
(15, 'Contact Austine Samuel', 'example.com', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `Technologies`
--

CREATE TABLE `Technologies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Technologies`
--

INSERT INTO `Technologies` (`id`, `name`, `icon`) VALUES
(1, 'Nodejs', '/images/d6caf2620b30887.svg'),
(2, 'Android', '/images/079efe229f1199b.svg'),
(3, 'AWS', '/images/e17adb30671911c.svg'),
(4, 'FIgma', '/images/1297dc561463d8e.svg'),
(5, 'Firebase', '/images/224156bf43ef8f8.svg'),
(6, 'Flutter', '/images/adc5ce71289c76e.svg'),
(7, 'Google cloud', '/images/921d7d0123d5806.svg'),
(8, 'Java', '/images/f8c062a026da9a4.svg'),
(9, 'Magento', '/images/80e4d0360549f5a.svg'),
(10, 'Kotlin', '/images/52a6ba41b9623d2.svg');

-- --------------------------------------------------------

--
-- Table structure for table `whoWeAreComponent`
--

CREATE TABLE `whoWeAreComponent` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `buttonText` varchar(255) NOT NULL,
  `clickRedir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whoWeAreComponent`
--

INSERT INTO `whoWeAreComponent` (`id`, `heading`, `text`, `buttonText`, `clickRedir`) VALUES
(1, 'Hire the Best Web and Mobile App Developers For Your Project', 'Expertise helps Blueket tackle the world\'s most difficult challenges. Blueket provides digital products for worldwide brands on the web, mobile, and linked platforms. Expertise helps Blueket tackle the world\'s most difficult challenges. Blueket provides digital products for worldwide brands on the web, mobile, and linked platforms.\r\n\r\nExpertise helps Blueket tackle the world\'s most difficult challenges. Blueket provides digital products for worldwide brands on the web', 'Get Started', 'https://sdsd.sdsd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `businessinfoimage`
--
ALTER TABLE `BusinessInfoImage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `businessinfolist`
--
ALTER TABLE `BusinessInfoList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editheadingtexts`
--
ALTER TABLE `editHeadingTexts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getsolutiontext`
--
ALTER TABLE `GetSolutionText`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getsolutiontextlist`
--
ALTER TABLE `GetSolutionTextList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headingslidecontainers`
--
ALTER TABLE `headingSlideContainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latestprojects`
--
ALTER TABLE `LatestProjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latestprojectslist`
--
ALTER TABLE `LatestProjectsList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ourinfo`
--
ALTER TABLE `OurInfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pageinfo`
--
ALTER TABLE `pageInfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicesweprovide`
--
ALTER TABLE `ServicesWeProvide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subnavigations`
--
ALTER TABLE `subNavigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Technologies`
--
ALTER TABLE `Technologies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whoWeAreComponent`
--
ALTER TABLE `whoWeAreComponent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `businessinfoimage`
--
ALTER TABLE `BusinessInfoImage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `businessinfolist`
--
ALTER TABLE `BusinessInfoList`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `editheadingtexts`
--
ALTER TABLE `editHeadingTexts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `getsolutiontext`
--
ALTER TABLE `GetSolutionText`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `getsolutiontextlist`
--
ALTER TABLE `GetSolutionTextList`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headingslidecontainers`
--
ALTER TABLE `headingSlideContainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `latestprojects`
--
ALTER TABLE `LatestProjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `latestprojectslist`
--
ALTER TABLE `LatestProjectsList`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ourinfo`
--
ALTER TABLE `OurInfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pageinfo`
--
ALTER TABLE `pageInfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `servicesweprovide`
--
ALTER TABLE `ServicesWeProvide`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subnavigations`
--
ALTER TABLE `subNavigations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Technologies`
--
ALTER TABLE `Technologies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `whoWeAreComponent`
--
ALTER TABLE `whoWeAreComponent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
