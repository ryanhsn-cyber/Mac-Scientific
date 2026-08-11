-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2026 at 01:21 PM
-- Server version: 10.11.16-MariaDB-cll-lve
-- PHP Version: 8.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dermatol_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `photo`, `role_id`, `password`, `email_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@macscientific.com', '01775457008', '1783755634logo_1785426681.webp', 0, '$2y$10$Bi2ppNkvdx/7aGe55I6fyuQ4e8hFlA0Q6wBUD7MSSDpqiwC3JAUNS', NULL, '2018-02-28 23:27:08', '2026-07-30 09:51:21'),
(3, 'Admin', 'siteadmin@shohojsolution.com', '01735544074', '17097300021260370_1785426681.webp', 0, '$2y$10$40vkfh20RukQnS7YyC2uBuPb92urwUkdefzil9XTlbUZXlFl5BTki', NULL, '2018-02-28 23:27:08', '2026-07-30 09:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT 0,
  `keyword` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` varchar(255) DEFAULT 'unlimited'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `url`, `image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shein Womens Clothing 2021 Summer Fashion Design Clothing Manufacturer Lantern Long Sleeve', '45% OFF', '#', '163172091306.jpg', ' Banner 1', 1, NULL, NULL),
(2, 'Casual Minimalist Tie Waist women clothing Denim Halter Midi Pencil Sling Dresses', '70% OFF', '#', '163172090805.jpg', 'Banner 2', 1, NULL, NULL),
(3, 'Top Sale High Quality Newest Designs Custom Women Clothing Wholesale from China Dresses', '60% OFF', '#', '163172090304.jpg', 'Banner 3', 1, NULL, NULL),
(5, '2021 Summer Women Clothing Ropa Sexy Lady Cut Out Halter Mini Dresses', '50% OFF', '#', '163172089704.jpg', 'Banner 4', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bcategories`
--

CREATE TABLE `bcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bcategories`
--

INSERT INTO `bcategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PRP', 'PRP', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `is_popular` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_items`
--

CREATE TABLE `campaign_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `is_feature` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_descriptions` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `is_feature` tinyint(4) DEFAULT 1,
  `serial` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `photo`, `meta_keywords`, `meta_descriptions`, `status`, `is_feature`, `serial`, `created_at`, `updated_at`) VALUES
