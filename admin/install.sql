CREATE TABLE IF NOT EXISTS `#__mlinks` (
  `sitename` varchar(100) NOT NULL default '',
  `sitelink` varchar(200) NOT NULL default '',
  `cat` int(4) NOT NULL default '0',
  `id` int(3) NOT NULL auto_increment,
  `sitedesc` varchar(255) NOT NULL default '',
  `access` smallint(6) NOT NULL default '0',
  `published` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `#__mlinks_track` (
  `mlt_id` bigint(20) NOT NULL auto_increment,
  `mlt_link` int(11) NOT NULL,
  `mlt_user` int(11) NOT NULL,
  `mlt_when` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `mlt_ip` varchar(15) NOT NULL,
  PRIMARY KEY  (`mlt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;