--
-- Table structure for table `#__forums2_forums`
--

CREATE TABLE IF NOT EXISTS `#__forums2_forums` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT 'forum',
  `path` varchar(200) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `ordering` int(4) NOT NULL DEFAULT '0',
  `topic_count` int(11) NOT NULL DEFAULT '0',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `last_post` int(11) NOT NULL DEFAULT '0',
  `params` longtext,
  `rules` text,
  PRIMARY KEY (`id`),
  KEY `last_post` (`last_post`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_posts`
--

CREATE TABLE IF NOT EXISTS `#__forums2_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `text` longtext,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `remote_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `published` (`published`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_posts_answers`
--

CREATE TABLE IF NOT EXISTS `#__forums2_posts_answers` (
  `post_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_posts_attachments`
--

CREATE TABLE IF NOT EXISTS `#__forums2_posts_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `vfilename` varchar(255) NOT NULL DEFAULT '',
  `comment` text,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `size` int(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_posts_reports`
--

CREATE TABLE IF NOT EXISTS `#__forums2_posts_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `reason` text,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_posts_votes`
--

CREATE TABLE IF NOT EXISTS `#__forums2_posts_votes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `unique_id` varchar(50) NOT NULL DEFAULT '',
  `params` longtext,
  `post_count` int(11) NOT NULL DEFAULT '0',
  `last_post` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `published` (`published`),
  KEY `last_post` (`last_post`),
  KEY `unique_id` (`unique_id`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics_favorites`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics_favorites` (
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`topic_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics_featured`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics_featured` (
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics_subscribers`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics_subscribers` (
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id_user_type` (`topic_id`,`user_id`),
  KEY `notified` (`notified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics_tags`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics_tags` (
  `tag_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_topics_track`
--

CREATE TABLE IF NOT EXISTS `#__forums2_topics_track` (
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `last_visit` datetime NOT NULL,
  PRIMARY KEY (`topic_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__forums2_users_profiles`
--

CREATE TABLE IF NOT EXISTS `#__forums2_users_profiles` (
  `user_id` int(11) NOT NULL,
  `params` text NOT NULL,
  `location` varchar(55) NOT NULL DEFAULT '',
  `avatar` varchar(15) NOT NULL DEFAULT '',
  `about` text,
  `signature` text,
  `website` varchar(250) NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `last_visit` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `post_count` int(11) NOT NULL DEFAULT '0',
  `vote_count` int(11) NOT NULL DEFAULT '0',
  `answer_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__pm_discussions`
--

CREATE TABLE IF NOT EXISTS `#__pm_discussions` (
  `id` varchar(25) NOT NULL,
  `subject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__pm_discussions_users`
--

CREATE TABLE IF NOT EXISTS `#__pm_discussions_users` (
  `discussion_id` varchar(25) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `last_read` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `discussion_user` (`discussion_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__pm_messages`
--

CREATE TABLE IF NOT EXISTS `#__pm_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` varchar(25) NOT NULL DEFAULT '0',
  `text` longtext,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `remote_address` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `discussion_id` (`discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__tags`
--

CREATE TABLE IF NOT EXISTS `#__tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(50) NOT NULL DEFAULT '',
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(3) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ordering` (`ordering`),
  KEY `published` (`published`),
  KEY `alias` (`alias`),
  KEY `public` (`public`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `#__forums2_posts`
--
-- ALTER TABLE `#__forums2_posts` ADD FULLTEXT KEY `text` (`text`);

--
-- Indexes for table `#__forums2_topics`
--
-- ALTER TABLE `#__forums2_topics` ADD FULLTEXT KEY `title` (`title`);