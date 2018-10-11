-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 年 10 朁E11 日 12:46
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpuser`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ext_users`
--

CREATE TABLE `ext_users` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'User-ID',
  `fb_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'facebook-ID',
  `stat` varchar(16) NOT NULL COMMENT 'ステイタス 有効/無効',
  `utype` varchar(20) NOT NULL COMMENT 'ユーザー種別',
  `email` varchar(128) NOT NULL COMMENT 'メールアドレス',
  `loginid` varchar(128) DEFAULT NULL,
  `passwd` varchar(128) NOT NULL COMMENT 'パスワード',
  `ac_ip` varchar(20) NOT NULL COMMENT 'アクセスIP',
  `sessid` varchar(256) NOT NULL COMMENT 'セッション',
  `ac_date` datetime NOT NULL COMMENT 'アクセス日時',
  `denycnt` tinyint(2) NOT NULL COMMENT 'ログイン失敗回数',
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザーログイン用情報';

--
-- テーブルのデータのダンプ `ext_users`
--

INSERT INTO `ext_users` (`id`, `fb_id`, `stat`, `utype`, `email`, `loginid`, `passwd`, `ac_ip`, `sessid`, `ac_date`, `denycnt`, `up_date`) VALUES
(1, NULL, '', 'admin', 'admin@test.com', NULL, '123', '', '', '0000-00-00 00:00:00', 0, '2018-10-08 05:10:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ext_users`
--
ALTER TABLE `ext_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ext_users`
--
ALTER TABLE `ext_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User-ID', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
