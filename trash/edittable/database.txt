CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `tech` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `fname`, `lname`, `tech`, `email`, `address`) VALUES
(147, 'Nilesh', 'Shirgave', 'wordpress', 'nilesh@domain.com', 'Kolhapur'),
(148, 'Sandip', 'Patil', '.net', 'sandip@domain.com', 'Kolhapur'),
(149, 'Amit', 'Patil', 'php', 'amit@domain.com', 'Karad');