-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `naiyou` text NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`) VALUES
(1, 'takeshi', '111@aaa.or.jp', '内容', '2020-12-27 16:02:14'),
(2, '太郎', 'bbb@bbb.or.jp', 'テスト電文', '2020-12-27 16:15:57'),
(3, 'バインドテスト', 'emailテスト', 'naiiyouテスト', '2020-12-27 16:15:59'),
(4, 'バインドテスト', 'emailテスト', 'naiiyouテスト', '2020-12-27 16:18:12'),
(5, 'バインドテスト', 'emailテスト', 'naiiyouテスト', '2020-12-27 17:02:08'),
(6, 'バインドテスト', 'emailテスト', 'naiiyouテスト', '2020-12-27 22:48:43'),
(7, '花子', 'hanako@ccc.or.jp', '花子テスト', '2020-12-27 23:08:10'),
(8, '三郎', 'saburou@fff.or.jp', '三郎テスト', '2020-12-27 23:19:03'),
(9, '四郎', 'shirou@ggg.or.jp', '四郎テスト', '2020-12-27 23:19:43');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'sugahara takeshi', 'sugatake', 'shiketa406240', 1, 1),
(2, 'satou makoto', 'torasan', 'sibamata', 0, 1),
(3, 'tanaka satoru', 'satoru', 'kyusyu', 0, 0),
(4, 'saito satosi', 'hamustar', '123456', 1, 0),
(5, 'maruyama hirotaka', 'marusan', '111111', 1, 0),
(6, 'abe yasuhiro', 'abechan2', '22222', 0, 1),
(8, 'ebihara hiroshi', 'ebii2', '33333', 0, 1),
(9, 'hashimoto kazuo', 'hasikazu', '55555', 0, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルのAUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
