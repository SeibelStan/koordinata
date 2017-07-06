-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Хост: srv-db-plesk12.ps.kz:3306
-- Время создания: Май 16 2016 г., 15:51
-- Версия сервера: 5.5.47-MariaDB
-- Версия PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `im_koordinata`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adds`
--

CREATE TABLE `adds` (
  `id` int(11) NOT NULL,
  `category` varchar(10) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `contacts` varchar(50) NOT NULL,
  `short` varchar(300) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_start` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `ability` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `places` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `anglomeration` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `adds`
--

INSERT INTO `adds` (`id`, `category`, `user_id`, `user_name`, `title`, `contacts`, `short`, `content`, `date`, `date_start`, `price`, `ability`, `gender`, `age`, `places`, `location`, `address`, `location_name`, `anglomeration`, `active`) VALUES
(6, '0', 1, 'Adm God', 'Название6 вфв фв', '+7 700 0000', '', 'Текст', '2016-01-26 17:18:42', '2016-01-05 10:25', 0, 0, 0, 16, 50, 1, '', 'Караганда', 1, 1),
(7, '0', 1, 'Adm God', 'Название7', '+7 700 0000', '', 'Текст', '2016-02-02 17:18:46', '2016-01-12 10:10', 0, 0, 0, 0, 0, 1, '', 'Караганда', 1, 1),
(4, '2', 1, 'Adm God', 'НазваниеЧЧЧ', '+7 700 0000', '', 'Текст', '2016-01-24 14:26:38', '2016-01-30 10:25', 0, 0, 0, 0, 0, 1, '', 'Караганда', 1, 1),
(5, '0', 1, 'Adm God', 'Название5', '+7 700 0000', '', 'Текст Текст Текст Текст Текст', '2016-02-08 17:18:40', '2016-01-20 10:26', 0, 2, 0, 0, 0, 2, '', 'Темиртау', 1, 1),
(8, '0', 1, 'Adm God', 'Название8 вфв фыавыпйфцй22', '+7 700 0000', '', 'Текст', '2016-02-09 17:18:48', '2016-01-08 14:30', 0, 0, 0, 0, 0, 1, '', 'Караганда', 1, 1),
(2, '0', 1, 'Adm God', 'Название2', '+7 700 0000', '', 'Текст', '2016-01-26 12:53:35', '2016-01-22 16:25', 0, 1, 0, 0, 0, 2, '', 'Темиртау', 1, 1),
(1, '0', 1, 'Adm God', 'Музей-заповедник «Царицыно»', '+7 700 0000', 'Царские дворцы в стиле русской готики, чистые пруды...\nПарк, так и не ставший императорской резиденцией, сегодня открыт для всех, кто хочет найти уголок спокойствия в шумной столице.', '<p>В восемнадцатом веке по указу императрицы Екатерины II был заложен&nbsp;<strong>парк Царицыно</strong>. Предполагалось, что это будет летняя императорская резиденция, которая заменит усадьбу Коломенское, порядком наскучившую императрице.</p>\r\n\r\n<p>Дворцовый комплекс строился много лет. Первый дворец, построенный архитектором Василием Баженовым, не понравился Екатерине, поэтому был снесен. На его месте архитектор Матвей Казаков возвел новое здание, которое и сохранилось до наших дней.</p>\r\n\r\n<p>Дворцовый комплекс парка является образцом русской готики в архитектуре, он не имеет себе равных в России. Сам парк Царицыно расположен в холмистой местности, имеет каскад прудов. Для создания английских садов в императорской резиденции был выписан из Англии один из лучших садовников того времени Фрэнсис Рид.</p>\r\n\r\n<p>Но Екатерина II умерла раньше, чем закончились работы над созданием дворцов и садов Царицыно. Кроме неё некому было заниматься этой резиденцией. Сады стали быстро зарастать, дома ветшали. В девятнадцатом веке парк был открыт для гуляний, в оранжереях, которые были заложены еще при Екатерине, выращивали и продавали экзотические фрукты.</p>\r\n\r\n<p>С 1860 года парк и многие его постройки стали дачами. Там отдыхали многие известные писатели: Достоевский, Тютчев, Чехов, Плещеев, именно здесь Бунин познакомился со своей будущей женой. В свое время бывали здесь Чайковский, Тимирязев и многие другие видные деятели культуры и науки. С 1927 года в зданиях Царицыно располагались различные музеи, а в 1993 г. он получил статус музея-заповедника.</p>\r\n\r\n<p>Активно восстанавливать бывший императорский дворец начали только в 2004 году.</p>\r\n\r\n<p>Сегодня это большой парк, куда приезжают гулять не только жители окрестных районов Москвы. На входе на территорию музея-заповедника гостей встречает&nbsp;<strong>музыкальный фонтан</strong>, подойти к которому можно по двум изящным мостикам. При подъезде к дворцам появляются стилизованные крепостные ворота с башнями. В Оперном доме, который строился как место проведения торжественных приемов и балов, теперь проходят концерты классической музыки, различные официальные мероприятия. На тропинках сегодня можно встретить белочек, которые охотно лакомятся орешками.</p>\r\n\r\n<p>Во дворце и на территории парка регулярно проходят экскурсии как для взрослых, так и для детей. Здесь можно познакомиться с особенностями быта и моды разных веков. Действует несколько постоянных экспозиций, посвященных истории Царицыно и правлению Екатерины II, проходят временные выставки, которые знакомят посетителей с современной живописью и декоративно-прикладным искусством.</p>\r\n\r\n<p>Также на территории парка располагается единственный в Москве оранжерейный комплекс, использующийся по назначению &mdash; здесь до сих пор выращивают растения тех же видов, что и в XVIII веке.</p>\r\n\r\n<p>Летом здесь можно покататься на сегвеях, совершить поездку на электромобиле, переплыть пруд на лодке и примерить исторические костюмы. В парке проходят различные квес', '2016-01-28 12:39:39', '2016-02-29 08:50', 1000, 0, 0, 0, 100, 2, 'Музей-заповедник «Царицыно»', 'Темиртау', 1, 1),
(3, '0', 1, 'Adm God', 'Название3', '+7 700 0000', '', 'Текст', '2016-02-06 12:54:39', '2016-01-01 14:25', 1500, 0, 0, 0, 0, 2, '', 'Темиртау', 1, 0),
(9, '0', 1, 'Adm God', 'Стадион Спартак', '555', '', 'Запись', '2016-02-01 17:18:57', '2016-01-08 11:26', 1000, 0, 0, 0, 0, 1, '', 'Караганда', 1, 0),
(10, '0', 1, 'Adm God', 'Truper-страсть к совершенству!', '8-777-7777777', 'fdsf', '<p><strong>5555jjjj</strong></p>\r\n', '2016-01-29 20:06:02', '2016-01-01 00:05', 1000, 0, 0, 0, 50, 2, '', 'Темиртау', 1, 1),
(13, '3', 1, 'Adm God', 'Пыщпыщне на вишне', '+77777', 'Музе́й (от греч. μουσεῖον — Дом Муз) — учреждение, занимающееся сбором, изучением, хранением и экспонированием предметов — памятников естественной истории, материальной и духовной культуры, а также просветительской и популяризаторской деятельностью.', '<p>История<strong>&nbsp;Государственного музея искусств им. А. Кастеева Республики Казахстан&nbsp;</strong>начинается<strong>&nbsp;</strong>с 1935 года, когда&nbsp;Совет Народных Комиссаров Казахской АССР принял 23 сентября Постановление об организации Казахской государственной художественной галереи. Особое внимание в этом Постановлении уделялось проведению юбилейной художественной выставки в честь 15-летия Казахской АССР, которая и дала начало нашей коллекции.&nbsp;</p>\r\n\r\n<p>В 1965 году Совет Министров КазССР принял решение о выделении галерее собственного здания. Здание было спроектировано казахстанскими архитекторами Эльзой Кузнецовой, Ольгой Наумовой и Борисом Новиковым&nbsp;специально для нужд музея, и в 1976 году галерея была переименована в&nbsp;<strong>Государственный музей искусств Республики Казахстан.</strong>&nbsp;В его состав также вошел&nbsp;Республиканский музей прикладного искусства (образован в 1970 г.). Для посетителей новое здание музея было открыто 16 сентября 1976 года.&nbsp;<strong>В январе 1984 г. музею было присвоено имя Народного художника Казахской ССР А. Кастеева (1904-1973 гг.).</strong></p>\r\n\r\n<p>В настоящее время Государственный музей искусств РК им. А. Кастеева является крупнейшим художественным музеем страны и ведущим научно-исследовательским и культурно-просветительским центром в области изобразительного</p>\r\n\r\n<p><img alt="1 залы" src="http://www.gmirk.kz/images/1_zaly.jpg" style="border:none; float:right; height:133px; line-height:18.2px; margin:10px 10px 10px 0px; padding:0px; width:200px" /></p>\r\n\r\n<p>&nbsp;искусства.</p>\r\n\r\n<div id="lnk" style="padding: 0px; margin: 0px; color: rgb(54, 54, 54); font-family: Verdana, sans-serif; font-size: 12px; line-height: 20px; top: -768px; position: absolute; background-color: rgb(237, 238, 238);"><a href="http://1genericpills.net/buy-cheap-xenicalorlistat-online/" style="color: rgb(0, 153, 204); padding: 0px; margin: 0px;">buy cheap Xenical online</a>&nbsp;<a href="http://1genericpills.net/buy-cheap-xenicalorlistat-online/" style="color: rgb(0, 153, 204); padding: 0px; margin: 0px;">1genericpills.net</a>&nbsp;<a href="http://1genericpills.net/buy-cheap-xenicalorlistat-online/" style="color: rgb(0, 153, 204); padding: 0px; margin: 0px;">buy Xenical</a>&nbsp;<a href="http://1genericpills.net/buy-cheap-xenicalorlistat-online/" style="color: rgb(0, 153, 204); padding: 0px; margin: 0px;">buy Xenical online</a>&nbsp;<a href="http://1genericpills.net/buy-cheap-xenicalorlistat-online/" style="color: rgb(0, 153, 204); padding: 0px; margin: 0px;">Xenical online</a></div>\r\n\r\n<p><strong>Богатая, разнообразная, бесценная коллекция</strong>&nbsp;дает яркое представление о художественной культуре Казахстана, стран Европы и Азии, мастеров прошлых эпох и настоящего времени. Число экспонатов основного фонда музея составляет более 23 000 единиц.</p>\r\n', '2016-03-08 20:27:02', '2016-03-27T19:40', 7000, 0, 0, 0, 42, 2, 'Макарова 14', 'Темиртау', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `reply_id`, `post_id`, `post_type`, `user_id`, `user_name`, `content`, `date`) VALUES
(1, 0, 1, 'news', 1, 'Админ!', 'dada', '2016-01-03 20:40:07'),
(7, 1, 1, 'news', 1, 'Админ!', 'fgdfg', '2016-01-03 20:49:35'),
(8, 0, 1, 'news', 1, 'Adm God', 'Тест текста', '2016-01-07 01:56:48'),
(9, 0, 1, 'adds', 1, 'Adm God', '1111', '2016-01-07 02:00:18'),
(10, 9, 1, 'adds', 1, 'Adm God', 'fdasfsfsdf', '2016-01-07 02:00:48'),
(11, 0, 1, 'adds', 1, 'Adm God', 'Траляля', '2016-01-07 02:16:40'),
(12, 0, 1, 'adds', 1, 'Adm God', 'вфвфв', '2016-01-07 02:16:47'),
(13, 9, 1, 'adds', 1, 'Adm God', 'вфвфв', '2016-01-07 02:18:33');

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `name`, `title`, `content`) VALUES
(1, 'about', 'О проекте', '<p>Страница</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `anglomeration` int(11) NOT NULL,
  `isanglomeration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`id`, `title`, `anglomeration`, `isanglomeration`) VALUES
(1, 'Караганда', 1, 1),
(2, 'Темиртау', 1, 0),
(3, 'Шахтинск', 1, 0),
(4, 'Пришахтинск', 1, 0),
(5, 'Сарань', 1, 0),
(6, 'Астана', 2, 1),
(7, 'Алмата', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` varchar(20000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `name`, `content`, `date`) VALUES
(1, 'Новость', 'dd', '<p>вфывфв</p>\r\n', '2016-01-03 20:12:36');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(16, 'seibel.stan@ya.ru', '2d4bd1ade7afd7c64372aa7f7a3cdfd0f6f4a6f484b1ac008230a3696f141c75', '2015-07-20 21:54:48');

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'json',
  `title` varchar(50) NOT NULL,
  `content` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `name`, `type`, `title`, `content`) VALUES
