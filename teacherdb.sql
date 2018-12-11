-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:53105
-- Generation Time: Feb 19, 2018 at 09:23 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacherdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kadai`
--

CREATE TABLE `kadai` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

--
-- Dumping data for table `kadai`
--

INSERT INTO `kadai` (`testID`, `testName`) VALUES
('c', 'Cプログラミング'),
('ip', 'ITパスポート'),
('en', '英語');

-- --------------------------------------------------------

--
-- Table structure for table `kadaiaisan`
--

CREATE TABLE `kadaiaisan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaigodaisan`
--

CREATE TABLE `kadaigodaisan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaihukumotosan`
--

CREATE TABLE `kadaihukumotosan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaihuzimotosan`
--

CREATE TABLE `kadaihuzimotosan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaik018`
--

CREATE TABLE `kadaik018` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kadaik018`
--

INSERT INTO `kadaik018` (`testID`, `testName`) VALUES
('en', '英語'),
('ip', 'ITパスポート');

-- --------------------------------------------------------

--
-- Table structure for table `kadaiokazakisan`
--

CREATE TABLE `kadaiokazakisan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaiokazakisan2`
--

CREATE TABLE `kadaiokazakisan2` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadairathnak`
--

CREATE TABLE `kadairathnak` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

--
-- Dumping data for table `kadairathnak`
--

INSERT INTO `kadairathnak` (`testID`, `testName`) VALUES
('ip', 'ITパスポート'),
('mondai', '問題'),
('en', '英語');

-- --------------------------------------------------------

--
-- Table structure for table `kadaitakahasisan`
--

CREATE TABLE `kadaitakahasisan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaitakahasisan2`
--

CREATE TABLE `kadaitakahasisan2` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaitamayamasan`
--

CREATE TABLE `kadaitamayamasan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaiyamadasan`
--

CREATE TABLE `kadaiyamadasan` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `kadaiyamadasan2`
--

