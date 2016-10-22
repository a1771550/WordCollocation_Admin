-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2016 at 11:14 PM
-- Server version: 5.6.28-76.1-log
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kevinl57_wordcollocation`
--

-- --------------------------------------------------------

--
-- Table structure for table `collocation`
--

CREATE TABLE IF NOT EXISTS `collocation` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wordId` bigint(20) NOT NULL,
  `colWordId` bigint(20) NOT NULL,
  `CollocationPattern` int(11) NOT NULL,
  `RowVersion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `idx_id` (`Id`),
  KEY `collocation_colword__fk` (`colWordId`),
  KEY `collocation_word_Id_fk` (`wordId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `collocation`
--

INSERT INTO `collocation` (`Id`, `wordId`, `colWordId`, `CollocationPattern`, `RowVersion`) VALUES
(1, 1, 5, 2, '2016-10-03 08:58:10'),
(2, 3, 4, 3, '2016-10-03 08:58:10'),
(3, 61, 6, 6, '2016-10-03 08:58:10'),
(4, 61, 7, 6, '2016-10-03 08:58:10'),
(7, 1, 8, 3, '2016-10-03 08:58:10'),
(8, 1, 9, 2, '2016-10-03 08:58:10'),
(9, 1, 10, 2, '2016-10-03 08:58:10'),
(10, 61, 11, 6, '2016-10-03 08:58:10'),
(11, 61, 12, 6, '2016-10-03 08:58:10'),
(12, 61, 13, 6, '2016-10-03 08:58:10'),
(13, 14, 15, 2, '2016-10-03 08:58:10'),
(14, 16, 17, 3, '2016-10-03 08:58:10'),
(15, 16, 19, 6, '2016-10-03 08:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Entry` varchar(1000) NOT NULL,
  `EntryZht` varchar(1000) DEFAULT NULL,
  `EntryZhs` varchar(1000) DEFAULT NULL,
  `EntryJap` varchar(1000) DEFAULT NULL,
  `Source` smallint(6) DEFAULT '1',
  `Remark` varchar(200) DEFAULT NULL,
  `CollocationId` bigint(20) NOT NULL,
  `RowVersion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `example_collocation_Id_fk` (`CollocationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`Id`, `Entry`, `EntryZht`, `EntryZhs`, `EntryJap`, `Source`, `Remark`, `CollocationId`, `RowVersion`) VALUES
