--
-- ��Ʈw�G `s44`
--

-- --------------------------------------------------------

--
-- ��ƪ��c `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- ��ƪ��ץX��� `accounts`
--

INSERT INTO `accounts` (`id`, `account`, `password`, `name`, `question`, `answer`) VALUES
(1, 'admin', '4321', '�޲z��', '�A�O��', '�޲z��'),
(10, 'abc', 'ddd', 'some', 'iam', 'handsome'),
(14, 'apple', 'google', 'mr. l arabia suger', 'IT', 'IT');

-- --------------------------------------------------------

--
-- ��ƪ��c `date`
--

CREATE TABLE IF NOT EXISTS `date` (
`id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- ��ƪ��c `floors`
--

CREATE TABLE IF NOT EXISTS `floors` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `r1` int(11) NOT NULL,
  `r2` int(11) NOT NULL,
  `r3` int(11) NOT NULL,
  `r4` int(11) NOT NULL,
  `r5` int(11) NOT NULL,
  `r6` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- ��ƪ��ץX��� `floors`
--

INSERT INTO `floors` (`id`, `name`, `r1`, `r2`, `r3`, `r4`, `r5`, `r6`) VALUES
(1, 'new floor', 1, 1, 1, 1, 1, 1),
(3, 'balaaaa floor', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- ��ƪ��c `reserves`
--

CREATE TABLE IF NOT EXISTS `reserves` (
`id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `date` date NOT NULL,
  `section` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

--
-- ��ƪ��ץX��� `reserves`
--

INSERT INTO `reserves` (`id`, `serial`, `date`, `section`, `floor`, `room`, `name`) VALUES
(93, 4846862, '2015-04-01', 0, 1, 1, 10),
(94, 8854949, '2015-04-01', 0, 1, 2, 10),
(95, 1220824, '2015-04-01', 2, 1, 2, 10),
(96, 5810912, '2015-04-04', 1, 3, 2, 10);

--
-- �w�ץX��ƪ�����
--

--
-- ��ƪ���� `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`);

--
-- ��ƪ���� `date`
--
ALTER TABLE `date`
 ADD PRIMARY KEY (`id`);

--
-- ��ƪ���� `floors`
--
ALTER TABLE `floors`
 ADD PRIMARY KEY (`id`);

--
-- ��ƪ���� `reserves`
--
ALTER TABLE `reserves`
 ADD PRIMARY KEY (`id`);

--
-- �b�ץX����ƪ�ϥ� AUTO_INCREMENT
--

--
-- �ϥθ�ƪ� AUTO_INCREMENT `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- �ϥθ�ƪ� AUTO_INCREMENT `date`
--
ALTER TABLE `date`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- �ϥθ�ƪ� AUTO_INCREMENT `floors`
--
ALTER TABLE `floors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- �ϥθ�ƪ� AUTO_INCREMENT `reserves`
--
ALTER TABLE `reserves`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