CREATE TABLE `kadaiyamadasan2` (
  `testID` varchar(20) NOT NULL,
  `testName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全課題のテーブル';

-- --------------------------------------------------------

--
-- Table structure for table `mondaitb`
--

CREATE TABLE `mondaitb` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mondaitb`
--

INSERT INTO `mondaitb` (`mondaiID`, `mondai`, `kai1`, `kai2`, `kai3`, `kai4`, `seikaiNum`) VALUES
(1, 'PCのオペレーティングシステムを構成するプログラムを知的財産として保護する法律はどれか。', '意匠法', '回路配置法', '実用新案法', '著作権法', 3),
(2, '検索エンジンの検索結果が上位に表示されるよう，Webページ内に適切なキーワードを盛り込んだり，HTMLやリンクの内容を工夫したりする手法はどれか。', 'BPO', 'LPO', 'MBO', 'SEO', 3),
(3, '国民生活の安心や安全を損なうような，企業の法令違反行為の事実を，労働者が公益通報者保護法で定められた通報先に通報した場合，その労働者は解雇などの不利益を受けないよう同法によって保護される。a～dのうち，公益通報者保護法が保護の対象としている\"労働者\"に該当するものだけを全て挙げたものはどれか。<br>\r\na.アルバイト <br>\r\nb.正社員<br>\r\nc.パートタイマ<br>\r\nd.派遣労働者<br>', 'a，b，c，d', 'a，b，d', 'b，c，d', 'b，d', 1),
(4, '派遣先の行為に関する記述a～dのうち，適切なものだけを全て挙げたものはどれか。\r\n\r\n派遣契約の種類を問わず，特定の個人を指名して派遣を要請した。\r\n派遣労働者が派遣元を退職した後に自社で雇用した。\r\n派遣労働者を仕事に従事させる際に，自社の従業員の中から派遣先責任者を決めた。\r\n派遣労働者を自社とは別の会社に派遣した。', 'a，c', 'a，d', 'b，c', 'b，d', 3),
(5, 'DFDの表記に関する記述として，最も適切なものはどれか。', '時間の経過や状況の変化に伴う，システムの状態の遷移を表記する。', 'システムで扱う実体同士を関連付けて，データの構造を表記する。', 'システムを構成する要素の属性や操作，要素同士の関係を表記する。', 'データの流れに着目し，業務のデータの流れと処理の関係を表記する。', 4);

-- --------------------------------------------------------

--
-- Table structure for table `teacherlist`
--

CREATE TABLE `teacherlist` (
  `teacherID` varchar(20) NOT NULL,
  `teacherName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacherlist`
--

INSERT INTO `teacherlist` (`teacherID`, `teacherName`) VALUES
('aisan', '阿井瞬'),
('godaisan', '五大めぐみ'),
('hukumotosan', '福本あき'),
('huzimotosan', '藤村将也'),
('k018', '吉田'),
('okazakisan', '岡崎フミヤ'),
('okazakisan2', '岡崎窈'),
('rathnak', 'チャンラタナック'),
('takahasisan', '高橋一輝'),
('takahasisan2', '高橋倫子'),
('tamayamasan', '玉山'),
('yamadasan', '山田直人'),
('yamadasan2', '山田芳正');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `problemNo` int(10) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer1` varchar(500) NOT NULL,
  `answer2` varchar(500) NOT NULL,
  `answer3` varchar(500) NOT NULL,
  `answer4` varchar(500) NOT NULL,
  `trueAns` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testk018_en`
--

CREATE TABLE `testk018_en` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testk018_ip`
--

CREATE TABLE `testk018_ip` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testk018_ip`
--

INSERT INTO `testk018_ip` (`mondaiID`, `mondai`, `kai1`, `kai2`, `kai3`, `kai4`, `seikaiNum`) VALUES
(1, '集合A，B，Cを使った等式のうち，集合A，B，Cの内容によらず常に成立する等式はどれか。ここで，∪は和集合，∩は積集合を示す。', '(A∪B)∩(A∩C) ＝ B∩(A∪C)', '(A∪B)∩C ＝ (A∪C)∩(B∪C)', '(A∩C)∪(B∩A) ＝ (A∩B)∪(B∩C)', '(A∩C)∪(B∩C) ＝ (A∪B)∩C', 4),
(2, '0以外の数値を浮動小数点表示で表現する場合，仮数部の最上位桁が0以外になるように，桁合わせする操作はどれか。ここで，仮数部の表現方法は，絶対値表現とする。', '切上げ', '切捨て', '桁上げ', '正規化', 4),
(3, 'XとYの否定論理積 X NAND Yは，NOT(X AND Y)として定義される。X OR YをNANDだけを使って表した論理式はどれか。', '((X NAND Y) NAND X) NAND Y', '(X NAND X) NAND (Y NAND Y)', '(X NAND Y) NAND (X NAND Y)', 'X NAND (Y NAND (X NAND Y))', 2),
(4, 'e-ビジネスの事例のうち，ロングテールの考え方に基づく販売形態はどれか。', 'インターネットの競売サイトに商品を長期間出品し，一番高値で落札した人に販売する。', '継続的に自社商品を購入してもらえるよう，実店舗で採寸した顧客のサイズの情報を基に，その顧客の体型に合う商品をインターネットで注文できるようにする。', '実店舗において長期にわたって売上が大きい商品だけを，インターネットで大量に販売する。', '販売見込み数がかなり少ない商品を幅広く取扱い，インターネットで販売する。', 4);

-- --------------------------------------------------------

--
-- Table structure for table `testrathnak_en`
--

CREATE TABLE `testrathnak_en` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testrathnak_en`
--

INSERT INTO `testrathnak_en` (`mondaiID`, `mondai`, `kai1`, `kai2`, `kai3`, `kai4`, `seikaiNum`) VALUES
(1, 'John has not been able to recall where ___________.', 'does she live', 'she lives', 'did she live', 'lived the girl', 2),
(2, 'Ben would have study medicine if he _____________________ to a medical school.', 'could be able to enter', 'had been admitted', 'was admitted', 'were admitted', 2),
(3, 'He entered a university ____________________.', 'when he had sixteen years', 'when sixteen years were his age', 'at the age of sixteen', 'at age sixteen years old', 3),
(4, 'The jurors were told to ____________________.', 'talk all they wanted', 'make lots of expressions', 'speak freely', 'talk with their minds open', 3),
(5, 'Those students do not like to read novels, ______________ text books.', 'in any case', 'forgetting about', 'leaving out of the question', 'much less', 4),
(6, 'He _________________ looked forward to the new venture.', 'eagerly', 'with great eagerness', 'eagernessly', 'in a state of increasing eagerness', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testrathnak_ip`
--

CREATE TABLE `testrathnak_ip` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testrathnak_ip`
--

INSERT INTO `testrathnak_ip` (`mondaiID`, `mondai`, `kai1`, `kai2`, `kai3`, `kai4`, `seikaiNum`) VALUES
(1, '集合A，B，Cを使った等式のうち，集合A，B，Cの内容によらず常に成立する等式はどれか。ここで，∪は和集合，∩は積集合を示す。', '(A∪B)∩(A∩C) ＝ B∩(A∪C)', '(A∪B)∩C ＝ (A∪C)∩(B∪C)', '(A∩C)∪(B∩A) ＝ (A∩B)∪(B∩C)', '(A∩C)∪(B∩C) ＝ (A∪B)∩C', 4),
(2, '0以外の数値を浮動小数点表示で表現する場合，仮数部の最上位桁が0以外になるように，桁合わせする操作はどれか。ここで，仮数部の表現方法は，絶対値表現とする。', '切上げ', '切捨て', '桁上げ', '正規化', 4),
(3, 'XとYの否定論理積 X NAND Yは，NOT(X AND Y)として定義される。X OR YをNANDだけを使って表した論理式はどれか。', '((X NAND Y) NAND X) NAND Y', '(X NAND X) NAND (Y NAND Y)', '(X NAND Y) NAND (X NAND Y)', 'X NAND (Y NAND (X NAND Y))', 2),
(4, 'e-ビジネスの事例のうち，ロングテールの考え方に基づく販売形態はどれか。', 'インターネットの競売サイトに商品を長期間出品し，一番高値で落札した人に販売する。', '継続的に自社商品を購入してもらえるよう，実店舗で採寸した顧客のサイズの情報を基に，その顧客の体型に合う商品をインターネットで注文できるようにする。', '実店舗において長期にわたって売上が大きい商品だけを，インターネットで大量に販売する。', '販売見込み数がかなり少ない商品を幅広く取扱い，インターネットで販売する。', 4);

-- --------------------------------------------------------

--
-- Table structure for table `testrathnak_mondai`
--

CREATE TABLE `testrathnak_mondai` (
  `mondaiID` int(10) NOT NULL,
  `mondai` varchar(500) DEFAULT NULL,
  `kai1` varchar(300) DEFAULT NULL,
  `kai2` varchar(300) DEFAULT NULL,
  `kai3` varchar(300) DEFAULT NULL,
  `kai4` varchar(300) DEFAULT NULL,
  `seikaiNum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testrathnak_mondai`
--

INSERT INTO `testrathnak_mondai` (`mondaiID`, `mondai`, `kai1`, `kai2`, `kai3`, `kai4`, `seikaiNum`) VALUES
(1, '企業の活動のうち，コンプライアンスの推進活動に関係するものはどれか。', '営業担当者が保有している営業ノウハウ，顧客情報及び商談情報を営業部門で共有し，営業活動の生産性向上を図る仕組みを整備する。', '顧客情報や購買履歴を顧客と接する全ての部門で共有し，顧客満足度向上を図る仕組みを整備する。', 'スケジュール，書類，伝言及び会議室予約状況を，部門やプロジェクトなどのグループで共有し，コミュニケーションロスを防止する。', '法令遵守を目指した企業倫理に基づく行動規範や行動マニュアルを制定し，社員に浸透させるための倫理教育を実施する。', 4),
(2, '2人又はそれ以上の上司から指揮命令を受けるが，プロジェクトの目的管理と職能部門の職能的責任との調和を図る組織構造はどれか。', '事業部制組織', '社内ベンチャ組織', 'マトリックス組織', '職能別組織', 3),
(3, '著作権法による保護の対象となるものはどれか。', '操作マニュアル', 'プログラム言語', 'アルゴリズム', 'プロトコル', 1),
(4, 'システム開発のプロセスには，システム要件定義，システム方式設計，システム結合テスト，ソフトウェア受入れなどがある。システム要件定義で実施する作業はどれか。', 'システムテストの計画を作成し，テスト環境の準備を行う。', '開発の委託者が実際の運用と同様の条件でソフトウェアを使用し，正常に稼働することを確認する。', 'システムに要求される機能，性能を明確にする。', 'プログラム作成と，評価基準に従いテスト結果のレビューを行う。', 3),
(5, 'ソフトウェア開発プロジェクトにおいて，上流工程から順に工程を進めることにする。要件定義，システム設計，詳細設計の工程ごとに完了判定を行い，最後にプログラミングに着手する。このプロジェクトで適用するソフトウェア開発モデルはどれか。', 'プロトタイピングモデル', 'ウォータフォールモデル', '段階的モデル', 'スパイラルモデル', 2),
(6, 'プロジェクトの成果物の作成作業を階層的に分解したものはどれか。', 'WBS', 'SLA', 'RFP', 'EVM', 1),
(7, 'システム監査に関する説明として，適切なものはどれか。', 'プロジェクトの要求事項を満足させるために，知識，スキル，ツール及び技法をプロジェクト活動に適用させること', '品質の良いソフトウェアを，効率よく開発するための技術や技法のこと', '情報システムに関わるリスクに対するコントロールが適切に整備・運用されているかどうかを検証すること', 'ITサービスマネジメントを実現するためのフレームワークのこと', 3),
(8, 'a，b，c，d，e，fの6文字を任意の順で1列に並べたとき，aとbが隣同士になる場合は，何通りか。', '720', '240', '1,440', '120', 4),
(9, 'PCのメーラーに関する記述として，適切なものはどれか。', 'PCのハードウェアやアプリケーションなどを管理するソフトウェア', '電子メールを送受信するためのソフトウェア', '文書の作成や編集を行うソフトウェア', 'Webページを閲覧するためのソフトウェア', 2),
(10, '公開鍵暗号方式と共通鍵暗号方式において，共通鍵暗号方式だけがもつ特徴として，適切なものはどれか。', '個別に安全な通信を行う必要がある相手が複数であっても，鍵は一つでよい。', '電子証明書によって，鍵の持ち主を確認できる。', '復号には，暗号化で使用した鍵と同一の鍵を用いる。', '暗号化に使用する鍵を第三者に知られても，安全に通信ができる。', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kadai`
--
ALTER TABLE `kadai`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaiaisan`
--
ALTER TABLE `kadaiaisan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaigodaisan`
--
ALTER TABLE `kadaigodaisan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaihukumotosan`
--
ALTER TABLE `kadaihukumotosan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaihuzimotosan`
--
ALTER TABLE `kadaihuzimotosan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaik018`
--
ALTER TABLE `kadaik018`
  ADD PRIMARY KEY (`testID`);

--
-- Indexes for table `kadaiokazakisan`
--
ALTER TABLE `kadaiokazakisan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaiokazakisan2`
--
ALTER TABLE `kadaiokazakisan2`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadairathnak`
--
ALTER TABLE `kadairathnak`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaitakahasisan`
--
ALTER TABLE `kadaitakahasisan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaitakahasisan2`
--
ALTER TABLE `kadaitakahasisan2`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaitamayamasan`
--
ALTER TABLE `kadaitamayamasan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaiyamadasan`
--
ALTER TABLE `kadaiyamadasan`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `kadaiyamadasan2`
--
ALTER TABLE `kadaiyamadasan2`
  ADD PRIMARY KEY (`testID`),
  ADD UNIQUE KEY `testName` (`testName`);

--
-- Indexes for table `mondaitb`
--
ALTER TABLE `mondaitb`
  ADD PRIMARY KEY (`mondaiID`);

--
-- Indexes for table `teacherlist`
--
ALTER TABLE `teacherlist`
  ADD PRIMARY KEY (`teacherID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`problemNo`);

--
-- Indexes for table `testk018_en`
--
ALTER TABLE `testk018_en`
  ADD PRIMARY KEY (`mondaiID`);

--
-- Indexes for table `testk018_ip`
--
ALTER TABLE `testk018_ip`
  ADD PRIMARY KEY (`mondaiID`);

--
-- Indexes for table `testrathnak_en`
--
ALTER TABLE `testrathnak_en`
  ADD PRIMARY KEY (`mondaiID`);

--
-- Indexes for table `testrathnak_ip`
--
ALTER TABLE `testrathnak_ip`
  ADD PRIMARY KEY (`mondaiID`);

--
-- Indexes for table `testrathnak_mondai`
--
ALTER TABLE `testrathnak_mondai`
  ADD PRIMARY KEY (`mondaiID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mondaitb`
--
ALTER TABLE `mondaitb`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `problemNo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testk018_en`
--
ALTER TABLE `testk018_en`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testk018_ip`
--
ALTER TABLE `testk018_ip`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testrathnak_en`
--
ALTER TABLE `testrathnak_en`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `testrathnak_ip`
--
ALTER TABLE `testrathnak_ip`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testrathnak_mondai`
--
ALTER TABLE `testrathnak_mondai`
  MODIFY `mondaiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
