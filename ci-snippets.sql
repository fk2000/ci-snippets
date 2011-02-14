--
-- テーブルの構造 `sn_sessions`
--
CREATE TABLE IF NOT EXISTS `sn_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) DEFAULT CHARSET=utf8;

--
-- テーブルの構造 `sn_snippets`
--
CREATE TABLE IF NOT EXISTS `sn_snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `code` text NOT NULL,
  `code_type` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `invalid` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) DEFAULT CHARSET=utf8  ;
