CREATE TABLE IF NOT EXISTS `#__melo_links` (
  `link_name` varchar(100) NOT NULL DEFAULT '',
  `link_alias` varchar(255) NOT NULL DEFAULT '',
  `link_url` varchar(200) NOT NULL DEFAULT '',
  `link_cat` int(4) NOT NULL DEFAULT '0',
  `link_id` int(3) NOT NULL AUTO_INCREMENT,
  `link_desc` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `#__melo_track` (
  `mlt_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mlt_link` int(11) NOT NULL,
  `mlt_user` int(11) NOT NULL,
  `mlt_when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mlt_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`mlt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;