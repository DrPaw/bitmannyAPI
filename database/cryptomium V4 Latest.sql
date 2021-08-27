-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2021 at 12:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptomium`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@admin.com', 'admin', NULL, '6061fbac5b71b1617034156.png', '$2y$10$GmNdZfsrjLzsuwK3f8Woce6KWzm3KtRbL2gC5w1POh/Kf3SfTnMPO', NULL, NULL, '2021-03-29 21:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_logs`
--

CREATE TABLE `commission_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `who` int(11) DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `main_amo` decimal(18,2) DEFAULT 0.00,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_topics`
--

CREATE TABLE `contact_topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_topics`
--

INSERT INTO `contact_topics` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Support', '2021-02-03 13:51:57', '2021-02-03 13:51:57'),
(2, 'Complaints', '2021-02-03 13:52:08', '2021-02-03 13:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `cryptotrxs`
--

CREATE TABLE `cryptotrxs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin_id` int(11) DEFAULT NULL,
  `hash` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trxid` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explorer_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cryptowallets`
--

CREATE TABLE `cryptowallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin_id` int(11) NOT NULL,
  `label` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `balance` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crypto_escrows`
--

CREATE TABLE `crypto_escrows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin_id` int(11) NOT NULL,
  `trade_code` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paidamount` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paidusd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crypto_escrows`
--

INSERT INTO `crypto_escrows` (`id`, `coin_id`, `trade_code`, `wallet_id`, `amount`, `usd`, `paidamount`, `paidusd`, `fee`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 6, '5ZXP6WZFH1YA', 'RHxfjPdAGyVzJCHaDUeofo', '1.01000000', '1.01000000', '1', '1.01000000', NULL, 16, 0, '2021-06-16 15:12:15', '2021-06-16 15:12:15'),
(13, 6, 'KRP66VZUOKY8', 'RD3aWgrZji7x6Yr5Q3dLJA', '1.01000000', '1.01000000', '1', '1.01000000', NULL, 16, 0, '2021-06-16 15:39:06', '2021-06-16 15:39:06'),
(14, 6, 'A73TNTU63F93', 'RDKn5ncjjWyB7hrFQiUtdG', '5.05000000', '5.05000000', '1', '5.05000000', NULL, 16, 1, '2021-06-16 16:42:22', '2021-06-16 17:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_offers`
--

CREATE TABLE `crypto_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(1) DEFAULT NULL,
  `coin_id` int(11) NOT NULL,
  `code` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rate` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int(88) DEFAULT NULL,
  `account` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crypto_offers`
--

INSERT INTO `crypto_offers` (`id`, `type`, `coin_id`, `code`, `wallet_id`, `min`, `max`, `user_id`, `rate`, `country`, `currency`, `payment_method`, `account`, `note`, `expire`, `status`, `created_at`, `updated_at`) VALUES
(23, 2, 6, 'KGPQAKU5COMH', '0', '100', '100', 16, '124', 'Albania', 'ALL', 13, 'RHc4nPK3424DPnGF73hFo4VNMA1krMBib4', 'No Scam Zone', '30', 1, '2021-06-16 16:39:03', '2021-06-16 16:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_offers_trade`
--

CREATE TABLE `crypto_offers_trade` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wallet` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `units` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketcode` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `escrowwallet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escrowid` varchar(56) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escrowvalue` varchar(67) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escrowusd` varchar(56) COLLATE utf8mb4_unicode_ci NOT NULL,
  `escrowpay` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escrowfee` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer` int(55) DEFAULT NULL,
  `paid` int(55) DEFAULT 0,
  `disbursed` int(2) NOT NULL DEFAULT 0,
  `dispute` int(1) NOT NULL DEFAULT 0,
  `expire` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crypto_offers_trade`
--

INSERT INTO `crypto_offers_trade` (`id`, `user_id`, `wallet`, `coin`, `amount`, `units`, `marketcode`, `trx`, `status`, `escrowwallet`, `escrowid`, `escrowvalue`, `escrowusd`, `escrowpay`, `escrowfee`, `buyer`, `paid`, `disbursed`, `dispute`, `expire`, `created_at`, `updated_at`) VALUES
(46, 16, NULL, '6', '5', '5.05000000', 'KGPQAKU5COMH', 'A73TNTU63F93', 1, 'RDKn5ncjjWyB7hrFQiUtdGJEwaZJvVChEE', 'TCN2282', '5.05000000', '5.05000000', '4.9995', '0.0505', 16, 1, 1, 0, '2021-06-16 18:10:35', '2021-06-16 16:40:35', '2021-06-16 17:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_ratings`
--

CREATE TABLE `crypto_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer` int(20) DEFAULT NULL,
  `seller` int(20) DEFAULT NULL,
  `rate` int(10) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketcode` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tradecode` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crypto_trade_chat`
--

CREATE TABLE `crypto_trade_chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(191) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tradecode` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketcode` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crypto_trade_chat`
--

INSERT INTO `crypto_trade_chat` (`id`, `sender`, `receiver`, `message`, `tradecode`, `marketcode`, `type`, `created_at`, `updated_at`) VALUES
(3, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', '2AH5GHJN2ZS2', '6KX66PH22AOF', 1, '2021-06-16 14:58:13', '2021-06-16 14:58:13'),
(4, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', 'MPW97NDHMCGK', '6KX66PH22AOF', 1, '2021-06-16 14:58:57', '2021-06-16 14:58:57'),
(5, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', 'PM1QHP344UFC', '6KX66PH22AOF', 1, '2021-06-16 14:59:55', '2021-06-16 14:59:55'),
(6, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', 'AF7DDFQXXX7R', '6KX66PH22AOF', 1, '2021-06-16 15:01:03', '2021-06-16 15:01:03'),
(7, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', 'AFBE5PSFZH7Q', '6KX66PH22AOF', 1, '2021-06-16 15:03:22', '2021-06-16 15:03:22'),
(8, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', '35NGVHFSHWQY', '6KX66PH22AOF', 1, '2021-06-16 15:04:12', '2021-06-16 15:04:12'),
(9, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', '5ZXP6WZFH1YA', '6KX66PH22AOF', 1, '2021-06-16 15:07:14', '2021-06-16 15:07:14'),
(10, 16, 16, 'hello guy', '5ZXP6WZFH1YA', '6KX66PH22AOF', 2, '2021-06-16 15:12:27', '2021-06-16 15:12:27'),
(11, 16, 16, 'hellio', '5ZXP6WZFH1YA', '6KX66PH22AOF', 2, '2021-06-16 15:18:22', '2021-06-16 15:18:22'),
(12, 16, 16, 'hello', '5ZXP6WZFH1YA', '6KX66PH22AOF', 1, '2021-06-16 15:24:52', '2021-06-16 15:24:52'),
(13, 16, 16, 'Hi, i want to sell Test Coin worth of 1 USD to you', 'KRP66VZUOKY8', 'CGOV9H4RBP46', 1, '2021-06-16 15:35:07', '2021-06-16 15:35:07'),
(14, 16, 16, 'Howfar', 'KRP66VZUOKY8', 'CGOV9H4RBP46', 2, '2021-06-16 15:40:24', '2021-06-16 15:40:24'),
(15, 16, 16, 'Make payment to fcmb 1234567', 'KRP66VZUOKY8', 'CGOV9H4RBP46', 2, '2021-06-16 15:40:51', '2021-06-16 15:40:51'),
(16, 16, 16, 'Hi, i want to sell Test Coin worth of 5 USD to you', 'A73TNTU63F93', 'KGPQAKU5COMH', 1, '2021-06-16 16:40:35', '2021-06-16 16:40:35'),
(17, 16, 16, 'Okay No Wahala', 'A73TNTU63F93', 'KGPQAKU5COMH', 1, '2021-06-16 16:42:51', '2021-06-16 16:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apipass` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apikey` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `buy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_coin` tinyint(4) NOT NULL DEFAULT 0,
  `canbuy` int(1) NOT NULL DEFAULT 1,
  `cansell` int(1) NOT NULL DEFAULT 1,
  `canoffer` int(1) NOT NULL DEFAULT 1,
  `canwallet` int(1) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `icon`, `apipass`, `apikey`, `price`, `fee`, `sell`, `buy`, `min`, `max`, `image`, `is_coin`, `canbuy`, `cansell`, `canoffer`, `canwallet`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ethereum', 'ETH', 'sign-eth-alt', NULL, NULL, '2567.55', '1', '400', '435', 1, 1000000000, 'Ethereum.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:14:00', '2018-02-15 05:36:57', '2021-06-15 19:35:30'),
(2, 'Bitcoin', 'BTC', 'sign-eth-alt', NULL, NULL, '40157', '1', '400', '435', 10, 2147483647, 'Bitcoin.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:14:00', '2018-02-15 05:36:57', '2021-06-15 19:35:30'),
(3, 'Bitcoin Cash', 'BCH', 'sign-bch-alt', NULL, NULL, '625.27', '1', '390', '400', 100, 1000, 'Bitcoin.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:13:29', '2018-02-15 05:36:57', '2021-06-15 19:35:30'),
(4, 'Litecoin', 'LTC', 'sign-ltc-alt', NULL, NULL, '175.24', '1', '370', '400', 100000, 100000, 'Litecoin.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:13:25', '2018-02-15 05:36:57', '2021-06-15 19:35:30'),
(5, 'Dashcoin', 'DASH', NULL, NULL, NULL, '172.34', '1', '350', '350', 100000, 100000, 'Dash.svg', 1, 1, 1, 1, 1, 1, NULL, '2021-01-22 02:39:38', '2021-06-15 19:35:30'),
(6, 'Test Coin', 'TCN', 'sign-php-alt', 'kay22687', '$2y$10$Zth1BhELUq89vHHl7686fOj2IbwQH3zHtxRoaztqsFUY2W3rwNx82', '465', '1', '465', '465', 1, 10, 'IOTA.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:13:17', '2018-10-22 11:49:14', '2021-03-30 22:44:31'),
(11, 'USD Teter', 'USDT', 'sign-php-alt', NULL, NULL, '1', '1', '465', '465', 100, 1000, 'Steem.svg', 1, 1, 1, 1, 1, 1, '2021-01-15 05:13:17', '2018-10-22 11:49:14', '2021-06-15 17:59:34'),
(118, 'Dogecoin', 'DOGE', NULL, NULL, NULL, '0.321337', '1', '350', '350', 100, 1000, 'Dash.svg', 1, 1, 1, 1, 1, 1, NULL, '2021-01-22 02:39:38', '2021-06-15 19:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `name`, `symbol`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(2, 'America', 'Dollars', 'USD', '$', 1, 1, '2020-11-23 15:41:39', '2020-11-23 14:41:39'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(4, 'Argentina', 'Pesos', 'ARS', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(6, 'Australia', 'Dollars', 'AUD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '???', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(8, 'Bahamas', 'Dollars', 'BSD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(9, 'Barbados', 'Dollars', 'BBD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(11, 'Belgium', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(13, 'Bermuda', 'Dollars', 'BMD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(16, 'Botswana', 'Pula', 'BWP', 'P', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(17, 'Bulgaria', 'Leva', 'BGN', '??', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(18, 'Brazil', 'Reais', 'BRL', 'R$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(21, 'Cambodia', 'Riels', 'KHR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(22, 'Canada', 'Dollars', 'CAD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(24, 'Chile', 'Pesos', 'CLP', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(26, 'Colombia', 'Pesos', 'COP', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(27, 'Costa Rica', 'Colón', 'CRC', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(29, 'Cuba', 'Pesos', 'CUP', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(30, 'Cyprus', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'K?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(35, 'Egypt', 'Pounds', 'EGP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(36, 'El Salvador', 'Colones', 'SVC', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(38, 'Euro', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(40, 'Fiji', 'Dollars', 'FJD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(41, 'France', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(42, 'Ghana', 'Cedis', 'GHC', '¢', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(44, 'Greece', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(46, 'Guernsey', 'Pounds', 'GGP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(47, 'Guyana', 'Dollars', 'GYD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(53, 'India', 'Rupees', 'INR', 'Rp', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(55, 'Iran', 'Rials', 'IRR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(56, 'Ireland', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(58, 'Israel', 'New Shekels', 'ILS', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(59, 'Italy', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(61, 'Japan', 'Yen', 'JPY', '¥', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(62, 'Jersey', 'Pounds', 'JEP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '??', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(64, 'Korea (North)', 'Won', 'KPW', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(65, 'Korea (South)', 'Won', 'KRW', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', '??', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(67, 'Laos', 'Kips', 'LAK', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(69, 'Lebanon', 'Pounds', 'LBP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(70, 'Liberia', 'Dollars', 'LRD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(73, 'Luxembourg', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(74, 'Macedonia', 'Denars', 'MKD', '???', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(76, 'Malta', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(77, 'Mauritius', 'Rupees', 'MUR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(78, 'Mexico', 'Pesos', 'MXN', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(79, 'Mongolia', 'Tugriks', 'MNT', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(81, 'Namibia', 'Dollars', 'NAD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(82, 'Nepal', 'Rupees', 'NPR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(84, 'Netherlands', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(85, 'New Zealand', 'Dollars', 'NZD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(87, 'Nigeria', 'Naira', 'NGN', '?', 390, 1, '2021-02-06 07:29:44', '2021-01-13 06:49:10'),
(88, 'North Korea', 'Won', 'KPW', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(89, 'Norway', 'Krone', 'NOK', 'kr', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(90, 'Oman', 'Rials', 'OMR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(91, 'Pakistan', 'Rupees', 'PKR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(96, 'Poland', 'Zlotych', 'PLN', 'z?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(97, 'Qatar', 'Rials', 'QAR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(98, 'Romania', 'New Lei', 'RON', 'lei', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(99, 'Russia', 'Rubles', 'RUB', '???', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(102, 'Serbia', 'Dinars', 'RSD', '???.', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(103, 'Seychelles', 'Rupees', 'SCR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(104, 'Singapore', 'Dollars', 'SGD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(105, 'Slovenia', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(107, 'Somalia', 'Shillings', 'SOS', 'S', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(108, 'South Africa', 'Rand', 'ZAR', 'R', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(109, 'South Korea', 'Won', 'KRW', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(110, 'Spain', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(114, 'Suriname', 'Dollars', 'SRD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(115, 'Syria', 'Pounds', 'SYP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(117, 'Thailand', 'Baht', 'THB', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(119, 'Turkey', 'Lira', 'TRY', 'TL', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(120, 'Turkey', 'Liras', 'TRL', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(124, 'United States of America', 'Dollars', 'USD', '$', NULL, 1, '2021-01-13 07:49:10', '2021-01-13 06:49:10'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(126, 'Uzbekistan', 'Sums', 'UZS', '??', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(127, 'Vatican City', 'Euro', 'EUR', '€', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(129, 'Vietnam', 'Dong', 'VND', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(130, 'Yemen', 'Rials', 'YER', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00'),
(132, 'India', 'Rupees', 'INR', '?', NULL, 1, '2020-11-22 12:23:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `method_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `final_amo` decimal(18,8) DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(11) NOT NULL DEFAULT 0,
  `verify_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '	1=> confirm , 2 => pending, -2 => rejected	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT 1,
  `sms_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'ACCOUNT_RECOVERY_CODE', 'Account recovery code send', 'Account recovery code', 'Your account recovery code is: {{code}}', 'Your account recovery code is: {{code}}', '{\"code\":\"Recovery code\"}', 1, 1, '2019-09-24 23:04:05', '2021-02-12 17:45:52'),
