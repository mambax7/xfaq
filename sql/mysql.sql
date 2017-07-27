#
# Structure de la table `xfaq_topic`
#

CREATE TABLE `xfaq_topic` (
  `topic_id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_pid`          INT(5) UNSIGNED  NOT NULL DEFAULT "0",
  `topic_title`        VARCHAR(255)     NOT NULL DEFAULT "",
  `topic_desc`         TEXT             NOT NULL,
  `topic_img`          VARCHAR(255)     NOT NULL DEFAULT "",
  `topic_weight`       INT(5)           NOT NULL DEFAULT "0",
  `topic_submitter`    INT(10)          NOT NULL DEFAULT "0",
  `topic_date_created` INT(10)          NOT NULL DEFAULT "0",
  `topic_online`       TINYINT(1)       NOT NULL DEFAULT "0",
  PRIMARY KEY (`topic_id`)
)
  ENGINE = MyISAM;
#
# Table structure for table `xfaq_faq`
#

CREATE TABLE `xfaq_faq` (
  `faq_id`            INT(8)       NOT NULL  AUTO_INCREMENT,
  `faq_question`      TEXT         NOT NULL,
  `faq_answer`        TEXT         NULL,
  `faq_topic`         INT(8)       NOT NULL,
  `faq_url`           VARCHAR(200) NULL,
  `faq_open`          TINYINT(1)   NULL,
  `faq_ansUser`       INT(8)       NOT NULL,
  `faq_weight`        INT(11)      NULL,
  `faq_hit`           INT(11)      NULL,
  `faq_metas_keyword` TEXT         NOT NULL,
  `faq_metas_desc`    TEXT         NOT NULL,
  `faq_howdoi`        VARCHAR(255) NOT NULL,
  `faq_diduno`        TEXT         NOT NULL,
  `faq_date_answer`   INT(10)      NOT NULL,
  `faq_submitter`     INT(10)      NOT NULL  DEFAULT '0',
  `faq_date_created`  INT(10)      NOT NULL  DEFAULT '0',
  `faq_online`        TINYINT(1)   NOT NULL  DEFAULT '0',
  PRIMARY KEY (`faq_id`)
)
  ENGINE = MyISAM;