(1, 'addscat', 'json', 'Категории объявлений', '[\n    {\n        "id": "0",\n        "title": "Праздник"\n    },\n    {\n        "id": "1",\n        "title": "Концерт"\n    },\n    {\n        "id": "2",\n        "title": "Спорт"\n    },\n    {\n        "id": "3",\n        "title": "Встреча"\n    }\n]'),
(7, 'kw-main', 'raw', 'Ключевые с главной', 'Мероприятия Караганды'),
(8, 'description', 'raw', 'Описание', 'Мероприятия Караганды');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subscribes`
--

INSERT INTO `subscribes` (`id`, `user_id`, `add_id`, `type`) VALUES
(27, 3, 7, 'subscribe'),
(28, 3, 1, 'subscribe'),
(33, 1, 1, 'subscribe'),
(34, 1, 1, 'meet'),
(36, 1, 4, 'subscribe');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `bdate` date NOT NULL,
  `gender` int(11) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `contacts` varchar(500) NOT NULL,
  `location` int(11) NOT NULL DEFAULT '1',
  `anglomeration` int(11) NOT NULL DEFAULT '1',
  `password` varchar(100) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `bdate`, `gender`, `tel`, `contacts`, `location`, `anglomeration`, `password`, `updated_at`, `created_at`, `remember_token`, `admin`, `active`, `hash`) VALUES
(1, 'seibel.stan@ya.ru', 'Adm God', '1992-11-24', 1, '77089018149', 'http://vk.com/seibel.stan', 2, 1, '$2y$10$foAS20BlC0sxMTSxA89fPu31b7jHHCZ54hvClaJ2QSPVFhxS4y2xm', '2016-03-21 16:57:54', '2015-07-27 09:50:53', 'a5ryEeN9RLE8v0iN5uWhjXBhvV1poS46dB2IDOLssIfKObbKh99SCYnVIYaY', 1, 1, 'used!'),
(5, 'tatieleont@gmail.com', 'Татьяна', '0000-00-00', 0, 'i see u', '', 1, 1, '$2y$10$3rDuWw2POsDULh8GC0U9d.gEv9dW0AdLbzersdO0EBVo0xG4BO6uW', '2016-01-18 15:16:31', '2016-01-18 15:16:30', 'S6knaoaMDzH94b4RHK4kP2ioKnFc5jwPrjllnHCUYoVrQ8sb5nfZ2WfnbHnC', 1, 1, 'used!'),
(6, 'eklikesw@gmail.com', 'Евгений', '0000-00-00', 0, '', '', 1, 1, '$2y$10$jx72vbooT2Tx1UnxXmuZLOTbNOKHnPQCLWd1BYgzR7HmeYMf2eG7C', '2016-03-21 18:20:04', '2016-03-21 18:18:25', 'eZ91nxjCGdPVqdAtl9HmOTveVrhZK5UASAK0MSyy19cLEF4jlH6sZSE9wjTv', 0, 1, 'used!');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adds`
--
ALTER TABLE `adds`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `adds` ADD FULLTEXT KEY `search` (`title`,`content`,`location_name`,`user_name`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adds`
--
ALTER TABLE `adds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
