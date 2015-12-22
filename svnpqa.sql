-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2015 at 06:15 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svnpqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_action`
--

CREATE TABLE `access_action` (
  `id` int(10) NOT NULL COMMENT '主键',
  `uri` varchar(100) COLLATE utf8_bin DEFAULT '' COMMENT '权限控制URI',
  `desc` tinytext COLLATE utf8_bin NOT NULL COMMENT 'action 描述当前action功能'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='action';

--
-- Dumping data for table `access_action`
--

INSERT INTO `access_action` (`id`, `uri`, `desc`) VALUES
(45, '*', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `repository`
--

CREATE TABLE `repository` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` tinytext NOT NULL COMMENT '地址',
  `user` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源库';

--
-- Dumping data for table `repository`
--

INSERT INTO `repository` (`id`, `address`, `user`, `password`, `update_time`, `create_time`) VALUES
(2, 'http://svn.oa.com/Web/trunk', 'sasumi', 'sasumi123456', '2015-12-22 01:50:42', '2015-12-22 01:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_group_id` int(10) NOT NULL COMMENT '用户组',
  `name` varchar(32) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `real_name` varchar(45) NOT NULL COMMENT '真实姓名',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `last_login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `state` enum('0','1') NOT NULL DEFAULT '0' COMMENT '状态(禁用,启用)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_group_id`, `name`, `password`, `real_name`, `create_time`, `update_time`, `last_login_time`, `last_login_ip`, `state`) VALUES
(2, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '123', '0000-00-00 00:00:00', '2015-11-30 07:45:10', '2015-10-27 20:16:43', '', '1'),
(3, 2, 'user00', 'c4ca4238a0b923820dcc509a6f75849b', 'test', '0000-00-00 00:00:00', '2015-11-30 07:46:20', '2015-10-27 20:54:26', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '组名',
  `description` tinytext COMMENT '描述',
  `state` enum('0','1') NOT NULL DEFAULT '0' COMMENT '状态(禁用,启用)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组';

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `description`, `state`) VALUES
(1, '管理员', '管理员\r\n', '1'),
(2, '部门管理员', 'test', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_auth`
--

CREATE TABLE `user_group_auth` (
  `id` int(10) NOT NULL COMMENT '主键',
  `user_group_id` int(10) NOT NULL COMMENT '用户组',
  `action_id` int(10) NOT NULL COMMENT '权限',
  `type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '类型(白名单,黑名单)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户组权限';

--
-- Dumping data for table `user_group_auth`
--

INSERT INTO `user_group_auth` (`id`, `user_group_id`, `action_id`, `type`) VALUES
(24, 1, 45, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_action`
--
ALTER TABLE `access_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repository`
--
ALTER TABLE `repository`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_auth`
--
ALTER TABLE `user_group_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_action`
--
ALTER TABLE `access_action`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `repository`
--
ALTER TABLE `repository`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_group_auth`
--
ALTER TABLE `user_group_auth`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