(25, 'Obviously, I’m not an artist. But, that being the case, I can honestly marvel at and appreciate our son’s abilities.', '很明顯，我不是一個藝術家。但是，在這樣的情況下，我可以誠實地驚嘆和讚賞兒子的能力。', '很明显，我不是一个艺术家。但是，在这样的情况下，我可以诚实地惊叹和赞赏儿子的能力。', '明らかに、私はアーティストではないよ。しかし、ケースであることを、私は正直に驚嘆し、私たちの息子の能力を理解することができる。', 1, '', 1, '2016-10-13 06:14:24'),
(26, 'The students cheered with passionate abandon.', '學生們熱烈地盡情歡呼。', '学生们热烈地尽情欢呼。', '学生が情熱的な奔放さと声援を送った。', 1, '', 2, '2016-10-13 06:15:25'),
(27, 'The village has been hastily abandoned.', '這個村莊一下子遭遺棄了。', '这个村庄一下子遭遗弃了。', '村は急いで放棄されている。', 1, '', 3, '2016-10-13 06:15:41'),
(29, 'Both players demonstrated their ability to hit the ball hard.', '兩名球員都顯露出用力擊球的能力。', '两名球员都显露出用力击球的能力。', '両選手は、ハードボールを打つ能力を実証した。', 1, '', 8, '2016-10-13 06:16:01'),
(31, 'The government does not propose to abandon the project altogether.', '政府並不打算完全放棄這個計畫。', '政府并不打算完全放弃这个计画。', '政府は完全にプロジェクトを放棄することを提案していません。', 1, '', 4, '2016-10-13 06:30:14'),
(32, 'Her father wanted her to be a physicist, and there was no denying Sumi’s natural ability with science and math.', '森彌的父親認為她具有自然與科學和數學的天賦才能，希望她成為一位物理學家。', '森弥的父亲认为她具有自然与科学和数学的天赋才能，希望她成为一位物理学家。', '彼女の父は彼女が物理学者になりたいと思っておらず、全く科学と数学とスミの自然な能力が否定されました。', 1, '', 7, '2016-10-13 06:30:33'),
(33, 'I seem to have lost my ability to attract clients.', '我好像失去了招徠顧客的能力。', '我好像失去了招徕顾客的能力。', '私は顧客を引き付けるために自分の能力を失っているように見える。', 1, '', 9, '2016-10-13 06:31:12'),
(34, 'This principle has now been effectively abandoned.', '這一原則事實上已被放棄。', '这一原则事实上已被放弃。', 'この原則は、今では事実上放棄されている。', 1, '', 10, '2016-10-13 06:31:27'),
(35, 'Traditional policies were simply abandoned.', '一些傳統的政策根本就給廢止了。', '一些传统的政策根本就给废止了。', '従来の政策は単に放棄された。', 1, '', 11, '2016-10-13 06:31:50'),
(36, 'This is your record to show that you have formally abandoned your permanent resident status.', '這是您的記錄，表明您已經正式放棄永久居民身份。', '这是您的记录，表明您已经正式放弃永久居民身份。', 'これは、正式にあなたの永住権を放棄したことを示すためにあなたの記録である。', 1, '', 12, '2016-10-13 06:32:10'),
(37, 'Number 3, Lauriston Gardens wore an ill-omened and minatory look.', '3號洛里斯頓花園，外觀給人一種不祥和的感覺，而且挺陰森的。', '3号洛里斯顿花园，外观给人一种不祥和的感觉，而且挺阴森的。', 'サードローリストンガーデンズ、不吉感、緻密な色合いの外観を与える。', 5, '', 13, '2016-10-13 06:32:28'),
(38, 'Looking for work after a long absence requires some forethought and advance warning before job seekers even begin their job search.', '已經很久沒有工作的人，若要重新再找工作，事先要想清楚，心態上也需要適度的調整。', '已经很久没有工作的人，若要重新再找工作，事先要想清楚，心态上也需要适度的调整。', '事前にそれを明確にすることを考え、再び仕事を見つけるために、仕事をせずに長い時間がかかった、メンタリティも適切な調整を必要とします。', 1, '', 14, '2016-10-13 06:33:00'),
(39, 'You will not be paid for the full period of absence.', '整個缺勤期間你不會有報酬。', '整个缺勤期间你不会有报酬。', 'あなたが不在の全期間に支払われることはありません。', 1, '', 15, '2016-10-13 06:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE IF NOT EXISTS `pos` (
  `Id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Entry` varchar(20) NOT NULL,
  `EntryZht` varchar(30) NOT NULL,
  `EntryZhs` varchar(30) NOT NULL,
  `EntryJap` varchar(30) NOT NULL,
  `RowVersion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CanDel` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  KEY `Entry` (`Entry`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`Id`, `Entry`, `EntryZht`, `EntryZhs`, `EntryJap`, `RowVersion`, `CanDel`) VALUES
(1, 'noun', '名詞', '名词', '名詞', '2016-10-03 08:58:10', 0),
(2, 'verb', '動詞', '动词', '動詞', '2016-10-03 08:58:10', 0),
(3, 'adjective', '形容詞', '形容词', '形容詞', '2016-10-03 08:58:10', 0),
(4, 'adverb', '副詞', '副词', '副詞', '2016-10-03 08:58:10', 0),
(5, 'preposition', '前置詞', '前置词', '前置詞', '2016-10-03 08:58:10', 0),
(6, 'pronoun', '代名詞', '代名词', '代名詞', '2016-10-03 08:58:10', 0),
(7, 'conjunction', '連接詞', '连接词', '接続詞', '2016-10-03 08:58:10', 0),
(8, 'interjection', '感嘆詞', '感叹词', '間投詞', '2016-10-03 08:58:10', 0),
(9, 'phrase', '片語', '片语', '語句', '2016-10-03 08:58:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `access_token`) VALUES
(1, 'a1771550', NULL, '$2y$12$BQcLP0j9PbFK5v.OqkOIiOBgN1GhwxADrOYlB/ObWHEeCixoCYT62', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `word`
--

CREATE TABLE IF NOT EXISTS `word` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Entry` varchar(50) NOT NULL,
  `EntryZht` varchar(200) NOT NULL,
  `EntryZhs` varchar(200) NOT NULL,
  `EntryJap` varchar(200) NOT NULL,
  `posId` smallint(6) NOT NULL DEFAULT '1',
  `RowVersion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CanDel` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `idx_id` (`Id`),
  KEY `idx_entry` (`Entry`),
  KEY `posId` (`posId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `word`
--

INSERT INTO `word` (`Id`, `Entry`, `EntryZht`, `EntryZhs`, `EntryJap`, `posId`, `RowVersion`, `CanDel`) VALUES
(1, 'ability', '能力', '能力', '能力', 1, '2016-10-03 08:58:10', 0),
(2, 'profile', '展示', '展示', 'プロファイルへ', 2, '2016-10-03 08:58:10', 0),
(3, 'abandon', '放任; 放緃', '放任; 放緃', 'フェア;耽溺', 1, '2016-10-03 08:58:10', 0),
(4, 'passionate', '熱情的', '热情的', '情熱的な', 3, '2016-10-03 08:58:10', 0),
(5, 'appreciate', '賞識', '赏识', '鑑賞する', 2, '2016-10-03 08:58:10', 0),
(6, 'hastily', '倉促地', '仓促地', '急いで', 4, '2016-10-03 08:58:10', 0),
(7, 'altogether', '共同', '共同', '完全に', 4, '2016-10-03 08:58:10', 0),
(8, 'natural', '天然的', '天然的', 'ナチュラル', 3, '2016-10-03 08:58:10', 0),
(9, 'demonstrate', '顯露; 顯現', '显露; 显现', '実証する', 2, '2016-10-03 08:58:10', 0),
(10, 'lose', '失去', '失去', '失う', 2, '2016-10-03 08:58:10', 0),
(11, 'effectively', '事實上', '事实上', '効果的に', 4, '2016-10-03 08:58:10', 0),
(12, 'simply', '根本上', '根本上', '単に', 4, '2016-10-03 08:58:10', 0),
(13, 'formally', '正式地', '正式地', '正式に', 4, '2016-10-03 08:58:10', 0),
(14, 'look', '外觀', '外观', 'エクステリア', 1, '2016-10-03 08:58:10', 0),
(15, 'wear', '穿著', '穿著', '着用する', 2, '2016-10-03 08:58:10', 0),
(16, 'absence', '缺席; 不在場', '缺席; 不在场', '不在', 1, '2016-10-03 08:58:10', 0),
(17, 'long', '長的', '长的', '長い', 3, '2016-10-03 08:58:10', 0),
(18, 'period', '期間', '期间', '期間', 1, '2016-10-03 08:58:10', 0),
(19, 'a/the period of ...', '在...的期間', '在...的期间', 'の...期間', 9, '2016-10-03 08:58:10', 0),
(35, 'To...', '往...', '往...', 'へ...', 5, '2016-10-03 08:58:10', 0),
(36, 'On behalf of...', '代表...', '代表...', 'の...代わっ', 9, '2016-10-03 08:58:10', 0),
(37, 'Upon...', '在...之上', '在...之上', 'で...トップ', 5, '2016-10-03 08:58:10', 0),
(39, 'In favor of...', '為了...', '为了...', '為了...', 9, '2016-10-03 08:58:10', 0),
(40, 'For...', '為了...', '为了...', 'のため...', 5, '2016-10-03 08:58:10', 0),
(41, 'Under...', '在...之下', '在...之下', '前の下...', 5, '2016-10-03 08:58:10', 0),
(42, 'Above...', '在...之上', '在...之上', 'で...トップ', 5, '2016-10-03 08:58:10', 0),
(43, 'In...', '在...之內', '在...之內', '内...', 5, '2016-10-03 08:58:10', 0),
(44, 'At...', '在...', '在...', 'で...', 5, '2016-10-03 08:58:10', 0),
(45, 'On...', '在...之上', '在...之上', 'で...トップ', 5, '2016-10-03 08:58:10', 0),
(46, 'Of...', '的...', '的...', 'の...', 5, '2016-10-03 08:58:10', 0),
(47, 'From...', '由...', '由...', 'バイ...', 5, '2016-10-03 08:58:10', 0),
(48, 'Up...', '往...上', '往...上', '行く...上', 5, '2016-10-03 08:58:10', 0),
(49, 'Down...', '往...下', '往...下', '前の下...', 5, '2016-10-03 08:58:10', 0),
(50, 'Out of...', '在...之外', '在...之外', 'の...外', 9, '2016-10-03 08:58:10', 0),
(51, 'cheque', '支票', '支票', '支票', 1, '2016-10-03 08:58:10', 0),
(60, 'cancel', '取消', '取消', '取消', 2, '2016-10-03 08:58:10', 1),
(61, 'abandon', '放棄', '放弃', 'あきらめます', 2, '2016-10-13 06:09:04', 1),
(62, 'look', '看', '看', '見て', 2, '2016-10-13 06:19:16', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collocation`
--
ALTER TABLE `collocation`
  ADD CONSTRAINT `collocation_colword__fk` FOREIGN KEY (`colWordId`) REFERENCES `word` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `collocation_word_Id_fk` FOREIGN KEY (`wordId`) REFERENCES `word` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `example`
--
ALTER TABLE `example`
  ADD CONSTRAINT `example_collocation_Id_fk` FOREIGN KEY (`CollocationId`) REFERENCES `collocation` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `word`
--
ALTER TABLE `word`
  ADD CONSTRAINT `word_ibfk_1` FOREIGN KEY (`posId`) REFERENCES `pos` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