(18, 'PRP', 'prp', '17097173381320765_1785426680.webp', '[{\"value\":\"women\"}]', 'Women Clothing', 1, 1, 1, NULL, NULL),
(19, 'PRF', 'prf', '17097296381612817_1785426680.webp', '[{\"value\":\"men\"}]', 'men', 1, 1, 2, NULL, NULL),
(21, 'INJECTION', 'injection', '17097297312642651_1785426680.webp', NULL, NULL, 1, 1, 3, NULL, NULL),
(22, 'Labware', 'labware', '17097298082621689_1785426680.webp', NULL, NULL, 1, 1, 4, NULL, NULL),
(23, 'Dermalfiller', 'dermalfiller', '17097298922080183_1785426680.webp', NULL, NULL, 1, 1, 5, NULL, NULL),
(24, 'MICRONEEDLING', 'microneedling', '17097299581260370_1785426680.webp', NULL, NULL, 1, 1, 6, NULL, NULL),
(25, 'Care', 'care', '17097299722642651_1785426680.webp', NULL, NULL, 1, 1, 7, NULL, NULL),
(26, 'Threadlifting', 'threadlifting', '17097065881546661_1785426680.webp', NULL, NULL, 1, 1, 8, NULL, NULL),
(27, 'Med courses', 'med-courses', '17097299812642651_1785426680.webp', NULL, NULL, 1, 1, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chield_categories`
--

CREATE TABLE `chield_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', NULL, NULL),
(2, 'Albania', NULL, NULL),
(3, 'Algeria', NULL, NULL),
(4, 'American Samoa', NULL, NULL),
(5, 'Andorra', NULL, NULL),
(6, 'Angola', NULL, NULL),
(7, 'Anguilla', NULL, NULL),
(8, 'Antarctica', NULL, NULL),
(9, 'Antigua and Barbuda', NULL, NULL),
(10, 'Argentina', NULL, NULL),
(11, 'Armenia', NULL, NULL),
(12, 'Aruba', NULL, NULL),
(13, 'Australia', NULL, NULL),
(14, 'Austria', NULL, NULL),
(15, 'Azerbaijan', NULL, NULL),
(16, 'Bahamas', NULL, NULL),
(17, 'Bahrain', NULL, NULL),
(18, 'Bangladesh', NULL, NULL),
(19, 'Barbados', NULL, NULL),
(20, 'Belarus', NULL, NULL),
(21, 'Belgium', NULL, NULL),
(22, 'Belize', NULL, NULL),
(23, 'Benin', NULL, NULL),
(24, 'Bermuda', NULL, NULL),
(25, 'Bhutan', NULL, NULL),
(26, 'Bolivia', NULL, NULL),
(27, 'Bosnia and Herzegovina', NULL, NULL),
(28, 'Botswana', NULL, NULL),
(29, 'Bouvet Island', NULL, NULL),
(30, 'Brazil', NULL, NULL),
(31, 'British Indian Ocean Territory', NULL, NULL),
(32, 'Brunei Darussalam', NULL, NULL),
(33, 'Bulgaria', NULL, NULL),
(34, 'Burkina Faso', NULL, NULL),
(35, 'Burundi', NULL, NULL),
(36, 'Cambodia', NULL, NULL),
(37, 'Cameroon', NULL, NULL),
(38, 'Canada', NULL, NULL),
(39, 'Cape Verde', NULL, NULL),
(40, 'Cayman Islands', NULL, NULL),
(41, 'Central African Republic', NULL, NULL),
(42, 'Chad', NULL, NULL),
(43, 'Chile', NULL, NULL),
(44, 'China', NULL, NULL),
(45, 'Christmas Island', NULL, NULL),
(46, 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'Colombia', NULL, NULL),
(48, 'Comoros', NULL, NULL),
(49, 'Democratic Republic of the Congo', NULL, NULL),
(50, 'Republic of Congo', NULL, NULL),
(51, 'Cook Islands', NULL, NULL),
(52, 'Costa Rica', NULL, NULL),
(53, 'Croatia (Hrvatska)', NULL, NULL),
(54, 'Cuba', NULL, NULL),
(55, 'Cyprus', NULL, NULL),
(56, 'Czech Republic', NULL, NULL),
(57, 'Denmark', NULL, NULL),
(58, 'Djibouti', NULL, NULL),
(59, 'Dominica', NULL, NULL),
(60, 'Dominican Republic', NULL, NULL),
(61, 'East Timor', NULL, NULL),
(62, 'Ecuador', NULL, NULL),
(63, 'Egypt', NULL, NULL),
(64, 'El Salvador', NULL, NULL),
(65, 'Equatorial Guinea', NULL, NULL),
(66, 'Eritrea', NULL, NULL),
(67, 'Estonia', NULL, NULL),
(68, 'Ethiopia', NULL, NULL),
(69, 'Falkland Islands (Malvinas)', NULL, NULL),
(70, 'Faroe Islands', NULL, NULL),
(71, 'Fiji', NULL, NULL),
(72, 'Finland', NULL, NULL),
(73, 'France', NULL, NULL),
(74, 'France, Metropolitan', NULL, NULL),
(75, 'French Guiana', NULL, NULL),
(76, 'French Polynesia', NULL, NULL),
(77, 'French Southern Territories', NULL, NULL),
(78, 'Gabon', NULL, NULL),
(79, 'Gambia', NULL, NULL),
(80, 'Georgia', NULL, NULL),
(81, 'Germany', NULL, NULL),
(82, 'Ghana', NULL, NULL),
(83, 'Gibraltar', NULL, NULL),
(84, 'Guernsey', NULL, NULL),
(85, 'Greece', NULL, NULL),
(86, 'Greenland', NULL, NULL),
(87, 'Grenada', NULL, NULL),
(88, 'Guadeloupe', NULL, NULL),
(89, 'Guam', NULL, NULL),
(90, 'Guatemala', NULL, NULL),
(91, 'Guinea', NULL, NULL),
(92, 'Guinea-Bissau', NULL, NULL),
(93, 'Guyana', NULL, NULL),
(94, 'Haiti', NULL, NULL),
(95, 'Heard and Mc Donald Islands', NULL, NULL),
(96, 'Honduras', NULL, NULL),
(97, 'Hong Kong', NULL, NULL),
(98, 'Hungary', NULL, NULL),
(99, 'Iceland', NULL, NULL),
(100, 'India', NULL, NULL),
(101, 'Isle of Man', NULL, NULL),
(102, 'Indonesia', NULL, NULL),
(103, 'Iran (Islamic Republic of)', NULL, NULL),
(104, 'Iraq', NULL, NULL),
(105, 'Ireland', NULL, NULL),
(106, 'Israel', NULL, NULL),
(107, 'Italy', NULL, NULL),
(108, 'Ivory Coast', NULL, NULL),
(109, 'Jersey', NULL, NULL),
(110, 'Jamaica', NULL, NULL),
(111, 'Japan', NULL, NULL),
(112, 'Jordan', NULL, NULL),
(113, 'Kazakhstan', NULL, NULL),
(114, 'Kenya', NULL, NULL),
(115, 'Kiribati', NULL, NULL),
(116, 'Korea, Democratic People\'s Republic of', NULL, NULL),
(118, 'Kosovo', NULL, NULL),
(119, 'Kuwait', NULL, NULL),
(120, 'Kyrgyzstan', NULL, NULL),
(121, 'Lao People\'s Democratic Republic', NULL, NULL),
(122, 'Latvia', NULL, NULL),
(123, 'Lebanon', NULL, NULL),
(124, 'Lesotho', NULL, NULL),
(125, 'Liberia', NULL, NULL),
(126, 'Libyan Arab Jamahiriya', NULL, NULL),
(127, 'Liechtenstein', NULL, NULL),
(128, 'Lithuania', NULL, NULL),
(129, 'Luxembourg', NULL, NULL),
(130, 'Macau', NULL, NULL),
(131, 'North Macedonia', NULL, NULL),
(132, 'Madagascar', NULL, NULL),
(133, 'Malawi', NULL, NULL),
(134, 'Malaysia', NULL, NULL),
(135, 'Maldives', NULL, NULL),
(136, 'Mali', NULL, NULL),
(137, 'Malta', NULL, NULL),
(138, 'Marshall Islands', NULL, NULL),
(139, 'Martinique', NULL, NULL),
(140, 'Mauritania', NULL, NULL),
(141, 'Mauritius', NULL, NULL),
(142, 'Mayotte', NULL, NULL),
(143, 'Mexico', NULL, NULL),
(144, 'Micronesia, Federated States of', NULL, NULL),
(145, 'Moldova, Republic of', NULL, NULL),
(146, 'Monaco', NULL, NULL),
(147, 'Mongolia', NULL, NULL),
(148, 'Montenegro', NULL, NULL),
(149, 'Montserrat', NULL, NULL),
(150, 'Morocco', NULL, NULL),
(151, 'Mozambique', NULL, NULL),
(152, 'Myanmar', NULL, NULL),
(153, 'Namibia', NULL, NULL),
(154, 'Nauru', NULL, NULL),
(155, 'Nepal', NULL, NULL),
(156, 'Netherlands', NULL, NULL),
(157, 'Netherlands Antilles', NULL, NULL),
(158, 'New Caledonia', NULL, NULL),
(159, 'New Zealand', NULL, NULL),
(160, 'Nicaragua', NULL, NULL),
(161, 'Niger', NULL, NULL),
(162, 'Nigeria', NULL, NULL),
(163, 'Niue', NULL, NULL),
(164, 'Norfolk Island', NULL, NULL),
(165, 'Northern Mariana Islands', NULL, NULL),
(166, 'Norway', NULL, NULL),
(167, 'Oman', NULL, NULL),
(168, 'Pakistan', NULL, NULL),
(169, 'Palau', NULL, NULL),
(170, 'Palestine', NULL, NULL),
(171, 'Panama', NULL, NULL),
(172, 'Papua New Guinea', NULL, NULL),
(173, 'Paraguay', NULL, NULL),
(174, 'Peru', NULL, NULL),
(175, 'Philippines', NULL, NULL),
(176, 'Pitcairn', NULL, NULL),
(177, 'Poland', NULL, NULL),
(178, 'Portugal', NULL, NULL),
(179, 'Puerto Rico', NULL, NULL),
(180, 'Qatar', NULL, NULL),
(181, 'Reunion', NULL, NULL),
(182, 'Romania', NULL, NULL),
(183, 'Russian Federation', NULL, NULL),
(184, 'Rwanda', NULL, NULL),
(185, 'Saint Kitts and Nevis', NULL, NULL),
(186, 'Saint Lucia', NULL, NULL),
(187, 'Saint Vincent and the Grenadines', NULL, NULL),
(188, 'Samoa', NULL, NULL),
(189, 'San Marino', NULL, NULL),
(190, 'Sao Tome and Principe', NULL, NULL),
(191, 'Saudi Arabia', NULL, NULL),
(192, 'Senegal', NULL, NULL),
(193, 'Serbia', NULL, NULL),
(194, 'Seychelles', NULL, NULL),
(195, 'Sierra Leone', NULL, NULL),
(196, 'Singapore', NULL, NULL),
(197, 'Slovakia', NULL, NULL),
(198, 'Slovenia', NULL, NULL),
(199, 'Solomon Islands', NULL, NULL),
(200, 'Somalia', NULL, NULL),
(201, 'South Africa', NULL, NULL),
(202, 'South Georgia South Sandwich Islands', NULL, NULL),
(203, 'South Sudan', NULL, NULL),
(204, 'Spain', NULL, NULL),
(205, 'Sri Lanka', NULL, NULL),
(206, 'St. Helena', NULL, NULL),
(207, 'St. Pierre and Miquelon', NULL, NULL),
(208, 'Sudan', NULL, NULL),
(209, 'Suriname', NULL, NULL),
(210, 'Svalbard and Jan Mayen Islands', NULL, NULL),
(211, 'Swaziland', NULL, NULL),
(212, 'Sweden', NULL, NULL),
(213, 'Switzerland', NULL, NULL),
(214, 'Syrian Arab Republic', NULL, NULL),
(215, 'Taiwan', NULL, NULL),
(216, 'Tajikistan', NULL, NULL),
(217, 'Tanzania, United Republic of', NULL, NULL),
(218, 'Thailand', NULL, NULL),
(219, 'Togo', NULL, NULL),
(220, 'Tokelau', NULL, NULL),
(221, 'Tonga', NULL, NULL),
(222, 'Trinidad and Tobago', NULL, NULL),
(223, 'Tunisia', NULL, NULL),
(224, 'Turkey', NULL, NULL),
(225, 'Turkmenistan', NULL, NULL),
(226, 'Turks and Caicos Islands', NULL, NULL),
(227, 'Tuvalu', NULL, NULL),
(228, 'Uganda', NULL, NULL),
(229, 'Ukraine', NULL, NULL),
(230, 'United Arab Emirates', NULL, NULL),
(231, 'United Kingdom', NULL, NULL),
(232, 'United States', NULL, NULL),
(233, 'United States minor outlying islands', NULL, NULL),
(234, 'Uruguay', NULL, NULL),
(235, 'Uzbekistan', NULL, NULL),
(236, 'Vanuatu', NULL, NULL),
(237, 'Vatican City State', NULL, NULL),
(238, 'Venezuela', NULL, NULL),
(239, 'Vietnam', NULL, NULL),
(240, 'Virgin Islands (British)', NULL, NULL),
(241, 'Virgin Islands (U.S.)', NULL, NULL),
(242, 'Wallis and Futuna Islands', NULL, NULL),
(243, 'Western Sahara', NULL, NULL),
(244, 'Yemen', NULL, NULL),
(245, 'Zambia', NULL, NULL),
(246, 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1, 0, NULL, NULL),
(8, 'BDT', '৳', 84, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `body` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `type`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Order', 'Your Have Successfully Placed The Order', '<p>Hello {user_name},</p><p>Your Order Has Been Placed Successfilly.<br>Your Order Number is {transaction_number}.<br></p>', NULL, NULL),
(2, 'Registration', 'Welcome To Online Baby Shop', '<p>Hello ; {user_name},</p><p>You have successfully registered to {site_title}, We wish you will have a wonderful experience using our service.</p><p>Thank You .<br></p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extra_settings`
--

CREATE TABLE `extra_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_t4_slider` tinyint(4) DEFAULT 1,
  `is_t4_featured_banner` tinyint(4) DEFAULT 1,
  `is_t4_specialpick` tinyint(4) DEFAULT 1,
  `is_t4_3_column_banner_first` tinyint(4) DEFAULT 1,
  `is_t4_flashdeal` tinyint(4) DEFAULT 1,
  `is_t4_3_column_banner_second` tinyint(4) DEFAULT 1,
  `is_t4_popular_category` tinyint(4) DEFAULT 1,
  `is_t4_2_column_banner` tinyint(4) DEFAULT 1,
  `is_t4_blog_section` tinyint(4) DEFAULT 1,
  `is_t4_brand_section` tinyint(4) DEFAULT 1,
  `is_t4_service_section` tinyint(4) DEFAULT 1,
  `is_t3_slider` tinyint(4) DEFAULT 1,
  `is_t3_service_section` tinyint(4) DEFAULT 1,
  `is_t3_3_column_banner_first` tinyint(4) DEFAULT 1,
  `is_t3_popular_category` tinyint(4) DEFAULT 1,
  `is_t3_flashdeal` tinyint(4) DEFAULT 1,
  `is_t3_3_column_banner_second` tinyint(4) DEFAULT 1,
  `is_t3_pecialpick` tinyint(4) DEFAULT 1,
  `is_t3_brand_section` tinyint(4) DEFAULT 1,
  `is_t3_2_column_banner` tinyint(4) DEFAULT 1,
  `is_t3_blog_section` tinyint(4) DEFAULT 1,
  `is_t2_slider` tinyint(4) DEFAULT 1,
  `is_t2_service_section` tinyint(4) DEFAULT 1,
  `is_t2_3_column_banner_first` tinyint(4) DEFAULT 1,
  `is_t2_flashdeal` tinyint(4) DEFAULT 1,
  `is_t2_new_product` tinyint(4) DEFAULT 1,
  `is_t2_3_column_banner_second` tinyint(4) DEFAULT 1,
  `is_t2_featured_product` tinyint(4) DEFAULT 1,
  `is_t2_bestseller_product` tinyint(4) DEFAULT 1,
  `is_t2_toprated_product` tinyint(4) DEFAULT 1,
  `is_t2_2_column_banner` tinyint(4) DEFAULT 1,
  `is_t2_blog_section` tinyint(4) DEFAULT 1,
  `is_t2_brand_section` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_t1_falsh` tinyint(4) DEFAULT 1,
  `is_t2_falsh` tinyint(4) DEFAULT 1,
  `is_t3_falsh` tinyint(4) DEFAULT 1,
  `is_t4_falsh` tinyint(4) DEFAULT 1,
  `is_t2_three_column_category` tinyint(4) DEFAULT 1,
  `is_t3_three_column_category` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_settings`
--

INSERT INTO `extra_settings` (`id`, `is_t4_slider`, `is_t4_featured_banner`, `is_t4_specialpick`, `is_t4_3_column_banner_first`, `is_t4_flashdeal`, `is_t4_3_column_banner_second`, `is_t4_popular_category`, `is_t4_2_column_banner`, `is_t4_blog_section`, `is_t4_brand_section`, `is_t4_service_section`, `is_t3_slider`, `is_t3_service_section`, `is_t3_3_column_banner_first`, `is_t3_popular_category`, `is_t3_flashdeal`, `is_t3_3_column_banner_second`, `is_t3_pecialpick`, `is_t3_brand_section`, `is_t3_2_column_banner`, `is_t3_blog_section`, `is_t2_slider`, `is_t2_service_section`, `is_t2_3_column_banner_first`, `is_t2_flashdeal`, `is_t2_new_product`, `is_t2_3_column_banner_second`, `is_t2_featured_product`, `is_t2_bestseller_product`, `is_t2_toprated_product`, `is_t2_2_column_banner`, `is_t2_blog_section`, `is_t2_brand_section`, `created_at`, `updated_at`, `is_t1_falsh`, `is_t2_falsh`, `is_t3_falsh`, `is_t4_falsh`, `is_t2_three_column_category`, `is_t3_three_column_category`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 0, 1, 0, NULL, NULL, 0, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_descriptions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category_id`, `title`, `details`, `meta_keywords`, `meta_descriptions`, `created_at`, `updated_at`) VALUES
(15, 1, 'How can I purchase it ?', 'Voluptatibus enim, aut natus sint porro veniam atque obcaecati ullam, consequatur laboriosam laborum corrupti autem fugit', NULL, NULL, NULL, NULL),
(25, 1, 'Anim pariatur cliche reprehenderit ?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus.', NULL, NULL, NULL, NULL),
(27, 1, 'Smartphones in Every Day Life ?', 'afdads', '[{\"value\":\"ad\"},{\"value\":\"fd\"}]', 'dfa', NULL, NULL),
(28, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing  ?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, NULL, NULL),
(29, 3, 'But I must explain to you how all this mistaken idea ?', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, cons', NULL, NULL, NULL, NULL),
(30, 3, 'Where does it come from ?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', NULL, NULL, NULL, NULL),
(31, 4, 'Where can I get some ?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', NULL, NULL, NULL, NULL),
(32, 4, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(33, 4, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(34, 4, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(35, 5, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(36, 5, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(37, 5, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(38, 6, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(39, 6, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(40, 6, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(41, 7, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(42, 7, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(43, 7, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fcategories`
--

CREATE TABLE `fcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_descriptions` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fcategories`
--

INSERT INTO `fcategories` (`id`, `name`, `text`, `slug`, `meta_keywords`, `meta_descriptions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronics !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Electronics-', NULL, NULL, 1, NULL, NULL),
(3, 'Poroduct Delevery !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Poroduct-Delevery-', '[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]', 'It is a long established fact that a r', 1, NULL, NULL),
(4, 'Discount Policy !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Discount-Policy-', NULL, NULL, 1, NULL, NULL),
(5, 'Vat Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Vat-Information-', NULL, NULL, 1, NULL, NULL),
(6, 'Coupon  Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Coupon--Information-', NULL, NULL, 1, NULL, NULL),
(7, 'Offer Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Offer-Information-', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `item_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'hZn4ACD+GEL-10ml_1785426681.webp', NULL, NULL),
(2, 2, 'bnBXPRP TUBE =ACD+GEL  (3)_1785426681.webp', NULL, NULL),
(155, 22, 'hV26Syring Connector_1785426682.webp', NULL, NULL),
(156, 21, 'nABWTourniquet-1000x1000_1785426682.webp', NULL, NULL),
(157, 20, '2wIDCentrifuge_1785426682.webp', NULL, NULL),
(158, 23, 'ZoXR5_1785426682.webp', NULL, NULL),
(159, 24, 'DTXcSodium Citrate Tube_1785426682.webp', NULL, NULL),
(160, 16, 'V5iwPRP Tube _ACD-GEL_BIOTIN-15ml-_1785426682.webp', NULL, NULL),
(161, 13, 'FWp6PRP=ACD+GEL+BIOTIN-10 ML  (6)_1785426682.webp', NULL, NULL),
(162, 25, 'PP3J6_1785426683.webp', NULL, NULL),
(163, 10, 'JvtC5_1785426683.webp', NULL, NULL),
(164, 9, 'z1k2GF 15ml Tube _1785426683.webp', NULL, NULL),
(165, 8, 'wFemGFC Tube  (5)_1785426683.webp', NULL, NULL),
(166, 7, 'MOsd5_1785426684.webp', NULL, NULL),
(170, 27, 'KSZV1_1785426684.webp', NULL, NULL),
(171, 27, 'CW8v2_1785426684.webp', NULL, NULL),
(172, 27, 'QyQx3_1785426684.webp', NULL, NULL),
(173, 27, 'vB734_1785426684.webp', NULL, NULL),
(174, 27, 'OgT05_1785426684.webp', NULL, NULL),
(175, 27, 'jS1y6_1785426684.webp', NULL, NULL),
(176, 28, 'RaIwcommon_1785426684.webp', NULL, NULL),
(177, 28, 'SOLVPRP Tube _ACD-GEL_BIOTIN-12ml_1785426684.webp', NULL, NULL),
(178, 28, 'Bg3hPRP Tube _ACD-GEL_BIOTIN-12ml-1_1785426684.webp', NULL, NULL),
(179, 28, 'ooBmPRP Tube _ACD-GEL_BIOTIN-15ml-_1785426684.webp', NULL, NULL),
(180, 4, 'x63t4_1785426685.webp', NULL, NULL),
(181, 3, 'FEYH3_1785426685.webp', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cutomizes`
--

CREATE TABLE `home_cutomizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_first` text DEFAULT NULL,
  `banner_secend` text DEFAULT NULL,
  `banner_third` text DEFAULT NULL,
  `popular_category` text DEFAULT NULL,
  `two_column_category` text DEFAULT NULL,
  `feature_category` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page4` text DEFAULT NULL,
  `home_4_popular_category` text DEFAULT NULL,
  `hero_banner` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_cutomizes`
--

INSERT INTO `home_cutomizes` (`id`, `banner_first`, `banner_secend`, `banner_third`, `popular_category`, `two_column_category`, `feature_category`, `created_at`, `updated_at`, `home_page4`, `home_4_popular_category`, `hero_banner`) VALUES
(1, '{\"title1\":\"Babys Items\",\"subtitle1\":\"50% OFF\",\"firsturl1\":\"#\",\"title2\":\"Fathers\",\"subtitle2\":\"40% OFF\",\"firsturl2\":\"#\",\"title3\":\"Home\",\"subtitle3\":\"30% OFF\",\"firsturl3\":\"#\",\"img1\":\"IyAnc_ban7.png\",\"img2\":\"lXcoc_ban7.png\",\"img3\":\"V4rwc_ban7.png\"}', '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Man\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"title3\":\"Headphone\",\"subtitle3\":\"60% OFF\",\"url3\":\"#\",\"img1\":\"ST2oc_ban7.png\",\"img2\":\"9Ci4c_ban7.png\",\"img3\":\"PNmdc_ban7.png\"}', '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Headphones\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img1\":\"LcoLc_ban7.png\",\"img2\":\"5YhAc_ban7.png\"}', '{\"popular_title\":\"Popular Categories\",\"category_id1\":\"18\",\"subcategory_id1\":\"6\",\"childcategory_id1\":null,\"category_id2\":\"19\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}', '{\"category_id1\":\"27\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"22\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null}', '{\"feature_title\":\"Featured Categories\",\"category_id1\":\"18\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"27\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}', NULL, NULL, '{\"label1\":\"FORMAL\",\"url1\":\"#\",\"label2\":\"LIMITEN EDITION\",\"url2\":\"#\",\"label3\":\"WOMEN\'S COLLECTION\",\"url3\":\"#\",\"label4\":\"SMART CASUALS\",\"url4\":\"#\",\"label5\":\"POLO\",\"url5\":\"#\",\"img1\":\"16368975771.jpg\",\"img2\":\"16368975772.jpg\",\"img3\":\"16368975773.jpg\",\"img4\":\"16368975774.jpg\",\"img5\":\"16368975775.jpg\"}', '[\"18\",\"19\",\"21\",\"27\"]', '{\"title1\":\"Exosome\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Connector\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img2\":\"QyC7Mobile Image.png\",\"img1\":\"bEn1Regenerative-Medicine-Therapies_1513094672.jpg\"}');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT 0,
  `subcategory_id` int(11) DEFAULT 0,
  `childcategory_id` int(11) DEFAULT 0,
  `tax_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `sort_details` text DEFAULT NULL,
  `specification_name` text DEFAULT NULL,
  `specification_description` text DEFAULT NULL,
  `is_specification` tinyint(4) DEFAULT 0,
  `details` text DEFAULT NULL,
  `how_to_use` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `discount_price` double DEFAULT 0,
  `previous_price` double DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `is_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `file_type` enum('file','link') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `license_name` text DEFAULT NULL,
  `license_key` text DEFAULT NULL,
  `item_type` varchar(255) DEFAULT 'normal',
  `thumbnail` varchar(255) DEFAULT NULL,
  `affiliate_link` text DEFAULT NULL,
  `tier_prices` text DEFAULT NULL,
  `features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `tax_id`, `brand_id`, `name`, `slug`, `sku`, `tags`, `video`, `sort_details`, `specification_name`, `specification_description`, `is_specification`, `details`, `how_to_use`, `photo`, `discount_price`, `previous_price`, `stock`, `meta_keywords`, `meta_description`, `status`, `is_type`, `date`, `file`, `link`, `file_type`, `created_at`, `updated_at`, `license_name`, `license_key`, `item_type`, `thumbnail`, `affiliate_link`, `tier_prices`, `features`) VALUES
(1, 18, NULL, NULL, 3, NULL, 'PRP Tube – ACD + Gel, 10ml', 'PRP-Tube-–-ACD---Gel--10ml-', 'v0r4TyS2z5', '', NULL, 'PRP Tube – ACD + Gel, 10ml', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 10ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuges</b></p>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 10ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuge</b></p>', NULL, '17833316887_1785426677.webp', 0, 0, 89, '', NULL, 1, 'feature', NULL, NULL, NULL, NULL, '2026-07-06 09:54:48', '2026-07-30 09:51:17', NULL, NULL, 'normal', 'MJrlwv60_1785426677.webp', NULL, NULL, NULL),
(2, 18, NULL, NULL, 3, NULL, 'PRP Tube – ACD + Gel', '15ml', 'nljgZ7P145', '', NULL, 'Sterile 15 ml  PRP Tube with ACD + Gel. ISO 13485 & CE certified. Ideal for PRP hair, skin & joint treatments. Crystal clear and trusted by professionals.', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Pre-filled with ACD and Separation Gel</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Crystal Clear 15 ml Tube – Ready to Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>ISO 13485 &amp; CE Certified</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Sterile, Pyrogen-Free &amp; Single Use</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Excellent Plasma Separation Efficiency</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Trusted by Dermatologists &amp; Medical Professionals</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✅ <b>Compatible with Common PRP Protocols &amp; Centrifuges</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><font style=\"font-size: 14pt;\"><b>Applications / Uses:</b></font></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Hair PRP Therapy (Hair Regrowth, Follicle Repair)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Facial Aesthetics (Anti-aging, Wrinkles, Acne Scars)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Orthopedic PRP Therapy (Joint Pain, Ligament Healing)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Skin Rejuvenation (Glow, Texture, Pigmentation)</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">✔️ <b>Wound Healing &amp; Cell Regeneration</b></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><font style=\"font-size: 14pt;\"><b>Using System / Instructions:</b></font></p><ol style=\"font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Draw 12 ml of blood into the tube (ACD prevents clotting).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Place the tube in a centrifuge machine (follow PRP-specific RPM/time).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>The gel separates the plasma from red and white blood cells.</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Use a syringe to extract the PRP from the upper layer.</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Apply PRP to the treatment area (scalp, skin, joints, etc.).</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Dispose of the tube after single use.</b></p></li></ol><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><i><b>Always use by trained professionals under sterile conditions.</b></i></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><b>Certifications:</b></p><ul style=\"font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>ISO 13485 Certified (Medical Devices Quality)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>CE Certified (European Compliance)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Sterile &amp; Single-Use Only</b></p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\"><br><br></p>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">The <b>PRP Tube – ACD + Gel (15 ml )</b> is a high-quality, <b>sterile single-use medical device</b> used for safe and efficient <b>Platelet-Rich Plasma (PRP) preparation</b>. Pre-filled with <b>ACD (Anticoagulant Citrate Dextrose)</b> to prevent blood clotting and <b>separation gel</b> to isolate plasma effectively, this tube ensures <b>high-purity PRP collection</b> for clinical and aesthetic applications.</p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; font-size: medium;\">This product is <b>ISO 13485 and CE certified</b>, guaranteeing safety, sterility, and consistent performance. It is compatible with most <b>standard centrifuge machines</b> and trusted by <b>clinics, dermatologists, and PRP specialists</b>.</p>', NULL, '1783336459PRP TUBE =ACD+GEL  (2)_1785426677.webp', 2.1428571428571, 2.6190476190476, 18, '', NULL, 1, 'feature', NULL, NULL, NULL, NULL, '2026-07-06 11:14:19', '2026-08-05 08:07:12', NULL, NULL, 'normal', 'hrfT5pbJ_1785426677.webp', NULL, NULL, ''),
(3, 18, NULL, NULL, 3, NULL, 'PRP & PRF Clinical Centrifuge Machine (DM0506) | 300–5000 RPM | LCD Display | Brushless Motor | CE & ISO Certified', '-PRP---PRF-Clinical-Centrifuge-Machine--DM0506----300–5000-RPM---LCD-Display---Brushless-Motor---CE---ISO-Certified', 'KlNnXlNVFG', '', NULL, 'Professional low-speed laboratory centrifuge designed for PRP, PRF, blood, urine, and laboratory sample separation. Features a maintenance-free brushless DC motor, LCD display, programmable settings, and a fixed-angle 6-place rotor compatible with 1.5–15 ml tubes. Suitable for hospitals, aesthetic clinics, diagnostic laboratories, and research facilities.', '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\">Model: DM0506 / CF0506<br>Brand: WEIAI<br>Max Speed: 5000 RPM<br>Speed Range: 300–5000 RPM<br>Max RCF: 2350 × g<br>Display: LCD<br>Motor: Brushless DC Motor<br>Power Supply: AC 110V/220V, 50/60Hz<br>Dimensions: 300 × 240 × 180 mm<br>Weight: 5.2 kg<br>Package Size: 400 × 350 × 270 mm<br>Warranty: 1 Year<br>Certificates: CE, ISO, FCC, FDA, LVD (as applicable from supplier documentation)</p><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; line-height: 19.9333px; color: rgb(79, 129, 189); break-inside: avoid; background: transparent; break-after: avoid; font-weight: bold; font-size: 13pt; font-family: Calibri, serif;\">How to Use</h2><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\">1. Collect samples using appropriate sterile tubes.<br>2. Balance the rotor with equal-weight tubes opposite each other.<br>3. Insert tubes securely and close the lid.<br>4. Set RPM/RCF and timer as required.<br>5. Press Start to begin centrifugation.<br>6. Wait until the cycle completes and the lid unlocks automatically.<br>7. Remove samples carefully and continue processing according to your validated protocol.<br><br>Example Settings:<br>• PRP: 4000 RPM for 5 minutes<br>• PRF: 2700 RPM for 7 minutes<br><br>Note: These are example settings only. Always follow the validated protocol recommended by your laboratory, clinician, or tube manufacturer.</p>', NULL, 1, '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><span style=\"background-color: transparent; color: rgb(51, 51, 51); font-size: 11pt;\">The PRP &amp; PRF Clinical Centrifuge Machine (DM0506) is a professional laboratory centrifuge engineered for medical, aesthetic, and laboratory applications. It is suitable for PRP preparation, PRF protocols, blood component separation, urine analysis, and routine laboratory procedures. Powered by a brushless DC motor, it offers quiet operation, stable speed, and long service life. The LCD display allows easy monitoring of RPM, RCF, and timer settings, while two programmable memory modes simplify repetitive workflows.</span></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt;\"></p>', '<h2 class=\"western\" style=\"margin-top: 0.14in; margin-bottom: 0in; font-family: Calibri, serif; font-weight: bold; line-height: 19.9333px; color: rgb(79, 129, 189); font-size: 13pt; direction: ltr; break-inside: avoid; background: transparent; break-after: avoid;\">How to Use</h2><p class=\"western\" style=\"margin-bottom: 0.14in; font-family: Cambria, serif; font-size: 11pt; line-height: 16.8667px; direction: ltr; background: transparent;\">1. Collect samples using appropriate sterile tubes.<br>2. Balance the rotor with equal-weight tubes opposite each other.<br>3. Insert tubes securely and close the lid.<br>4. Set RPM/RCF and timer as required.<br>5. Press Start to begin centrifugation.<br>6. Wait until the cycle completes and the lid unlocks automatically.<br>7. Remove samples carefully and continue processing according to your validated protocol.<br><br>Example Settings:<br>• PRP: 4000 RPM for 5 minutes<br>• PRF: 2700 RPM for 7 minutes<br><br>Note: These are example settings only. Always follow the validated protocol recommended by your laboratory, clinician, or tube manufacturer.</p>', '17833368431_1785426677.webp', 535.71428571429, 416.66666666667, 11, '', NULL, 1, 'feature', NULL, NULL, NULL, NULL, '2026-07-06 11:20:43', '2026-07-30 09:51:17', NULL, NULL, 'normal', 'AEnFHtnT_1785426677.webp', NULL, NULL, ''),
(4, 18, NULL, NULL, 3, NULL, 'Atlantica EXOSOME', 'atlantica-exosome-nDDnV', 'faWhxiDt2s', '', NULL, 'Atlantica EXOSOME', NULL, NULL, 1, '<p><img src=\"/assets/images/rfwJ1.png\" style=\"width: 945.328px;\"><img src=\"/assets/images/hCiA1.jpeg\" style=\"width: 945.328px;\"><br></p>', NULL, '5WoAJBguiV_1785426677.webp', 178.57142857143, 214.28571428571, 98, 'Atlantica EXOSOME', 'Atlantica EXOSOME', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:17', NULL, NULL, 'normal', '5WoAJBguiV.jpeg', NULL, NULL, ''),
(6, 18, NULL, NULL, 3, NULL, 'Blood Collection Neddel Holder', 'blood-collection-neddel-holder-2FovP', 'kRyrmLTAi3', '', NULL, 'Blood Collection Neddel Holder', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Durable Medical-Grade Plastic</b> – Lightweight yet strong for repeated single-use applications</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Compact (Small Size)</b> – Easy to handle, especially in pediatric or delicate procedures</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Universal Compatibility</b> – Fits most standard blood collection needles and vacutainer tubes</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Disposable &amp; Hygienic</b> – Designed for single use to prevent cross-contamination</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Secure Needle Locking System</b> – Ensures stable connection during blood draw</p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Ideal for use in hospitals, clinics, laboratories, and diagnostic centers. A cost-effective, reliable solution for routine phlebotomy needs.</p>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The <b>Plastic Blood Collection Needle Holder</b> is an essential component in safe and efficient venipuncture procedures. Designed for use with standard blood collection needles and vacuum tubes, this small-sized holder offers a secure grip and excellent control, ensuring smooth blood draws for healthcare professionals.</p>', NULL, '1783346689Blood collection needle-holder_1785426677.webp', 1000, 1200, 100, 'Blood Collection Neddel Holder', 'Blood Collection Neddel Holder', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:17', NULL, NULL, 'normal', 'kKmfZkmG_1785426677.webp', NULL, NULL, NULL),
(7, 18, NULL, NULL, 3, NULL, 'ZGTS 192 Gold Derma Roller 0.5mm', 'ZGTS-192-Gold-Derma-Roller-0-5mm', 'FlycTHpiWa', '', NULL, 'Professional 0.5mm microneedle derma roller with 192 fine needles, designed for controlled microneedling procedures in clinical and aesthetic settings.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">192 precision microneedles</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">0.5 mm needle length</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Ergonomic gold handle</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Smooth rolling mechanism</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Individually packed</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional-use device</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Lightweight design</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Suitable for skin and scalp protocols</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The ZGTS 192 Gold Derma Roller System is a professional microneedling device featuring 192 fine needles and a comfortable ergonomic handle. The 0.5 mm model is intended for use by trained professionals as part of established microneedling protocols. The device is individually packaged and designed for precision, smooth rolling and consistent contact with the treatment area. It is commonly used in aesthetic clinics and hair restoration practices as part of professional skin and scalp care procedures. Use only according to the manufacturer\'s instructions and applicable clinical protocols.</p>', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clean and prepare the treatment area.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Disinfect the device according to the manufacturer\'s instructions before use if applicable.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Roll gently following your clinic\'s protocol in the required directions.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Apply post-procedure products only according to protocol.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dispose of or maintain the device as instructed by the manufacturer.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">For professional use. Follow local infection-control procedures and manufacturer guidance.</p>', 'HNlUSDQ7IW_1785426677.webp', 6.547619047619, 11.904761904762, 100, 'ZGTS Derma Roller,192 Needle Derma Roller,0.5mm Microneedle Roller,• Professional Derma Roller,• Hair Microneedling Roller', NULL, 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:17', NULL, NULL, 'normal', 'HNlUSDQ7IW.jpeg', NULL, NULL, ''),
(8, 18, NULL, NULL, 3, NULL, 'GFC Tube – 10ml (Growth Factor Concentrate | Sterile | ISO 13485 | CE Certified)', 'GFC-Tube-–-10ml--Growth-Factor-Concentrate---Sterile---ISO-13485---CE-Certified-', 'NNvrT9PijC', '', NULL, 'GFC Tube 10 ML', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Designed for GFC (Growth Factor Concentrate) Therapy</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Crystal Clear Tube for Easy Observation</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>ISO 13485 &amp; CE Certified</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Sterile &amp; Pyrogen-Free</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Accurate Separation – Maximum Growth Factor Yield</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Ideal for Hair, Skin &amp; Joint Therapy</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Trusted by Clinics, Dermatologists &amp; Orthopedic Specialists</b></p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The <b>GFC Tube (Growth Factor Concentrate)</b> – 10ml is a <b>sterile, single-use medical device</b> specifically designed for the <b>collection and concentration of growth factors</b> from blood. These concentrated growth factors are used in <b>advanced PRP treatments</b> for <b>hair regrowth, skin rejuvenation, wound healing, and orthopedic care</b>.</p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">This <b>crystal-clear tube</b> is manufactured under strict <b>ISO 13485</b> standards and is <b>CE certified</b>, ensuring safe use in clinical environments. It enables <b>high-yield separation</b> of plasma enriched with growth factors, resulting in better, faster results in both medical and aesthetic treatments.&nbsp;</p>', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Hair Regrowth Treatments (GFC Hair Therapy)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Skin Rejuvenation</b> (Wrinkles, Acne Scars, Fine Lines)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Orthopedic Injections</b> (Joint &amp; Ligament Healing)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Facial Aesthetic Enhancements</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Cell Repair &amp; Collagen Boosting</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Wound Healing and Post-Surgery Recovery</b></p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><b>Usage System / Instructions:</b></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Collect patient’s blood</b> directly into the sterile 10ml GFC tube.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Place the tube in a <b>centrifuge</b> (as per GFC protocol).</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">After centrifugation, <b>growth factor-rich PRP</b> separates from blood cells.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Extract the <b>concentrated growth factors</b> using a syringe.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Apply to the <b>target area</b> (scalp, face, or joint) for treatment.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Dispose</b> of the tube after a single use.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><i>For best results, always use under clinical supervision with trained personnel.</i></p>', '1783346940GF 15ml Tube _1785426677.webp', 1.7857142857143, 2.3809523809524, 100, 'GFC PRP Tube,Growth Factor Concentrate Tube,10ml GFC Tube,PRP Tube Bangladesh,CE Certified PRP Tube,PRP for Hair Growth,Skin PRP Tube,Sterile PRP Tube,ISO Certified PRP Tube,GFC Tube for Clinics,PRP Tube for Aesthetic Use', 'GFC Tube 10 ML', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:17', NULL, NULL, 'normal', 'VclqAkIU_1785426677.webp', NULL, NULL, ''),
(9, 18, NULL, NULL, 3, NULL, 'GFC Tube – 15ml (Growth Factor Concentrate | Sterile | CE & ISO 13485 Certified)', 'GFC-Tube-–-15ml--Growth-Factor-Concentrate---Sterile---CE---ISO-13485-Certified-', 'nQOj0Yb4ns', '', NULL, 'GFC Tube 15 ML', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Larger 15ml Volume – More PRP per Session</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Designed for Growth Factor Concentration (GFC)</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Crystal Clear Tube for Visual Precision</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>ISO 13485 &amp; CE Certified</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Sterile, Pyrogen-Free &amp; Single-Use</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Trusted by Clinics, Dermatologists, and Orthopedic Doctors</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Compatible with Most Centrifuges</b></p></li></ul>', NULL, 1, 'GFC Tube 15 ML', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Hair PRP &amp; GFC Therapy</b> (Hair Loss, Thinning Hair)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Skin PRP Treatments</b> (Acne Scars, Anti-Aging, Wrinkles)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Joint &amp; Ligament Injections</b> (Orthopedic GFC Therapy)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Facial Rejuvenation Procedures</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Post-Surgical Healing Support</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✔️ <b>Wound &amp; Scar Repair</b></p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"></p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">🧪 <b>Usage System / Instructions:</b></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Draw blood</b> into the 15ml GFC Tube directly from the patient.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Insert the tube into a <b>centrifuge</b> (follow GFC-specific RPM &amp; duration).</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">The <b>growth factor-rich plasma</b> separates naturally due to tube design.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Use a sterile syringe to <b>extract the GFC-enriched PRP</b>.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">Apply directly to <b>scalp, skin, or joints</b> based on treatment.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Dispose safely</b> after a single use.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><i>Use by trained professionals in clinical settings is recommended.</i></p>', '1783347016GF 15ml Tube  (1)_1785426677.webp', 2.1428571428571, 2.9761904761905, 100, 'GFC PRP Tube 15ml,Growth Factor Concentrate Tube,Sterile GFC Tube,15ml PRP Tube,PRP Tube for Hair Skin Joint,CE Certified PRP Tube,ISO 13485 PRP Tube,Medical PRP Tube,GFC Tube Bangladesh,PRP Tube for Clinics,GFC Therapy Supplies', 'GFC Tube 15 ML', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:18', NULL, NULL, 'normal', 'VVmHQJf1_1785426678.webp', NULL, NULL, ''),
(10, 18, NULL, NULL, 3, NULL, 'LxC Lacto Exo Colla Professional Skin Booster', 'LxC-Lacto-Exo-Colla-Professional-Skin-Booster', 'qXesMvojci', '', NULL, 'Professional skin booster kit featuring a blend of exosome-related ingredients, PDRN, collagen and peptides for use by qualified professionals in aesthetic practice.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Four exosome-related ingredients</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">PDRN component</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Collagen &amp; peptide complex</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Two-ampoule system</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional-use presentation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Sterile packaging</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clinic-ready format</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Individually packaged</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">LxC Lacto Exo Colla is a professional aesthetic skin booster supplied as a two-ampoule kit. According to the manufacturer brochure, the formulation combines four exosome-related ingredients (Lactobacillus, Panax Ginseng, Centella Asiatica and Camellia Japonica), together with PDRN, collagen and peptides. The brochure describes it as a professional product intended for aesthetic skin-care protocols and provides preparation instructions for use by trained professionals. The product is presented in sterile packaging and is designed for clinic workflows. Use should always follow the manufacturer\'s instructions and applicable local regulations.</p>', '<p style=\"direction: ltr; margin: 0.14in 0.65in 0.19in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium; border-width: medium medium 1px; border-style: none none solid; border-color: currentcolor currentcolor rgb(79, 129, 189); padding: 0in 0in 0.06in;\"><font color=\"#4f81bd\"><i><b>Follow the manufacturer instructions included with the product.</b></i></font></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clean the skin.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Prepare the ampoules as directed.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Mix the components according to the manufacturer protocol.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Apply according to the intended professional procedure.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Use only by trained professionals</p></li></ol>', '5vMi8XeB93_1785426678.webp', 47.619047619048, 59.52380952381, 100, 'LxC Lacto Exo Colla  Exosome Skin Booster  Professional Exosome Kit  PDRN Collagen Peptides  Aesthetic Skin Booster', 'Professional LxC Lacto Exo Colla exosome skin booster kit. Contact MAC Scientific for product availability.', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:18', NULL, NULL, 'normal', '5vMi8XeB93.jpeg', NULL, NULL, ''),
(11, 18, NULL, NULL, 3, NULL, '18G x 100mm PRP Transfer Needle', '18G-x-100mm-PRP-Transfer-Needle', 'Yr4MEXEejH', '', NULL, 'Sterile 18G × 100mm transfer needle designed for the safe transfer of PRP and other sterile fluids between compatible containers during professional clinical procedures. Intended for use by trained healthcare professionals.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">18G × 100mm size</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Medical-grade stainless steel</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Sterile, single-use</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Long cannula for fluid transfer</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compatible with Luer syringes</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Individually packed</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional clinical use</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Suitable for PRP workflows</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The RenwalSkin 18G × 100mm Special Beauty Long Needle is a professional sterile transfer accessory commonly used during PRP preparation workflows. Its extra-long 100 mm stainless-steel cannula helps transfer platelet-rich plasma or other sterile solutions from one compatible tube or container to another while supporting aseptic handling. The needle is manufactured for single-use professional applications and is individually sterilized. Suitable for dermatology, hair restoration, regenerative medicine and aesthetic clinics, it is compatible with standard Luer-lock and Luer-slip syringes. Use only according to established clinical protocols and infection-control practices.</p>', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Open the sterile package immediately before use.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Attach the needle securely to a compatible sterile syringe.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Transfer PRP or other sterile fluid between compatible tubes or containers using aseptic technique.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dispose of the needle in an approved sharps container after single use.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Important: This needle is intended as a transfer accessory. Follow your clinic\'s validated PRP protocol and all applicable infection-control procedures.</p>', 'nyEBiRHhVR_1785426678.webp', 0.47619047619048, 1.0714285714286, 100, '18G x 100mm PRP Transfer Needle | MAC Scientific', 'Buy sterile 18G × 100mm PRP transfer needles for professional blood and PRP transfer procedures. Available from MAC Scientific.', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:18', NULL, NULL, 'normal', 'nyEBiRHhVR.jpeg', NULL, NULL, '');
INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `tax_id`, `brand_id`, `name`, `slug`, `sku`, `tags`, `video`, `sort_details`, `specification_name`, `specification_description`, `is_specification`, `details`, `how_to_use`, `photo`, `discount_price`, `previous_price`, `stock`, `meta_keywords`, `meta_description`, `status`, `is_type`, `date`, `file`, `link`, `file_type`, `created_at`, `updated_at`, `license_name`, `license_key`, `item_type`, `thumbnail`, `affiliate_link`, `tier_prices`, `features`) VALUES
(13, 18, NULL, NULL, 3, NULL, 'PRP= ACD+GEL+BIOTIN 10ML', 'prp-acdgelbiotin-10ml-K4G06', '2iecd0XvTl', 'PRP Tube,ACD Gel Biotin,MAC SCIENTIFIC,Hair Growth PRP,10ml PRP Tube,Biotin Infused PRP,Trichology Supplies,Aesthetic Clinical Supplies,Platelet Rich Plasma,Biotin PRP Tube,Gel Separator Tube,Hair Restoration,Medical Supplies Dhaka,Scalp Rejuvenation', NULL, 'PRP= ACD+GEL+BIOTIN 10ML', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><b>Why Choose Us?</b></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>3-in-1 Formulation: ACD + Separation Gel + Biotin</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Sterile, Pyrogen-Free, Single-Use</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>ISO 13485 &amp; CE Certified</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Crystal Clear 10ml Tube for Easy Plasma Observation</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Enhanced PRP Yield &amp; Quality</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Clinically Trusted for Hair, Skin &amp; Joint Treatments</b></p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\">✅ <b>Compatible with Most Centrifuge Machines</b></p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The <b>PRP Tube – ACD + Gel + Biotin (10ml)</b> is a premium-quality, <b>crystal-clear sterile medical tube</b> designed for effective <b>Platelet-Rich Plasma (PRP) preparation</b>. It contains <b>ACD (Anticoagulant Citrate Dextrose)</b> to prevent blood clotting, <b>separation gel</b> for clear plasma isolation, and <b>Biotin (Vitamin B7)</b> to boost cell regeneration and therapeutic results.</p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">This tube is <b>CE and ISO 13485 certified</b>, ensuring <b>international medical-grade safety and performance</b>. It is widely used by <b>aesthetic professionals, dermatologists, and orthopedic specialists</b> to improve <b>hair restoration</b>, <b>skin rejuvenation</b>, and <b>tissue healing</b> outcomes.</p><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br></p><p style=\"margin-bottom: 0.11in; font-size: medium; line-height: 1.16px; direction: ltr; background: transparent; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Applications / Uses:</span></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"margin-bottom: 0.11in; line-height: 1.16px; direction: ltr; background: transparent;\">✔️ <span style=\"font-weight: 600;\">Hair PRP Therapy</span> – Strengthens roots, reduces hair fall</p></li><li><p style=\"margin-bottom: 0.11in; line-height: 1.16px; direction: ltr; background: transparent;\">✔️ <span style=\"font-weight: 600;\">Skin Rejuvenation</span> – Fights aging, improves skin texture</p></li><li><p style=\"margin-bottom: 0.11in; line-height: 1.16px; direction: ltr; background: transparent;\">✔️ <span style=\"font-weight: 600;\">Facial Aesthetics</span> – Acne scars, fine lines, glow therapy</p></li><li><p style=\"margin-bottom: 0.11in; line-height: 1.16px; direction: ltr; background: transparent;\">✔️ <span style=\"font-weight: 600;\">Joint &amp; Muscle Healing</span> – Aids orthopedic PRP treatments</p></li><li><p style=\"margin-bottom: 0.11in; line-height: 1.16px; direction: ltr; background: transparent;\">✔️ <span style=\"font-weight: 600;\">Post-Surgical Recovery &amp; Cell Regeneration</span></p></li></ul>', '<div _ngcontent-ng-c1311279210=\"\" inline-copy-host=\"\" class=\"markdown markdown-main-panel enable-luminous-fast-follows enable-updated-hr-color stronger tutor-markdown-rendering\" id=\"model-response-message-contentr_56b9bb2c48a7d47d\" aria-busy=\"false\" aria-live=\"polite\" dir=\"ltr\" style=\"--animation-duration: 400ms; --fade-animation-function: ease-out; animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: flex; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: column; float: none; gap: 16px; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><p data-path-to-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\">Based on the technical documentation provided, here is a clear, step-by-step distillation of the clinical protocol, execution parameters, and safety guidelines for the PER system.</p><h2 data-path-to-node=\"2\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans&quot;, sans-serif !important; line-height: 1.15 !important;\">⚙️ Centrifugation &amp; Processing Parameters</h2><p data-path-to-node=\"3\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\">To achieve the target platelet concentration of <b data-path-to-node=\"3\" data-index-in-node=\"48\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">4–5x baseline</b> (<span class=\"math-inline\" data-math=\"1 \\times 10^6 \\text{ platelets/}\\mu\\text{L} \\pm 20\\%\" data-index-in-node=\"63\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">$1 \\times 10^6 \\text{ platelets/}\\mu\\text{L} \\pm 20\\%$</span>), the centrifuge must be configured exactly to the following settings to properly isolate the \"Buffy Coat\" layer:</p><table data-path-to-node=\"4\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 32px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><thead style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><strong style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; margin-bottom: 0px !important; line-height: 1.15 !important;\">Parameter</strong></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><strong style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; margin-bottom: 0px !important; line-height: 1.15 !important;\">Value / Setting</strong></td></tr></thead><tbody style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,1,0,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,1,0,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">Force (RCF)</b></span></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,1,1,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,1,1,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">1200 g</b></span></td></tr><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,2,0,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,2,0,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">Speed (RPM)</b></span></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,2,1,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,2,1,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">3400 rpm</b> <i data-path-to-node=\"4,2,1,0\" data-index-in-node=\"9\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">(Specifically validated for the Hettich EBA 200 inclined/fixed-angle rotor)</i></span></td></tr><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,3,0,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,3,0,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">Time</b></span></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,3,1,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,3,1,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">7 minutes</b></span></td></tr><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,4,0,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,4,0,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">Tube Capacity</b></span></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,4,1,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">9 mL vacuum draw</span></td></tr><tr style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,5,0,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><b data-path-to-node=\"4,5,0,0\" data-index-in-node=\"0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">Built-in Anticoagulant</b></span></td><td style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 1px solid rgb(196, 199, 197); inset: 0px; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 8px 12px; page: auto; perspective: none; position: relative; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"><span data-path-to-node=\"4,5,1,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">0.8 mL Sodium Citrate (pH 6.5–7.0)</span></td></tr></tbody></table><blockquote data-path-to-node=\"5\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-bottom: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; line-height: 1.15 !important;\"><p data-path-to-node=\"5,0\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\">⚠️ <b data-path-to-node=\"5,0\" data-index-in-node=\"3\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">RCF vs. RPM Warning:</b> If you are not using a Hettich EBA 200 or an equivalent inclined-rotor centrifuge, you <b data-path-to-node=\"5,0\" data-index-in-node=\"111\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">must</b> manually calculate the correct RPM to achieve exactly <b data-path-to-node=\"5,0\" data-index-in-node=\"170\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\">1200 g</b> using the manufacturer\'s RCF converter link provided in your manual. Improper forces will result in complete failure to isolate the target layer.</p></blockquote><h2 data-path-to-node=\"7\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; color: rgb(31, 31, 31); columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans&quot;, sans-serif !important; line-height: 1.15 !important;\">🩸 Step-by-Step Application Protocol</h2><p data-path-to-node=\"8\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; font-family: &quot;Google Sans Text&quot;, sans-serif !important; line-height: 1.15 !important;\"></p><div class=\"attachment-container unknown\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><response-element class=\"\" ng-version=\"0.0.0-PLACEHOLDER\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y: 0px; zoom: 1; margin-top: 0px !important; line-height: 1.15 !important;\"><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><sequence class=\"lm-enabled ng-star-inserted\" style=\"animation: auto ease 0s 1 normal none running none; appearance: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); border: 0px rgb(31, 31, 31); inset: auto; clear: none; clip: auto; columns: auto; contain: none; container: none; content: normal; cursor: auto; cx: 0px; cy: 0px; d: none; direction: ltr; display: inline; fill: rgb(0, 0, 0); filter: none; flex: 0 1 auto; flex-direction: row; float: none; gap: normal; hyphens: manual; interactivity: auto; isolation: auto; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; marker: none; mask: none; offset: normal; opacity: 1; order: 0; outline: rgb(31, 31, 31) none 3px; overlay: none; padding: 0px; page: auto; perspective: none; position: static; quotes: auto; r: 0px; resize: none; rotate: none; rule: 3px rgb(31, 31, 31); rx: auto; ry: auto; scale: none; speak: normal; stroke: none; transform: none; transition: all; translate: none; visibility: visible; x: 0px; y:', '1783346587PRP=ACD+GEL (1)_1785426678.webp', 2.3809523809524, 3.5714285714286, 100, 'PRP Tube,ACD Gel Biotin,MAC SCIENTIFIC,10ml PRP tube,Biotin infused PRP,hair growth PRP tubes,trichology supplies Bangladesh,medical grade PRP tube,platelet rich plasma biotin,separation gel PRP,MAC Scientific Dhaka,aesthetic clinical supplies,hair restoration PRP,blood collection tubes hair loss', 'Buy MAC SCIENTIFIC 10ml PRP Tubes infused with ACD, Separation Gel, and Biotin. Premium trichology-grade tubes engineered for advanced hair root regeneration.', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:40', '2026-07-30 09:51:18', NULL, NULL, 'normal', '2W34TQ75_1785426678.webp', NULL, '[{\"min_qty\":\"2\",\"price\":6.5476190476190474},{\"min_qty\":\"10\",\"price\":30.952380952380953},{\"min_qty\":\"20\",\"price\":60.714285714285715},{\"min_qty\":\"50\",\"price\":119.04761904761905}]', '');
INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `tax_id`, `brand_id`, `name`, `slug`, `sku`, `tags`, `video`, `sort_details`, `specification_name`, `specification_description`, `is_specification`, `details`, `how_to_use`, `photo`, `discount_price`, `previous_price`, `stock`, `meta_keywords`, `meta_description`, `status`, `is_type`, `date`, `file`, `link`, `file_type`, `created_at`, `updated_at`, `license_name`, `license_key`, `item_type`, `thumbnail`, `affiliate_link`, `tier_prices`, `features`) VALUES
(16, 18, NULL, NULL, 3, NULL, 'PRP Tube ACD + Gel + Biotin 12ml', 'PRP-Tube-ACD---Gel---Biotin-12ml', 'PpcJYLrS4C', '', NULL, 'Premium sterile PRP tubes with ACD anticoagulant, separation gel and biotin. Designed for reliable blood collection and efficient plasma separation for professional regenerative and aesthetic procedures.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Available in 10ml, 12ml &amp; 15ml</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">ACD anticoagulant</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Separation gel</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Biotin formulation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Sterile, single-use vacuum tube</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Medical-grade PET tube</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Leak-resistant cap</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compatible with most PRP centrifuges</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Individually packed</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional clinical use</p></li></ul>', NULL, 1, 'PRP=ACD+GEL+Biotin -12ml<span style=\"background-color: transparent; color: rgb(0, 0, 0); font-size: medium;\">The MAC Scientific PRP Tube (ACD + Gel + Biotin) is designed for healthcare professionals performing platelet-rich plasma procedures. The tube combines an ACD anticoagulant to help preserve the blood sample, a separation gel to assist plasma separation during centrifugation, and biotin as part of the tube formulation. Manufactured from medical-grade materials, each sterile vacuum tube is individually packed and intended for single use. Compatible with standard PRP centrifuges, it is suitable for use in dermatology, hair restoration, orthopedics, dentistry and regenerative medicine clinics. Available in 10ml, 12ml and 15ml sizes, it offers consistent quality and dependable performance for professional PRP workflows.</span>', '<h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; color: rgb(79, 129, 189); break-inside: avoid; line-height: 19.9333px; background: transparent; break-after: avoid; font-family: Calibri, serif; font-weight: bold; font-size: 13pt;\">Applications</h2><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">PRP preparation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Hair restoration</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Facial rejuvenation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Orthopedic PRP</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dental PRP</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Regenerative medicine</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clinical laboratory use</p></li></ul><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; color: rgb(79, 129, 189); break-inside: avoid; line-height: 19.9333px; background: transparent; break-after: avoid; font-family: Calibri, serif; font-weight: bold; font-size: 13pt;\">Operating Steps</h2><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Collect blood using standard venipuncture.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Fill the tube to the vacuum volume.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Gently invert 5–8 times to mix the additive.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Place balanced tubes in a compatible centrifuge.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Centrifuge using your validated protocol.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Remove the plasma layer using aseptic technique.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Important: Follow your clinic\'s validated PRP protocol and centrifuge settings. For professional use only.</p>', '178430431512ml_1785426678.webp', 3.2142857142857, 4.1666666666667, 95, 'PRP Tube ACD + Gel + Biotin | MAC Scientific', 'Buy sterile PRP tubes with ACD, Gel & Biotin in 10ml, 12ml and 15ml. Professional quality for PRP preparation. Order from MAC Scientific.', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:41', '2026-07-30 09:51:18', NULL, NULL, 'normal', '5Y7W7hHY_1785426678.webp', NULL, NULL, ''),
(20, 18, NULL, NULL, 3, NULL, 'TD4C PRP Centrifuge Machine for PRP, PRF & GFC', 'TD4C-PRP-Centrifuge-Machine-for-PRP--PRF---GFC', 'X0UGBTMztU', '', NULL, 'Achieve fast, reliable, and precise blood component separation with the TD4C PRP Centrifuge Machine. Designed for PRP, PRF, and GFC preparation, it delivers consistent performance, quiet operation, and user-friendly digital controls for modern medical and aesthetic practices.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Maximum speed up to 4000 RPM</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">High-efficiency brushless DC motor</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Digital LCD display for easy operation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Adjustable speed and timer settings</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Low vibration and quiet performance</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Automatic safety lid locking system</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Suitable for PRP, PRF, GFC, and CGF preparation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compact, durable, and space-saving design</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Easy cleaning and minimal maintenance</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Ideal for continuous clinical operation</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The TD4C PRP Centrifuge Machine is a high-performance laboratory centrifuge designed to meet the growing demands of regenerative medicine, aesthetic treatments, and clinical laboratories. Engineered for accurate blood component separation, this professional centrifuge ensures consistent preparation of Platelet-Rich Plasma (PRP), Platelet-Rich Fibrin (PRF), and Growth Factor Concentrate (GFC).<br><br>Powered by a maintenance-free brushless DC motor, the TD4C delivers stable operation with minimal vibration and low noise, making it ideal for daily clinical use. Its intuitive digital control panel allows precise adjustment of speed and time, ensuring reproducible results across various treatment protocols.<br><br>Whether you\'re performing hair restoration, facial rejuvenation, orthopedic injections, sports medicine procedures, or dental regenerative treatments, this centrifuge offers dependable performance and excellent durability.</p>', NULL, 'JYllm0jtun_1785426678.webp', 297.61904761905, 416.66666666667, 100, 'TC4 Centrifuge', 'TC4 Centrifuge', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:41', '2026-07-30 09:51:18', NULL, NULL, 'normal', 'JYllm0jtun.jpeg', NULL, NULL, ''),
(21, 25, NULL, NULL, 3, NULL, 'Tourniquet', 'tourniquet-kDB7y', 'NC2zl6ii9g', '', NULL, 'Usage: Hospital | Clinic | Laboratory', '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><b>Key Features:</b></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Strong ABS Buckle</b> – Ensures secure and comfortable fastening.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Perfect Finish</b> – No clumsy stitching; smooth edges for patient comfort.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Long Service Life</b> – Built with high-quality materials to withstand repeated use.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Easy to Use</b> – Simple application and quick release mechanism for convenience.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent;\"><b>Aesthetic &amp; Functional</b> – Designed with both form and function in mind.</p></li></ul><p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Our tourniquets go through rigorous quality checks to eliminate any possibility of defects, ensuring each unit meets medical industry standards.</p>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.11in; line-height: 1.16px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Enhance patient care and procedural efficiency with our <b>premium-quality Tourniquet</b>, engineered for reliable performance in medical settings. This tourniquet is designed with a <b>durable ABS buckle</b>, superior finishing, and long-lasting material — making it an ideal choice for hospitals, clinics, and laboratories.</p>', NULL, '1783346133Ttourniquet_1785426678.webp', 0.5952380952381, 0.95238095238095, 100, 'Tourniquet', 'Tourniquet', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:41', '2026-07-30 09:51:18', NULL, NULL, 'normal', 'nGxrTO64_1785426678.webp', NULL, NULL, ''),
(22, 21, NULL, NULL, 3, NULL, 'Unimaster', 'unimaster-GPuWh', 'sSdDdM6TKt', '', NULL, 'Unimaster', NULL, NULL, 1, 'Unimaster', NULL, '1783346025Needle_1785426678.webp', 0.5952380952381, 1.1904761904762, 100, 'Unimaster', 'Unimaster', 1, NULL, NULL, NULL, NULL, NULL, '2026-07-06 13:49:41', '2026-07-30 09:51:19', NULL, NULL, 'normal', 'CiIpT0bP_1785426679.webp', NULL, '[{\"min_qty\":\"10\",\"price\":5.9523809523809526}]', ''),
(23, 25, NULL, NULL, 3, NULL, '24K Gold T-Bar Facial Massager with Vibration', '24K-Gold-T-Bar-Facial-Massager-with-Vibration', 'b7sbIi4lTk', '', NULL, 'Enhance your skincare routine with the 24K Gold T-Bar Facial Massager. Featuring high-frequency vibration and a waterproof design, it helps relax facial muscles while promoting a refreshed, radiant appearance—perfect for professional and personal beauty care.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Premium gold-colored finish</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">High-frequency vibration massage</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Waterproof design</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Ergonomic T-shaped massage head</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compact &amp; lightweight</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Battery operated</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Suitable for face and neck massage</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional &amp; home use</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Easy one-button operation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Travel-friendly</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The 24K Gold T-Bar Facial Massager is a premium beauty device designed to complement your daily skincare routine. Its ergonomic T-shaped massage head and gentle high-frequency vibration provide a comfortable facial massage experience, helping skincare products spread more evenly while promoting a refreshed appearance. The waterproof construction allows convenient use during your skincare routine, while the compact, lightweight design makes it easy to carry. Ideal for beauty professionals, aesthetic clinics, spas and home users, it is suitable for facial massage, neck massage and beauty care.</p>', NULL, '178342415324K Gold T-Bar Facial Massager – Vibrating Skin Lifting & Energy Beauty Tool 1.webp', 11.904761904762, 14.285714285714, 100, '', NULL, 1, 'undefine', NULL, NULL, NULL, NULL, '2026-07-07 05:35:53', '2026-07-17 10:03:06', NULL, NULL, 'normal', 'nqezqbPr.webp', NULL, NULL, '');
INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `tax_id`, `brand_id`, `name`, `slug`, `sku`, `tags`, `video`, `sort_details`, `specification_name`, `specification_description`, `is_specification`, `details`, `how_to_use`, `photo`, `discount_price`, `previous_price`, `stock`, `meta_keywords`, `meta_description`, `status`, `is_type`, `date`, `file`, `link`, `file_type`, `created_at`, `updated_at`, `license_name`, `license_key`, `item_type`, `thumbnail`, `affiliate_link`, `tier_prices`, `features`) VALUES
(24, 18, NULL, NULL, 3, NULL, 'Sodium Citrate PRP Tube 10ml – Sterile Blood Collection Tube', 'Sodium-Citrate-PRP-Tube-10ml-–-Sterile-Blood-Collection-Tube', '5Twtlmf90n', '', NULL, 'Ensure reliable blood collection for PRP procedures with the 10ml Sodium Citrate PRP Tube. Sterile, vacuum-sealed, and designed for consistent sample collection, it is ideal for regenerative medicine, aesthetic treatments, and laboratory applications.', '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\"><br><br></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">10ml sterile vacuum tube</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Sodium Citrate anticoagulant</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Medical-grade PET</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Leak-resistant cap</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">CE marked</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Single-use sterile</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compatible with standard PRP centrifuges</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Maintains sample integrity</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Professional clinical use</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Quality inspected</p></li></ul>', NULL, 1, '<p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">The MAC Scientific Sodium Citrate PRP Tube 10ml is a premium sterile vacuum blood collection tube designed for professional PRP preparation and clinical blood processing. Pre-filled with Sodium Citrate anticoagulant, it helps maintain sample integrity during collection and centrifugation. Manufactured from medical-grade materials, it provides dependable vacuum performance and is compatible with most standard PRP centrifuges. Each tube is sterile, single-use, and intended for trained healthcare professionals.</p><h2 class=\"western\" style=\"margin-top: 0.14in; margin-bottom: 0in; font-family: Calibri, serif; font-weight: bold; line-height: 19.9333px; color: rgb(79, 129, 189); font-size: 13pt; direction: ltr; break-inside: avoid; background: transparent; break-after: avoid;\">Applications</h2><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">PRP preparation</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Regenerative medicine</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Hair restoration</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Dermatology</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Orthopedic PRP</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Dental PRP</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Clinical laboratories</p></li></ul><h2 class=\"western\" style=\"margin-top: 0.14in; margin-bottom: 0in; font-family: Calibri, serif; font-weight: bold; line-height: 19.9333px; color: rgb(79, 129, 189); font-size: 13pt; direction: ltr; break-inside: avoid; background: transparent; break-after: avoid;\">Steps</h2><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Check package integrity.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Collect blood using standard venipuncture.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Fill to vacuum volume.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Invert gently 5–8 times.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Balance tubes in centrifuge.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Centrifuge according to validated protocol.</p></li><li><p style=\"margin-bottom: 0.14in; line-height: 1.15px; direction: ltr; background: transparent;\">Process the sample using aseptic technique.</p></li></ol><p style=\"margin-bottom: 0.14in; font-size: medium; line-height: 1.15px; direction: ltr; background: transparent; color: rgb(0, 0, 0);\">Note: Single-use only. For professional use by trained healthcare personnel.</p><div class=\"elementor-section elementor-element elementor-element-ygexan8 elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-hith2yq elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-8220irg elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h2 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; line-height: 1.5em; color: rgb(0, 0, 0); font-weight: 700; font-size: 28px; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Instructions for use</font></h2></div></div><div class=\"elementor-widget elementor-element elementor-element-13153sw elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 15px;\"></div></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-xf6nw7u elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-fc9rdj4 elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-bufioxf elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">VI PRP-PRO</font></span><font dir=\"auto\" style=\"vertical-align: inherit;\"> | PRP tubes enable the simple, safe and rapid production of blood components (e.g. platelet gel, fibrin gel, bone marrow cell gel) and are intended for the use of autologous blood products.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The purpose of this medical device is to administer locally high concentrations of growth factors, such as those found in platelet concentrate. It may also provide cells involved in repair, supporting tissue and temporary fibrin scaffolding, and promoting cell migration.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The PRP tubes must be used by specially trained medical personnel and possibly under medical supervision.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Therapeutic efficacy depends on the intrinsic quality and the production of the blood components. This medical device enables the production and</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Activation (gelling) of blood components. VI - PRP-Pro is not therapeutic in itself. The most important indications for the use of this</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The medical device consists of the treatment of acute wounds, chronic ulcers of the skin, subcutaneous or mucocutaneous tissue as well as bone injuries, subcutaneous injections/fillers and strengthening of the hair roots.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The method based on this preparation is called \"Buffy Coat\" and requires PRP tubes that differ from the \"Empty Test\" (simple vacuum blood collection tube), which produces serum rather than a concentrate. These tubes are not capable of sedimenting the blood with high precision and producing a high PRP concentration. Furthermore, they do not allow for the extraction of only the intermediate layer (PRP).</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0px;\"></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-e1vem8m elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-xvenou4 elementor-col-50 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 719.75px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 719.75px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 689.75px;\"><div class=\"elementor-widget elementor-element elementor-element-0vjn872 elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Additionally, the plastic of the simple vacuum blood collection tubes contains micronized silicone, which can also induce platelet activation. All of this</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The centrifugation process results in a platelet-free serum that cannot be used for PRP.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">VI PRP-PRO | PRP tubes</font></span><font dir=\"auto\" style=\"vertical-align: inherit;\"> are </font><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">not</font></span><font dir=\"auto\" style=\"vertical-align: inherit;\"> made of plastic and do not contain micronized silicone!&nbsp;</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The composition is optimally balanced to achieve maximum biological effect. Platelet-rich plasma (PRP) is also known as autologous platelet gel, growth factor-rich plasma (PRGF), or platelet concentrate (PC). It is essentially an increase in the concentration of autologous platelets contained in a small amount of plasma after centrifugation of the patient\'s blood.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The PRP tubes are available in the following vacuum capacities: </font><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">9ml</font></span><font dir=\"auto\" style=\"vertical-align: inherit;\"> .</font></p></div></div></div></div></div></div><div class=\"elementor-column elementor-element elementor-element-ozee9vn elementor-col-50 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 719.75px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 719.75px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 689.75px;\"><div class=\"elementor-widget elementor-element elementor-element-ythbndq elementor-widget-image\" data-element_type=\"image\" style=\"position: relative; text-align: center;\"><div class=\"elementor-widget-container\"><div class=\"elementor-image\"><img loading=\"lazy\" src=\"https://prpmed.de/img/cms/PRP-PRO-SET20.jpg\" width=\"2235\" height=\"1490\" alt=\"PRP tubes\" style=\"height: auto; max-width: 100%; border-width: medium; border-color: currentcolor; border-image: initial; border-radius: 0px; box-shadow: none; opacity: 1;\"></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-ffattj3 elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-qg1ge57 elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-m5w6d33 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-ujt07m4 elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h2 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; line-height: 1.5em; color: rgb(0, 0, 0); font-weight: 700; font-size: 28px; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Application areas</font></h2></div></div><div class=\"elementor-widget elementor-element elementor-element-s8u28ve elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-h36szer elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-lqebr4i elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-o09q6ov elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">MAXILLO - FACIAL SURGERY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-ebz0og4 elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Reconstructions of the lower jaw, dental implants, tonal and oropharyngeal fissures;</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-nqvroq7 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-zartd7e elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Ear, nose and throat medicine</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-uq02s5t elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Neck and head surgery, facial or nasal fractures;</font></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Tooth alveolus lesions; breast augmentation; mandibular reconstruction; bone graft; oronasal fistula; lip repair; rhinoplasty and septum rhinoplasty; facial fractures</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-3d38fya elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-jybvuqo elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">PLASTIC, RECONSTRUCTIVE, AESTHETIC SURGERY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-4tid62n elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Skin flaps, muscle-skin reconstruction, mammoplasty; face and neck lift; musculocutaneous flaps and reconstruction; chronic ulcers; breast reconstruction and mammoplasty; craniofacial reconstruction; adjunctive to laser facial treatments</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-yoxf9ht elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-p4pb3yj elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">ORTHOPEDICS</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-dd5tcjs elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Pseudoarthrosis, osteosynthesis, bone implants, titanium prosthesis implants</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-grgl0l5 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-lzx0b3k elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">NEUROSURGERY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-6xy8xix elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Vertebral reconstructions; burr holes and craniectomy; cerebrospinal fluid loss</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-jtash63 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-5gvnazg elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Vascular and cardiac surgery</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-fuyjrbk elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Sternum repair; arterial bypass; arterial reconstruction; bronchopleural fistula</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-joti9su elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-lwwy263 elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">OPHTHALMOLOGY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-n1kav4k elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Corneal ulcers and wounds; repair of macular lesions (with hyperconcentrated platelets).</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-5c7ki9s elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-wsfkk3r elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">TRICHOLOGY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-gs9xmte elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Hair root regeneration</font></p></div></div></div><div class=\"elementor-widget elementor-element elementor-element-1d4i4jg elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 10px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-uwtwsa2 elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h3 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; font-weight: 700; line-height: 1.5em; color: rgb(0, 0, 0); font-size: 1.75rem; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">GENERAL MEDICINE, GERIATRICS, DIABETOLOGY, HEMATOLOGY, GENERAL SURGERY, DERMATOLOGY, RADIOTHERAPY</font></h3></div></div><div class=\"elementor-widget elementor-element elementor-element-wp6krmi elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">These are specialized areas where ulcers or acute or chronic fissures, primary or secondary, could find therapeutic support in the use of platelet gel.</font></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-mx63zei elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-wrblqgt elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-u3jl634 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-tjwhpz8 elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h2 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; line-height: 1.5em; color: rgb(0, 0, 0); font-weight: 700; font-size: 28px; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Precautions</font></h2></div></div><div class=\"elementor-widget elementor-element elementor-element-z0frtd6 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-1v219d7 elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-i39ityh elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-q8x82an elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The medical device may only be used by experienced personnel and only under certain conditions.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Use PRP with particular caution in the following cases:</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">• acute or chronic infections at the surgical site;</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">• uncontrolled metabolic disorders such as diabetes, osteomalacia, thyroid dysfunction, severe kidney or liver diseases;</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">• Long-term therapy with cortisone;</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">• Autoimmune diseases;</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">• Radiation therapy.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Patients with congenital or acquired functional platelet defects may release fewer growth factors.</font></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">In cases of thrombocytopenia, it is very difficult to obtain a platelet-rich concentrate for clinical use. The platelet gel is reabsorbed within a few days. No toxicity has been described in tissues treated with the gel. Standard monitoring procedures or prophylaxis against infectious complications should be used. Growth factors from the platelets induce cell proliferation.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The use of platelet gel is contraindicated in cases of suspected malignant degenerative lesions. To ensure tissue regeneration, the PRP must be introduced exclusively into viable tissue and in direct contact with the tissue (if necessary, by making micro-incisions on the tissue surface).</font></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-qv7p439 elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-tjrhf06 elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-5f6kd22 elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">By following these instructions for use, this medical device can produce PRP with a platelet concentration 4-5 times higher than the original blood sample (1 x 10⁶ platelets/microliter ± 20%). Growth factors and chemotactic mediators from the platelets are released primarily passively (i.e., without platelet activation). Therefore, platelet gel can be produced from the blood of patients taking oral anticoagulants, heparin, calcium heparin, platelet aggregation inhibitors, and cyclooxygenase inhibitors.</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Part of the release of growth factors may depend on the activation state of the platelets. It is therefore advisable to delay the release of the</font></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Wait for growth factors to be released if the patient is taking cyclooxygenase inhibitors or anti-platelet drugs. No interactions with systemic or topical agents are known. The intended use does not include adding medications to the platelet gel. If platelet gel is used for bone regeneration, the gel can be used with certified animal bone or certified biocompatible materials.</font></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-mgnlinr elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-q3lsnce elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-pbswx80 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-a2rxqke elementor-widget-heading\" data-element_type=\"heading\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><h2 class=\"elementor-heading-title elementor-size-default none\" style=\"margin: 0px; line-height: 1.5em; color: rgb(0, 0, 0); font-weight: 700; font-size: 28px; padding: 0px; letter-spacing: 1px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">VI PRP-PRO - APPLICATION PROTOCOL</font></h2></div></div><div class=\"elementor-widget elementor-element elementor-element-4wmoy63 elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 25px;\"></div></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-ohmqqit elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-ym3inag elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-kg1418t elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The production of PRP involves drawing autologous venous blood (from the patient being treated), which is then centrifuged and concentrated (using a method called Buffy Coat). Anticoagulant: Sodium citrate 0.8 ml, sodium citrate pH 6.5/7</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">After blood is drawn, the sample is centrifuged (rotation/centrifugal force depends on the centrifuge) until three layers are obtained:</font></p><p style=\"margin-bottom: 0.8rem;\"></p><ul style=\"padding: 0.6rem 0.6rem 0.6rem 2rem; margin-bottom: 0px; list-style: disc;\"><li><font dir=\"auto\" style=\"vertical-align: inherit;\">platelet-poor plasma (platelet-poor plasma-PPP)</font></li><li><font dir=\"auto\" style=\"vertical-align: inherit;\">platelet-rich plasma (platelet-rich plasma - PRP)</font></li><li><font dir=\"auto\" style=\"vertical-align: inherit;\">red blood cells</font></li></ul><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0.8rem;\"><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Set the centrifuge to the following parameters:</font></span></p><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">1200 RCF (g) (for Hettich EBA 200 at 3400 rpm) for 7 minutes for angle or inclined rotor centrifuges.&nbsp;</font><br><br><font dir=\"auto\" style=\"vertical-align: inherit;\">Depending on the centrifuge/rotor, you can use the following converter to determine the required speed for best results:</font></p><p style=\"margin-bottom: 0.8rem;\"><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">RCF/RPM CONVERTER</font></span></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">https://www.hettichlab.com/de/rpmrcf-umrechner/</font></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-4s5jp2u elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-wkzknmn elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-nmful7z elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">VI - PRP-PRO PRP tubes are a new generation product manufactured with advanced technology to improve the quality and efficiency of their use. They are all CE marked (93/42/EEC, updated by Directive 2007/47/EEC) and subsequently validated according to numerous ISO certifications such as ISO 9001:2008, EN ISO 13485:2012, EN ISO 14971:2009, ISO 10993-1:2009, and ISO 10993-3:2005.&nbsp;</font></p><p style=\"margin-bottom: 0.8rem;\"></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">The PRP tubes are sterile primary packaging. They are packaged in a laminar flow environment and are certified as a Class IIa medical device, registered with the Ministry of Health under the national registration number and CND classification.&nbsp;</font></p></div></div></div></div></div></div></div></div></div><div class=\"elementor-section elementor-element elementor-element-yatoxvh elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-element_type=\"section\" style=\"position: relative; backface-visibility: hidden; color: rgba(72, 72, 72, 0.99); font-family: Arial, Helvetica, sans-serif;\"><div class=\"elementor-container  elementor-column-gap-default      \" style=\"display: flex; margin-right: auto; margin-left: auto; position: relative; max-width: 1500px;\"><div class=\"elementor-row  \" style=\"display: flex; width: 1439.5px;\"><div class=\"elementor-column elementor-element elementor-element-7vrr1we elementor-col-100 elementor-top-column\" data-element_type=\"column\" style=\"position: relative; min-height: 1px; display: flex; width: 1439.5px;\"><div class=\"elementor-column-wrap elementor-element-populated\" style=\"width: 1439.5px; display: flex; padding: 15px;\"><div class=\"elementor-widget-wrap\" style=\"position: relative; width: 1409.5px;\"><div class=\"elementor-widget elementor-element elementor-element-5o4rrif elementor-widget-spacer\" data-element_type=\"spacer\" style=\"position: relative;\"><div class=\"elementor-widget-container\"><div class=\"elementor-spacer\"><div class=\"elementor-spacer-inner\" style=\"height: 15px;\"></div></div></div></div><div class=\"elementor-widget elementor-element elementor-element-sq2h8lu elementor-widget-text-editor\" data-element_type=\"text-editor\" style=\"position: relative; font-size: 15px; line-height: 1.5em; letter-spacing: 1px;\"><div class=\"elementor-widget-container\"><div class=\"elementor-text-editor rte-content\" style=\"backface-visibility: hidden; text-align: justify;\"><p style=\"margin-bottom: 0.8rem;\"><span style=\"color: rgb(208, 18, 26);\"><span style=\"font-weight: bolder;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">Important NOTE:</font></span></span></p><p style=\"margin-bottom: 0px;\"><font dir=\"auto\" style=\"vertical-align: inherit;\">As sellers, we would like to point out that the injection of products with and without lidocaine should only be carried out by trained and medically qualified personnel, in the medical and nursing fields.</font></p></div></div></div></div></div></div></div></div></div>', '<h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; color: rgb(79, 129, 189); break-inside: avoid; line-height: 19.9333px; background: transparent; break-after: avoid; font-family: Calibri, serif; font-weight: bold; font-size: 13pt;\">Applications</h2><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">PRP preparation</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Regenerative medicine</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Hair restoration</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dermatology</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Orthopedic PRP</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dental PRP</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clinical laboratories</p></li></ul><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; color: rgb(79, 129, 189); break-inside: avoid; line-height: 19.9333px; background: transparent; break-after: avoid; font-family: Calibri, serif; font-weight: bold; font-size: 13pt;\">Steps</h2><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Check package integrity.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Collect blood using standard venipuncture.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Fill to vacuum volume.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Invert gently 5–8 times.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Balance tubes in centrifuge.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Centrifuge according to validated protocol.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Process the sample using aseptic technique.</p></li></ol><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium;\">Note: Single-use only. For professional use by trained healthcare personnel.</p>', '1783425467Sodium Citrate Tube 10ml PRP 1_1785426679.webp', 0.83333333333333, 1.4285714285714, 100, '', NULL, 1, 'undefine', NULL, NULL, NULL, NULL, '2026-07-07 05:57:47', '2026-07-30 09:51:20', NULL, NULL, 'normal', 'N7lIlVuy_1785426680.webp', NULL, '[{\"min_qty\":\"10\",\"price\":8.333333333333334}]', '');
INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `tax_id`, `brand_id`, `name`, `slug`, `sku`, `tags`, `video`, `sort_details`, `specification_name`, `specification_description`, `is_specification`, `details`, `how_to_use`, `photo`, `discount_price`, `previous_price`, `stock`, `meta_keywords`, `meta_description`, `status`, `is_type`, `date`, `file`, `link`, `file_type`, `created_at`, `updated_at`, `license_name`, `license_key`, `item_type`, `thumbnail`, `affiliate_link`, `tier_prices`, `features`) VALUES
(25, 18, NULL, NULL, 3, NULL, 'PRP & PRF Clinical Centrifuge Machine (DM0506) | 300–5000 RPM | LCD Display | Brushless Motor | CE & ISO Certified', 'PRP---PRF-Clinical-Centrifuge-Machine--DM0506----300–5000-RPM---LCD-Display---Brushless-Motor---CE---ISO-Certified', 'KGIAVm8MEs', '', NULL, 'Professional low-speed laboratory centrifuge designed for PRP, PRF, blood, urine, and laboratory sample separation. Features a maintenance-free brushless DC motor, LCD display, programmable settings, and a fixed-angle 6-place rotor compatible with 1.5–15 ml tubes. Suitable for hospitals, aesthetic clinics, diagnostic laboratories, and research facilities.', '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">Model: DM0506 / CF0506<br>Brand: WEIAI<br>Max Speed: 5000 RPM<br>Speed Range: 300–5000 RPM<br>Max RCF: 2350 × g<br>Display: LCD<br>Motor: Brushless DC Motor<br>Power Supply: AC 110V/220V, 50/60Hz<br>Dimensions: 300 × 240 × 180 mm<br>Weight: 5.2 kg<br>Package Size: 400 × 350 × 270 mm<br>Warranty: 1 Year<br>Certificates: CE, ISO, FCC, FDA, LVD (as applicable from supplier documentation)</p>', NULL, 1, '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">The PRP &amp; PRF Clinical Centrifuge Machine (DM0506) is a professional laboratory centrifuge engineered for medical, aesthetic, and laboratory applications. It is suitable for PRP preparation, PRF protocols, blood component separation, urine analysis, and routine laboratory procedures. Powered by a brushless DC motor, it offers quiet operation, stable speed, and long service life. The LCD display allows easy monitoring of RPM, RCF, and timer settings, while two programmable memory modes simplify repetitive workflows.</p><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; line-height: 19.9333px; color: rgb(79, 129, 189); break-inside: avoid; background: transparent; break-after: avoid; font-weight: bold; font-size: 13pt; font-family: Calibri, serif;\">Key Features</h2><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">• Speed Range: 300–5000 RPM<br>• Maximum RCF: 2350 × g<br>• LCD Display<br>• Brushless DC Motor<br>• RPM/RCF Switching<br>• Two Programmable Memory Modes (P1/P2)<br>• Adjustable Deceleration<br>• Automatic Lid Lock Release<br>• Sound Alert<br>• Maintenance-Free Motor<br>• Compact Design<br>• CE &amp; ISO Certified</p><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; line-height: 19.9333px; color: rgb(79, 129, 189); break-inside: avoid; background: transparent; break-after: avoid; font-weight: bold; font-size: 13pt; font-family: Calibri, serif;\">Applications</h2><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\"><font face=\"Arial Black, serif\">PRP Preparation<br>PRF Preparation<br>Blood Separation<br>Plasma Separation<br>Serum Separation<br>Urine Sample Processing<br>Clinical Laboratories<br>Diagnostic Centers<br>Research Institutes<br>Aesthetic Clinics<br>Hair Restoration Clinics</font></p><h2 class=\"western\" style=\"direction: ltr; margin-top: 0.14in; margin-bottom: 0in; line-height: 19.9333px; color: rgb(79, 129, 189); break-inside: avoid; background: transparent; break-after: avoid; font-weight: bold; font-size: 13pt; font-family: Calibri, serif;\">Compatible Tube Sizes</h2><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">1.5 ml<br>2 ml<br>5 ml<br>7 ml<br>9.5 ml PRP Tube<br>10 ml<br>12 ml PRP Tube<br>15 ml<br>Rotor Capacity: 6 × 15 ml</p>', '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">1. Collect samples using appropriate sterile tubes.<br>2. Balance the rotor with equal-weight tubes opposite each other.<br>3. Insert tubes securely and close the lid.<br>4. Set RPM/RCF and timer as required.<br>5. Press Start to begin centrifugation.<br>6. Wait until the cycle completes and the lid unlocks automatically.<br>7. Remove samples carefully and continue processing according to your validated protocol.<br><br>Example Settings:<br>• PRP: 4000 RPM for 5 minutes<br>• PRF: 2700 RPM for 7 minutes<br><br>Note: These are example settings only. Always follow the validated protocol recommended by your laboratory, clinician, or tube manufacturer.</p>', '178342634312_1785426680.webp', 416.66666666667, 535.71428571429, 100, '', NULL, 1, 'undefine', NULL, NULL, NULL, NULL, '2026-07-07 06:12:23', '2026-07-30 09:51:20', NULL, NULL, 'normal', 'ZNyHvRej_1785426680.webp', NULL, NULL, ''),
(27, 21, NULL, NULL, 3, NULL, 'F10 Professional Microneedling Derma Pen', 'F10-Professional-Microneedling-Derma-Pen', 'nQSm212yOc', 'UHOOMA F10,Dermapen,Professional Dermapen,Wireless Dermapen,Microneedling Pen,Skin Pen,PRP Microneedling,Exosome Therapy,Hair Regrowth,Beard Growth,Acne Scar Treatment,Skin Rejuvenation,Anti Aging,Wrinkle Reduction,Collagen Induction Therapy,NK2 PRO Cartridge,Adjustable Needle Depth,Aesthetic Equipment,Dermatology Equipment,Medical Device,CE Certified,Hair Microneedling,Face Microneedling,Dermapen Bangladesh,MAC Scientific', NULL, 'Key Features\r\nProfessional Wireless Microneedling Pen\r\nPremium Aluminum Alloy Handle\r\nRechargeable Magnetic Battery System\r\nNK2 PRO Needle Cartridge Compatible\r\n6 Adjustable Speed Levels\r\nMaximum Speed: 7,647 RPM\r\nAdjustable Needle Depth\r\nLightweight & Ergonomic Design\r\nLow Noise Operation\r\nStable Needle Movement\r\nCE & RoHS Certified', '<p style=\"direction: ltr; margin: 0.14in 0.65in 0.19in; line-height: 1.15px; background: transparent; color: rgb(0, 0, 0); font-size: medium; border-width: medium medium 1px; border-style: none none solid; border-color: currentcolor currentcolor rgb(79, 129, 189); padding: 0in 0in 0.06in;\"><font color=\"#4f81bd\"><i><b>Key Features:</b></i></font></p><ul style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Adjustable needle depth: 0–2.5 mm</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">6 adjustable speed levels</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Digital LED display</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dual magnetic rechargeable batteries</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Type-C charging</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Multifunction charging base</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Integrated disinfection cup</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Memory function</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Precision adjustment ring (0.25 mm increments)</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Compatible with Nano, 3D Silicone, 5D Silicone, 11/12/16/24/36/42 Pin cartridges</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">CE Certified</p></li></ul>', NULL, 1, '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\">The <span lang=\"en-US\"></span>F10 Professional Microneedling Derma Pen System is an advanced microneedling device designed for aesthetic professionals. It features an aluminum alloy body, adjustable needle depth (0–2.5 mm), six speed levels, dual magnetic rechargeable batteries, a multifunction charging base, Type-C charging, and a digital display. The ergonomic design delivers precise and comfortable treatments for skin rejuvenation, collagen induction, hair restoration support, and improved topical serum absorption.</p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\"><img src=\"/assets/images/rViJ2.jpeg\" style=\"width: 945.328px;\"><br></p><p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\"><img src=\"/assets/images/X7Al3.jpeg\" style=\"width: 945.328px;\"><img src=\"/assets/images/cPBS12.jpeg\" style=\"width: 945.328px;\"><img src=\"/assets/images/yPWO11.jpeg\" style=\"width: 945.328px;\"><img src=\"/assets/images/hDSr13.jpeg\" style=\"width: 945.328px;\"><br></p>', '<p class=\"western\" style=\"direction: ltr; margin-bottom: 0.14in; line-height: 16.8667px; background: transparent; font-family: Cambria, serif; font-size: 11pt; color: rgb(0, 0, 0);\"><br><br></p><ol style=\"color: rgb(0, 0, 0); font-size: medium;\"><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clean and disinfect the treatment area.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Install a new sterile cartridge.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Adjust needle depth and speed.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Apply the recommended serum or PRP if indicated.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Perform treatment using professional microneedling technique.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Dispose of the cartridge after single use.</p></li><li><p style=\"direction: ltr; margin-bottom: 0.14in; line-height: 1.15px; background: transparent;\">Clean and disinfect the device before storage.</p></li></ol>', '17835190066_1785426680.webp', 142.85714285714, 178.57142857143, 99, '•  F10 Derma Pen,• Professional Microneedling Pen,• Wireless Derma Pen,• Skin Rejuvenation Device,• Professional Microneedling Machine,UHOOMA F10,Dermapen,Professional Dermapen,Wireless Dermapen,Microneedling Pen,Skin Pen,PRP Microneedling,Exosome Therapy,Hair Regrowth,Beard Growth,Acne Scar Treatment,Skin Rejuvenation,Anti Aging,Wrinkle Reduction,Collagen Induction Therapy,NK2 PRO Cartridge,Adjustable Needle Depth,Aesthetic Equipment,Dermatology Equipment,Medical Device,CE Certified,Hair Microneedling,Face Microneedling,Dermapen Bangladesh,MAC Scientific', 'MAC Scientific is Bangladesh\'s trusted destination for regenerative medicine, PRP, GFC, PRF, Exosome, microneedling devices, dermatology equipment, and laboratory products. Quality products, competitive prices, and reliable nationwide delivery.', 1, 'new', NULL, NULL, NULL, NULL, '2026-07-07 06:44:19', '2026-07-30 09:51:20', NULL, NULL, 'normal', 'q83hXg2m_1785426680.webp', NULL, NULL, ''),
(28, 18, NULL, NULL, 3, NULL, 'PRP Tube (ACD + Gel + Biotin)-12ml', 'PRP-Tube--ACD---Gel---Biotin--12ml', '2szHnh4nlY', '', 'https://youtu.be/h5hKGbeKvqw?si=8f6dKfHFR7BXobOd', 'Premium sterile PRP tubes with ACD anticoagulant, separation gel and biotin. Designed for reliable blood collection and efficient plasma separation for professional regenerative and aesthetic procedures.', NULL, NULL, 1, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">The MAC Scientific PRP Tube (ACD + Gel + Biotin) is designed for healthcare professionals performing platelet-rich plasma procedures. The tube combines an ACD anticoagulant to help preserve the blood sample, a separation gel to assist plasma separation during centrifugation, and biotin as part of the tube formulation. Manufactured from medical-grade materials, each sterile vacuum tube is individually packed and intended for single use. Compatible with standard PRP centrifuges, it is suitable for use in dermatology, hair restoration, orthopaedics, dentistry and regenerative medicine clinics. Available in 10ml, 12ml and 15ml sizes, it offers consistent quality and dependable performance for professional PRP workflows.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><h2><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\">Key Features</span></b><img src=\"/assets/images/XUZGACD_GEL_Biotin -15ml.jpeg\" style=\"width: 50%; float: right;\" class=\"note-float-right\"><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\"><o:p></o:p></span></b></h2><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Available in 10ml, 12ml &amp; 15ml</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">ACD anticoagulant</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Separation gel</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Biotin formulation</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Sterile, single-use vacuum tube</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Medical-grade PET tube</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Leak-resistant cap</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Compatible with most PRP centrifuges</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Individually packed</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Professional clinical use</span></p><p class=\"MsoListBullet\"><b style=\"color: inherit; font-size: 1.625rem;\"><span style=\"font-family: Calibri; color: rgb(54, 96, 145); font-size: 14pt;\">. Application / How to Use</span></b></p><h1><img src=\"/assets/images/6cbGcommon.jpeg\" style=\"width: 50%; float: right;\" class=\"note-float-right\"><b><span style=\"font-family: Calibri; color: rgb(54, 96, 145); font-size: 14pt;\"><o:p></o:p></span></b></h1><h2><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\">Applications</span></b><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\"><o:p></o:p></span></b></h2><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">PRP preparation</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Hair restoration</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Facial rejuvenation</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Orthopedic PRP</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Dental PRP</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Regenerative medicine</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListBullet\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">·<span style=\"font-style: normal; font-variant: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Clinical laboratory use</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><h2><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\">Operating Steps</span></b><b><span style=\"font-family: Calibri; color: rgb(79, 129, 189); font-size: 13pt;\"><o:p></o:p></span></b></h2><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">1. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Collect blood using standard venipuncture.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">2. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Fill the tube to the vacuum volume.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">3. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Gently invert 5–8 times to mix the additive.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">4. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Place balanced tubes in a compatible centrifuge.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">5. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Centrifuge using your validated protocol.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoListNumber\"><!--[if !supportLists]--><span style=\"font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';mso-bidi-font-family:\'Times New Roman\';\r\nfont-size:11.0000pt;\">6. </span><!--[endif]--><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Remove the plasma layer using aseptic technique.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\">Important: Follow your clinic\'s validated PRP protocol and centrifuge settings. For professional use only.</span><span style=\"mso-spacerun:\'yes\';font-family:Cambria;mso-fareast-font-family:\'ＭＳ 明朝\';\r\nmso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;\"><o:p></o:p></span></p>', '<p><img src=\"/assets/images/cbTRPRP ACD_GEL_15 ml.webp\" style=\"width: 945.328px;\"><img src=\"/assets/images/Caynmac scientific PRP Step by Step.png\" style=\"width: 945.328px;\"><br></p>', '1784303558acd gel biotin 12ml_1785426680.webp', 3.6309523809524, 3.5714285714286, 96, '', 'Buy sterile PRP tubes with ACD, Gel & Biotin in 10ml, 12ml and 15ml. Professional quality for PRP preparation. Order from MAC Scientific.', 1, 'feature', NULL, NULL, NULL, NULL, '2026-07-08 11:17:26', '2026-08-06 00:34:46', NULL, NULL, 'normal', 'Ny8hQbZb_1785426680.webp', NULL, NULL, 'Safe,Easy to use');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `file`, `name`, `is_default`, `rtl`, `created_at`, `updated_at`, `type`) VALUES
(1, 'English', '1647794127lN7PfPAc.json', '1647794127lN7PfPAc', 1, 0, NULL, NULL, 'Website'),
(2, 'Bangla', '1647792286wzAqXQOx.json', '1647792286wzAqXQOx', 0, 0, NULL, NULL, 'Website'),
(3, 'English', '1647794074eEeCbfDD.json', '1647794074eEeCbfDD', 1, 0, NULL, NULL, 'Dashboard'),
(4, 'Bangla', '1638870927JMqjbCXv.json', '1638870927JMqjbCXv', 0, 1, NULL, NULL, 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'test', '2021-12-03 06:33:29', '2021-12-03 06:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_08_21_073142_create_admins_table', 1),
(2, '2021_08_21_073507_create_users_table', 1),
(3, '2021_09_20_144419_create_items_table', 1),
(4, '2021_09_20_151605_create_settings_table', 1),
(5, '2021_09_21_073848_create_attributes_table', 1),
(6, '2021_09_21_073951_create_attribute_options_table', 1),
(7, '2021_09_21_074028_create_banners_table', 1),
(8, '2021_09_21_074231_create_bcategories_table', 1),
(9, '2021_09_21_074309_create_brands_table', 1),
(10, '2021_09_21_074412_create_campaign_items_table', 1),
(11, '2021_09_21_074536_create_categories_table', 1),
(12, '2021_09_21_074744_create_chield_categories_table', 1),
(13, '2021_09_21_074952_create_countries_table', 1),
(14, '2021_09_21_075024_create_currencies_table', 1),
(15, '2021_09_21_075231_create_email_templates_table', 1),
(16, '2021_09_21_075346_create_faqs_table', 1),
(17, '2021_09_21_075642_create_fcategories_table', 1),
(18, '2021_09_21_080223_create_galleries_table', 1),
(19, '2021_09_21_080320_create_home_cutomizes_table', 1),
(20, '2021_09_21_080454_create_languages_table', 1),
(21, '2021_09_21_080652_create_messages_table', 1),
(22, '2021_09_21_080805_create_notifications_table', 1),
(23, '2021_09_21_090957_create_orders_table', 1),
(25, '2021_09_21_092255_create_payment_settings_table', 1),
(26, '2021_09_21_092722_create_posts_table', 1),
(27, '2021_09_21_092801_create_promo_codes_table', 1),
(28, '2021_09_21_093709_create_reviews_table', 1),
(29, '2021_09_21_093833_create_roles_table', 1),
(30, '2021_09_21_094020_create_services_table', 1),
(31, '2021_09_21_094413_create_shipping_services_table', 1),
(32, '2021_09_21_094517_create_sliders_table', 1),
(33, '2021_09_21_094630_create_socials_table', 1),
(34, '2021_09_21_094739_create_subcategories_table', 1),
(35, '2021_09_21_094831_create_subscribers_table', 1),
(36, '2021_09_21_094903_create_taxes_table', 1),
(37, '2021_09_21_095021_create_tickets_table', 1),
(38, '2021_09_21_095605_create_track_orders_table', 1),
(39, '2021_09_21_095650_create_transactions_table', 1),
(40, '2021_09_21_095836_create_wishlists_table', 1),
(41, '2021_09_21_091316_create_pages_table', 2),
(42, '2021_09_22_095954_add_extra_visibility_to_settings_table', 3),
(43, '2021_09_29_075836_add_theme_to_settings_table', 4),
(44, '2021_09_30_103035_google_chapcha_to_settings__table', 5),
(45, '2021_10_04_141643_add_currency_deraction_to_settings_table', 6),
(46, '2021_10_08_135417_add_theme_field_to_sliders_table', 7),
(51, '2021_10_09_153059_license_to_items_table', 8),
(56, '2021_10_09_173004_remove_item_type_to_items_table', 9),
(57, '2021_10_09_173038_set_item_type_to_items_table', 9),
(58, '2021_10_10_051502_add_scrript_to_settings_table', 10),
(59, '2021_10_10_142339_thumbnail_to_items_table', 11),
(61, '2021_10_10_163455_home_page4_to_home_cutomizes_table', 12),
(62, '2021_10_11_090243_create_extra_settings_table', 13),
(63, '2021_10_12_145150_add_home4populer_category_to_home_cutomizes_table', 14),
(64, '2021_10_13_100048_create_sitemaps_table', 15),
(65, '2021_10_15_140708_add_type_to_promo_codes_table', 16),
(66, '2021_10_15_163958_add_announcement_link_to_settings_table', 17),
(68, '2021_11_21_143624_add_shop_extra_field_to_settings_table', 19),
(69, '2021_11_20_105052_add_stock_to_attribute_options_table', 20),
(71, '2021_11_21_151422_add_home_page_title_to_settings_table', 21),
(72, '2021_11_23_141528_add_type_to_languages_table', 22),
(73, '2021_11_23_144810_add_privacy_terms_to_settings_table', 23),
(74, '2021_11_23_182026_add_guest_checkout_to_settings_table', 24),
(76, '2021_11_24_144859_add_guest_hero_banner_to_home_cutomizes_table', 25),
(77, '2021_11_26_163222_add_affiliate_link_to_items_table', 26),
(78, '2021_11_27_113624_add_css_field_to_settings_table', 27),
(79, '2021_12_05_161222_add_flash_section_to_extra_settings_table', 28),
(82, '2021_12_05_165840_add_popup_field_to_settings_table', 29),
(83, '2021_12_06_141255_add_3column_section_to_extra_settings_table', 30),
(84, '2022_01_03_141239_add_currency_seperator_to_settings_table', 31),
(85, '2022_01_04_142738_create_states_table', 32),
(86, '2022_01_04_145532_add_state_id_to_users_table', 33),
(88, '2022_01_04_161647_add_state_id_to_orders_table', 34),
(89, '2022_01_06_155345_add_disqus_to_settings_table', 35),
(90, '2022_01_16_143429_add_type_to_states_table', 36),
(91, '2022_01_16_153254_add_state_to_orders_table', 37),
(92, '2022_03_01_162121_add_is_decemial_to_settings_table', 38),
(93, '2022_03_20_154807_update_column_to_home_cutomizes_table', 39),
(94, '2026_07_06_181207_add_tier_prices_to_items_table', 40),
(95, '2026_07_07_051808_add_store_stats_to_settings_table', 41),
(96, '2026_07_07_104022_add_steadfast_columns_to_settings_and_orders', 42),
(97, '2026_07_07_112555_add_how_to_use_to_items_table', 43),
(98, '2026_07_09_061258_add_facebook_capi_columns_to_settings', 43),
(99, '2026_07_09_070336_sync_production_settings_cleanup', 43),
(100, '2026_07_09_074828_add_sms_url_to_settings_table', 43),
(101, '2026_07_09_184709_add_features_to_items_table', 44),
(102, '2026_07_19_055011_add_video_to_items_table', 45);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `order_id`, `user_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 133, NULL, 0, '2024-03-06 15:19:31', '2024-03-06 15:19:31'),
(2, 134, NULL, 0, '2024-03-06 15:24:49', '2024-03-06 15:24:49'),
(3, 135, NULL, 0, '2024-08-03 18:59:32', '2024-08-03 18:59:32'),
(4, 136, NULL, 0, '2024-08-18 21:38:50', '2024-08-18 21:38:50'),
(5, NULL, 11, 0, '2024-08-26 11:51:15', '2024-08-26 11:51:15'),
(6, 137, NULL, 0, '2024-08-26 11:52:59', '2024-08-26 11:52:59'),
(7, NULL, 12, 0, '2024-09-18 05:25:32', '2024-09-18 05:25:32'),
(8, NULL, 13, 0, '2024-11-06 16:42:29', '2024-11-06 16:42:29'),
(13, NULL, 1, 0, '2026-07-09 08:47:29', '2026-07-09 08:47:29'),
(15, NULL, 2, 0, '2026-07-12 07:15:48', '2026-07-12 07:15:48'),
(16, NULL, 3, 0, '2026-07-15 11:28:52', '2026-07-15 11:28:52'),
(18, NULL, 4, 0, '2026-07-23 01:56:59', '2026-07-23 01:56:59'),
(19, 7, NULL, 0, '2026-07-26 00:03:41', '2026-07-26 00:03:41'),
(20, NULL, 5, 0, '2026-07-26 09:26:25', '2026-07-26 09:26:25'),
(21, NULL, 6, 0, '2026-07-30 12:30:19', '2026-07-30 12:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart` text DEFAULT NULL,
  `currency_sign` varchar(255) DEFAULT NULL,
  `currency_value` varchar(255) DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `shipping` text DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `tax` double NOT NULL DEFAULT 0,
  `charge_id` varchar(255) DEFAULT NULL,
  `transaction_number` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `shipping_info` text DEFAULT NULL,
  `billing_info` text DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_price` double DEFAULT 0,
  `state` text DEFAULT NULL,
  `steadfast_consignment_id` varchar(255) DEFAULT NULL,
  `steadfast_tracking_code` varchar(255) DEFAULT NULL,
  `steadfast_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart`, `currency_sign`, `currency_value`, `discount`, `shipping`, `payment_method`, `txnid`, `tax`, `charge_id`, `transaction_number`, `order_status`, `shipping_info`, `billing_info`, `payment_status`, `created_at`, `updated_at`, `state_price`, `state`, `steadfast_consignment_id`, `steadfast_tracking_code`, `steadfast_status`) VALUES
(7, 0, '{\"28-\":{\"options_id\":[],\"attribute\":{\"names\":[],\"option_name\":[],\"option_price\":[]},\"attribute_price\":0,\"name\":\"PRP Tube (ACD + Gel + Biotin)-12ml\",\"slug\":\"PRP-Tube--ACD---Gel---Biotin--12ml\",\"qty\":\"4\",\"price\":2.9761904761905,\"main_price\":2.9761904761905,\"photo\":\"1784303558acd gel biotin 12ml.png\",\"type\":\"normal\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '৳', '84', '[]', 'null', 'Cash On Delivery', NULL, 0, NULL, 'uZPrXUquqQ', 'Pending', '{\"ship_first_name\":\"Mahmudul\",\"ship_last_name\":\"alam\",\"ship_email\":\"customer@gmail.com\",\"ship_phone\":\"01767185501\",\"ship_company\":null,\"ship_address1\":\"Kristopur sadar, Mymensingh\",\"ship_address2\":null,\"ship_zip\":null,\"ship_city\":\"Mymensingh\",\"ship_country\":\"Bangladesh\"}', '{\"_token\":\"iNV1pQtcQNSznEhWbFdg41hhPGcGqa8LeQrTtZro\",\"bill_first_name\":\"Mahmudul\",\"bill_last_name\":\"alam\",\"bill_email\":\"customer@gmail.com\",\"bill_phone\":\"01767185501\",\"bill_address1\":\"Kristopur sadar, Mymensingh\",\"bill_address2\":null,\"bill_zip\":null,\"bill_city\":\"Mymensingh\",\"bill_country\":\"Bangladesh\",\"same_ship_address\":\"on\"}', 'Unpaid', '2026-07-26 00:03:41', '2026-07-29 08:35:32', 0, NULL, '277241441', 'SFR260729STE3625ACBD', 'in_review');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_descriptions` text DEFAULT NULL,
  `pos` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_keywords`, `meta_descriptions`, `pos`, `created_at`, `updated_at`) VALUES
(7, 'About Us', 'about-us', '<div class=\"about-us-content\">\n    <p class=\"lead font-weight-normal text-muted mb-4\">Mac Scientific is a trusted supplier of regenerative medicine, aesthetic, and laboratory products, dedicated to supporting healthcare professionals with high-quality, reliable, and innovative medical solutions.</p>\n    \n    <p>We specialize in supplying premium PRP Tubes, PRF Tubes, GFC Tubes, Sodium Citrate Tubes, Microneedling products, and other regenerative medicine and aesthetic consumables. In addition, we offer a comprehensive range of laboratory equipment, consumables, and diagnostic supplies to meet the everyday needs of clinics, hospitals, diagnostic centers, and research laboratories.</p>\n    \n    <p>At Mac Scientific, we believe that quality products are the foundation of better patient care and clinical success. Every product we provide is carefully selected to ensure safety, consistency, and performance, enabling medical professionals to deliver the highest standards of treatment and diagnosis.</p>\n    \n    <p>Our commitment extends beyond supplying products. We focus on building long-term relationships with our customers through exceptional service, competitive pricing, timely delivery, and professional support. Whether serving a regenerative medicine clinic, an aesthetic practice, or a diagnostic laboratory, we strive to be a dependable partner in advancing healthcare.</p>\n    \n    <p>As the medical industry continues to evolve, Mac Scientific remains committed to innovation, integrity, and excellenceâ€”helping healthcare professionals achieve better outcomes and shaping the future of regenerative medicine, aesthetics, and laboratory diagnostics.</p>\n\n    <div class=\"row mt-5 mb-4\">\n        <div class=\"col-md-6 mb-4\">\n            <div class=\"card h-100 border-0 shadow-sm p-4 bg-light\">\n                <h3 class=\"h4 text-primary mb-3\"><i class=\"icon-target mr-2\"></i>Mission</h3>\n                <p class=\"mb-0\">At Mac Scientific, our mission is to empower healthcare professionals, regenerative medicine practitioners, aesthetic clinics, and diagnostic laboratories by providing high-quality, reliable, and innovative medical products. We are committed to delivering premium PRP, PRF, GFC, and aesthetic consumables, along with essential laboratory supplies, while ensuring exceptional customer service, competitive pricing, and long-term professional partnerships. Our goal is to support better clinical outcomes through trusted products and continuous innovation.</p>\n            </div>\n        </div>\n        <div class=\"col-md-6 mb-4\">\n            <div class=\"card h-100 border-0 shadow-sm p-4 bg-light\">\n                <h3 class=\"h4 text-primary mb-3\"><i class=\"icon-eye mr-2\"></i>Vision</h3>\n                <p class=\"mb-0\">Our vision is to become one of the most trusted and leading suppliers of regenerative medicine, aesthetic, and laboratory products in Bangladesh and beyond. We aspire to advance healthcare by making innovative medical technologies more accessible, supporting the growth of healthcare professionals, and contributing to safer, more effective patient care. Through integrity, quality, and continuous improvement, â€œmac scientificâ€ aims to be the preferred partner for clinics, hospitals, and laboratories across the region.</p>\n            </div>\n        </div>\n    </div>\n</div>', NULL, NULL, 2, NULL, NULL),
(10, 'Privacy Policy', 'privacy-policy', '<div class=\"privacy-policy-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p>Mac Scientific respects your privacy and is committed to protecting your personal information.</p>\n    \n    <p>We may collect information such as your name, phone number, email address, business name, shipping address, and order details when you contact us or place an order.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">How We Use Your Information</h3>\n    <p>Your information is used only to:</p>\n    <ul class=\"mb-4\">\n        <li>Process and deliver orders.</li>\n        <li>Provide customer support.</li>\n        <li>Respond to inquiries.</li>\n        <li>Improve our services.</li>\n        <li>Send order updates and promotional communications (where permitted).</li>\n    </ul>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Information Sharing &amp; Protection</h3>\n    <p>We do not sell or rent your personal information to third parties.</p>\n    <p>We implement reasonable administrative and technical measures to protect your information. However, no internet transmission or electronic storage method is completely secure.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Third-Party Links</h3>\n    <p>Our website may contain links to third-party websites. Mac Scientific is not responsible for their privacy practices or content.</p>\n    \n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Updates &amp; Contact</h3>\n    <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with the revised effective date.</p>\n    <p>If you have any questions regarding this Privacy Policy, please contact Mac Scientific using the contact information provided on our website.</p>\n</div>', NULL, NULL, 2, NULL, NULL),
(11, 'Terms & Service', 'terms-and-service', '<div class=\"terms-service-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">By placing an order through Mac Scientific, you agree to the following terms and conditions:</p>\n    \n    <ol class=\"pl-3 mb-4\">\n        <li class=\"mb-2\">Product availability is subject to stock.</li>\n        <li class=\"mb-2\">Prices may change without prior notice.</li>\n        <li class=\"mb-2\">Orders are confirmed only after acceptance by Mac Scientific.</li>\n        <li class=\"mb-2\">Customers are responsible for providing accurate shipping and billing information.</li>\n        <li class=\"mb-2\">Products should be inspected upon delivery. Any damage or incorrect shipment should be reported within 48 hours.</li>\n        <li class=\"mb-2\">Returns or replacements are accepted only for damaged, defective, or incorrectly supplied products, subject to our return policy.</li>\n        <li class=\"mb-2\">Products intended for professional medical use should be used only by qualified healthcare professionals and according to the manufacturerâ€™s instructions.</li>\n        <li class=\"mb-2\">Mac Scientific shall not be liable for improper use, misuse, or unauthorized modification of any product.</li>\n        <li class=\"mb-2\">We reserve the right to refuse or cancel any order when necessary.</li>\n        <li class=\"mb-2\">These Terms &amp; Conditions are governed by the laws of Bangladesh.</li>\n    </ol>\n</div>', NULL, NULL, 2, NULL, NULL),
(12, 'Return Policy', 'return-policy', '<div class=\"return-policy-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">At Mac Scientific, customer satisfaction is important to us. We are committed to supplying high-quality regenerative medicine, aesthetic, and laboratory products. Please review our Return &amp; Refund Policy before placing an order.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">1. Eligibility for Returns</h3>\n    <p>Returns may be accepted only under the following circumstances:</p>\n    <ul class=\"mb-3\">\n        <li>The product received is damaged during delivery.</li>\n        <li>The product delivered is incorrect or does not match the confirmed order.</li>\n        <li>The product has a manufacturing defect.</li>\n        <li>The product is received with broken or tampered packaging.</li>\n    </ul>\n    <p class=\"font-weight-bold text-dark mb-4\">To be eligible for a return, you must notify us within 48 hours of receiving the product.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">2. Non-Returnable Items</h3>\n    <p>For safety, hygiene, and quality assurance reasons, the following items cannot be returned or exchanged unless they are defective or supplied incorrectly:</p>\n    <ul class=\"mb-4\">\n        <li>Opened or used medical products.</li>\n        <li>Sterile products with broken seals or opened packaging.</li>\n        <li>Products damaged due to misuse, improper storage, or mishandling.</li>\n        <li>Clearance, promotional, or special-order items (unless defective).</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">3. Return Conditions</h3>\n    <p>To process a return, the product must:</p>\n    <ul class=\"mb-4\">\n        <li>Be unused and in its original condition.</li>\n        <li>Be returned with its original packaging and accessories (if applicable).</li>\n        <li>Include proof of purchase, such as an invoice or order confirmation.</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">4. Refund Policy</h3>\n    <p>Once the returned product has been received and inspected, Mac Scientific will notify you of the outcome.</p>\n    <p>If your return is approved, we may:</p>\n    <ul class=\"mb-3\">\n        <li>Issue a full refund.</li>\n        <li>Replace the product with the same item.</li>\n        <li>Provide store credit, where applicable.</li>\n    </ul>\n    <p class=\"mb-4\">Refunds will be processed using the original payment method whenever possible. Processing times may vary depending on the payment provider.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">5. Shipping Charges</h3>\n    <ul class=\"mb-4\">\n        <li>If the return is due to our error (wrong item, damaged product, or manufacturing defect), Mac Scientific will bear the applicable return shipping costs.</li>\n        <li>If the return is requested for reasons other than our error and is accepted at our discretion, the customer may be responsible for shipping charges.</li>\n    </ul>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">6. Order Cancellation</h3>\n    <p class=\"mb-4\">Orders may be cancelled before shipment. Once an order has been dispatched, it cannot be cancelled and will be subject to this Return &amp; Refund Policy.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-2\">7. Contact Us</h3>\n    <p class=\"mb-4\">For return or refund requests, please contact our customer support team with your order details and photographs (if applicable) before sending any product back.</p>\n\n    <div class=\"alert alert-info mt-4\">\n        <p class=\"mb-0\">Thank you for choosing Mac Scientific. We appreciate your trust and remain committed to providing reliable products and professional customer service.</p>\n    </div>\n</div>', NULL, NULL, 2, NULL, NULL),
(14, 'Legal Notice', 'legal-notice', '<div class=\"legal-notice-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">Welcome to Mac Scientific. By accessing and using this website, you agree to comply with the terms outlined in this Legal Notice.</p>\n\n    <p>Mac Scientific is a supplier of regenerative medicine, aesthetic, and laboratory products. All information provided on this website is intended for general informational and commercial purposes only.</p>\n\n    <p>The products displayed on this website are intended for use by qualified healthcare professionals, licensed medical practitioners, clinics, hospitals, diagnostic laboratories, or authorized distributors, where applicable.</p>\n\n    <p class=\"font-weight-bold text-dark\">Mac Scientific does not provide medical advice, diagnosis, or treatment. Any clinical decisions regarding the use of our products remain the sole responsibility of the healthcare professional.</p>\n\n    <p>While we strive to ensure the accuracy of all product information, specifications, and pricing, Mac Scientific reserves the right to modify product details, availability, and prices without prior notice.</p>\n\n    <p>All trademarks, logos, product images, text, and website content are the property of Mac Scientific or their respective owners and may not be reproduced without written permission.</p>\n\n    <p class=\"mb-0\">Any disputes arising from the use of this website shall be governed by the applicable laws of the People\'s Republic of Bangladesh.</p>\n</div>', '[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]', NULL, 2, NULL, NULL),
(15, 'Medical Disclaimer', 'medical-disclaimer', '<div class=\"medical-disclaimer-content\">\n    <p class=\"text-muted mb-4\"><strong>Effective Date:</strong> June 30, 2026</p>\n    \n    <p class=\"lead font-weight-normal text-muted mb-4\">The information provided on the Mac Scientific website is intended for general informational and commercial purposes only. It is not intended to replace professional medical advice, diagnosis, or treatment.</p>\n\n    <p>Mac Scientific is a supplier of regenerative medicine, aesthetic, and laboratory products. We do not practice medicine, provide medical consultations, or recommend specific treatments.</p>\n\n    <p>Many of our productsâ€”including PRP Tubes, PRF Tubes, GFC Tubes, Sodium Citrate Tubes, microneedling products, and other medical consumablesâ€”are intended for use by qualified healthcare professionals, licensed medical practitioners, hospitals, clinics, diagnostic laboratories, and trained personnel only.</p>\n\n    <p>Customers are solely responsible for ensuring that products are used in accordance with applicable laws, local regulations, manufacturer instructions, and accepted clinical protocols.</p>\n\n    <p>Mac Scientific does not guarantee specific clinical outcomes or treatment results. Individual patient outcomes may vary depending on medical conditions, practitioner expertise, treatment protocols, and other factors beyond our control.</p>\n\n    <p>Product images, descriptions, specifications, and pricing are provided for reference purposes only and may be updated or changed without prior notice.</p>\n\n    <h3 class=\"h5 font-weight-bold mt-4 mb-3\">Professional Acknowledgement &amp; Agreement</h3>\n    <p>By purchasing or using products supplied by Mac Scientific, you acknowledge and agree that:</p>\n    <ul class=\"mb-4\">\n        <li class=\"mb-2\">You are responsible for determining whether a product is appropriate for your intended professional use.</li>\n        <li class=\"mb-2\">Products must be used only by qualified healthcare professionals where applicable.</li>\n        <li class=\"mb-2\">Mac Scientific shall not be liable for any injury, loss, damage, or adverse outcome resulting from improper use, misuse, unauthorized modification, or failure to follow manufacturer instructions.</li>\n        <li class=\"mb-2\">The information on this website should never be interpreted as medical advice or a substitute for consultation with a licensed healthcare professional.</li>\n    </ul>\n\n    <p>If you have questions regarding product specifications, compatibility, or intended use, please contact Mac Scientific before placing your order.</p>\n\n    <div class=\"alert alert-info mt-4\">\n        <p class=\"mb-0\">Thank you for choosing Mac Scientific as your trusted partner in regenerative medicine, aesthetic solutions, and laboratory supplies.</p>\n    </div>\n</div>', NULL, NULL, 2, '2026-07-06 07:24:28', '2026-07-06 07:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `information` text DEFAULT NULL,
  `unique_keyword` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `name`, `information`, `unique_keyword`, `photo`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', NULL, 'cod', '1631032407index.png', 'Cash on Delivery basically means you will pay the amount of product while you get the item delivered to you.', 1, NULL, NULL),
(14, 'Stripe', '{\"key\":\"pk_test_51HZI80H3jdWvr8gEn3oRtFlnJTqRpecXGQueOyngEArTyF6gjjfOVqbFeFMpAMRoQmKwPPrh81OiWzhDlqtS5nGs00gKycg4Oa\",\"secret\":\"sk_test_51HZI80H3jdWvr8gErqdNWpqUkAgHMQdw7uug1mfUY38vIUfodsAWj4hoBK43rBvHebYETVX4ZCne03o3Ifco1qkR00dhrdpPsh\"}', 'stripe', '1601930611stripe-logo-blue.png', 'Stripe is the faster & safer way to send money. Make an online payment via Stripe.', 0, NULL, NULL),
(15, 'Paypal', '{\"client_id\":\"AUtv8KISHG9l9rmlXB0cSLjt6A91IsGfPACeRreuRpEV3GR-ZRnxIxXnUVKNYIfqVXrxs2uPlGDot0Cc\",\"client_secret\":\"EEdtOBI_NjI2bJzLSIzumsN_xSI7htn8qyAcRz0mvO8Emv-7CdfQeqxNZlDhiDAd0ZhV49e4sOhjtwho\",\"check_sandbox\":1}', 'paypal', '16218678201601930675paypal-784404_960_720.png', 'PayPal is the faster & safer way to send money. Make an online payment via PayPal.', 0, NULL, NULL),
(17, 'Mollie', '{\"key\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\"}', 'mollie', '1621785282Mollie.jpeg', 'Mollie is a Payment Provider for Belgium and the Netherlands, offering payment methods such as credit card, iDEAL, Bancontact/Mister cash, PayPal, SCT, SDD and others.', 0, NULL, NULL),
(18, 'Paytm', '{\"mercent\":\"tkogux49985047638244\",\"client_secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"is_paytm\":\"1\",\"paytm_mode\":\"sandbox\"}', 'paytm', '1631978815images.png', 'Paytm is the faster & safer way to send money. Make an online payment via Paytm.', 0, NULL, NULL),
(19, 'SSLCommerz', '{\"store_id\":\"\",\"store_password\":\"\",\"check_sandbox\":0}', 'sslcommerz', '1631978716ssl-thumb.jpeg', 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.', 0, NULL, NULL),
(24, 'Mercadopago', '{\"public_key\":\"TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8\",\"token\":\"TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482\",\"check_sandbox\":1}', 'mercadopago', '1633085560unnamed.jpeg', 'Mercadopago is the faster & safer way to send money. Make an online payment via Mercadopago.', 0, NULL, NULL),
(25, 'Authorize.Net', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"check_sandbox\":1}', 'authorize', '1633100640seal2.png', 'Authorize.Net is the faster & safer way to send money. Make an online payment via Authorize.Net', 0, NULL, NULL),
(26, 'Paystack', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"geniusdevs@gmail.com\"}', 'paystack', '1634237632paystack-opengraph.png', 'Paystack is the faster & safer way to send money. Make an online payment via Paystack.', 0, NULL, NULL),
(27, 'Bank Transfer', NULL, 'bank', '1638530860pngwing.com (1).png', '', 0, NULL, NULL),
(28, 'Razorpay', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\"}', 'razorpay', '1637992878download.jpeg', 'Rezorpay is the faster & safer way to send money. Make an online payment via Rezorpay.', 0, NULL, NULL),
(29, 'Flutter Wave', '{\"public_key\":\"FLWPUBK_TEST-d54c4c69ef195e721af2139e7dfe1a23-X\",\"secret_key\":\"FLWSECK_TEST-86c6484143e62c4c9bc2e8aa08a07c92-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '1637998096download.png', 'Flutterwave is the faster & safer way to send money. Make an online payment via Flutterwave.', 0, NULL, NULL),
(30, 'bKash', NULL, 'bkash', 'payments/bkash_logo.jpg', 'Please pay using bKash', 1, NULL, NULL),
(31, 'Nagad', NULL, 'nagad', 'payments/nagad_logo.png', 'Please pay using Nagad', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_descriptions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `details`, `photo`, `category_id`, `tags`, `meta_keywords`, `meta_descriptions`, `created_at`, `updated_at`) VALUES
(69, 'What Is PRP and How Does It Work? A Complete Guide to Platelet-Rich Plasma', 'what-is-prp-and-how-does-it-work-a-complete-guide-to-platelet-rich-plasma', '<h1>What Is PRP and How Does It Work? A Complete Guide to Platelet-Rich Plasma</h1><h1 style=\"color: rgb(51, 51, 51);\"><p><img src=\"/assets/images/dkJD1785938696.webp\" style=\"width: 1479px;\"><br></p><p>Platelet-rich plasma, commonly known as <strong>PRP</strong>, is a concentrated preparation made from a person’s own blood. It contains a higher concentration of platelets than is normally found in circulating blood.</p><p>Platelets are best known for helping the blood clot after an injury. However, they also contain biologically active proteins, signaling molecules, cytokines, and growth factors involved in inflammation, tissue repair, blood-vessel formation, and wound healing. PRP therapy is designed to concentrate these components and apply them to a targeted area under the direction of a qualified healthcare professional.</p><p>PRP has been investigated and used in several areas of medicine, including:</p><ul><li><p>Orthopedics and sports medicine</p></li><li><p>Hair-loss management</p></li><li><p>Dermatology and aesthetic medicine</p></li><li><p>Dentistry and oral surgery</p></li><li><p>Wound management</p></li><li><p>Reconstructive procedures</p></li><li><p>Other regenerative-medicine applications</p></li></ul><p>However, PRP is not a guaranteed cure. Its effectiveness varies according to the medical condition, patient, preparation system, platelet concentration, presence of white blood cells, injection technique, and treatment protocol. Research remains stronger for some applications than for others.</p><hr></h1><h2>What Does PRP Mean?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP stands for <strong>Platelet-Rich Plasma</strong>.</p><p>To understand PRP, it helps to understand the main components of blood:</p></h1><h3>Red blood cells</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Red blood cells carry oxygen from the lungs to the tissues and return carbon dioxide to the lungs.</p></h1><h3>White blood cells</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>White blood cells are involved in immune responses and protection against infection.</p></h1><h3>Platelets</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Platelets are small, nucleus-free cell fragments produced from megakaryocytes, mainly in the bone marrow. They participate in clot formation, but they also contribute to inflammation, immune signaling, blood-vessel responses, and tissue repair.</p></h1><h3>Plasma</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Plasma is the liquid portion of blood. It carries cells, proteins, nutrients, hormones, electrolytes, and other substances throughout the body.</p><p>PRP is the portion of plasma prepared to contain a platelet concentration above the person’s baseline blood level. There is no single universal composition for every PRP product, which is one reason study results and clinical outcomes may vary.</p><hr></h1><h2>How Does PRP Work?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP is intended to support the body’s natural healing response by delivering a concentrated mixture of platelets and other plasma components to a targeted location.</p><p>The process can be understood in several stages.</p></h1><h3>1. Platelet concentration</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>A small quantity of blood is collected from the patient into a suitable sterile collection system. The blood is then processed, usually by centrifugation, to separate its components according to their density.</p><p>The goal is to produce a plasma fraction containing a higher platelet concentration while controlling the quantities of red blood cells and white blood cells.</p></h1><h3>2. Platelet activation</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Platelets may become activated when they contact damaged tissue, collagen, thrombin, calcium, or other activating signals.</p><p>Following activation, platelets change shape and release substances stored inside their granules.</p></h1><h3>3. Growth-factor and cytokine release</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Activated platelets release a range of biologically active molecules. Frequently discussed examples include:</p><ul><li><p>Platelet-derived growth factor, or PDGF</p></li><li><p>Transforming growth factor beta, or TGF-β</p></li><li><p>Vascular endothelial growth factor, or VEGF</p></li><li><p>Epidermal growth factor, or EGF</p></li><li><p>Insulin-like growth factor, or IGF</p></li><li><p>Fibroblast growth factor, or FGF</p></li></ul><p>These molecules may influence cell migration, cell proliferation, extracellular-matrix production, collagen activity, blood-vessel formation, inflammatory signaling, and tissue remodeling. Their effects are complex and depend on the tissue environment, dose, timing, and other components within the PRP preparation.</p></h1><h3>4. Formation of a temporary biological environment</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Plasma contains proteins such as fibrinogen, fibronectin, and other molecules that may help create a temporary matrix or scaffold around the treated area.</p><p>This environment can support cell attachment, communication, and tissue remodeling. It should not be interpreted as creating entirely new tissue by itself; rather, PRP is intended to influence the local biological healing environment.</p></h1><h3>5. Modulation of inflammation and repair</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Inflammation is part of normal healing. PRP may influence inflammatory pathways rather than simply “switching inflammation off.”</p><p>The effect can vary according to the concentration of platelets, leukocytes and other components. For example, leukocyte-rich and leukocyte-poor PRP may behave differently in different tissues.</p><p>This is one reason why the type of PRP and the clinical indication should be selected by an appropriately trained medical professional.</p><hr></h1><h2>How Is PRP Prepared?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Although individual devices and clinical protocols differ, PRP preparation generally follows these steps.</p></h1><h3>Step 1: Patient assessment</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Before treatment, a qualified medical professional evaluates the patient’s condition, medical history, medications, blood-related risks, treatment objectives, and suitability for PRP.</p></h1><h3>Step 2: Blood collection</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>A measured volume of the patient’s own blood is collected using an appropriate sterile blood-collection system.</p><p>Depending on the preparation system, the collection tube may contain an anticoagulant to reduce premature clotting during processing.</p></h1><h3>Step 3: Centrifugation</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>The tube is placed in a compatible centrifuge and processed according to the validated instructions for the specific device, tube, rotor, sample volume, and intended PRP formulation.</p><p>Centrifugation separates blood components according to their physical properties. After processing, the sample may contain identifiable red-cell, plasma, platelet, white-cell, or separation-barrier fractions, depending on the system used.</p><p>There is no single centrifugation speed and time that is correct for every PRP tube or centrifuge. RPM alone is not sufficient for comparing protocols because the actual centrifugal force also depends on rotor radius. Healthcare professionals should follow the manufacturer’s validated instructions rather than applying an unverified universal setting.</p></h1><h3>Step 4: PRP collection</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>The platelet-containing plasma fraction is collected using an aseptic technique while minimizing contamination from unwanted layers.</p><p>The final volume and composition depend on the collection system and protocol.</p></h1><h3>Step 5: Application</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>The prepared PRP may be applied or injected into a targeted area by a qualified healthcare professional. Ultrasound guidance may be used for certain musculoskeletal injections to improve placement accuracy.</p><p>PRP preparation and administration should be performed only with suitable equipment, infection-control procedures, trained personnel, and patient-specific clinical judgment.</p><hr></h1><h2>What Is Inside PRP?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP is not composed of platelets alone. Depending on the preparation method, it may contain different amounts of:</p><ul><li><p>Platelets</p></li><li><p>Plasma</p></li><li><p>White blood cells</p></li><li><p>Red blood-cell contamination</p></li><li><p>Fibrinogen and other plasma proteins</p></li><li><p>Cytokines</p></li><li><p>Chemokines</p></li><li><p>Growth factors</p></li><li><p>Extracellular vesicles</p></li><li><p>Adhesion proteins and signaling molecules</p></li></ul><p>PRP composition can therefore differ considerably between products and preparation systems. Modern research increasingly emphasizes the importance of reporting the final PRP composition rather than describing every preparation simply as “PRP.”</p><hr></h1><h2>Different Types of PRP</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP may be classified according to its platelet, leukocyte, red-cell, and fibrin content.</p></h1><h3>Leukocyte-rich PRP</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Leukocyte-rich PRP contains a comparatively higher concentration of white blood cells.</p><p>It may produce different inflammatory and antimicrobial responses, but it may not be ideal for every tissue or condition.</p></h1><h3>Leukocyte-poor PRP</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Leukocyte-poor PRP contains fewer white blood cells. It is sometimes selected when limiting a strong inflammatory response is considered desirable.</p></h1><h3>Platelet-rich fibrin</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Platelet-rich fibrin, or PRF, is related to PRP but is not identical. PRF preparation generally creates a fibrin-rich matrix that may retain platelets and signaling molecules.</p></h1><h3>Activated and non-activated PRP</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Some protocols apply PRP without deliberate activation, allowing contact with tissue to initiate activation. Other protocols use an activating agent based on the clinical purpose and preparation system.</p><p>No single PRP type is universally best. Selection should depend on the medical indication, current evidence, product instructions, and professional judgment.</p><hr></h1><h2>What Are the Potential Applications of PRP?</h2><h3>PRP for hair loss</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP is commonly investigated as an adjunctive treatment for certain forms of hair loss, particularly androgenetic alopecia.</p><p>The proposed mechanisms include effects on follicular cells, local blood-vessel signaling, growth-factor activity, and the hair-growth cycle. Some studies report improvements in hair density or thickness, but outcomes vary, and standardized treatment protocols are still developing. PRP should not be presented as a permanent or guaranteed cure for hair loss.</p><p>A proper diagnosis remains essential because hair loss can be associated with:</p><ul><li><p>Genetic factors</p></li><li><p>Hormonal conditions</p></li><li><p>Nutritional deficiency</p></li><li><p>Thyroid disorders</p></li><li><p>Autoimmune disease</p></li><li><p>Scalp disease</p></li><li><p>Medication</p></li><li><p>Stress or recent illness</p></li></ul><p>PRP may not address the underlying cause in every patient.</p></h1><h3>PRP for skin rejuvenation</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>In aesthetic medicine, PRP has been investigated for facial rejuvenation, skin texture, fine lines, acne scars, wound healing, and support following selected procedures.</p><p>Proposed effects include fibroblast activity, collagen-related signaling, extracellular-matrix remodeling, and vascular responses. Although studies report promising findings, treatment methods and outcome measures remain inconsistent.</p><p>PRP should not be advertised as producing permanent rejuvenation, instant regeneration, or guaranteed collagen formation.</p></h1><h3>PRP for joints and tendons</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP has been studied for conditions such as:</p><ul><li><p>Knee osteoarthritis</p></li><li><p>Tennis elbow</p></li><li><p>Tendinopathy</p></li><li><p>Plantar fasciitis</p></li><li><p>Selected ligament injuries</p></li><li><p>Selected muscle injuries</p></li><li><p>Some sports-related injuries</p></li></ul><p>Evidence differs significantly by condition. Some patients may experience improvement in pain or function, but study quality, preparation methods, treatment schedules, and follow-up periods vary.</p><p>Even where evidence appears promising, PRP is usually one element of a broader treatment plan that may include rehabilitation, exercise, weight management, activity modification, medication, or surgery.</p></h1><h3>PRP for wound healing</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Because platelets participate in clotting and tissue repair, PRP has also been investigated for difficult wounds and selected surgical applications.</p><p>The results depend on the wound type, blood supply, infection status, metabolic health, treatment method, and overall patient condition. It should not replace necessary infection management, vascular assessment, diabetic control, debridement, or standard wound care.</p></h1><h3>PRP in dentistry</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP and related platelet concentrates may be used or investigated in:</p><ul><li><p>Oral surgery</p></li><li><p>Periodontal procedures</p></li><li><p>Bone-grafting procedures</p></li><li><p>Implant-related procedures</p></li><li><p>Soft-tissue healing</p></li></ul><p>The exact product, preparation method, and application should be selected according to the procedure and available clinical evidence.</p><hr></h1><h2>What Are the Possible Benefits of PRP?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Potential advantages may include:</p></h1><h3>It is autologous</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Most clinical PRP is prepared from the patient’s own blood. This can reduce certain risks associated with donor-derived biological materials, although it does not eliminate risks related to collection, processing, contamination, injection, or inappropriate patient selection.</p></h1><h3>It delivers concentrated platelets locally</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP allows a platelet-containing preparation to be placed at a selected treatment site.</p></h1><h3>It may support natural repair pathways</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP uses components involved in normal clotting, signaling, and tissue-repair processes.</p></h1><h3>It can be performed as an outpatient procedure</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Many PRP procedures do not require hospital admission, although the setting depends on the application and the patient’s medical condition.</p></h1><h3>Recovery may be relatively short</h3><h1 style=\"color: rgb(51, 51, 51);\"><p>Some people return to normal activity quickly. However, pain, swelling, activity restrictions, and recovery time vary according to the treatment area and procedure.</p><hr></h1><h2>Is PRP Safe?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP is often described as a treatment made from the patient’s own blood, but “autologous” does not mean completely risk-free.</p><p>Possible side effects or complications can include:</p><ul><li><p>Pain during or after blood collection</p></li><li><p>Pain at the treatment site</p></li><li><p>Temporary swelling</p></li><li><p>Bruising</p></li><li><p>Bleeding</p></li><li><p>Redness</p></li><li><p>Local inflammation</p></li><li><p>Dizziness or fainting during blood collection</p></li><li><p>Infection</p></li><li><p>Injury to nearby nerves, blood vessels, or other structures</p></li><li><p>Temporary worsening of symptoms</p></li><li><p>Failure to achieve the expected result</p></li><li><p>Reactions to local anesthetics, activating agents, antiseptics, or other materials used during the procedure</p></li></ul><p>Risks depend on the treatment site, procedure, equipment, sterility, practitioner experience, and patient’s medical condition. Additional risks may apply when PRP is combined with microneedling, surgery, medication, fillers, grafting materials, or other procedures.</p><hr></h1><h2>Who May Not Be a Suitable Candidate for PRP?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Suitability must be determined by a qualified healthcare professional. Additional evaluation or postponement may be required for people with conditions such as:</p><ul><li><p>Active infection</p></li><li><p>Infection at the intended treatment site</p></li><li><p>Significant platelet abnormality</p></li><li><p>Severe anemia</p></li><li><p>Certain bleeding or clotting disorders</p></li><li><p>Uncontrolled systemic illness</p></li><li><p>Some cancers or active cancer treatment</p></li><li><p>Unstable cardiovascular disease</p></li><li><p>Pregnancy, depending on the indication</p></li><li><p>Use of anticoagulant or antiplatelet medication</p></li><li><p>Known allergy to another substance planned for use during the procedure</p></li></ul><p>Patients should not stop aspirin, anticoagulants, anti-inflammatory medicines, or other prescribed treatments without consulting the clinician who prescribed them.</p><hr></h1><h2>Does PRP Work Immediately?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP does not usually produce an instant biological result.</p><p>Following treatment, local signaling and tissue remodeling may develop over several weeks or months. The response depends on:</p><ul><li><p>The condition being treated</p></li><li><p>Duration and severity of the condition</p></li><li><p>Patient age and general health</p></li><li><p>Platelet number and function</p></li><li><p>PRP composition</p></li><li><p>Treatment technique</p></li><li><p>Number and spacing of treatment sessions</p></li><li><p>Rehabilitation and aftercare</p></li><li><p>Other medical treatments</p></li></ul><p>For some applications, several sessions may be recommended. Maintenance procedures may also be considered, particularly for chronic or progressive conditions. Results are not necessarily permanent.</p><hr></h1><h2>How Many PRP Sessions Are Needed?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>There is no universal treatment schedule.</p><p>A healthcare professional may recommend one or more sessions depending on the diagnosis, treatment area, evidence, response to previous treatment, and product protocol.</p><p>Websites should avoid statements such as “three sessions are required for everyone.” A more accurate statement is:</p><blockquote><p>The recommended number of PRP sessions varies according to the condition, patient, preparation method, and clinical response.</p></blockquote><hr></h1><h2>What Factors Affect PRP Quality?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP quality cannot be judged only by the color of the plasma or the stated tube volume.</p><p>Important factors include:</p><ul><li><p>Patient’s baseline platelet count</p></li><li><p>Platelet recovery</p></li><li><p>Final platelet concentration</p></li><li><p>Final PRP volume</p></li><li><p>Red blood-cell contamination</p></li><li><p>Leukocyte concentration</p></li><li><p>Platelet activation during processing</p></li><li><p>Sterility</p></li><li><p>Anticoagulant type and ratio</p></li><li><p>Time between collection and application</p></li><li><p>Centrifugal force and processing time</p></li><li><p>Rotor radius and centrifuge characteristics</p></li><li><p>Tube and separation-system design</p></li><li><p>Handling and collection technique</p></li><li><p>Storage conditions, where applicable</p></li><li><p>Compliance with the manufacturer’s instructions</p></li></ul><p>PRP-preparation methods remain highly variable, and better standardization and reporting are recurring priorities in clinical research.</p><hr></h1><h2>RPM Versus RCF in PRP Preparation</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>RPM means <strong>revolutions per minute</strong>. It describes how quickly the centrifuge rotor turns.</p><p>RCF means <strong>relative centrifugal force</strong> and is usually expressed as a multiple of gravity, such as ×g.</p><p>Two centrifuges operating at the same RPM can generate different RCF values when their rotor radii are different. Therefore, copying an RPM setting from another machine may not reproduce the same separation result.</p><p>PRP preparation should follow the validated parameters for the exact:</p><ul><li><p>PRP tube</p></li><li><p>Anticoagulant system</p></li><li><p>Sample volume</p></li><li><p>Centrifuge model</p></li><li><p>Rotor type</p></li><li><p>Rotor radius</p></li><li><p>Intended final product</p></li></ul><p>This is why universal online claims such as “all PRP must be centrifuged at one fixed RPM and time” can be misleading.</p><hr></h1><h2>Is a Higher Platelet Concentration Always Better?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Not necessarily.</p><p>A preparation must contain enough functional platelets to achieve its intended biological purpose, but an extremely high concentration does not automatically produce a better clinical result.</p><p>Clinical response may depend on the interaction among:</p><ul><li><p>Platelet concentration</p></li><li><p>Platelet activation</p></li><li><p>Leukocytes</p></li><li><p>Plasma proteins</p></li><li><p>Fibrin</p></li><li><p>Red-cell contamination</p></li><li><p>Treatment volume</p></li><li><p>Tissue type</p></li><li><p>Patient factors</p></li></ul><p>The ideal composition may differ between scalp, skin, tendon, cartilage, bone, and wound applications.</p><hr></h1><h2>PRP Versus Stem-Cell Therapy</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP and stem-cell treatments are not the same.</p><p>PRP is primarily a platelet-containing plasma preparation derived from blood. It contains platelets and signaling molecules but should not be described as a stem-cell product.</p><p>Stem-cell or cell-based therapies involve different types of cells, collection methods, processing requirements, biological mechanisms, risks, and regulatory considerations.</p><p>Claims that PRP “creates stem cells” or is automatically equivalent to stem-cell therapy are scientifically inaccurate.</p><hr></h1><h2>PRP Versus PRF</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP and PRF are related blood-derived preparations, but they have important differences.</p></h1><h3>PRP</h3><h1 style=\"color: rgb(51, 51, 51);\"><ul><li><p>Usually contains a liquid plasma fraction enriched with platelets</p></li><li><p>Often uses an anticoagulant during collection</p></li><li><p>May remain liquid until activated or applied</p></li><li><p>Composition depends on the preparation system</p></li></ul></h1><h3>PRF</h3><h1 style=\"color: rgb(51, 51, 51);\"><ul><li><p>Usually forms a fibrin-rich matrix or clot</p></li><li><p>Often uses a different preparation approach</p></li><li><p>Can retain platelets and other cellular or signaling components within the fibrin network</p></li><li><p>May release biological molecules differently over time</p></li></ul><p>The correct option depends on the clinical application and professional judgment.</p><hr></h1><h2>What Should Patients Ask Before PRP Treatment?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Patients may consider asking:</p><ol><li><p>What is my exact diagnosis?</p></li><li><p>What evidence supports PRP for my condition?</p></li><li><p>What realistic improvement can I expect?</p></li><li><p>What alternatives are available?</p></li><li><p>How many sessions may be required?</p></li><li><p>What are the total costs?</p></li><li><p>What are the risks for my individual condition?</p></li><li><p>Who will prepare and administer the PRP?</p></li><li><p>Is the preparation system sterile and appropriate for its intended use?</p></li><li><p>Will imaging guidance be used where necessary?</p></li><li><p>What should I do before and after treatment?</p></li><li><p>How will treatment results be measured?</p></li></ol><p>A responsible clinic should explain both the potential benefits and the uncertainty.</p><hr></h1><h2>Important Limitations of PRP Research</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP research can be difficult to interpret because different studies may use:</p><ul><li><p>Different collection tubes</p></li><li><p>Different centrifugation systems</p></li><li><p>Different platelet concentrations</p></li><li><p>Different leukocyte levels</p></li><li><p>Different activation methods</p></li><li><p>Different injection volumes</p></li><li><p>Different treatment schedules</p></li><li><p>Different outcome measurements</p></li><li><p>Different follow-up periods</p></li><li><p>Different patient populations</p></li></ul><p>A positive result from one PRP formulation cannot automatically be applied to every PRP product or every medical condition.</p><p>Recent reviews continue to call for better standardization, improved quality control, clearer reporting, and larger high-quality clinical trials.</p><hr></h1><h1>Frequently Asked Questions About PRP</h1><h2>Is PRP made from the patient’s own blood?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Most clinical PRP is autologous, meaning it is prepared from the same patient who will receive it.</p></h1><h2>Is PRP a medicine?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP is a blood-derived biological preparation rather than a conventional pharmaceutical drug. Its regulatory status and permitted uses can differ according to the country, device, processing method, and clinical application.</p></h1><h2>Is PRP the same as plasma?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>No. Ordinary plasma is the liquid portion of blood. PRP is a processed plasma fraction intended to contain an increased concentration of platelets.</p></h1><h2>Is yellow plasma always PRP?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>No. Appearance alone cannot confirm platelet concentration, purity, sterility, leukocyte level, or clinical quality. Laboratory measurement and validated processing are more reliable than color alone.</p></h1><h2>Can PRP regrow all lost hair?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>No. PRP may help selected patients with certain types of hair loss, but it does not guarantee complete hair regrowth. Patients with permanently destroyed or scarred follicles may respond differently.</p></h1><h2>Can PRP permanently remove wrinkles?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>No. PRP may support skin-remodeling processes, but it should not be advertised as permanently eliminating wrinkles or reversing aging.</p></h1><h2>Can PRP rebuild damaged cartilage?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP may improve symptoms in some patients with selected joint conditions, but evidence does not support promising that it will completely regrow or permanently rebuild severely damaged cartilage.</p></h1><h2>Can PRP be prepared in any ordinary tube?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>PRP should be prepared only with an appropriate sterile collection and processing system designed or validated for the intended purpose. Ordinary laboratory tubes may not provide suitable anticoagulation, separation, sterility, biocompatibility, or clinical safety.</p></h1><h2>Can one centrifuge setting be used for every PRP tube?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>No. Processing conditions should match the tube, centrifuge, rotor, sample volume, and manufacturer’s validated instructions.</p></h1><h2>Is PRP treatment painful?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Patients may experience discomfort during blood collection and application. Pain varies according to the treatment location, needle technique, and use of local anesthesia.</p></h1><h2>How long do PRP results last?</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>The duration varies according to the condition, patient, and treatment plan. PRP results are not necessarily permanent, and additional treatment may be considered.</p><hr></h1><h2>Conclusion</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>Platelet-rich plasma is an autologous blood-derived preparation containing concentrated platelets and a range of biologically active molecules.</p><p>After activation, platelets release growth factors, cytokines, and other signals that may influence inflammation, blood-vessel formation, cell activity, extracellular-matrix production, and tissue remodeling.</p><p>PRP has promising applications in hair restoration, dermatology, orthopedics, dentistry, wound care, and other areas. However, it is not a universal cure, and results vary substantially.</p><p>Safe and responsible PRP practice requires:</p><ul><li><p>A correct diagnosis</p></li><li><p>Appropriate patient selection</p></li><li><p>A sterile and suitable preparation system</p></li><li><p>Validated processing instructions</p></li><li><p>Trained medical professionals</p></li><li><p>Realistic communication</p></li><li><p>Proper consent and follow-up</p></li><li><p>Evidence-based clinical judgment</p></li></ul><p>Patients should consult a qualified healthcare professional to determine whether PRP is appropriate for their particular condition.</p><hr></h1><h2>Medical Disclaimer</h2><h1 style=\"color: rgb(51, 51, 51);\"><p>This article is provided for general educational and professional-information purposes only. It does not provide medical advice, diagnosis, treatment instructions, or a substitute for consultation with a qualified healthcare professional.</p><p>PRP collection, processing, injection, and clinical application must be performed by appropriately trained and authorized medical professionals using suitable sterile equipment and patient-specific clinical judgment.</p><p>Product availability, device classification, approved indications, and regulatory requirements may vary by jurisdiction.</p><hr></h1><h2>About MAC Scientific</h2><h1 style=\"color: rgb(51, 51, 51);\"><p><strong>MAC Scientific</strong> supplies PRP-related tubes, laboratory consumables, centrifuge solutions, and selected aesthetic and regenerative-medicine products for professional use in Bangladesh.</p><p><strong>Website:</strong> ms-bd.com<br><strong>Phone and WhatsApp:</strong> 01312-699221<br><strong>Email:</strong> <a href=\"mailto:macscientificbd@gmail.com\">macscientificbd@gmail.com</a><br><strong>Address:</strong> 59, 2nd Floor, Rajanigandha Super Market, Kachukhet, Dhaka Cantonment, Dhaka-1206, Bangladesh</p><p><strong>For professional and authorized use only.</strong></p></h1>', '[\"vEGO1785938706.webp\"]', 3, '', NULL, NULL, '2026-08-05 08:04:03', '2026-08-05 08:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `no_of_times` int(11) NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `title`, `code_name`, `no_of_times`, `discount`, `status`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Flash Discount', 'ironman', 95, 2, 1, NULL, NULL, NULL),
(2, 'Halloween Carnival', 'superman', 96, 5, 1, NULL, NULL, NULL),
(3, 'Fest Carnival', 'loki', 94, 10, 1, NULL, NULL, 'amount');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `item_id`, `review`, `subject`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 28, 'good', 'project', 5, 1, '2026-07-12 07:16:31', '2026-07-12 07:16:31'),
(2, 4, 27, 'F10 Derma Pen offers premium build quality, smooth performance, and reliable results. Its powerful motor, adjustable needle depth, dual rechargeable batteries, and ergonomic design make treatments comfortable and efficient. Ideal for PRP, Exosome, microneedling, skin rejuvenation, acne scar treatment, and hair restoration. A highly recommended choice for dermatologists and aesthetic professionals looking for a high-quality device at a competitive price.', 'Excellent Professional Derma Pen', 5, 1, '2026-07-23 01:59:50', '2026-07-23 01:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `section` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(1, 'test', '[\"Manage Categories\",\"Manage Products\",\"Manage Orders\",\"Transactions\",\"Ecommerce\",\"Customer List\",\"Manages Tickets\",\"Manage Site\",\"Manage Faqs Contents\",\"Manage Blogs\",\"Manages Pages\",\"Subscribers List\",\"Manage System User\"]', '2021-12-05 10:24:27', '2021-12-05 10:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(31, 'Secure Online Payment', 'We posess SSL / Secure Certificate', '162196474904_1785426681.webp', 1, NULL, NULL),
(32, '24/7 Customer Support', 'Friendly 24/7 customer support', '162196471103_1785426681.webp', 1, NULL, NULL),
(33, 'Money Back Guarantee', 'We return money within 30 days', '162196467602_1785426681.webp', 1, NULL, NULL),
(34, 'Nationwide Delivery', 'Reliable shipping for all orders nationwide', '162196463701_1785426681.webp', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `loader` varchar(255) DEFAULT NULL,
  `is_loader` tinyint(4) DEFAULT 1,
  `feature_image` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `smtp_check` tinyint(4) DEFAULT 0,
  `email_host` varchar(255) DEFAULT NULL,
  `email_port` varchar(255) DEFAULT NULL,
  `email_encryption` varchar(255) DEFAULT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `email_pass` varchar(255) DEFAULT NULL,
  `email_from` varchar(255) DEFAULT NULL,
  `email_from_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `overlay` text DEFAULT NULL,
  `google_analytics_id` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_shop` tinyint(4) DEFAULT 1,
  `is_blog` tinyint(4) DEFAULT 1,
  `is_faq` tinyint(4) DEFAULT 1,
  `is_contact` tinyint(4) DEFAULT 1,
  `facebook_check` tinyint(4) DEFAULT 1,
  `facebook_client_id` varchar(255) DEFAULT NULL,
  `facebook_client_secret` varchar(255) DEFAULT NULL,
  `facebook_redirect` varchar(255) DEFAULT NULL,
  `google_check` tinyint(4) DEFAULT 1,
  `google_client_id` varchar(255) DEFAULT NULL,
  `google_client_secret` varchar(255) DEFAULT NULL,
  `google_redirect` varchar(255) DEFAULT NULL,
  `min_price` double DEFAULT 0,
  `max_price` double DEFAULT 100000,
  `footer_phone` varchar(255) DEFAULT NULL,
  `footer_address` text DEFAULT NULL,
  `footer_email` varchar(255) DEFAULT NULL,
  `footer_gateway_img` varchar(255) DEFAULT NULL,
  `social_link` text DEFAULT NULL,
  `friday_start` varchar(255) DEFAULT NULL,
  `friday_end` varchar(255) DEFAULT NULL,
  `satureday_start` varchar(255) DEFAULT NULL,
  `satureday_end` varchar(255) DEFAULT NULL,
  `copy_right` varchar(255) DEFAULT NULL,
  `is_slider` tinyint(4) DEFAULT 1,
  `is_category` tinyint(4) DEFAULT 1,
  `is_product` tinyint(4) DEFAULT 1,
  `is_top_banner` tinyint(4) DEFAULT 1,
  `is_recent` tinyint(4) DEFAULT 1,
  `is_top` tinyint(4) DEFAULT 1,
  `is_best` tinyint(4) DEFAULT 1,
  `is_flash` tinyint(4) DEFAULT 1,
  `is_brand` tinyint(4) DEFAULT 1,
  `is_blogs` tinyint(4) DEFAULT 1,
  `is_campaign` tinyint(4) DEFAULT 1,
  `is_brands` tinyint(4) DEFAULT 1,
  `is_bottom_banner` tinyint(4) DEFAULT 1,
  `is_service` tinyint(4) DEFAULT 1,
  `campaign_title` varchar(255) DEFAULT NULL,
  `campaign_end_date` varchar(255) DEFAULT NULL,
  `campaign_status` tinyint(4) DEFAULT 1,
  `twilio_sid` varchar(255) DEFAULT NULL,
  `twilio_token` varchar(255) DEFAULT NULL,
  `twilio_form_number` varchar(255) DEFAULT NULL,
  `twilio_country_code` varchar(255) DEFAULT NULL,
  `is_announcement` tinyint(4) DEFAULT 1,
  `announcement` varchar(255) DEFAULT NULL,
  `announcement_delay` decimal(11,2) NOT NULL DEFAULT 0.00,
  `is_maintainance` tinyint(4) DEFAULT 1,
  `maintainance_image` varchar(255) DEFAULT NULL,
  `maintainance_text` text DEFAULT NULL,
  `is_twilio` tinyint(4) DEFAULT 0,
  `twilio_section` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_three_c_b_first` tinyint(4) NOT NULL DEFAULT 1,
  `is_popular_category` tinyint(4) NOT NULL DEFAULT 1,
  `is_three_c_b_second` tinyint(4) NOT NULL DEFAULT 1,
  `is_highlighted` tinyint(4) NOT NULL DEFAULT 1,
  `is_two_column_category` tinyint(4) NOT NULL DEFAULT 1,
  `is_popular_brand` tinyint(4) NOT NULL DEFAULT 1,
  `is_featured_category` tinyint(4) NOT NULL DEFAULT 1,
  `is_two_c_b` tinyint(4) NOT NULL DEFAULT 1,
  `theme` varchar(255) DEFAULT NULL,
  `google_recaptcha_site_key` varchar(255) DEFAULT NULL,
  `google_recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `recaptcha` tinyint(4) DEFAULT 0,
  `currency_direction` tinyint(4) DEFAULT 1,
  `google_analytics` text DEFAULT NULL,
  `google_adsense` text DEFAULT NULL,
  `facebook_pixel` text DEFAULT NULL,
  `facebook_messenger` text DEFAULT NULL,
  `is_google_analytics` tinyint(4) DEFAULT 0,
  `is_google_adsense` tinyint(4) DEFAULT 0,
  `is_facebook_pixel` tinyint(4) DEFAULT 0,
  `is_facebook_messenger` tinyint(4) DEFAULT 0,
  `announcement_link` text DEFAULT NULL,
  `is_attribute_search` tinyint(4) DEFAULT 1,
  `is_range_search` tinyint(4) DEFAULT 1,
  `view_product` int(11) DEFAULT 12,
  `home_page_title` varchar(255) DEFAULT 'Home',
  `is_privacy_trams` tinyint(4) DEFAULT 1,
  `policy_link` varchar(255) DEFAULT '''#''',
  `terms_link` varchar(255) DEFAULT '''#''',
  `is_guest_checkout` tinyint(4) DEFAULT 1,
  `custom_css` text DEFAULT NULL,
  `announcement_title` varchar(255) DEFAULT NULL,
  `announcement_type` varchar(255) DEFAULT 'banner',
  `is_cookie` tinyint(4) DEFAULT 1,
  `cookie_text` varchar(255) DEFAULT NULL,
  `announcement_details` text DEFAULT NULL,
  `decimal_separator` varchar(255) DEFAULT '.',
  `thousand_separator` varchar(255) DEFAULT ',',
  `disqus` text DEFAULT NULL,
  `is_disqus` tinyint(4) NOT NULL DEFAULT 0,
  `is_decimal` tinyint(4) DEFAULT 1,
  `store_response_time` varchar(50) DEFAULT '&le;4h',
  `store_on_time_delivery` varchar(50) DEFAULT '&ge;90%',
  `store_reorder_rate` varchar(50) DEFAULT '30%',
  `steadfast_api_key` varchar(255) DEFAULT NULL,
  `steadfast_secret_key` varchar(255) DEFAULT NULL,
  `facebook_pixel_id` varchar(255) DEFAULT NULL,
  `facebook_capi_token` text DEFAULT NULL,
  `facebook_capi_test_code` varchar(255) DEFAULT NULL,
  `is_facebook_capi` tinyint(4) NOT NULL DEFAULT 0,
  `is_facebook_capi_view_content` tinyint(4) NOT NULL DEFAULT 0,
  `is_facebook_capi_add_to_cart` tinyint(4) NOT NULL DEFAULT 0,
  `is_facebook_capi_purchase` tinyint(4) NOT NULL DEFAULT 0,
  `is_facebook_capi_initiate_checkout` tinyint(4) NOT NULL DEFAULT 0,
  `sms_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `loader`, `is_loader`, `feature_image`, `primary_color`, `smtp_check`, `email_host`, `email_port`, `email_encryption`, `email_user`, `email_pass`, `email_from`, `email_from_name`, `contact_email`, `version`, `overlay`, `google_analytics_id`, `meta_keywords`, `meta_description`, `is_shop`, `is_blog`, `is_faq`, `is_contact`, `facebook_check`, `facebook_client_id`, `facebook_client_secret`, `facebook_redirect`, `google_check`, `google_client_id`, `google_client_secret`, `google_redirect`, `min_price`, `max_price`, `footer_phone`, `footer_address`, `footer_email`, `footer_gateway_img`, `social_link`, `friday_start`, `friday_end`, `satureday_start`, `satureday_end`, `copy_right`, `is_slider`, `is_category`, `is_product`, `is_top_banner`, `is_recent`, `is_top`, `is_best`, `is_flash`, `is_brand`, `is_blogs`, `is_campaign`, `is_brands`, `is_bottom_banner`, `is_service`, `campaign_title`, `campaign_end_date`, `campaign_status`, `twilio_sid`, `twilio_token`, `twilio_form_number`, `twilio_country_code`, `is_announcement`, `announcement`, `announcement_delay`, `is_maintainance`, `maintainance_image`, `maintainance_text`, `is_twilio`, `twilio_section`, `created_at`, `updated_at`, `is_three_c_b_first`, `is_popular_category`, `is_three_c_b_second`, `is_highlighted`, `is_two_column_category`, `is_popular_brand`, `is_featured_category`, `is_two_c_b`, `theme`, `google_recaptcha_site_key`, `google_recaptcha_secret_key`, `recaptcha`, `currency_direction`, `google_analytics`, `google_adsense`, `facebook_pixel`, `facebook_messenger`, `is_google_analytics`, `is_google_adsense`, `is_facebook_pixel`, `is_facebook_messenger`, `announcement_link`, `is_attribute_search`, `is_range_search`, `view_product`, `home_page_title`, `is_privacy_trams`, `policy_link`, `terms_link`, `is_guest_checkout`, `custom_css`, `announcement_title`, `announcement_type`, `is_cookie`, `cookie_text`, `announcement_details`, `decimal_separator`, `thousand_separator`, `disqus`, `is_disqus`, `is_decimal`, `store_response_time`, `store_on_time_delivery`, `store_reorder_rate`, `steadfast_api_key`, `steadfast_secret_key`, `facebook_pixel_id`, `facebook_capi_token`, `facebook_capi_test_code`, `is_facebook_capi`, `is_facebook_capi_view_content`, `is_facebook_capi_add_to_cart`, `is_facebook_capi_purchase`, `is_facebook_capi_initiate_checkout`, `sms_url`) VALUES
(1, 'Mac Scientific', 'prp_logo_1785426681.webp', '1783618809ChatGPT Image Jul 9, 2026, 11_28_45 PM_1785426681.webp', '1709711634download_1785426681.webp', 0, '1600622296topic.jpg', '#112BB1', 0, '', '', '', '', '', '', '', '', '4.0', NULL, 'UA-106757798-1', 'Mac Scientific,PRP Tube Bangladesh,PRP Tube,GFC Tube,PRF Tube,ACD Gel Tube,ACD Gel Biotin Tube,Exosome,Hair Exosome,Skin Exosome,PRP Centrifuge,PRF Centrifuge,Dermapen,Dr Pen,Derma Roller,Microneedling,Aesthetic Equipment,Regenerative Medicine,Medical Consumables,Laboratory Equipment,Medical Supplies Bangladesh,Aesthetic Products Bangladesh', 'MAC Scientific is Bangladesh\'s trusted supplier of PRP, GFC & PRF Tubes, Exosomes, PRP Centrifuges, Dermapen, Derma Rollers, and premium aesthetic & laboratory products with nationwide delivery.', 1, 1, 0, 1, 0, '', '', '', 0, '', '', '', 0, 10000, '+8801312699221', 'Shop No. 59. 2nd Floor, Rajanigandha Super Market, Kachukhet, Dhaka-1206, Bangladesh.', 'macscientificbd@gmail.com', '1709711755y7mS4QRuHu6dNY9y6FAmv29me1Rg4v4CCAbpJdq4.png', '{\"icons\":[\"fab fa-facebook-f\",\"fab fa-facebook\",\"fab fa-instagram\",\"fab fa-youtube\",\"fab fa-whatsapp\"],\"links\":[\"https:\\/\\/facebook.com\\/macscientific\",\"https:\\/\\/www.facebook.com\\/profile.php?id=61574534235204\",\"https:\\/\\/instagram.com\\/macscientific\",\"https:\\/\\/www.youtube.com\\/@MACScientific\",\"https:\\/\\/wa.me\\/8801312699221\"]}', '9:27 PM', '9:27 PM', '9:27 PM', '9:27 PM', 'All rights reserved By Mac Scientific', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 'Deals Of The Week', '10/10/2022', 1, 'AC73e54518487ad4e26da8b465a7614f1f0', '300d787df0c398ae46b84b74ea86f59c', '+8801775457708', '+880', 1, '1709712076head1.png', 1.00, 0, '16323327831619241714761747856.jpg', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank you.', 1, '{\"\'purchase\'\":\"Your Order Purchase Successfully Your order {order_number} received on {order_date}. Expected delivery between 2-3 days. Total price: {order_amount}.\",\"\'order_status\'\":\"Your Order status update. Order number is {order_number}\",\"\'merchant_purchase\'\":\"You Got New Order Order Details:Order #{order_number} by {customer_name} ({customer_phone}). Items: {order_items}. Total: {order_amount}. Address: {customer_address}\"}', NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 'theme2', '#', '#', 0, 1, NULL, NULL, NULL, '#', 0, 0, 0, 0, '#', 1, 1, 16, 'MAC Scientific | PRP Tube, GFC Tube, Exosome & Aesthetic Products Bangladesh', 1, '#', '#', 1, NULL, 'Get 50% Discount.', 'newletter', 1, 'Your experience on this site will be improved by allowing cookies.', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, facere nesciunt doloremque nobis debitis sint?', '.', ',', '#', 1, 1, '&le;4h', '&ge;90%', '30%', '2pxfihf6488wch4dlixpvgpp5ka4d6lj', 'aampng8rzadqaiznzdovnww1', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_services`
--

CREATE TABLE `shipping_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `minimum_price` double NOT NULL DEFAULT 0,
  `is_condition` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_services`
--

INSERT INTO `shipping_services` (`id`, `title`, `price`, `minimum_price`, `is_condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free Delevery', 0, 1000, 1, 0, NULL, NULL),
(2, 'Delivery', 1.4285714285714, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitemap_url` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page` varchar(255) DEFAULT 'theme1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `photo`, `title`, `link`, `logo`, `details`, `created_at`, `updated_at`, `home_page`) VALUES
(18, '1783610939Trusted by Professionals_1785426680.webp', '#', '#', '1783340454logo_1785426680.webp', 'It is a long established fact that a reader will be distracted by the readable content', NULL, NULL, 'theme2'),
(20, 'YlvLPRP-vs-PRF3_1785426681.webp', '#', '#', 'IlfIPRP-vs-PRF3_1785426681.webp', 'no', NULL, NULL, 'theme1'),
(22, 'JB5nshutterstock_1068445823_1785426681.webp', '#', '#', 'o8dmshutterstock_1068445823_1785426681.webp', '#', NULL, NULL, 'theme2');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'fab fa-facebook-square', NULL, NULL),
(2, 'https://twitter.com/', 'fab fa-twitter-square', NULL, NULL),
(3, 'https://www.instagram.com/', 'fab fa-instagram', NULL, NULL),
(10, 'https://www.pinterest.com/', 'fab fa-pinterest-square', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `slug`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PRP-Tubes', 'PRP-Tubes', 18, 0, NULL, NULL),
(2, 'PRP Sets', 'PRP-Sets', 18, 0, NULL, NULL),
(3, 'Needles', 'Needles', 21, 0, NULL, NULL),
(4, 'Syringes', 'Syringes', 21, 0, NULL, NULL),
(5, 'Spare Needles', 'Spare-Needles', 21, 0, NULL, NULL),
(6, 'Blood Collection Set', 'Blood-Collection-Set', 21, 0, NULL, NULL),
(7, 'Valves, Connectors, Closures', 'Valves--Connectors--Closures', 21, 0, NULL, NULL),
(8, 'Tourniquets', 'Tourniquets', 21, 0, NULL, NULL),
(9, 'Centrifuge', 'Centrifuge', 22, 0, NULL, NULL),
(10, 'Essentials', 'Essentials', 22, 0, NULL, NULL),
(11, 'Centrifuge cart', 'Centrifuge-cart', 22, 0, NULL, NULL),
(12, 'Needling Pen', 'Needling-Pen', 24, 0, NULL, NULL),
(13, 'Spare Needle', 'Spare-Needle', 24, 0, NULL, NULL),
(14, 'Serum & Ampoules', 'Serum---Ampoules', 24, 0, NULL, NULL),
(15, 'BB Glow', 'BB-Glow', 24, 0, NULL, NULL),
(16, 'Mesorollers', 'Mesorollers', 24, 0, NULL, NULL),
(18, 'FRUIT ACID PEELING', 'FRUIT-ACID-PEELING', 25, 0, NULL, NULL),
(19, 'Creams', 'Creams', 25, 0, NULL, NULL),
(20, 'Peeling', 'Peeling', 25, 0, NULL, NULL),
(21, 'Face Masks', 'Face-Masks', 25, 0, NULL, NULL),
(22, 'Wound healing ointments', 'Wound-healing-ointments', 25, 0, NULL, NULL),
(23, 'Disinfectant', 'Disinfectant', 25, 0, NULL, NULL),
(24, 'ANTI AGING', 'ANTI-AGING', 25, 0, NULL, NULL),
(25, 'Medical Training', 'Medical-Training', 27, 0, NULL, NULL),
(26, 'Online Courses', 'Online-Courses', 27, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'user@gmail.com', NULL, NULL),
(2, 'mehedihasaen588@gmail.com', NULL, NULL),
(3, 'thereisalottoknow@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'High Tax', 4, 1, NULL, NULL),
(2, 'Low Tax', 1, 1, NULL, NULL),
(3, 'No Tax', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `message`, `file`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I need help', 'I need help', NULL, 1, NULL, '2021-12-03 06:32:39', '2021-12-03 06:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `track_orders`
--

CREATE TABLE `track_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_orders`
--

INSERT INTO `track_orders` (`id`, `order_id`, `title`, `created_at`, `updated_at`) VALUES
(7, 7, 'Pending', '2026-07-26 00:03:41', '2026-07-26 00:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `user_email` varchar(255) DEFAULT NULL,
  `currency_sign` varchar(255) DEFAULT NULL,
  `currency_value` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `txn_id`, `amount`, `user_email`, `currency_sign`, `currency_value`, `created_at`, `updated_at`) VALUES
(7, '7', 'uZPrXUquqQ', 12, 'customer@gmail.com', '৳', 84, '2026-07-26 00:03:41', '2026-07-26 00:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email_token` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ship_address1` varchar(255) DEFAULT NULL,
  `ship_address2` varchar(255) DEFAULT NULL,
  `ship_zip` varchar(255) DEFAULT NULL,
  `ship_city` varchar(255) DEFAULT NULL,
  `ship_country` varchar(255) DEFAULT NULL,
  `ship_company` varchar(255) DEFAULT NULL,
  `bill_address1` varchar(255) DEFAULT NULL,
  `bill_address2` varchar(255) DEFAULT NULL,
  `bill_zip` varchar(255) DEFAULT NULL,
  `bill_city` varchar(255) DEFAULT NULL,
  `bill_country` varchar(255) DEFAULT NULL,
  `bill_company` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `photo`, `email_token`, `password`, `ship_address1`, `ship_address2`, `ship_zip`, `ship_city`, `ship_country`, `ship_company`, `bill_address1`, `bill_address2`, `bill_zip`, `bill_city`, `bill_country`, `bill_company`, `created_at`, `updated_at`, `state_id`) VALUES
(1, 'Juned', 'Ahmed', '01312699221', 'engr.juned@gmail.com', NULL, 'PggFCl', '$2y$10$zoz.Atpk.yVy0pYY/uBuG.XY6RjLLYDYnvC2uzPWuYvNvQe3FTQIu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-09 08:47:29', '2026-07-09 08:47:29', NULL),
(2, 'No One', 'Have', '01911845990', 'noone@mail.com', NULL, 'IjCPDf', '$2y$10$7/mHp9Czgr61jZiSoDBlpuZjZ083L3m/MAH1VVLixTyLXV4Toj4hC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-12 07:15:48', '2026-07-12 07:15:48', NULL),
(3, 'FDSA', 'FDADF', '1337133710', 'xevega6676@soppat.com', NULL, 'BwjDp1', '$2y$10$cHgfegbpwnNGtUMMMBilX.evhz2E6.dkvJGzPhBASzWStTKQOabSK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-15 11:28:52', '2026-07-15 11:28:52', NULL),
(4, 'Juned', 'Ahmed', '01312699221', 'engr.rihad@gmail.com', NULL, 'G9xEc1', '$2y$10$wx9qVFXV5dHjhKQHxmm/7ecWtDHVlAkfadM9xAJS33WWriYPP5IUy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-23 01:56:59', '2026-07-23 01:56:59', NULL),
(5, 'Mahmudul', 'alam', '01767185501', 'brayanadams3@gmail.com', NULL, 'XFBVes', '$2y$10$9n0.4.3o5GcTPAiIeVRrseV2R1//raLb9.fkt0fsIglMJcyVEB5Oa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-26 09:26:25', '2026-07-26 09:26:25', NULL),
(6, 'Tarik', 'Mohammed', '01755521481', 'thsomoy@gmail.com', NULL, '9XnqhX', '$2y$10$96IuhU.rgZypAx15PfJAzuOLepzf4M6ULH.xoHv39DBIoMW/yLQrC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-30 12:30:19', '2026-07-30 12:30:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bcategories`
--
ALTER TABLE `bcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_items`
--
ALTER TABLE `campaign_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chield_categories`
--
ALTER TABLE `chield_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_settings`
--
ALTER TABLE `extra_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fcategories`
--
ALTER TABLE `fcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_cutomizes`
--
ALTER TABLE `home_cutomizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_services`
--
ALTER TABLE `shipping_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_orders`
--
ALTER TABLE `track_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bcategories`
--
ALTER TABLE `bcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_items`
--
ALTER TABLE `campaign_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `chield_categories`
--
ALTER TABLE `chield_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extra_settings`
--
ALTER TABLE `extra_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `fcategories`
--
ALTER TABLE `fcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `home_cutomizes`
--
ALTER TABLE `home_cutomizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_services`
--
ALTER TABLE `shipping_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `track_orders`
--
ALTER TABLE `track_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
