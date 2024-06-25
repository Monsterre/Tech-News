-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 25 juin 2024 à 15:27
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tech-news`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualitées`
--

CREATE TABLE `actualitées` (
  `IdA` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `libelle` varchar(200) DEFAULT NULL,
  `auteur` varchar(500) DEFAULT NULL,
  `date_publication` varchar(500) DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `url_actu` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `actualitées`
--

INSERT INTO `actualitées` (`IdA`, `titre`, `libelle`, `auteur`, `date_publication`, `url_image`, `url_actu`) VALUES
(133, 'Avez-vous besoin d\'un VPN en 2024 ?', 'Nous expliquons pourquoi les VPN sont l\'un des outils de protection de la vie privée les plus efficaces et pourquoi vous devriez en utiliser un pour naviguer anonymement.', 'Adrien Bar Hiyé', '7 March 24', 'https://cdn.mos.cms.futurecdn.net/mL6o6FqxTLqzwLQ2E8gFmT-320-80.png', 'https://global.techradar.com/fr-fr/pro/vpn/avez-vous-besoin-dun-vpn-en-2024'),
(134, 'Vision Pro d\'Apple : déjà été piratée, Apple affirme qu\'il ne faut pas s\'inquiéter, ce que contestent les spécialistes de la sécurité', 'Apple a déjà fourni à son casque Vision Pro une mise à jour de sécurité, qui concerne une cible populaire : le moteur WebKit.', 'Adrien Bar Hiyé', '2 February 24', 'https://cdn.mos.cms.futurecdn.net/Lf57iiLPbXwuBr9ycfVY6i-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/security/vision-pro-d-apple-deja-ete-piratee-apple-affirme-qu-il-ne-faut-pas-s-inquieter-ce-que-contestent-les-specialistes-de-la-securite'),
(135, 'Windows 11 : Une nouvelle version permet à l\'IA Copilot de faire des choses étranges sur votre bureau', 'Microsoft dit travailler sur un correctif pour son Copilot de bureau dans Windows 11, parce qu\'il n\'aime pas les configurations multi-moniteurs.', 'Adrien Bar Hiyé', '2 November 23', 'https://cdn.mos.cms.futurecdn.net/hyRpeBLe5UqyqKosDFHFJL-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/windows-11-une-nouvelle-version-permet-a-lia-copilot-de-faire-des-choses-etranges-sur-votre-bureau'),
(136, 'Le G7 décide d\'établir un code de conduite en matière d\'IA', 'Une énième mesure ou une réelle meilleure protection contre les dangers de l\'IA ?', 'Adrien Bar Hiyé', '31 October 23', 'https://cdn.mos.cms.futurecdn.net/AKz7B9eRYadXarkFULYfAJ-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/le-g7-decide-detablir-un-code-de-conduite-en-matiere-dia'),
(138, 'DALL-E vient d\'être lancé pour les utilisateurs ChatGPT Plus', 'Open AI annonce la disponibilité de son générateur d\'art IA pour les utilisateurs de ChatGPT.', 'Adrien Bar Hiyé', '23 October 23', 'https://cdn.mos.cms.futurecdn.net/xgnX3DhCfMfJgYaxCJuUk4-320-80.png', 'https://global.techradar.com/fr-fr/pro/dall-e-vient-detre-lance-pour-les-utilisateurs-professionnels-et-il-est-encore-plus-puissant'),
(139, 'Amazon s\'apprête à signer un accord d\'un milliard de dollars... avec Microsoft 365', 'Des licences Microsoft 365 d\'une valeur de plus d\'un milliard de dollars seront fournies aux travailleurs d\'Amazon.', 'Adrien Bar Hiyé', '18 October 23', 'https://cdn.mos.cms.futurecdn.net/3M5rYkK6SN3LfYGA5JaKZJ-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/amazon-sapprete-a-signer-un-accord-dun-milliard-de-dollars-avec-microsoft-365'),
(140, 'Attention ! Même les pages 404 peuvent voler les données de vos cartes de crédit', 'Des boutiques en ligne populaires ont été compromises avec Magecart, le code se cachant dans les pages 404.', 'Adrien Bar Hiyé', '10 October 23', 'https://cdn.mos.cms.futurecdn.net/YXEZxnPi2Yv5CdL4rhtKJP-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/security/attention-meme-les-pages-404-peuvent-voler-les-donnees-de-vos-cartes-de-credit'),
(141, 'Une IA a réussi à concevoir entièrement un robot qui se déplace, et ce en moins de 60 secondes', 'Il s\'agit du premier algorithme capable de concevoir des robots qui fonctionnent réellement dans le monde réel.', 'Adrien Bar Hiyé', '9 October 23', 'https://cdn.mos.cms.futurecdn.net/Rg4UFcQCxfd4nXTB2cgLT7-320-80.jpeg', 'https://global.techradar.com/fr-fr/pro/une-ia-a-reussi-a-concevoir-entierement-un-robot-qui-se-deplace-et-ce-en-moins-de-60-secondes');

-- --------------------------------------------------------

--
-- Structure de la table `catégories`
--

CREATE TABLE `catégories` (
  `IdC` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `catégories`
--

INSERT INTO `catégories` (`IdC`, `nom`) VALUES
(1, 'Site Web'),
(2, 'Produit');

-- --------------------------------------------------------

--
-- Structure de la table `critiques`
--

CREATE TABLE `critiques` (
  `IdCR` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `auteur` varchar(500) NOT NULL,
  `date_publication` varchar(500) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `url_critique` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `critiques`
--

INSERT INTO `critiques` (`IdCR`, `titre`, `libelle`, `auteur`, `date_publication`, `url_image`, `url_critique`) VALUES
(4, 'Test du Sandisk Professional G-Drive 2 To', 'Ce nouveau SSD externe offre un support de stockage haut de gamme qui allie durabilité et vitesse de transfert élevée.', 'Adrien Bar Hiyé', '26 March 24', 'https://cdn.mos.cms.futurecdn.net/323oc6ZCDEcdX5ybHotG64-320-80.jpg', 'https://global.techradar.com/fr-fr/reviews/test-ssd-sandisk-professional-g-drive-2-to'),
(5, 'Test de Flow VPN 2024', 'Un VPN non sécurisé et un chatbot d\'IA bidon constituent un ensemble à éviter à tout prix.', 'Adrien Bar Hiyé', '22 March 24', 'https://cdn.mos.cms.futurecdn.net/kQvULgkRSTkS8wPPnGKm7-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/vpn/test-de-flow-vpn'),
(6, 'Test du HTC Vive Focus 3', 'Le HTC Vive Focus 3 propose un réel renouveau de la gestion de la réalité virtuelle, à travers une proposition matérielle tout-en-un vouée à faire son chemin en entreprise.', 'Adrien Bar Hiyé', '12 March 24', 'https://cdn.mos.cms.futurecdn.net/e2kA4pVPHHwKoUafJUo2Qb-320-80.jpg', 'https://global.techradar.com/fr-fr/reviews/test-htc-vive-focus-3'),
(7, 'Test de NordVPN 2024', 'S\'agit-il vraiment du \'VPN le plus avancé au monde\' ? Nous répondons à cette question et à bien d\'autres dans notre évaluation de NordVPN 2024.', 'Clio Leonard, Mike Williams, Adrien Bar Hiyé', '6 March 24', 'https://cdn.mos.cms.futurecdn.net/FRBqLDhGdVbjLznbEJesyF-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/vpn/test-de-nordvpn-year'),
(8, 'Test du VPN Google One', 'Les fans de Google pourraient apprécier l\'ensemble de l\'offre One, mais le VPN lui-même est très limité.', 'Mike Williams, Clio Leonard, Adrien Bar Hiyé', '5 March 24', 'https://cdn.mos.cms.futurecdn.net/EF4NUKcoZVajA4KtUcea26-320-80.jpg', 'https://global.techradar.com/fr-fr/reviews/test-du-vpn-google-one'),
(9, 'Test de l’Honor MagicBook 14 2021 (Intel Edition)', 'Cette mise à niveau de l\'ordinateur portable Honor offre certaines promesses, même si celles-ci sont limitées par des choix matériels curieux.', 'Adrien Bar Hiyé', '2 February 24', 'https://cdn.mos.cms.futurecdn.net/fkDxSNzxAfWe3woGWmcW9X-320-80.jpg', 'https://global.techradar.com/fr-fr/reviews/honor-magicbook-14-2021-intel-edition'),
(10, 'Test du SSD portable Samsung T9', 'Samsung passe enfin à la technologie USB Gen 2x2 avec le T9, un disque SSD externe conçu pour répondre aux besoins des utilisateurs.', 'Clio Leonard, Mark Pickavance', '20 October 23', 'https://cdn.mos.cms.futurecdn.net/ZSLo4RAwjUe4HSqQ4eLo39-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/test-du-samsung-t9-le-ssd-portable-efficace-et-robuste'),
(11, 'Test Avira Antivirus : des solutions efficaces', 'Les solutions antivirus d\'Avira sont d\'une solidité impressionnante, mais c\'est la suite phare qui offre le meilleur rapport qualité-prix.', 'Clio Leonard, Mike Williams', '27 July 23', 'https://cdn.mos.cms.futurecdn.net/ZpsLLr5zTSt7XEeGH9hwr8-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/security/test-avira-antivirus-des-solutions-efficaces'),
(12, 'Test d\'ExpressVPN, un service à la hauteur de toutes vos attentes', 'Dans notre test complet d\'ExpressVPN, nous explorons les entrailles de l\'une des plus grandes références de VPN pour voir si elle est à la hauteur de l\'engouement qu\'elle suscite.', 'Clio Leonard, Mike Williams', '13 July 23', 'https://cdn.mos.cms.futurecdn.net/FFA5FVBJHbhL8VCAs5bjsi-320-80.jpg', 'https://global.techradar.com/fr-fr/pro/vpn/test-dexpressvpn-un-service-a-la-hauteur-de-toutes-vos-attentes');

-- --------------------------------------------------------

--
-- Structure de la table `favories_actualitées`
--

CREATE TABLE `favories_actualitées` (
  `IdFA` int(11) NOT NULL,
  `IdU` int(11) NOT NULL,
  `IdA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favories_actualitées`
--

INSERT INTO `favories_actualitées` (`IdFA`, `IdU`, `IdA`) VALUES
(2, 1, 138),
(3, 1, 133);

-- --------------------------------------------------------

--
-- Structure de la table `favories_critiques`
--

CREATE TABLE `favories_critiques` (
  `IdFC` int(11) NOT NULL,
  `IdU` int(11) NOT NULL,
  `IdCR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favories_critiques`
--

INSERT INTO `favories_critiques` (`IdFC`, `IdU`, `IdCR`) VALUES
(1, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `favories_guides`
--

CREATE TABLE `favories_guides` (
  `IdFG` int(11) NOT NULL,
  `IdU` int(11) NOT NULL,
  `IdG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favories_guides`
--

INSERT INTO `favories_guides` (`IdFG`, `IdU`, `IdG`) VALUES
(38, 1, 127),
(39, 1, 128);

-- --------------------------------------------------------

--
-- Structure de la table `guides`
--

CREATE TABLE `guides` (
  `IdG` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `auteur` varchar(500) NOT NULL,
  `date_publication` varchar(500) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `url_guide` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `guides`
--

INSERT INTO `guides` (`IdG`, `titre`, `libelle`, `auteur`, `date_publication`, `url_image`, `url_guide`) VALUES
(127, 'Les meilleurs VPN pour partager et télécharger des torrents en 2024', 'Les VPN dédiés au torrenting garantissent l\'anonymat de votre identité lorsque vous téléchargez des torrents. Nous vous aidons à choisir celui qui correspond le mieux à vos besoins.', 'Emmanuelle Soubelet', '28 March 24', 'https://cdn.mos.cms.futurecdn.net/DXi9cNinMDRoKPCfTXpeC9-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleurs-vpn-telechargement-torrent'),
(128, 'Meilleurs aspirateurs robots : lesquels vous garantissent sols propres et zéro poussière ?', 'Le ménage vous épuise ? Ces 9 aspirateurs robots peuvent prendre la relève.', 'Emmanuelle Soubelet', '28 March 24', 'https://cdn.mos.cms.futurecdn.net/PRguN4RMSmLkWsGrap6cRS-320-80.jpg', 'https://global.techradar.com/fr-fr/best/meilleurs-aspirateurs-robots'),
(129, 'Les meilleurs vidéoprojecteurs de 2024 : transformez votre salon en salle de cinéma', 'Découvrez le modèle le mieux adapté à votre intérieur, à votre budget et à vos goûts télévisuels / cinématographiques.', 'Emmanuelle Soubelet', '28 March 24', 'https://cdn.mos.cms.futurecdn.net/GhNwR6h6UvPMjDbpMHwsEG-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleurs-videoprojecteurs'),
(131, 'Les meilleurs téléviseurs 8K envisageables en 2024', 'Vous désirez plus de pixels que nécessaire et une qualité d\'image au sommet ? Ces téléviseurs 8K possèdent les résolutions les plus sensationnelles du marché.', 'Emmanuelle Soubelet', '28 March 24', 'https://cdn.mos.cms.futurecdn.net/4VsN3fVo6ogPZ2pDNDe72H-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleurs-televiseurs-8k'),
(132, 'Les meilleurs VPN pour le streaming en 2024', 'Un VPN peut vous ouvrir un monde de nouvelles possibilités pour le streaming à la demande et en direct. Découvrez les meilleures propositions du moment.', 'Emmanuelle Soubelet', '27 March 24', 'https://cdn.mos.cms.futurecdn.net/E4DGXnCxhfxVkVPchQFyK8-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleurs-vpn-streaming'),
(133, 'Meilleures montres connectées hybrides : elles vous offrent davantage que l\'heure', 'Vous souhaitez profiter des fonctionnalités premium d\'une Apple Watch, tout en conservant le design sobre d\'une montre analogique ? Optez pour l\'hybride.', 'Emmanuelle Soubelet', '27 March 24', 'https://cdn.mos.cms.futurecdn.net/Zx8sFBdFmqm3WwfMkTSXZe-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleures-montres-connectees-hybrides'),
(134, 'Meilleurs ordinateurs portables Dell : quel modèle choisir en 2024 ?', 'Il n\'est pas facile de déterminer quel sera le PC portable idéal pour vous accompagner tout au long de cette nouvelle saison. Mais il y a de fortes chances que ce soit un Dell.', 'Emmanuelle Soubelet', '27 March 24', 'https://cdn.mos.cms.futurecdn.net/QHtKydULjSL3jipwKUSMwD-320-80.jpg', 'https://global.techradar.com/fr-fr/news/meilleurs-ordinateurs-dell');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `IdP` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `libelle` varchar(500) NOT NULL,
  `IdC` int(11) NOT NULL,
  `url_produit` varchar(500) NOT NULL,
  `image_produit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`IdP`, `nom`, `libelle`, `IdC`, `url_produit`, `image_produit`) VALUES
(1, 'Amazon', 'Géant mondial du commerce électronique, Amazon propose une vaste sélection de produits informatiques, allant des composants matériels aux périphériques. Les avis des utilisateurs et les descriptions détaillées des produits aident les acheteurs à faire des choix informés.', 1, 'https://www.amazon.fr/?tag=admarketpla00-21&ref=pd_sl_1315a9a27e0e6e81c1a94487420a13ea31a4768166c80e3c8475b329&mfadid=adm', 'https://m.media-amazon.com/images/G/08/gc/designs/livepreview/amazon_squidink_noto_email_v2016_fr-main._CB463436975_.png'),
(2, 'Newegg', 'Spécialisé dans les produits électroniques et informatiques, Newegg est un site de référence pour les amateurs de technologie. Il propose des critiques approfondies, des guides d\'achat et des promotions régulières.', 1, 'https://www.newegg.com', 'https://www.newegg.com/sellers/wp-content/uploads/2022/01/Newegg_Marketplace_logo1.png'),
(4, 'Best Buy', 'Best Buy est un détaillant majeur en électronique grand public aux États-Unis, offrant une large gamme de produits informatiques avec des options de financement et des services après-vente.', 1, 'https://www.bestbuy.com/?intl=nosplash', 'https://corporate.bestbuy.com/wp-content/uploads/2018/05/2018_rebrand_blog_logo_LEAD_ART-thegem-blog-timeline-large.jpg'),
(5, 'Boulanger', 'Chaîne française de magasins spécialisés dans l\'électroménager et l\'électronique, Boulanger propose une gamme étendue de produits informatiques, avec des conseils et des services d\'installation.', 1, 'https://www.boulanger.com', 'https://lucid.communiti.corsica/img/back/back-blg-enseigne-boulanger.jpg'),
(6, 'LDLC', 'LDLC est un des leaders français de la vente en ligne de produits informatiques. Le site propose des composants, des ordinateurs et des périphériques avec des avis d\'experts et des guides d\'achat.', 1, 'https://www.ldlc.com', 'https://www.pagesjaunes.fr/media/agc/14/1d/67/00/00/42/c2/15/88/c5/62b3141d67000042c21588c5/62b3141d67000042c21588c6.gif'),
(7, 'Apple MacBook Pro 16', 'Le MacBook Pro 16 pouces de 2023 est équipé de la puce M2 Max, offrant des performances exceptionnelles pour les professionnels de la création. Il dispose d\'un écran Retina XDR, d\'une autonomie prolongée, et d\'un clavier Magic Keyboard amélioré. Sa puissance de traitement et ses capacités graphiques en font un choix idéal pour le montage vidéo, la modélisation 3D et les autres tâches exigeantes.', 2, 'https://www.apple.com/fr/macbook-pro/', 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/mbp16-spaceblack-select-202310?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1697311054290'),
(8, 'NVIDIA GeForce RTX 4090', 'La carte graphique GeForce RTX 4090 de NVIDIA est une bête de puissance pour les gamers et les professionnels. Basée sur l\'architecture Ada Lovelace, elle offre des performances sans précédent en jeu, du ray tracing en temps réel et des capacités d\'IA avancées. Elle est idéale pour les configurations de gaming haut de gamme et les stations de travail créatives.', 2, 'https://www.nvidia.com/fr-fr/geforce/graphics-cards/40-series/rtx-4090/', 'https://www.nvidia.com/content/dam/en-zz/Solutions/geforce/ada/rtx-4090/geforce-ada-4090-web-og-1200x630.jpg'),
(9, 'Logitech MX Master 3S', 'La souris Logitech MX Master 3S est conçue pour offrir confort et précision. Elle dispose d\'une roulette MagSpeed, de boutons programmables, et d\'un capteur Darkfield haute précision qui fonctionne sur toutes les surfaces, même le verre. C\'est un choix populaire parmi les professionnels pour sa polyvalence et son ergonomie.', 2, 'https://www.logitech.com/fr-fr/products/mice/mx-master-3s.910-006559.html', 'https://resource.logitech.com/w_692,c_lpad,ar_4:3,q_auto,f_auto,dpr_1.0/d_transparent.gif/content/dam/logitech/en/products/mice/mx-master-3s/gallery/mx-master-3s-mouse-top-view-graphite.png?v=1'),
(10, 'Samsung 980 Pro SSD', 'Le SSD Samsung 980 Pro est un disque NVMe M.2 offrant des vitesses de lecture/écriture ultra-rapides, jusqu\'à 7000/5000 MB/s. Il est idéal pour les gamers, les créateurs de contenu et les utilisateurs qui nécessitent des performances de stockage exceptionnelles. Il améliore significativement les temps de chargement et la réactivité du système.', 2, 'https://www.samsung.com/fr/memory-storage/nvme-ssd/ssd-980-pro-nvme-m-2-pcie-4-0-500gb-mz-v8p500bw/', 'https://images.samsung.com/is/image/samsung/fr-980-pro-nvme-m2-ssd-mz-v8p500bw-frontblack-304154350?$650_519_PNG$'),
(11, 'Raspberry Pi 4 Model B', 'Le Raspberry Pi 4 Model B est un micro-ordinateur compact et abordable, idéal pour les projets DIY, l\'apprentissage de la programmation et les petites applications serveur. Il est disponible avec 2, 4, ou 8 Go de RAM, et dispose de ports USB 3.0, Ethernet gigabit, et d\'un processeur quad-core ARM Cortex-A72. Sa flexibilité et son coût attractif en font un produit très prisé dans la communauté des makers et des éducateurs.', 2, 'https://www.raspberrypi.com/products/raspberry-pi-4-model-b/', 'https://assets.raspberrypi.com/static/raspberry-pi-4-labelled-f5e5dcdf6a34223235f83261fa42d1e8.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdU` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdU`, `nom`, `prenom`, `age`, `email`, `identifiant`, `mdp`) VALUES
(1, 'test', 'test', 12, 'test@gmail.com', 'test', '$2y$10$0h247730JWiTjnyTJp3XKeNSCOWB3SkANVJ1Q/7iAPxdLbz5evUnS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actualitées`
--
ALTER TABLE `actualitées`
  ADD PRIMARY KEY (`IdA`);

--
-- Index pour la table `catégories`
--
ALTER TABLE `catégories`
  ADD PRIMARY KEY (`IdC`);

--
-- Index pour la table `critiques`
--
ALTER TABLE `critiques`
  ADD PRIMARY KEY (`IdCR`);

--
-- Index pour la table `favories_actualitées`
--
ALTER TABLE `favories_actualitées`
  ADD PRIMARY KEY (`IdFA`),
  ADD KEY `IdA` (`IdA`),
  ADD KEY `IdU` (`IdU`);

--
-- Index pour la table `favories_critiques`
--
ALTER TABLE `favories_critiques`
  ADD PRIMARY KEY (`IdFC`),
  ADD KEY `IdU` (`IdU`),
  ADD KEY `favorie_critiques_ibfk_2` (`IdCR`);

--
-- Index pour la table `favories_guides`
--
ALTER TABLE `favories_guides`
  ADD PRIMARY KEY (`IdFG`),
  ADD KEY `IdU` (`IdU`),
  ADD KEY `IdG` (`IdG`);

--
-- Index pour la table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`IdG`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`IdP`),
  ADD KEY `IdC` (`IdC`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdU`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actualitées`
--
ALTER TABLE `actualitées`
  MODIFY `IdA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT pour la table `catégories`
--
ALTER TABLE `catégories`
  MODIFY `IdC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `critiques`
--
ALTER TABLE `critiques`
  MODIFY `IdCR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `favories_actualitées`
--
ALTER TABLE `favories_actualitées`
  MODIFY `IdFA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `favories_critiques`
--
ALTER TABLE `favories_critiques`
  MODIFY `IdFC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `favories_guides`
--
ALTER TABLE `favories_guides`
  MODIFY `IdFG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `guides`
--
ALTER TABLE `guides`
  MODIFY `IdG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `IdP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `IdU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favories_actualitées`
--
ALTER TABLE `favories_actualitées`
  ADD CONSTRAINT `favories_actualitées_ibfk_1` FOREIGN KEY (`IdA`) REFERENCES `actualitées` (`IdA`),
  ADD CONSTRAINT `favories_actualitées_ibfk_2` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`);

--
-- Contraintes pour la table `favories_critiques`
--
ALTER TABLE `favories_critiques`
  ADD CONSTRAINT `favories_critiques_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`),
  ADD CONSTRAINT `favories_critiques_ibfk_2` FOREIGN KEY (`IdCR`) REFERENCES `critiques` (`IdCR`);

--
-- Contraintes pour la table `favories_guides`
--
ALTER TABLE `favories_guides`
  ADD CONSTRAINT `favories_guides_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`),
  ADD CONSTRAINT `favories_guides_ibfk_2` FOREIGN KEY (`IdG`) REFERENCES `guides` (`IdG`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`IdC`) REFERENCES `catégories` (`IdC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
