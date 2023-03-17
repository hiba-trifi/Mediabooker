-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2023 at 04:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_mediatheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(11) NOT NULL,
  `nom_adm` varchar(50) DEFAULT NULL,
  `email_adm` varchar(50) DEFAULT NULL,
  `mdp_adm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `nom_adm`, `email_adm`, `mdp_adm`) VALUES
(10, 'admin', 'adm@adm.adm', '$2y$10$jp./8INsiPHBaECCI7gYquH8JpZOcmeBZpEAmjoczIgLabC6flH1W'),
(12, 'adm2', 'adm2.adm2@adm.com', '$2y$10$XoW04ohSiujlhYVX/gIrw.6xllyE5HUzvj4hmqtswiOaeFt7nPfna');

-- --------------------------------------------------------

--
-- Table structure for table `emprunt`
--

CREATE TABLE `emprunt` (
  `id_emp` int(11) NOT NULL,
  `date_emp` date DEFAULT NULL,
  `date_eff` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `id_res` int(11) NOT NULL,
  `id_ov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprunt`
--

INSERT INTO `emprunt` (`id_emp`, `date_emp`, `date_eff`, `date_retour`, `id_res`, `id_ov`) VALUES
(5, '2023-03-15', '2023-03-16', '2023-03-15', 54, 16),
(6, '2023-03-16', '2023-03-16', '2023-03-16', 56, 19),
(7, '2023-03-16', '2023-03-17', '2023-03-31', 57, 20),
(8, '2023-03-17', '2023-03-17', '2023-04-01', 60, 72);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id_mb` int(11) NOT NULL,
  `nom_mb` varchar(50) DEFAULT NULL,
  `adresse_mb` varchar(50) DEFAULT NULL,
  `email_mb` varchar(50) DEFAULT NULL,
  `dateN__mb` date DEFAULT NULL,
  `type_mb` varchar(50) DEFAULT NULL,
  `surnom_mb` varchar(50) DEFAULT NULL,
  `mdp_mb` varchar(255) DEFAULT NULL,
  `date_cmt` date DEFAULT NULL,
  `tel_mb` int(11) DEFAULT NULL,
  `penalite_mb` int(11) DEFAULT 0,
  `cin_mb` varchar(255) DEFAULT NULL,
  `lock_cmp` varchar(110) DEFAULT NULL,
  `date_lock` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_mb`, `nom_mb`, `adresse_mb`, `email_mb`, `dateN__mb`, `type_mb`, `surnom_mb`, `mdp_mb`, `date_cmt`, `tel_mb`, `penalite_mb`, `cin_mb`, `lock_cmp`, `date_lock`) VALUES
(16, '', 'RUE al awama', 'trifi.hiba.solicode@gmail.com', '2023-03-21', 'Etudiant', 'hibahiba', '$2y$10$ZN68jDaLD5EKsBJMBGonDO61Sa/BLPUSRNcN1d/k/rDNTrFIDZppe', '2023-03-14', 674439035, 2, 'BY3300', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `id_ov` int(11) NOT NULL,
  `titre_ov` varchar(50) DEFAULT NULL,
  `auteur_ov` varchar(50) DEFAULT NULL,
  `img_ov` varchar(255) DEFAULT NULL,
  `dateEdt_ov` date DEFAULT NULL,
  `type_ov` varchar(50) DEFAULT NULL,
  `etat_ov` varchar(50) DEFAULT NULL,
  `date_achat_ov` date DEFAULT NULL,
  `page_ov` int(11) DEFAULT NULL,
  `id_adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ouvrage`
--

INSERT INTO `ouvrage` (`id_ov`, `titre_ov`, `auteur_ov`, `img_ov`, `dateEdt_ov`, `type_ov`, `etat_ov`, `date_achat_ov`, `page_ov`, `id_adm`) VALUES
(16, 'The Great Gatsby', 'F. Scott Fitzgerald', '../img/6410b223a3a95.jpg', '1925-04-10', 'Livre', 'Neuf', '2022-01-01', 180, 10),
(17, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', '../img/6412ff17bb80c.jpg', '1997-06-26', 'Livre', 'Bon état', '2022-01-01', 223, 10),
(19, 'The Godfather', 'Mario Puzo', '../img/6410b2438cabe.jpg', '1969-03-10', 'Roman', 'Acceptable', '2022-01-01', 448, 10),
(20, 'The Lion King', '', '../img/6410b24c0aab7.jpg', '1925-04-10', 'Cassettes vidéo', 'Déchiré', '2022-01-01', 700, 10),
(21, 'Queen - Greatest Hits', '', '../img/6410b25ce98d0.jpg', '1925-04-10', 'CD', 'Bon état', '2022-01-01', 130, 10),
(22, 'The Shawshank Redemption', '', '../img/6410b26eae29d.jpg', '1925-04-10', 'DVD', 'Neuf', '2022-01-01', 569, 10),
(23, 'A Brief History of Time', 'Stephen Hawking', '../img/6410b29514f74.jpg', '1988-04-01', 'Mémoire de recherche', 'Assez usé', '2022-01-01', 212, 10),
(24, 'Romeo and Juliet', 'William Shakespeare', '../img/6410b2a442508.jpg', '1597-01-01', 'Livre', 'Bon état', '2022-01-01', 218, 10),
(25, 'The Catcher in the Rye', 'J.D. Salinger', '../img/6410b2b7ef876.jpg', '1951-07-16', 'Livre', 'Neuf', '2022-01-01', 277, 10),
(26, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', '../img/6410b2c82d6e3.webp', '1979-10-12', 'Livre', 'Assez usé', '2022-01-01', 193, 10),
(27, 'The Dark Knight', '', '../img/6410b2d664950.jpg', '1925-04-10', 'DVD', 'Bon état', '2022-01-01', 399, 10),
(28, 'Forrest Gump', '', '../img/6410b2e554028.jpg', '1925-04-10', 'DVD', 'Assez usé', '2022-01-01', 58, 10),
(29, 'The Godfather Part II', 'Mario Puzo', '../img/6410b2fed4e21.jpg', '1974-12-12', 'DVD', 'Neuf', '2022-01-01', 200, 10),
(30, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '../img/6410b30e4ba12.jpg', '2023-03-06', 'Livre ', 'Neuf', '2023-03-08', 334, 10),
(46, 'La vie des abeilles', 'Maurice Maeterlinck', '../img/64132c5b600a3.jpg', '1910-01-01', 'Mémoire de recherche', 'Neuf', '2022-02-25', 400, 12),
(47, 'Pour en finir avec la croissance', 'Serge Latouche', '../img/64132c3fefff5.webp', '2013-09-12', 'Mémoire de recherche', 'Bon état', '2022-02-25', 250, 12),
(51, 'Inception', 'Christopher Nolan', '../img/64132cb88f0c8.webp', '2010-07-14', 'DVD', 'Bon état', '2022-02-01', 148, 12),
(52, 'Pulp Fiction', 'Quentin Tarantino', '../img/64132d6538389.webp', '1994-05-21', 'DVD', 'Acceptable', '2022-02-01', 154, 12),
(53, 'The Matrix', 'Lana Wachowski, Lilly Wachowski', '../img/64132d742d47b.webp', '1999-03-31', 'DVD', 'Déchiré', '2022-02-01', 136, 12),
(54, 'The Dark Side of the Moon', 'Pink Floyd', '../img/64132d89b377a.webp', '1973-03-01', 'CD', 'Neuf', '2022-02-01', 45, 10),
(55, '21', 'Adele', '../img/64132dc498587.webp', '2011-01-19', 'CD', 'Bon état', '2022-02-05', 57, 12),
(56, 'Thriller', 'Michael Jackson', '../img/64132f9dc05c8.webp', '1982-11-30', 'CD', 'Assez usé', '2022-02-10', 62, 10),
(57, 'The Lord of the Rings: The Fellowship of the Ring', 'Howard Shore', '../img/64132fb316a42.webp', '2001-11-20', 'DVD', 'Neuf', '2022-02-20', 179, 12),
(58, 'Star Wars: Episode IV - A New Hope', 'George Lucas', '../img/64132fc6a5a25.webp', '1977-05-25', 'Cassette vidéo', 'Neuf', '1992-08-05', 120, 10),
(66, 'La Nuit des temps', 'René Barjavel', '../img/64132fd783399.webp', '1968-01-01', 'Livre', 'Bon état', '2022-02-01', 416, 10),
(67, 'The Da Vinci Code', 'Dan Brown', '../img/64132ff2eff7a.webp', '2003-03-18', 'Livre', 'Neuf', '2022-02-01', 592, 12),
(69, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '../img/6413300a2214f.webp', '1943-04-06', 'Livre', 'Acceptable', '2022-02-03', 96, 12),
(70, 'Le Rouge et le Noir', 'Stendhal', '../img/64133019db1c3.webp', '1830-11-13', 'Livre', 'Bon état', '2022-02-04', 624, 12),
(71, 'Les Misérables', 'Victor Hugo', '../img/64133035611c3.webp', '1862-04-03', 'Livre', 'Neuf', '2022-02-05', 1232, 12),
(72, 'The Economist Magazine', 'Various', '../img/641330432dc4a.webp', '1843-09-02', 'Revue', 'Neuf', '2022-02-07', 112, 12),
(73, 'La Nuit des temps', 'René Barjavel', '../img/6413305cd7828.webp', '1968-01-01', 'Livre', 'Bon état', '2022-02-01', 416, 10),
(74, 'The Da Vinci Code', 'Dan Brown', '../img/641330809c65d.webp', '2003-03-18', 'Livre', 'Neuf', '2022-02-01', 592, 12),
(75, 'The Catcher in the Rye', 'J.D. Salinger', '../img/64133093142d3.jpg', '1951-07-16', 'Livre', 'Assez usé', '2022-02-02', 277, 10),
(76, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '../img/641330abe2e65.webp', '1943-04-06', 'Livre', 'Neuf', '2022-02-03', 96, 12),
(77, 'Le Rouge et le Noir', 'Stendhal', '../img/641330bfea454.webp', '1830-11-13', 'Livre', 'Assez usé  ', '2022-02-04', 624, 12),
(78, 'Les Misérables', 'Victor Hugo', '../img/6413317b0587a.webp', '1862-04-03', 'Livre', 'Bon état', '2022-02-05', 1232, 12),
(79, 'The Economist Magazine', 'Various', '../img/6413318ae92ce.webp', '1843-09-02', 'Revue', 'Assez usé  ', '2022-02-07', 112, 12);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_res` int(11) NOT NULL,
  `date_res` date NOT NULL,
  `validation_res` int(11) DEFAULT 0,
  `id_ov` int(11) NOT NULL,
  `id_mb` int(11) NOT NULL,
  `code_res` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_res`, `date_res`, `validation_res`, `id_ov`, `id_mb`, `code_res`) VALUES
(54, '2023-03-15', 2, 16, 16, 'uKZr1'),
(56, '2023-03-16', 2, 19, 16, 'qMXBT'),
(57, '2023-03-16', 2, 20, 16, 'SvKqM'),
(59, '2023-03-17', 0, 27, 16, 'bdNr1'),
(60, '2023-03-17', 2, 72, 16, 'prTXr'),
(61, '2023-03-17', 0, 77, 16, 'WF2th'),
(62, '2023-03-17', 0, 66, 16, 'BDgFB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emp`),
  ADD UNIQUE KEY `id_res` (`id_res`),
  ADD KEY `id_ov` (`id_ov`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_mb`);

--
-- Indexes for table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`id_ov`),
  ADD KEY `id_adm` (`id_adm`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_res`),
  ADD KEY `id_ov` (`id_ov`),
  ADD KEY `id_mb` (`id_mb`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_mb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `id_ov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`id_ov`) REFERENCES `ouvrage` (`id_ov`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`id_res`) REFERENCES `reservation` (`id_res`);

--
-- Constraints for table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD CONSTRAINT `ouvrage_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `admin` (`id_adm`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_ov`) REFERENCES `ouvrage` (`id_ov`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_mb`) REFERENCES `membre` (`id_mb`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
