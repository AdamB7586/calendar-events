CREATE TABLE IF NOT EXISTS `lessons_calendar` (
  `calendar_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fino` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `pupil` int(11) UNSIGNED DEFAULT NULL,
  `event` text DEFAULT NULL,
  `transmission` tinyint(1) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`calendar_id`),
  KEY `date_between` (`start`,`end`),
  KEY `fino` (`fino`),
  KEY `pupil` (`pupil`),
  KEY `sms_sent` (`sms_sent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;