 *  Cloud Website

 * Just add this into your database :

 CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) NOT NULL,
  `mdp` text NOT NULL,
  `email` text NOT NULL,
  `avatar` text NOT NULL,
  `Bio` text NOT NULL,
  `rang` int(11) NOT NULL,
  `date_inscription` int(11) NOT NULL,
  `code_confirmation` text NOT NULL,
  `crypt_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;
