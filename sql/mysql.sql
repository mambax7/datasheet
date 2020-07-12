-- Tabulky ------------------------------------------------

CREATE TABLE `datasheet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `d_name` text,
  `d_file` text,
  `d_desc` text,
  `d_date` varchar(10),
  `d_count` varchar(10),
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- Naplneni tabulek daty ----------------------------------

INSERT INTO `datasheet` VALUES ('1' ,'Sample','Sample', 'Sample','0','0');