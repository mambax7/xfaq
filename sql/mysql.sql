
#
# Structure de la table `xfaq_topic`
#

CREATE TABLE `xfaq_topic` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `topic_pid` int(5) unsigned NOT NULL default "0",
  `topic_title` varchar(255) NOT NULL default "",
  `topic_desc` text NOT NULL,  
  `topic_img` varchar(255) NOT NULL default "",
  `topic_weight` int(5) NOT NULL default "0",
  `topic_submitter` int (10)   NOT NULL default "0",
  `topic_date_created` int (10)   NOT NULL default "0",
  `topic_online` tinyint (1)   NOT NULL default "0",
  PRIMARY KEY  (`topic_id`)
) TYPE=MyISAM;
#
# Table structure for table `xfaq_faq`
#
		
CREATE TABLE  `xfaq_faq` (
`faq_id` int (8)   NOT NULL  auto_increment,
`faq_question` text   NOT NULL ,
`faq_answer` text   NULL ,
`faq_topic` int (8)   NOT NULL ,
`faq_url` varchar (200)   NULL ,
`faq_open` tinyint (1)   NULL ,
`faq_ansUser` int (8)   NOT NULL ,
`faq_weight` int (11)   NULL ,
`faq_hit` int (11)   NULL ,
`faq_metas_keyword` text NOT NULL,
`faq_metas_desc` text NOT NULL,
`faq_howdoi` varchar(255) NOT NULL ,
`faq_diduno` text NOT NULL ,
`faq_date_answer` int (10)   NOT NULL,
`faq_submitter` int (10)   NOT NULL default '0',
`faq_date_created` int (10)   NOT NULL default '0',
`faq_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM;

