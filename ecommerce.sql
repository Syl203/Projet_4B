-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 16 mars 2022 à 14:11
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` tinyint(1) NOT NULL,
  `date_depot` datetime NOT NULL,
  `image_produit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`) VALUES
(1, 'Vélo de course KS Cycling', 'Construit pour faire de la vitesse : avec le vélo de course IMPERIOUS de KS Cycling dépassez vos performances!\r\n\r\nLe design de ce vélo de course va attirer tous les regards. Sa forme de cadre dynamique va attirer les regards. Le cadre noir en aluminium léger est agrémenté de détails en blanc. Selle, jantes et fourche s\'accordent tous pour donner au vélo un look racing.\r\n\r\nLes kilomètres ne seront pas un problème pour le IMPERIOUS!', 499, 1, '2022-03-11 00:00:00', 'img/velo.jpg'),
(2, 'Moulinet DAIWA underspin 80A', 'Le Daiwa Underspin 80 A est un moulinet capoté à frein arrière conçu pour la pêche de la truite. L\'Underspin 80 A est doté d\'un frein arrière micrométrique qui vous permettra de mener les combats avec une précision optimale. De plus, ce moulinet capoté possède un bâti et un rotor conçus en aluminium et en alliage métal.', 35, 1, '2022-03-11 00:00:00', 'img/moulinet.jpg'),
(4, 'Avion SEAGULL NEMESIS', 'SEAGULL NEMESIS (120-180) (SEA-114)\r\nEnvergure - 204.5cm, Surface Alaire -69dm2, Entoilé usine en Oracover,Longueur - 1682cm, Poids en vol Approx- 5.6kg\r\n', 356.9, 1, '2022-03-07 16:09:13', 'img/avion.jpg'),
(9, 'Longboard Globe Pinner Classic', 'Le nouveau Pinner Classic de Globe, un vrai pintail Old School parfait pour vos sessions de cruiser, carving, dancing... bref le skate à tout faire !', 179, 1, '2022-03-10 00:00:00', 'img/longboard.jpg'),
(11, 'SAXOPHONE ALTO YAS 280', 'Le Yamaha YAS 280 est un Saxophone Alto destin pour l\'apprentissage. Issu du clbre YTS 275, cette nouvelle version offre plusieurs amliorations comme la bague de serrage du bocal, ainsi qu\'une nouvelle connexion des cls de Si-Do# grave, pour un meilleur rglage et une parfaite projection. Le YAS-280 Yamaha est livr complet, avec bec et tui, en finition Gold Lacquer.', 990, 1, '2022-03-10 00:00:00', 'img/saxophone.jpg'),
(12, 'Epiphone Les Paul Junior', 'La simple et efficace Les Paul Junior reste une valeur sûre pour l’amateur de Gibson à la recherche d’un instrument de caractère. La voici dans sa déclinaison Epiphone qui, bien que reprenant la philosophie de son aînée, affiche un tarif bien plus accessible. D’une conception plus simple que la Standard, cette Junior n’en reste pas moins une vraie Les Paul de par son look et son caractère.', 377, 0, '2022-03-10 00:00:00', 'img/guitare.jpg'),
(13, 'Chaussures basses de randonnée', 'Confortable et résistante, la chaussure de randonnée imperméable HIKE UP LEATHER GTX M garantit une excellente adhérence sur les sentiers de montagne. Sa semelle crantée robuste Vibram® Fell Running est flexible et légère, ses crans carrés procurent une traction bien repartie et un bon contrôle en torsion. Elle est amortie en EVA pour plus de confort.', 159, 1, '2022-03-10 00:00:00', 'img/chaussures.png'),
(14, 'Souris trackball', 'Souris a boule de commande trackball sans fil - Il est sans câble en utilisant la technologie de radiofréquence 2,4 GHz, offrant une portée sans fil allant jusqu\'a 9 m - 5 niveaux de résolutions DPI (400-4800) - Il suffit de pousser le trackball vers l\'extérieur depuis son dos, de le nettoyer et de le remettre en place.', 70, 0, '2022-03-10 00:00:00', 'img/souris.jpg'),
(15, 'Sony PS4 slim 500 Go', 'La PlayStation 4 (abrégée officiellement PS4) est une console de jeux vidéo de salon de huitième génération développée par Sony Computer Entertainment', 549, 1, '2022-03-11 00:00:00', 'img/PS4.jpg'),
(18, 'Sac à dos ProCase', '50 x 30 x 28cm. Pour ranger votre équipement dont vous avez besoin pendant vos déplacement ou activités y compris des vêtements de rechange', 45, 1, '2022-03-14 00:00:00', 'img/sac.jpg'),
(19, 'Raspberry pi 3', 'Contenus :\r\n1 x Raspberry Pi 3 Modèle B\r\n- Broadcom BCM2387 chipset\r\n- 1.2GHz Quad- Core ARM Cortex-A53\r\n- RAM 1GB - 64 Bit CPU\r\n- 4 ports USB x - Sortie stéréo 4 pôles et le port vidéo composite\r\n- Full size HDMI-10/100 BaseT Ethernet...', 70, 1, '2022-03-14 00:00:00', 'img/rasp.webp'),
(20, 'Canne lancer Daiwa Samurai 210M', 'vxdfbdfbdfbf', 42, 1, '2022-03-14 00:00:00', 'img/canne.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(250) NOT NULL,
  `pass_user` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `email_user`, `pass_user`) VALUES
(8, 'mail@site.com', 'dede');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