(2, 'EVER_CODE', 'Email Verification code send', 'Please verify your email address', 'Your email verification code is: {{code}}', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(3, 'SVER_CODE', 'Phone Verification code send', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(4, 'PASS_RESET', 'Password reset email', 'You have changed your password', 'Your password has been changed successfully', 'Your password has been changed successfully', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(6, 'WITHDRAW_REQUEST', 'Withdraw Requested', 'Withdraw Request Send Successfully', '{{amount}} {{currency}}  withdraw requested by {{withdraw_method}}.  You will get {{method_amount}}  {{method_currency}}  in {{duration}}.  Trx: {{trx}}', '{{amount}} {{currency}} withdraw requested by {{withdraw_method}}. You will get {{method_amount}} {{method_currency}} in {{duration}}. Trx: {{trx}}', '{\"trx\":\"trx\",\"amount\":\"amount\",\"currency\":\"currency\",\"withdraw_method\":\"withdraw_method\",\"method_amount\":\"method_amount\",\"method_currency\":\"method_currency\",\"duration\":\"duration\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(7, 'TRADE_START', 'Trading Start', 'Trade has been started', '{{trade}} has been started with {{amount}}', '{{trade}} has been started with {{amount}}', '{\"amount\":\"Trade Amount\", \"trade\":\"Trade Name\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(8, 'TRADE_END', 'Trading End', 'Trade has been Ended', '{{trade}} has been ended. {{amount}} has been refunded to your balance.', '{{trade}} has been ended. {{amount}} has been refunded to your balance.', '{\"trade\":\"Trade Name\",\"amount\":\"Trade Amount/Return Amount}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(9, 'TRADE_CLOSE', 'Trading Closed', 'Trading has been closed', '{{trade}} has been closed. You have collected {{profit}}.', '{{trade}} has been closed. You have collected {{profit}}.', '{\"trade\":\"Trade Name\",\"profit\":\"Trading Profit\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(11, '2fa', 'Two Factor Verification', 'Two Factor Verification', 'Google auhtentication {{action}} succeffully.<div><br></div><div>IP : {{ip}}</div><div><br></div><div>Browser: {{browser}}</div><div><br></div><div><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">Time: {{time}}</span><br></div>', 'Google auhtentication {{action}} succeffully.\r\n\r\nIP : {{ip}}\r\n\r\nBrowser: {{browser}}\r\n\r\nTime: {{time}}', '{\"action\":\"action\",\"ip\":\"ip\",\"browser\":\"browser\",\"time\":\"time\"}', 1, 1, '2019-09-24 23:04:05', '2019-12-15 08:04:44'),
(13, 'WITHDRAW_APPROVE', 'Withdraw Request Confirm', 'Withdraw Request Confirm', 'Admin Approve Your  {{amount}} {{currency}}  withdraw request by {{method}}.  Transaction {{transaction}}', 'Admin Approve Your {{amount}} {{currency}} withdraw request by {{method}}. Transaction {{transaction}}', '{\"amount\":\"amount\",\"currency\":\"currency\",\"main_balance\":\"main_balance\",\"method\":\"method\",\"transaction\":\"transaction\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(14, 'WITHDRAW_REJECT', 'Withdraw Request refunded', 'Withdraw Request Cancel', 'Admin Rejected Your  {{amount}} {{currency}}  withdraw request. Your Main Balance  {{main_balance}}&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">&nbsp;{{method}}</span>&nbsp;, Transaction {{transaction}}', 'Admin Rejected Your {{amount}} {{currency}} withdraw request. Your Main Balance {{main_balance}}  {{method}} , Transaction {{transaction}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\"}', 1, 1, '2019-09-24 23:04:05', '2019-12-18 12:10:16'),
(15, 'DEPOSIT_PENDING', 'Manual deposit requested ', 'Payment Request Send Successfully', '{{amount}}  Deposit requested by {{method}}.     Charge: {{charge}} .   Trx: {{trx}}', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\nYour main Balance: {{new_balance}} {{currency}}\r\n\r\nTransaction {{transaction_id}}', '{\"trx\":\"trx\",\"amount\":\"amount\",\"method\":\"method\",\"charge\":\"charge\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(16, 'DEPOSIT_COMPLETE', 'Payment Successful', 'Payment Successfully', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}<div><br></div><div>Your main Balance: {{new_balance}} {{currency}}</div><div><br></div><div>Transaction {{transaction_id}}</div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}\r\n\r\nYour main Balance: {{new_balance}} {{currency}}\r\n\r\nTransaction {{transaction_id}}', '{\"amount\":\"amount\",\"currency\":\"currency\",\"gateway_currency\":\"gateway_currency\",\"gateway_name\":\"gateway_name\",\"new_balance\":\"new_balance\",\"transaction_id\":\"transaction ID\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(18, 'REF_COM', 'Referral commission', 'You Got Referral commission', 'Congratulation, You Got Level {{reflevel}} Referral Commission.', 'Congratulation, You Got Level {{reflevel}} Referral Commission.', '{\"reflevel\":\"Refer Level\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(19, 'BAL_ADD', 'Balance Add by Admin', 'Your balance has been credited', 'Your balance has been credited with {{amount}}', 'Your balance has been credited with {{amount}}', '{\"amount\":\"Credited Amount\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(20, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your balance has been debited', 'Your balance has been debited by {{amount}}', 'Your balance has been debited by {{amount}}', '{\"amount\":\"Debited Amount\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(21, 'DEPOSIT_APPROVE', 'Manual Deposit Approved', 'Payment Approval Successful', 'Admin Approve Your  {{amount}} {{gateway_currency}}  payment request by {{gateway_name}} transaction : {{transaction}}', 'Admin Approve Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}} transaction : {{transaction}}', '{\"amount\":\"amount\",\"gateway_currency\":\"gateway_currency\",\"gateway_name\":\"gateway_name\",\"transaction\":\"transaction\"}', 1, 1, NULL, NULL),
(22, 'DEPOSIT_REJECT', 'Manual Deposit Rejected', 'Payment Request Cancel', 'Admin Rejected Your  {{amount}} {{gateway_currency}}  payment request by {{gateway_name}}', 'Admin Rejected Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}}', '{\"amount\":\"amount\",\"gateway_currency\":\"gateway_currency\",\"gateway_name\":\"gateway_name\"}', 1, 1, NULL, NULL),
(23, 'INVESTMENT_PURCHASE', 'Investment Plan Purchase', 'Investment Plan Purchase', 'Congratulation, Successfully Invest complete. You invest  {{amount}} {{currency}}  And you will get {{interest_amount}} {{currency}} interest.', 'Congratulation, Successfully Invest complete. You invest  {{amount}} {{currency}}  And you will get {{interest_amount}} {{currency}} interest.', '{\"amount\":\"amount\",\"interest_amount\":\"interest amount\",\"trx\":\"transaction\",\"currency\":\"currency\"}', 1, 1, NULL, NULL),
(25, 'REFERRAL_COMMISSION', 'REFERRAL COMMISSION', 'REFERRAL COMMISSION', 'Congratulation, You you  {{amount}} {{currency}} interest And your main balance {{main_balance}} {{currency}} . {{level}} . Transaction {{trx}}', 'Congratulation, You you  {{amount}} {{currency}} interest And your main balance {{main_balance}} {{currency}} . {{level}} . Transaction {{trx}}', '{\"amount\":\"amount\",\"main_balance\":\"main balance\",\"trx\":\"transaction\",\"level\":\"level\",\"currency\":\"currency\"}', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_keys` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo', '{\"keywords\":[\"hyip website, real\"],\"description\":\"Blockchain Wallet Platform!\",\"social_title\":\"Block Chain\",\"social_description\":\"Blockchain Wallet\",\"image\":\"6061905031ddc1617006672.png\"}', '2019-09-24 23:04:05', '2021-03-29 13:31:12'),
(3, 'gauth', '{\"id\":\"DEMO\",\"secret\":\"DEMO\"}', '2019-09-24 23:04:05', '2019-09-24 23:04:05'),
(4, 'fauth', '{\"id\":\"DEMO\",\"secret\":\"DEMO\"}', '2019-09-24 23:04:05', '2019-09-24 23:04:05'),
(7, 'social.item', '{\"title\":\"Skypee\",\"icon\":\"<i class=\\\"fab fa-skype\\\"><\\/i>\",\"url\":\"https:\\/\\/getbootstrap.com\"}', '2019-09-24 23:53:31', '2021-02-15 03:50:29'),
(11, 'social.item', '{\"title\":\"Instagram\",\"icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/getbootstrap.com\"}', '2019-10-02 18:34:17', '2021-02-15 03:50:21'),
(12, 'social.item', '{\"title\":\"Youtbe\",\"icon\":\"<i class=\\\"fab fa-youtube\\\"><\\/i>\",\"url\":\"https:\\/\\/getbootstrap.com\"}', '2019-10-02 18:37:00', '2021-02-15 03:50:11'),
(13, 'social.item', '{\"title\":\"Facebok\",\"icon\":\"<i class=\\\"fab fa-facebook\\\"><\\/i>\",\"url\":\"https:\\/\\/getbootstrap.com\"}', '2019-10-02 18:38:36', '2021-02-15 03:49:40'),
(14, 'testimonial.title', '{\"title\":\"Testimonials\",\"subtitle\":\"Lose away off why half led have near bed. At engage simple father of period others excepts\"}', '2019-10-02 18:38:36', '2019-10-14 01:26:33'),
(16, 'service.title', '{\"title\":\"Why Choose us\",\"subtitle\":\"Distinctio necessitatibus atque voluptatem nesciunt quae corporis. Omnis iste laudantium tenetur, temporibus ipsa nemo ullam.\"}', '2019-10-02 18:38:36', '2019-10-14 01:47:42'),
(17, 'service.item', '{\"title\":\"How to spend\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-money-bill\\\"><\\/i>\"}', '2019-10-14 01:48:45', '2019-10-14 01:48:45'),
(18, 'service.item', '{\"title\":\"Your website\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-helicopter\\\"><\\/i>\"}', '2019-10-14 01:49:04', '2019-10-14 01:49:04'),
(19, 'service.item', '{\"title\":\"Deposit\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fab fa-html5\\\"><\\/i>\"}', '2019-10-14 01:49:23', '2019-10-14 01:49:23'),
(21, 'howWork.title', '{\"title\":\"How It Work\",\"subtitle\":\"Lose away off why half led have near bed. At engage simple father of period others except\"}', '2019-10-02 18:38:36', '2019-10-14 02:23:14'),
(22, 'howWork.item', '{\"title\":\"Deposit\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fas fa-money-check-alt\\\"><\\/i>\"}', '2019-10-14 02:21:18', '2019-10-14 02:46:31'),
(23, 'howWork.item', '{\"title\":\"Auto Trade\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fab fa-autoprefixer\\\"><\\/i>\"}', '2019-10-14 02:21:42', '2019-10-14 02:45:10'),
(24, 'howWork.item', '{\"title\":\"Get Paid\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fas fa-wallet\\\"><\\/i>\"}', '2019-10-14 02:21:54', '2019-10-14 02:46:12'),
(25, 'titles', '{\"mcm\":\"Market is closed now, you wont get any profit meanwhiles.\",\"bt1\":\"DEPOSIT, TRADE, EARN & ENJOY!\",\"bt2\":\"Automated Forex Trading Robot will Trade for you\",\"bt3\":\"Rem sint impedit similique, laborum laboriosam alias quis, harum animi odit odio vitae reiciendis enim. Magni amet est commodi possimus, blanditiis molestias\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=OX7ZeF2cuJw\",\"video_image_url\":\"https:\\/\\/thesoftking.com\\/assets\\/images\\/we-can-develop-img.jpg\",\"pm\":\"Payment We Accept\",\"stnt\":\"Start Transection Now\",\"stns\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis vel alias cupiditate corrupti, consequuntur odit molestias nam totam incidunt? Esse quasi porro obcaecati dolore nam maxime eaque! Quo, quaerat laudantium?\",\"st\":\"Don\'t Miss Any Update\",\"sti\":\"We will never send spam\",\"ft\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dicta dignissimos enim reprehenderit minima\"}', '2019-10-14 02:21:54', '2019-10-14 02:46:12'),
(27, 'faq', '{\"title\":\"How to login\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\\r\\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\"}', '2019-12-04 00:07:18', '2021-02-19 14:04:10'),
(28, 'faq', '{\"title\":\"Hello Hello Hello\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\"}', '2019-12-04 00:10:56', '2021-02-19 14:03:16'),
(29, 'faq', '{\"title\":\"HElo Hello\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\"}', '2019-12-04 00:11:40', '2021-02-19 14:02:49'),
(30, 'faq', '{\"title\":\"How to join\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\\r\\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\"}', '2019-12-04 00:12:11', '2021-02-19 14:03:44'),
(31, 'faq', '{\"title\":\"It is a long established fact that a reader will be distracted\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', ggmaking it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\"}', '2019-12-04 00:12:53', '2021-03-15 18:05:48'),
(32, 'rules', '{\"body\":\"You agree to be of legal age in your country to partake in this program, and in all the cases your minimal age must be 18 years.\"}', '2019-12-04 01:13:14', '2019-12-04 01:13:14'),
(33, 'rules', '{\"body\":\"<strong>INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD<\\/strong> is not available to the general public and is opened only to the qualified members of INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD, the use of this site is restricted to our members and to individuals personally invited by them. Every deposit is considered to be a private transaction between the INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD and its Member.\"}', '2019-12-04 01:13:40', '2019-12-04 01:15:55'),
(34, 'rules', '{\"body\":\"As a private transaction, this program is exempt from the US Securities Act of 1933, the US Securities Exchange Act of 1934 and the US Investment Company Act of 1940 and all other rules, regulations and amendments thereof. We are not FDIC insured. We are not a licensed bank or a security firm.\"}', '2019-12-04 01:16:27', '2019-12-04 01:16:27'),
(35, 'rules', '{\"body\":\"All the data giving by a member to <strong> INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD <\\/strong>will be only privately used and not disclosed to any third parties. INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD is not responsible or liable for any loss of data.&nbsp;\"}', '2019-12-04 01:16:57', '2019-12-04 01:18:05'),
(37, 'company_policy', '{\"title\":\"Privacy\",\"body\":\"Privacy Policy\\r\\nUpdated March 3rd, 2021\\r\\n\\r\\nOur service isn\\u2019t set up to collect personal information about you. You can join LocalCryptos under a pseudonym and remain anonymous to us if you want.\\r\\n\\r\\nHowever, if we receive information that identifies you, this Privacy Policy tells you how we deal with it.\\r\\n\\r\\nPersonal information\\r\\nThis Privacy Policy concerns any personal information of yours which is provided to us.\\r\\n\\r\\nPersonal information is any information about an identified individual or an individual who is reasonably identifiable, whether the information is true or not and whether the information is recorded in a material form or not.\\r\\n\\r\\nLocalCryptos collects, uses, and discloses personal information in accordance with this Privacy Policy and the Privacy Act 1988 (Cth) (including the Australian Privacy Principles) (Privacy Act).\\r\\n\\r\\nWhat personal information do we collect and why?\\r\\nThe types of personal information we may collect include:\\r\\n\\r\\nfrom users who sign up for a LocalCryptos account \\u2013 email addresses, names (if used as a username), trade activity (such as amounts and local currencies), phone numbers, and information about a user\\u2019s response time. For tax purposes, we will also collect information about whether you are an Australian resident;\\r\\nfrom website visitors \\u2013 IP addresses, website preferences, traffic sources and device information;\\r\\nif you contact us with a query \\u2013 your contact details.\\r\\nIf we are not provided with the information that we request, then we may not be able to provide services to you or respond to your query.\\r\\n\\r\\nWe do not collect the content of your communications with other LocalCryptos users, unless required to do so to resolve a dispute or investigate an abuse report under the Service Terms. These communications are end-to-end encrypted so we cannot decipher or read them without an involved user\'s consent.\\r\\n\\r\\nThe personal information you provide us may be used for a number of purposes connected with our business operations, which include to:\\r\\n\\r\\nprovide the LocalCryptos services, including facilitating communications between LocalCryptos users;\\r\\nrespond to any requests from you;\\r\\nbetter understand your needs in relation to cryptocurrency trading;\\r\\ndevelop and improve the quality and scope of the services we provide, and seek your feedback;\\r\\nstore choices you previously have made on the site, including when you are not logged in, to improve your experience;\\r\\nbetter understand our how website visitors use the website and how LocalCryptos users use the service; and\\r\\nto send you marketing messages about our products and services.\\r\\nWe may send you messages by email, SMS, or push notification, with updates about our services, news related to cryptocurrency or decentralised finance, and marketing messages. You always have the right to opt-out of receiving such information. You may exercise that right by clicking the \\\"unsubscribe\\\" link in a message we send you, or contacting us using the details below.\\r\\n\\r\\nWe will not use your information for purposes other than those described above unless we have your consent or as permitted by law (including for law enforcement or public health and safety reasons).\\r\\n\\r\\nPassive information collection\\r\\nAs you navigate through this website, certain information can be passively collected (that is, gathered without you actively providing the information) through various technologies, such as cookies, internet tags or web beacons and navigational data collection. You can manage passive information collection settings in the settings of your browser.\\r\\n\\r\\nThis website may use and combine such passively collected information to provide better services to website visitors, customise the website based on your preferences, compile and analyse statistics and trends and otherwise administer and improve the website for your use.\\r\\n\\r\\nHow we collect your personal information\\r\\nWe generally collect personal information directly from you, for example through online forms or when you contact us.\\r\\n\\r\\nWe may also collect personal information through trade activity, server log files and passive information collection technologies.\\r\\n\\r\\nSharing your personal information\\r\\nWe also may disclose your personal information to:\\r\\n\\r\\nothers in accordance with a request made by you \\u2013 for example, if your username is your real name, then we will list this when you ask to be listed on the LocalCryptos marketplace;\\r\\nour third party service providers engaged by us to perform business and technology services, when reasonably required;\\r\\nlaw enforcement bodies \\u2013 both if required by a warrant or voluntarily if we suspect you have engaged in fraud or misuse; and\\r\\npersons to whom we are required by law to disclose information.\\r\\nWhen making disclosures to our service providers, we take reasonable steps to ensure that they are bound by privacy obligations.\\r\\n\\r\\nUnless you consent, we otherwise do not disclose your personal information to third parties.\\r\\n\\r\\nDoes my personal information leave Australia?\\r\\nWe will only send your personal information outside Australia:\\r\\n\\r\\nif we are authorised to do so by law;\\r\\nfor any of the purposes set out in this Privacy Policy (but only to parties that are subject to obligations in relation to personal information no less onerous than those in this Privacy Policy); or\\r\\nif you have consented to us doing so.\\r\\nIn the course of our ordinary business operations we commonly disclose personal information to third party service providers located in the United States, Canada, Hong Kong, Japan, and Seychelles.\\r\\n\\r\\nAccess and correction\\r\\nYou may request access to any of the personal information we hold about you by contacting us as specified below. We reserve the right to charge a reasonable fee for the costs of retrieval and supply of any requested information.\\r\\n\\r\\nWe will take all reasonable steps to ensure that the personal information we collect, use or disclose is accurate, complete and up to date. To ensure your personal information is accurate, please notify us of any errors or changes to your personal information and we will take appropriate steps to update or correct such information in our possession.\\r\\n\\r\\nStorage and security\\r\\nWe will take all reasonable precautions to safeguard your information from loss, misuse, unauthorised access, modification, disclosure or destruction. We may store your files as electronic records. We implement a range of electronic security measures to protect the personal information that we hold, including using secured databases using industry-standard network security practices.\\r\\n\\r\\nYou should keep in mind that no internet transmission is ever completely secure or error-free.\\r\\n\\r\\nLinks to other websites\\r\\nThis website may contain links or references to other websites to which this Privacy Policy may not apply. You should check their own privacy policies before providing your personal information.\\r\\n\\r\\nNotifiable data breaches scheme\\r\\nIn the event of any loss or unauthorised access or disclosure of your personal information that is likely to result in serious harm to you, we will investigate and notify you and the Australian Information Commissioner as soon as practicable, in accordance with the Privacy Act.\\r\\n\\r\\nComplaints\\r\\nIf you have any questions or concerns about our collection, use or disclosure of personal information, or if you believe we have not complied with this Privacy Policy or the Privacy Act, please contact us as set out below. We will investigate the complaint and determine whether a breach has occurred and what action, if any, to take.\\r\\n\\r\\nLocalCryptos takes all privacy complaints seriously and will aim to resolve any such complaint in a timely and efficient manner.\\r\\n\\r\\nLocalCryptos expects our procedures will deal fairly and promptly with your complaint. However, if you remain dissatisfied, you can also make a formal complaint with the Officer of the Australian Information Commissioner (which is the regulator responsible for privacy in Australia):\\r\\n\\r\\nOffice of the Australian Information Commissioner (OAIC) Complaints must be made in writing\\r\\n\\u260e\\t1300 363 992\\r\\n\\u2709\\tDirector of Compliance Office of the Australian Information Commissioner GPO Box 5218 Sydney NSW 2001\\r\\n\\u2022\\twww.oaic.gov.au\\r\\nHow to contact us\\r\\nIf you wish to exercise your right to opt-out of receiving our marketing materials, or you have any questions or concerns about this Privacy Policy or our information practices, please contact us at: contact@localcryptos.com\\r\\n\\r\\nChanges to this Privacy Policy\\r\\nOur Privacy Policy may change from time to time as updated on this website. Before providing us with personal information, please check this Policy on our website for any changes.\\r\\n\\r\\nThis Privacy Policy was last updated January 2020.\"}', '2019-12-04 01:32:52', '2021-03-29 20:52:28'),
(38, 'about', '{\"title\":\"ABOUT US\",\"details\":\"<p>Indice International Investment Corporate Company Limited is a legal investment company incorporated in the United Kingdom with headquarters in London. Any investor can easy to check the company registration details before making a decision on cooperation. For that, you should go to the CompaniesHouse website, the official registers of legal entities in the Great Britain. Then use either our company name \\u2013 \\u201cIndice International Investment Corporate Company Limited\\u201d or company registration number .<\\/p>\\r\\n                        <p>Indice International Investment Corporate Company Limited is a very experienced and promising organization in the field of trustee administration and long-haul ventures. The joining of distinctive systems and techniques add to income, gainful collaboration, and organized advancement. The most created territory of Indice International Investment Corporate Company Limited movement is multicurrency trading on the Forex market.<\\/p>\\r\\n                        <p>Since 2018, we offer the best conditions for financial specialists from Great England and will be prepared to see you among them. Various organization workers are proficient money related investigators and experienced specialists in remote trade trading and hypothesis with securities and shares of various UK organizations. They have all the information and abilities that are important to be required in beneficial trade and expand the benefit with sensible risk.<\\/p>\\r\\n                        <p>Specialists of Indice International Investment Corporate Company Limited organization have built up an exceptional trading the system in 2010 and from that point forward enhance it and adjust to the business sector that is always showing signs of change affected by numerous variables. Such the system gives stable and hazard free benefits for the organization and its accomplices furthermore permit us to satisfy all commitments, which are connected with convenient installments to financial specialists.<\\/p>\\r\\n                        <p>The organization specialized the division has put into practice one of a kind programming for multicurrency trading program mode. This helps us to track the development of value outlines, select ideal passages for Forex benefits and expand gainfulness. On the premise of this product, we have made a venture stage to get interests in resource administration and additionally for association with organization customers who look for the most proficient utilization of their cash and who need to get the best money related results. trading knowledge and basic examination are the bases of our trade, we likewise attempt to tolerate carefully our own particular standards of danger administration and direction the work of our merchant\'s group.<\\/p>\\r\\n                        <p>Indice International Investment Corporate Company Limited speculation specialists are certain about their capacities and making each push to accomplish generous results and get a steady wage in the long haul. We see how it\'s troublesome for novices to make progress without legitimate experience and satisfactory trading store for agreeable operation. That is the reason we welcome you to join our organization and appreciate the advantages of Forex trading with us. Our trade is a safe and profitable at the same time, it includes intraday trades with popular currency instruments. Any of you can become our investor. We offer favorable conditions and low requirements for deposit.<\\/p>\\r\\n                        <p>You can use the popular electronic payment methods for your investments : We accept Perfect Money, Payeer and BTC as well. The minimum you can start with is just $30.<\\/p>\\r\\n                        <p>Please check the green address bar in your browser each time you visit the website of Indice International Investment Corporate Company Limited. This is the key to the security of your personal data as well as of your financial funds. Always check the \\u201cGreen Status Bar\\u201d<\\/p>\"}', NULL, '2019-12-04 05:18:09'),
(39, 'contact', '{\"title\":\"Contact With Us\",\"short_details\":\"Lorem ipsum dolor sit amet.\",\"email_address\":\"example@mail.com\",\"contact_details\":\"130 Hollister Church Rd, Palatka\",\"contact_number\":\"+01800 000 000\",\"latitude\":\"23.8715532\",\"longitude\":\"90.3793906\",\"website_footer\":\"<br>\"}', NULL, '2020-01-29 06:58:40'),
(41, 'blog.post', '{\"title\":\"HOW TO DEPOSIT & WITHDRAW INDICE INTERNATIONAL INVESTMENT CORPORATE COMPANY LTD\",\"body\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\",\"image\":\"604f5ca002f381615813792.png\"}', '2019-12-21 06:02:23', '2021-03-15 18:09:52'),
(42, 'homecontent', '{\"title\":\"Revolutionary Money Making Platform!\",\"featured_title\":\"Investment Plans\",\"site_information\":\"Statistics\",\"transaction_title\":\"Latest Transactions\",\"details\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum reiciendis obcaecati, veniam laborum quam quaerat veritatis doloremque voluptatum necessitatibus nihil quibusdam culpa perspiciatis aperiam minus laboriosam similique, dignissimos ratione accusamus.\",\"can_see_featured\":1,\"can_see_trx\":1,\"can_see_map\":1,\"can_see_info\":1,\"we_accept\":1,\"subscription_form\":1,\"image\":\"home01.png\",\"dragon\":\"dragon.png\",\"map\":\"map.png\"}', NULL, '2020-01-29 06:32:01'),
(44, 'testimonial', '{\"author\":\"FAHAD FOYEEZ\",\"designation\":\"Coder, TSK\",\"quote\":\"Lorem ipsum dolor sit amet, Mattis vestibulum elit omnis metus, eu urna at facilisi lobortis elementum turpis, vel sed molestie, varius purus rhoncus, morbi vitae purus. Pellentesque magna sagittis spendisse dolores purus nec, eleifend bibendum libero, feugiat nunc urna erat adipiscing nec varius.\",\"image\":\"60266b3434e631613130548.jpg\"}', '2020-01-21 07:15:12', '2021-02-12 16:49:08'),
(47, 'blog.caption', '{\"title\":\"News\",\"short_details\":\"Our Latest News & Blog\"}', NULL, '2021-02-19 14:04:53'),
(48, 'testimonial.caption', '{\"title\":\"appy Investor What Say About Our Banking\"}', NULL, '2020-01-21 12:05:05'),
(50, 'services', '{\"title\":\"100% Protected\",\"details\":\"Egestas erat massa id ptesqueat eget miet, nec dapibus i vivamus ultricies. laoreet erat eget porttitor maurimmy eu, eget penatibu tellus morb.\",\"image\":\"60618ff6486e41617006582.png\"}', '2020-01-21 09:51:46', '2021-03-29 13:29:42'),
(51, 'services', '{\"title\":\"Quick withdrawal\",\"details\":\"Egestas erat massa id ptesqueat eget miet, nec dapibus i vivamus ultricies. laoreet erat eget porttitor maurimmy eu, eget penatibu tellus morb.\",\"image\":\"60618f51c3ff91617006417.png\"}', '2020-01-21 09:52:03', '2021-03-29 13:26:58'),
(52, 'services', '{\"title\":\"Reliable platform\",\"details\":\"Egestas erat massa id ptesqueat eget miet, nec dapibus i vivamus ultricies. laoreet erat eget porttitor maurimmy eu, eget penatibu tellus morb.\",\"image\":\"60618f9b306261617006491.png\"}', '2020-01-21 09:52:18', '2021-03-29 13:28:11'),
(53, 'about.minimul', '{\"title\":\"ABOUT US\",\"details\":\"regionalCryptos p2p Exchange allows you to buy and sell your favorite cryptocurrency using any payment method, from anywhere in the world! Unlike other p2p exchanges and bitcoin exchanges in general, regionalcryptos offers more Cryptos, such as , Litecoin (LTC), dash coin (DSH) and more! Furthermore we offers the lowest fee than any other exchange in the P2P market, enhanced anonymity and security on your p2p trades! Traders can pay 0.9% fee per completed trade.\",\"commission_title\":null,\"commission_details\":null,\"commission_link\":null,\"investor_title\":null,\"investor_details\":null,\"statistics_title\":null,\"statistics_details\":null,\"about\":null}', NULL, '2021-03-29 20:48:48'),
(54, 'homecontent2', '{\"title\":\"Cryptomium\",\"details\":\"We Make It Easy For You.. No Whales...No Dips In Price...Just All The Way Up.\",\"plan_title\":null,\"plan_sub_title\":null,\"invest_title\":null,\"invest_sub_title\":null,\"profit_title\":null,\"profit_sub_title\":null,\"trx_title\":null,\"trx_sub_title\":null,\"step\":\"Get started in a few minutes\",\"step1\":\"Link your bank account Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.\",\"step2\":\"Create an account Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.\",\"step3\":\"Start buying & selling Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.\",\"f1\":\"Create your cryptocurrency wallet today\",\"f11\":\"BULLRUN has a variety of features that make it the best place to start trading and keeping your cryptos\",\"f2\":\"Buy and sell popular digital currencies, keep track of them in the one place.\",\"f3\":\"Invest in cryptocurrency slowly over time by scheduling buys daily, weekly, or monthly.\",\"f4\":\"For added security, store your funds in a vault with time delayed withdrawals.\",\"f5\":\"Stay on top of the markets with the BULLRUN app for Android or iOS.\",\"g1\":\"24-hour statistics\",\"g2\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere odit fuga nesciunt similique rerum nulla asperiores ullam deserunt architecto inventore.\",\"g3\":\"27 %\",\"g4\":\"73%\",\"g5\":\"200000000\",\"g6\":\"BTC & BNB\",\"g7\":\"4000\",\"g8\":\"5 Mins\",\"abouthead\":\"About Header\",\"aboutsubhead\":\"Trade Bitcoin, ETH, and hundreds of other cryptocurrencies in minutes.\",\"aboutbody\":\"About US Body\",\"problemheader\":\"The fasted and safest way to buy and store your token on the blockchain network\",\"problemsubheader\":\"The fasted and safest way to buy and store your token on the blockchain network\",\"problem\":\"Different pieces of the new Internet are born as building blocks, but there\\u2019s no way for them to work together.  Even interoperating new technologies with old centralised resources can prove useful in making the paradigm shift from Web 2 to Web 3 happen. Now we own our data, we can prove that we own what we have and have created it on different platforms, but how do we put it together into a whole new cohesive framework.\",\"solution\":\"Solution Body\",\"whitepaperheader\":\"The fasted and safest way to buy and store your token on the blockchain network\",\"whitepapersubheader\":\"The fasted and safest way to buy and store your token on the blockchain network\",\"whitepaperbody\":\"Body\",\"mobileappheader\":\"Download Our App\",\"mobileappsubheader\":\"A cryptocurrency wallet stores the public and private keys which can be used to receive or spend the cryptocurrency. A wallet can contain multiple public and private key pairs.\",\"mobileappbody\":\"Mobile APP Body\",\"roadmapheader\":\"Road Map\",\"roadmapsubheader\":\"Roadmap Body\",\"f112\":\"f112.png\",\"image\":\"banner01.png\",\"mobileappimage\":\"mobileappimage.png\",\"solutionimage\":\"solutionimage.png\",\"problemimage\":\"problemimage.png\",\"aboutimage\":\"aboutimage.png\"}', NULL, '2021-06-15 15:07:08'),
(55, 'profit.caption', '{\"has_image\":\"1\",\"title\":\"How To Get Profit.\",\"short_details\":\"Sodales integer. Eleifend elit hendrerit cras dui pretium. Vestibulum ut consectetuera hymenaeos tempor facilisi world class hyip investment.\",\"image\":\"5e27feeed243f1579679470.png\"}', NULL, '2020-01-22 08:04:39'),
(56, 'profit', '{\"has_image\":\"1\",\"title\":\"Create Account\",\"image\":\"5e27efbc403011579675580.png\"}', '2020-01-22 06:46:20', '2020-01-22 06:46:20'),
(57, 'profit', '{\"has_image\":\"1\",\"title\":\"Choose Plan\",\"image\":\"5e27effa8517a1579675642.png\"}', '2020-01-22 06:47:22', '2020-01-22 06:47:22'),
(58, 'profit', '{\"has_image\":\"1\",\"title\":\"Investment\",\"image\":\"5e27f00a896ea1579675658.png\"}', '2020-01-22 06:47:38', '2020-01-22 06:47:38'),
(59, 'profit', '{\"title\":\"Get Profit\",\"image\":\"5e27f01a4103d1579675674.png\"}', '2020-01-22 06:47:54', '2020-01-22 08:06:33'),
(61, 'feature.caption', '{\"has_image\":\"1\",\"title\":\"Our Features\",\"short_details\":\"Sodales integer. Eleifend elit hendrerit cras dui pretium. Vestibulum ut consectetuera hymenaeos tempor facilisi world class hyip investment.\",\"image\":\"5e28133aae42b1579684666.png\"}', NULL, '2020-01-22 09:17:46'),
(62, 'feature', '{\"title\":\"Protected Website\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:22:11', '2020-01-22 09:22:11'),
(63, 'feature', '{\"title\":\"Registered Company\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:23:43', '2020-01-22 09:23:43'),
(64, 'feature', '{\"title\":\"Strong Protection\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:23:54', '2020-01-22 09:23:54'),
(65, 'feature', '{\"title\":\"Comodo SSL\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:24:04', '2020-01-22 09:24:04'),
(66, 'feature', '{\"title\":\"Quick Withdrawal\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:24:24', '2020-01-22 09:24:24'),
(67, 'feature', '{\"title\":\"Reliable\",\"short_details\":\"Egestas erat massa id ptesqueat eget mi et, nec dapibus i vivamus ultricies. laoreet erat eget\"}', '2020-01-22 09:24:54', '2020-01-22 09:24:54'),
(68, 'company_policy', '{\"title\":\"Terms\",\"body\":\"sdjhksdjfgdjksghjskdghjdksghdsjkhgdjskghdsjkhgdsjkghsdjkhgsd\"}', '2021-02-02 14:35:00', '2021-02-02 14:35:00'),
(69, 'blog.post', '{\"title\":\"Mobile application development coming soon\",\"body\":\"We are proud to announce that our mobile application will be available to all users\",\"image\":\"604fe1b8454291615847864.png\"}', '2021-02-12 15:00:55', '2021-03-17 15:48:45'),
(70, 'services', '{\"title\":\"Facebok\",\"details\":\"safasfafs\",\"image\":\"606190192cdc91617006617.png\"}', '2021-02-12 15:40:24', '2021-03-29 13:30:17'),
(71, 'services', '{\"title\":\"Instagram\",\"details\":\"klhjgljgljglglkg\",\"image\":\"60618f75eab471617006453.png\"}', '2021-02-12 15:44:51', '2021-03-29 13:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `parameter_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `name`, `alias`, `image`, `status`, `parameter_list`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 101, 'Paypal', 'Paypal', '5d985257a92911570263639.jpg', 0, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"i@abir.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, 'PayPal allows customers to establish an account on its platform, which is connected to a user\'s credit card or checking account. PayPal is a fast, simple, and secure way to make a payment online.', '2019-09-14 13:14:22', '2021-03-17 04:40:47'),
(2, 102, 'Perfect Money', 'Perfect Money', '5d985267e2ee31570263655.jpg', 0, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"6451561651551dfgdfhhth\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, 'Paytm is largest mobile payments and commerce platform. It started with online mobile recharge and bill payments and has an online marketplace today. To keep things at ease, you can also use Paytm Wallet.', '2019-09-14 13:14:22', '2021-03-17 04:40:43'),
(3, 103, 'Stripe', 'Stripe', '5d98527da9ede1570263677.jpg', 0, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, 'Stripe is a third-party payments processor built around a simple idea: make it easy for companies to do business online.', '2019-09-14 13:14:22', '2021-03-17 04:40:52'),
(4, 104, 'Skrill', 'Skrill', '5d985288936bd1570263688.jpg', 0, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"TheSoftKing\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, 'Skrill is one of the most popular electronic payment systems in the world. In addition to rapid processing of payments and low commissions, the system’s advantages include the ability to use credit cards. Making a deposit using Skrill is possible through a form in the Personal Account.', '2019-09-14 13:14:22', '2021-03-17 04:41:12'),
(5, 105, 'PayTM', 'PayTM', '5d9852b9c57da1570263737.jpg', 0, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, 'Paytm is largest mobile payments and commerce platform. It started with online mobile recharge and bill payments and has an online marketplace today. To keep things at ease, you can also use Paytm Wallet.', '2019-09-14 13:14:22', '2021-03-17 04:41:02'),
(6, 106, 'Payeer', 'Payeer', '5d9852d61a60d1570263766.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"1320778801\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"123\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.g106\"}}', 'Payeer is one of the many e-wallets available for use on betting sites. As mentioned, the payment gateway allows deposits through various methods.', '2019-09-14 13:14:22', '2021-03-17 04:37:39'),
(7, 107, 'PayStack', 'PayStack', '5d9852ee227461570263790.jpg', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.g107\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.g107\"}}\r\n', 'Paystack, a widely popular payment gateway for African business, facilitates to accept secure online payments. The payment gateway allows the businesses registered in Africa to accept the payments from global customers.', '2019-09-14 13:14:22', '2021-05-01 03:03:43'),
(8, 108, 'VoguePay', 'VoguePay', '5d9852faa21731570263802.jpg', 0, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, 'VoguePay is an online payment gateway allows site owners to receive payment for their goods and services on their website without any setup fee for both local and International payments', '2019-09-14 13:14:22', '2021-03-17 04:41:23'),
(9, 109, 'Flutterwave', 'Flutterwave', '5d9853f5ce5f61570264053.jpg', 0, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"FLWPUBK_TEST-6973a7e9de42fd1e19e8ab8c73c5fdc3-X\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"FLWSECK_TEST-cf178fc7bd6c062714154865dae473d6-X\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"FLWSECK_TEST7f1b3153673e\"}}', '{\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}', 0, NULL, 'Its process credit card and local alternative payments, like mobile money and ACH, across Africa. They make it possible for global merchants to process payments like a local African company.', '2019-09-14 13:14:22', '2021-05-03 12:41:42'),
(10, 110, 'RazorPay', 'RazorPay', '5d9854adb0e101570264237.jpg', 0, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, 'Razor’s payment gateway is one of the most ambitious in its sector. Razorpay allows online businesses to accept, process and disburse digital payments through several payment modes like debit cards, credit cards, net banking, UPI and prepaid digital wallets.', '2019-09-14 13:14:22', '2021-03-17 04:42:03'),
(11, 111, 'Stripe JS', 'Stripe JS', '5d9855a3c43381570264483.jpg', 0, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, 'Stripe JS is a third-party payments processor built around a simple idea: make it easy for companies to do business online. It’s not just about processing credit cards. Stripe JS primarily targets developers with a suite of tools that make it nearly effortless to handle everything from in-app payments to marketplace transactions.', '2019-09-14 13:14:22', '2021-03-17 04:40:37'),
(12, 112, 'Instamojo', 'Instamojo', '5d9855d1485701570264529.png', 0, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, 'Instamojo Payment Gateway in PHP As for indian Payment Gateway. It provides many solutions like test environment and signup process also is simple.', '2019-09-14 13:14:22', '2021-03-17 04:41:31'),
(13, 501, 'Blockchain', 'Blockchain', '5d98566ba7b2b1570264683.jpg', 0, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"8df2e5a0-3798-4b74-871d-973615b57e7b\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CXLqfWXj1xgXe79nEQb3pv2E7TGD13pZgHceZKrQAxqXdrC2FaKuQhm5CYVGyNcHLhSdWau4eQvq3EDCyayvbKJvXa11MX9i2cHPugpt3G\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, 'Blockchain has been able to give under banked groups access to money, allows people to make cross-border payments and uses smart contracts to act as a means towards faster and safer payment processing', '2019-09-14 13:14:22', '2021-03-17 04:42:21'),
(14, 502, 'Block.io', 'Block.io', '5d98580ee98ed1570265102.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"amarvai2020\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.g502\"}}', 'This method provides exponentially higher security for your Wallets and applications than single-signature addresses. This way, you spend coins yourself, without trusting Block.io with your credentials.', '2019-09-14 13:14:22', '2021-04-16 04:38:20'),
(15, 503, 'CoinPayments', 'CoinPayments', '5d985d51661061570266449.jpg', 0, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"7638eebaf4061b7f7cdfceb14046318bbdabf7e2f64944773d6550bd59f70274\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"Cb6dee7af8Eb9E0D4123543E690dA3673294147A5Dc8e7a621B5d484a3803207\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, 'CoinPayments is a cloud wallet solution that offers an easy way to integrate a checkout system for numerous cryptocurrencies. Its website offers payment solutions for multiple crypto-currencies such as bitcoin and litecoin.', '2019-09-14 13:14:22', '2021-03-17 04:40:18'),
(16, 504, 'CoinPayments Fiat', 'CoinPayments Fiat', '5d985d5aef47b1570266458.jpg', 0, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, 'This is the same gateway as CoinPayments but we used fiat currency as calculation currency.', '2019-09-14 13:14:22', '2021-03-17 04:43:04'),
(17, 505, 'Coingate', 'Coingate', '5d985d66805591570266470.jpg', 0, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, 'CoinGate Bitcoin Payment Processor is an online cryptocurrency platform that provides merchant services to businesses and individuals', '2019-09-14 13:14:22', '2021-03-17 04:43:27'),
(18, 506, 'Coinbase Commerce', 'Coinbase commerce', '5d985d7d8fcc91570266493.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"d2e14051-7224-42b0-a9f7-16d6d66c8e30\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"fe35c5d5-76cb-4806-8ee0-84592db3183f\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.g506\"}}', 'Coinbase Commerce allows merchants to accept cryptocurrency payments in Bitcoin, Bitcoin Cash, Ethereum and Litecoin.', '2019-09-14 13:14:22', '2021-03-17 02:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percent_charge` decimal(8,4) NOT NULL DEFAULT 0.0000,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_currencies`
--

INSERT INTO `gateway_currencies` (`id`, `name`, `currency`, `symbol`, `method_code`, `min_amount`, `max_amount`, `percent_charge`, `fixed_charge`, `rate`, `image`, `parameter`, `created_at`, `updated_at`) VALUES
(23, 'FCMB', 'NGN', 'NGN', 1001, '1.00000000', '100.00000000', '1.0000', '1.00000000', '1.00000000', '6025a2ea791ce1613079274.png', '[]', '2021-02-03 07:03:19', '2021-02-12 02:34:34'),
(33, 'Stripe', 'USD', '$', 103, '1.00000000', '100000.00000000', '0.0000', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\",\"publishable_key\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}', '2021-02-12 02:16:02', '2021-02-12 02:16:02'),
(34, 'Skrill', 'USD', '$', 104, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"pay_to_email\":\"merchant@skrill.com\",\"secret_key\":\"TheSoftKing\"}', '2021-02-12 02:16:20', '2021-02-12 02:16:20'),
(35, 'PayTM', 'USD', '$', 105, '1.00000000', '1000.00000000', '0.0000', '1.00000000', '1.00000000', NULL, '{\"MID\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2021-02-12 02:16:44', '2021-02-12 02:16:44'),
(38, 'PayStack', 'NGN', 'N', 107, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"public_key\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\",\"secret_key\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}', '2021-02-12 02:17:47', '2021-02-12 02:17:47'),
(39, 'Vogue', 'EUR', '#', 108, '100.00000000', '1000.00000000', '1.0000', '1.00000000', '890.00000000', NULL, '{\"merchant_id\":\"demo\"}', '2021-02-12 02:18:08', '2021-02-12 02:18:08'),
(41, 'Razor', 'INR', 'R', 110, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '300.00000000', NULL, '{\"key_id\":\"rzp_test_kiOtejPbRZU90E\",\"key_secret\":\"osRDebzEqbsE1kbyQJ4y0re7\"}', '2021-02-12 02:18:50', '2021-02-12 02:18:50'),
(43, 'Stripe JS', 'USD', '$', 111, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\",\"publishable_key\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}', '2021-02-12 02:19:46', '2021-02-12 02:19:46'),
(44, 'Instamojo', 'INR', 'I', 112, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"api_key\":\"test_2241633c3bc44a3de84a3b33969\",\"auth_token\":\"test_279f083f7bebefd35217feef22d\",\"salt\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}', '2021-02-12 02:20:06', '2021-02-12 02:20:06'),
(45, 'Blockchain', 'BTC', 'B', 501, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"api_key\":\"8df2e5a0-3798-4b74-871d-973615b57e7b\",\"xpub_code\":\"xpub6CXLqfWXj1xgXe79nEQb3pv2E7TGD13pZgHceZKrQAxqXdrC2FaKuQhm5CYVGyNcHLhSdWau4eQvq3EDCyayvbKJvXa11MX9i2cHPugpt3G\"}', '2021-02-12 02:20:23', '2021-02-12 02:20:23'),
(48, 'Coinpayments', 'BTC', 'B', 503, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"public_key\":\"7638eebaf4061b7f7cdfceb14046318bbdabf7e2f64944773d6550bd59f70274\",\"private_key\":\"Cb6dee7af8Eb9E0D4123543E690dA3673294147A5Dc8e7a621B5d484a3803207\",\"merchant_id\":\"93a1e014c4ad60a7980b4a7239673cb4\"}', '2021-02-12 02:21:25', '2021-02-12 02:21:25'),
(49, 'Coinpayments Fiat', 'USD', '$', 504, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"merchant_id\":\"93a1e014c4ad60a7980b4a7239673cb4\"}', '2021-02-12 02:21:47', '2021-02-12 02:21:47'),
(50, 'Coingate', 'USD', '$', 505, '1.00000000', '10000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"api_key\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}', '2021-02-12 02:22:08', '2021-02-12 02:22:08'),
(52, 'fasfasfasds', '12', '12', 1002, '1.00000000', '1.00000000', '1.0000', '1.00000000', '124.00000000', '6025a5d0f41351613080016.jpg', '[]', '2021-02-12 02:46:57', '2021-02-12 02:46:57'),
(55, 'Coinbase Commerce', 'USD', '$', 506, '1.00000000', '1000.00000000', '0.5000', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"d2e14051-7224-42b0-a9f7-16d6d66c8e30\",\"secret\":\"fe35c5d5-76cb-4806-8ee0-84592db3183f\"}', '2021-03-17 02:20:51', '2021-03-17 02:20:51'),
(56, 'Payeer', 'USD', '$', 106, '1.00000000', '10000.00000000', '0.2000', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"1320778801\",\"secret_key\":\"123\"}', '2021-03-17 04:37:39', '2021-03-17 04:37:39'),
(57, 'Payeer', 'USD', '$', 106, '1.00000000', '10000.00000000', '0.2000', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"1320778801\",\"secret_key\":\"123\"}', '2021-03-17 04:37:39', '2021-03-17 04:37:39'),
(58, 'Block', 'BTC', 'B', 502, '1.00000000', '10000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"api_pin\":\"amarvai2020\",\"api_key\":\"23523523623623623\"}', '2021-04-16 04:36:39', '2021-04-16 04:36:39'),
(59, 'Flutterwave', 'NGN', 'N', 109, '1.00000000', '1000.00000000', '0.0000', '0.00000000', '1.00000000', NULL, '{\"public_key\":\"FLWPUBK_TEST-6973a7e9de42fd1e19e8ab8c73c5fdc3-X\",\"secret_key\":\"FLWSECK_TEST-cf178fc7bd6c062714154865dae473d6-X\",\"encryption_key\":\"FLWSECK_TEST7f1b3153673e\"}', '2021-05-03 12:41:42', '2021-05-03 12:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sitename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `efrom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email sent from',
  `etemp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email template',
  `smsapi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sms api',
  `bclr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Base Color',
  `sclr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Secondary Color',
  `ev` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sv` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `social_login` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'social login',
  `reg` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'allow registration',
  `alert` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => none, 1 => iziToast, 2 => toaster',
  `demo` int(1) DEFAULT NULL,
  `timeout` int(88) DEFAULT NULL,
  `active_template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'active template folder name',
  `deposit_commission` tinyint(4) NOT NULL DEFAULT 1,
  `invest_commission` tinyint(4) NOT NULL DEFAULT 1,
  `invest_return_commission` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `cur_text`, `cur_sym`, `efrom`, `etemp`, `smsapi`, `bclr`, `sclr`, `ev`, `en`, `mail_config`, `sv`, `sn`, `social_login`, `reg`, `alert`, `demo`, `timeout`, `active_template`, `deposit_commission`, `invest_commission`, `invest_return_commission`, `created_at`, `updated_at`) VALUES
(1, 'Cryptomium', 'USD', '$', 'help@email.com', '\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<meta http-equiv=\"Content-Type\" content=\"text/html charset=UTF-8\" />\r\n<html lang=\"en\">\r\n  <head>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <title>Thank you for Registering</title>\r\n    <style type=\"text/css\">\r\n      /* PUT ALL CSS IN THE EMAIL <HEAD>\r\n\r\nThese styles are meant for clients that recognize CSS in the <head>; the email WILL STILL WORK for those that don\'t. */\r\n\r\n      #outlook a {\r\n        padding: 0;\r\n      }\r\n      body {\r\n        width: 100% !important;\r\n        background-color: #f4f7fa;\r\n        -webkit-text-size-adjust: none;\r\n        -ms-text-size-adjust: none;\r\n        margin: 0 !important;\r\n        padding: 0 !important;\r\n      }\r\n      .ReadMsgBody {\r\n        width: 100%;\r\n      }\r\n      .ExternalClass {\r\n        width: 100%;\r\n      }\r\n      ol li {\r\n        margin-bottom: 15px;\r\n      }\r\n\r\n      img {\r\n        height: auto;\r\n        line-height: 100%;\r\n        outline: none;\r\n        text-decoration: none;\r\n      }\r\n      #backgroundTable {\r\n        height: 100% !important;\r\n        margin: 0;\r\n        padding: 0;\r\n        width: 100% !important;\r\n      }\r\n\r\n      p {\r\n        margin: 1em 0;\r\n      }\r\n\r\n      h1,\r\n      h2,\r\n      h3,\r\n      h4,\r\n      h5,\r\n      h6 {\r\n        color: #222222 !important;\r\n        font-family: Arial, Helvetica, sans-serif;\r\n        line-height: 100% !important;\r\n      }\r\n\r\n      table td {\r\n        border-collapse: collapse;\r\n      }\r\n\r\n      .yshortcuts,\r\n      .yshortcuts a,\r\n      .yshortcuts a:link,\r\n      .yshortcuts a:visited,\r\n      .yshortcuts a:hover,\r\n      .yshortcuts a span {\r\n        color: black;\r\n        text-decoration: none !important;\r\n        border-bottom: none !important;\r\n        background: none !important;\r\n      }\r\n\r\n      .im {\r\n        color: black;\r\n      }\r\n      div[id=\"tablewrap\"] {\r\n        width: 100%;\r\n        max-width: 600px !important;\r\n      }\r\n      table[class=\"fulltable\"],\r\n      td[class=\"fulltd\"] {\r\n        max-width: 100% !important;\r\n        width: 100% !important;\r\n        height: auto !important;\r\n      }\r\n\r\n      @media screen and (max-device-width: 430px),\r\n        screen and (max-width: 430px) {\r\n        td[class=\"emailcolsplit\"] {\r\n          width: 100% !important;\r\n          float: left !important;\r\n          padding-left: 0 !important;\r\n          max-width: 430px !important;\r\n        }\r\n        td[class=\"emailcolsplit\"] img {\r\n          margin-bottom: 20px !important;\r\n        }\r\n      }\r\n    </style>\r\n  </head>\r\n  <body>\r\n    <table style=\" width: 100%;\">\r\n      <tr>\r\n        <td />\r\n        <td valign=\"top\" style=\" width: 40%; min-width: 580px; text-align: center\">\r\n          <a\r\n            href=\"http://regionalcryptos.store\"\r\n            style=\"display:inline-block; text-align:center;\"\r\n          >\r\n            <img\r\n              src=\"http://trade.regionalcryptos.com.ng/assets/images/logo/logo.png\"\r\n              width=\"170\"\r\n            />\r\n          </a>\r\n        </td>\r\n        <td />\r\n      </tr>\r\n\r\n      <tr>\r\n        <td />\r\n        <td style=\" text-align: center;\">\r\n          <table\r\n            style=\"border-collapse: separate; border-radius: 4px; background-color: rgb(255, 255, 255);\"\r\n            width=\"100%\"\r\n            cellspacing=\"0\"\r\n            cellpadding=\"0\"\r\n          >\r\n            <tr>\r\n              <td height=\"20\"></td>\r\n            </tr>\r\n            <tr\r\n              style=\"color: rgb(78, 92, 110); font-size: 14px; line-height: 20px; margin-top: 20px;\"\r\n            >\r\n              <td\r\n                colspan=\"2\"\r\n                style=\"padding-left:90px; padding-right:90px; text-align:center\"\r\n                valign=\"top\"\r\n              >\r\n                <!-- BODY START -->\r\n                \r\n                <table>\r\n  <tr>\r\n    <td>\r\n  </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\"20\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td\r\n      style=\"text-align:center;\"\r\n      width=\"100%\"\r\n      bgcolor=\"#ffffff\"\r\n    >\r\n    {{message}}\r\n      <a\r\n        style=\"font-weight:bold; text-decoration:none;\"\r\n        href=\"https://www.regionalcryptos.store/login\"\r\n      >\r\n        <span\r\n          style=\"display:block; max-width:100% !important; width:93% !important; height:auto !important;background-color:#d3461e;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;border-radius:8px;color:#ffffff;font-size:24px;font-family:Arial, Helvetica, sans-serif;\"\r\n        >\r\n             Login\r\n        </span>\r\n      </a>\r\n    </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\"20\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td\r\n      style=\"margin: 0; color:#a2a2a2; font-size:12px; line-height:17px; font-style:italic;\"\r\n    >\r\n      \r\n    </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\"20\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"text-align: center;\">\r\n       \r\n    </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\"20\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td\r\n      style=\"margin: 0; color:#a2a2a2; font-size:12px; line-height:17px; font-style:italic;\"\r\n    >\r\n   Feel free to contact our customer\'s support representative if need be\r\n    </td>\r\n  </tr>\r\n</table>\r\n\r\n                <!-- BODY END -->\r\n              </td>\r\n            </tr>\r\n            <tr>\r\n              <td height=\"60\"></td>\r\n            </tr>\r\n          </table>\r\n        </td>\r\n        <td />\r\n      </tr>\r\n\r\n      <tr>\r\n        <td />\r\n        <td style=\" text-align: center; color:#9EB0C9!important;\">\r\n          <a\r\n            href=\"https://regionalcryptos.store/\"\r\n            target=\"_blank\"\r\n            style=\"text-decoration:none;\"\r\n            >© Regional Cryptos</a\r\n          >\r\n        </td>\r\n        <td />\r\n      </tr>\r\n    </table>\r\n  </body>\r\n</html>\r\n', 'aea771713397bae91584736378e2c648-b5e6fe75-39c5-499c-bf30-bcff05eda124', '#000000', 'd6d92b', 1, 1, '{\"name\":\"sendgrid\",\"appkey\":\"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\",\"sender\":\"help@regionalcryptos.store\"}', 0, 1, 1, 1, 1, 0, 30, 'minimul', 0, 0, 0, '2019-10-18 23:16:05', '2021-05-01 02:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `hodls`
--

CREATE TABLE `hodls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_amount` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_status` int(11) NOT NULL COMMENT '1 = ''%'' / 0 =''currency''',
  `times` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `capital_back_status` int(11) NOT NULL,
  `lifetime_status` int(11) NOT NULL,
  `repeat_time` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hodls`
--

INSERT INTO `hodls` (`id`, `name`, `minimum`, `maximum`, `fixed_amount`, `interest`, `interest_status`, `times`, `status`, `featured`, `capital_back_status`, `lifetime_status`, `repeat_time`, `created_at`, `updated_at`) VALUES
(4, 'Wells HODL', '100', '20000', '0', '10', 1, '720', 1, 0, 1, 0, '1', '2021-06-15 11:34:58', '2021-06-15 11:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `hodltrx`
--

CREATE TABLE `hodltrx` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `interest` decimal(11,2) NOT NULL DEFAULT 0.00,
  `period` int(11) NOT NULL,
  `hours` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_rec_time` int(11) NOT NULL DEFAULT 0,
  `next_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `capital_status` tinyint(1) NOT NULL COMMENT '1 = YES & 0 = NO',
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invests`
--

CREATE TABLE `invests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `interest` decimal(11,2) NOT NULL DEFAULT 0.00,
  `period` int(11) NOT NULL,
  `hours` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_rec_time` int(11) NOT NULL DEFAULT 0,
  `next_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `capital_status` tinyint(1) NOT NULL COMMENT '1 = YES & 0 = NO',
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `front` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(2, 'Germany', 'gr', '60a507ccdef3a1621428172.png', 0, 0, '2021-05-19 17:42:53', '2021-05-19 17:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(16, 'test@test.com', '826326', '2021-02-02 22:42:47'),
(18, 'regionalcryptos@gmail.com', '574598', '2021-03-19 22:43:18'),
(20, 'cryptotreenity@gmail.com', '553937', '2021-04-17 04:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Transfer', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(2, 'Paypal', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(3, 'Giftcard', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(4, 'Airtime', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(5, 'Perfect Money', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(6, 'Tron (crypto)', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(7, 'Payoner', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(8, 'ETH classic (crypto)', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(9, 'Money order', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(10, 'Chipper cash ', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(11, 'Cashapp', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(12, 'Zelle pay ', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55'),
(13, 'Cash in person ', 1, '2021-02-05 21:58:55', '2021-02-05 21:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_amount` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_status` int(11) NOT NULL COMMENT '1 = ''%'' / 0 =''currency''',
  `times` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `capital_back_status` int(11) NOT NULL,
  `lifetime_status` int(11) NOT NULL,
  `repeat_time` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `minimum`, `maximum`, `fixed_amount`, `interest`, `interest_status`, `times`, `status`, `featured`, `capital_back_status`, `lifetime_status`, `repeat_time`, `created_at`, `updated_at`) VALUES
(1, 'Bronze', '2', '2', '2', '15', 1, '72', 1, 1, 1, 0, '6', '2021-02-03 07:51:43', '2021-03-18 10:43:03'),
(2, 'Silver', '1000', '10000', '0', '25.5', 1, '48', 1, 1, 1, 0, '5', '2021-02-03 12:14:14', '2021-02-03 12:14:14'),
(3, 'MICRO', '1', '1', '1', '2', 1, '136', 1, 1, 1, 0, '11', '2021-02-11 19:49:07', '2021-04-16 04:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google-analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{app_key}}\");\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"ztPHrddJQjmU68_GYjf_hw\"}}', 'ganalytics.png', 1, '2019-10-18 23:16:05', '2021-03-18 17:25:26'),
(2, 'tawk-chat', 'Tawk Chat', 'Key location is shown bellow', 'tawky_big.png', '<script>\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\n                        (function(){\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\n                        s1.async=true;\n                        s1.src=\"https://embed.tawk.to/{{app_key}}/default\";\n                        s1.charset=\"UTF-8\";\n                        s1.setAttribute(\"crossorigin\",\"*\");\n                        s0.parentNode.insertBefore(s1,s0);\n                        })();\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"Demo\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2021-03-18 17:41:01'),
(3, 'google-recaptcha3', 'Google Recaptch 3', 'Key location is shown bellow', 'recaptcha3.png', '<script type=\"text/javascript\">\n\n                            var onloadCallback = function() {\n                                grecaptcha.render(\"recaptcha\", {\n                                    \"sitekey\" : \"{{sitekey}}\",\n                                    \"callback\": function(token) {\n                                        $(\"#recaptcha\").parents(\"form:first\").submit();\n                                    } \n                                });\n                            };\n                        </script>\n                        <script src=\"https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit\" async defer></script>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"6LfvhYQaAAAAAFRNOUnAeKsl0zNuIz5xTBXmC1yo\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2021-04-14 23:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `level`, `percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '56', 1, '2021-02-11 19:11:36', '2021-02-11 19:11:36'),
(2, 2, '6', 1, '2021-02-11 19:11:36', '2021-02-11 19:11:36'),
(3, 3, '7', 1, '2021-02-11 19:11:36', '2021-02-11 19:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `support_message_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `supportticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `supportticket_id`, `type`, `message`, `created_at`, `updated_at`) VALUES
(2, '2', 1, 'yrewterjkgbvbcgxgfdfgdytrutyiuolgj', '2021-05-01 07:10:49', '2021-05-01 07:10:49'),
(3, '2', 1, 'asdfsdb', '2021-05-01 07:49:14', '2021-05-01 07:49:14'),
(4, '2', 1, 'mjcchjgfghj', '2021-05-01 07:50:03', '2021-05-01 07:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `name`, `email`, `ticket`, `subject`, `status`, `department`, `priority`, `created_at`, `updated_at`) VALUES
(2, 14, 'Andrew Komolafe', 'Ibrahim@gmail.com', 'S-616544', 'This is a test mail', 2, 'Complaints', 'low', '2021-05-01 07:10:49', '2021-05-01 07:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `time_settings`
--

CREATE TABLE `time_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_settings`
--

INSERT INTO `time_settings` (`id`, `name`, `slug`, `time`, `created_at`, `updated_at`) VALUES
(5, 'Hourly', 'Hour', '1', '2021-06-15 11:19:38', '2021-06-15 11:20:16'),
(7, 'Daily', 'Days', '24', '2021-06-15 11:20:32', '2021-06-15 11:20:32'),
(8, 'Weekly', 'Weeks', '168', '2021-06-15 11:21:09', '2021-06-15 11:21:09'),
(9, 'Monthly', 'Months', '720', '2021-06-15 11:21:29', '2021-06-15 11:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `main_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `wallet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `rate` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `getamo` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_wallet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_amo` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoiceid` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeout` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trxes`
--

CREATE TABLE `trxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT 0.00,
  `main_amo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT 0.00,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refer` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passupdate` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `ev` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc` int(2) NOT NULL DEFAULT 0,
  `darkmode` int(2) DEFAULT 0,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `refer`, `password`, `passupdate`, `image`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `kyc`, `darkmode`, `provider`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 'Chris', 'Brown', 'test1234', 'test@test.com', '1234567890', NULL, '$2y$10$bIrYy63mFpc6sDvs/i.Rgexclo/fTp5mht7RN1wRHcG1uVzJrQGP.', NULL, NULL, '{\"address\":null,\"state\":null,\"zip\":null,\"country\":\"Albania\",\"city\":null}', 1, 1, 1, '635602', '2021-06-15 20:34:11', 0, 1, NULL, 0, 0, NULL, NULL, '2021-06-15 19:34:10', '2021-06-15 19:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `location`, `browser`, `os`, `long`, `lat`, `country`, `country_code`, `created_at`, `updated_at`) VALUES
(157, 14, '::1', '', 'Chrome', 'Mac OS X', NULL, NULL, NULL, NULL, '2021-06-15 10:50:10', '2021-06-15 10:50:10'),
(158, 14, '::1', '', 'Chrome', 'Mac OS X', NULL, NULL, NULL, NULL, '2021-06-15 17:57:33', '2021-06-15 17:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallets`
--

CREATE TABLE `user_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0.00000000',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wallets`
--

INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `type`, `status`, `created_at`, `updated_at`) VALUES
(32, 16, '0', 'deposit_wallet', 1, '2021-06-15 19:34:10', '2021-06-15 19:34:10'),
(33, 16, '0', 'interest_wallet', 1, '2021-06-15 19:34:10', '2021-06-15 19:34:10'),
(34, 16, '0', 'hodl_wallet', 1, '2021-06-15 19:34:10', '2021-06-15 19:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `wallet_id` int(11) DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(18,8) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '-1 = Default, 0 => pending, 1 => approved , 2 => reject	',
  `verify_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_limit` decimal(18,8) NOT NULL,
  `max_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_charge` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `percent_charge` decimal(5,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `image`, `min_limit`, `max_limit`, `delay`, `fixed_charge`, `rate`, `percent_charge`, `currency`, `user_data`, `description`, `verify_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bitcoin', '6050b24bc3e781615901259.png', '1.00000000', '1000000.00000000', '2', '1.00000000', '1.00000000', '1.00', 'USD', '[]', 'Withdrawal', 'Upload Proof', 1, '2021-02-03 07:26:43', '2021-03-16 18:27:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_logs`
--
ALTER TABLE `commission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_topics`
--
ALTER TABLE `contact_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptotrxs`
--
ALTER TABLE `cryptotrxs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_escrows`
--
ALTER TABLE `crypto_escrows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_offers`
--
ALTER TABLE `crypto_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_offers_trade`
--
ALTER TABLE `crypto_offers_trade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_ratings`
--
ALTER TABLE `crypto_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_trade_chat`
--
ALTER TABLE `crypto_trade_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_sms_templates_act_unique` (`act`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frontends_key_index` (`data_keys`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gateways_code_unique` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gateway_currencies_method_code_index` (`method_code`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hodls`
--
ALTER TABLE `hodls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hodltrx`
--
ALTER TABLE `hodltrx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invests`
--
ALTER TABLE `invests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plugins_act_unique` (`act`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_settings`
--
ALTER TABLE `time_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trxes`
--
ALTER TABLE `trxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallets`
--
ALTER TABLE `user_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdrawals_trx_unique` (`trx`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `commission_logs`
--
ALTER TABLE `commission_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_topics`
--
ALTER TABLE `contact_topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cryptotrxs`
--
ALTER TABLE `cryptotrxs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `crypto_escrows`
--
ALTER TABLE `crypto_escrows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `crypto_offers`
--
ALTER TABLE `crypto_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `crypto_offers_trade`
--
ALTER TABLE `crypto_offers_trade`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `crypto_ratings`
--
ALTER TABLE `crypto_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `crypto_trade_chat`
--
ALTER TABLE `crypto_trade_chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hodls`
--
ALTER TABLE `hodls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hodltrx`
--
ALTER TABLE `hodltrx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invests`
--
ALTER TABLE `invests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_settings`
--
ALTER TABLE `time_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trxes`
--
ALTER TABLE `trxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `user_wallets`
--
ALTER TABLE `user_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
