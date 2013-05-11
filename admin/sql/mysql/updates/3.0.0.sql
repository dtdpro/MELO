ALTER TABLE  `#__melo_links` CHANGE  `published`  `state` TINYINT( 1 ) NOT NULL DEFAULT  '1';

ALTER TABLE #__melo_links ADD `link_hits` int(11) NOT NULL DEFAULT '0',
ADD `checked_out` int(11) NOT NULL DEFAULT '0',
ADD `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD `created_by` int(10) unsigned NOT NULL DEFAULT '0',
ADD `created_by_alias` varchar(255) NOT NULL DEFAULT '',
ADD `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
ADD `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
  
ALTER TABLE  `#__melo_links` ADD INDEX  `idx_state` (  `state` );
ALTER TABLE  `#__melo_links` ADD INDEX  `idx_access` (  `access` );
ALTER TABLE  `#__melo_links` ADD INDEX  `idx_checkout` (  `checked_out` );
ALTER TABLE  `#__melo_links` ADD INDEX  `idx_catid` (  `link_cat` );
ALTER TABLE  `#__melo_links` ADD INDEX  `idx_createdby` (  `created_by` );

OPTIMIZE TABLE  `#__melo_links`;

DROP TABLE `#__melo_track`;