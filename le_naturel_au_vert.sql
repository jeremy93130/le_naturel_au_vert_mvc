-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 04 mai 2024 à 18:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `le_naturel_au_vert`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `instruction_livraison` longtext DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `nom_complet` varchar(255) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `adresse`, `code_postal`, `ville`, `pays`, `instruction_livraison`, `client_id`, `nom_complet`, `commande_id`, `telephone`, `type`) VALUES
(105, 'livraison', 94422, 'Paris', 'Afghanistan', 'livraison', 11, 'charles henry', 129, '0102030405', 'livraison'),
(106, 'facturation', 94400, 'Paris', 'Afghanistan', NULL, 11, 'charles henry', 129, '0102030405', 'facturation');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `titre_avis` varchar(255) NOT NULL,
  `date_avis` date NOT NULL DEFAULT current_timestamp(),
  `avis` text NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_produit`, `id_user`, `titre_avis`, `date_avis`, `avis`, `note`) VALUES
(1, 1, 11, 'Plante vraiment spéciale', '2024-05-04', 'Généralement les professeurs de français recommandent à leurs élèves de ne pas faire de phrases trop longues. Victor Hugo ou Marcel Proust n’ont pas vraiment respecté ce principe. Chez Proust, les phrases comptent en moyenne 43 mots contre une vingtaine en moyenne chez les écrivains de langue française.\n\nDans les Misérables de Victor Hugo, la phrase la plus longue contient 823 mots mais Marcel Proust fait mieux dans La Recherche puisque on trouve dans Sodome et Gomorrhe une phrase de 856 mots la voici :\n\nSans honneur que précaire, sans liberté que provisoire, jusqu’à la découverte du crime ; sans situation qu’instable, comme pour le poète la veille fêté dans tous les salons, applaudi dans tous les théâtres de Londres, chassé le lendemain de tous les garnis sans pouvoir trouver un oreiller où reposer sa tête, tournant la meule comme Samson et disant comme lui : “Les deux sexes mourront chacun de son côté” ; exclus même, hors les jours de grande infortune où le plus grand nombre se rallie autour de la victime, comme les juifs autour de Dreyfus, de la sympathie – parfois de la société – de leurs semblables, auxquels ils donnent le dégoût de voir ce qu’ils sont, dépeint dans un miroir, qui ne les flattant plus, accuse toutes les tares qu’ils n’avaient pas voulu remarquer chez eux-mêmes et qui leur fait comprendre que ce qu’ils appelaient leur amour (et à quoi, en jouant sur le mot, ils avaient, par sens social, annexé tout ce que la poésie, la peinture, la musique, la chevalerie, l’ascétisme, ont pu ajouter à l’amour) découle non d’un idéal de beauté qu’ils ont élu, mais d’une maladie inguérissable ; comme les juifs encore (sauf quelques-uns qui ne veulent fréquenter que ceux de leur race, ont toujours à la bouche les mots rituels et les plaisanteries consacrées) se fuyant les uns les autres, recherchant ceux qui leur sont le plus opposés, qui ne veulent pas d’eux, pardonnant leurs rebuffades, s’enivrant de leurs complaisances ; mais aussi rassemblés à leurs pareils par l’ostracisme qui les frappe, l’opprobre où ils sont tombés, ayant fini par prendre, par une persécution semblable à celle d’Israël, les caractères physiques et moraux d’une race, parfois beaux, souvent affreux, trouvant (malgré toutes les moqueries dont celui qui, plus mêlé, mieux assimilé à la race adverse, est relativement, en apparence, le moins inverti, accable celui qui l’est demeuré davantage), une détente dans la fréquentation de leurs semblables, et même un appui dans leur existence, si bien que, tout en niant qu’ils soient une race (dont le nom est la plus grande injure), ceux qui parviennent à cacher qu’ils en sont, ils les démasquent volontiers, moins pour leur nuire, ce qu’ils ne détestent pas, que pour s’excuser, et allant chercher comme un médecin l’appendicite l’inversion jusque dans l’histoire, ayant plaisir à rappeler que Socrate était l’un d’eux, comme les Israélites disent de Jésus, sans songer qu’il n’y avait pas d’anormaux quand l’homosexualité était la norme, pas d’anti-chrétiens avant le Christ, que l’opprobre seul fait le crime, parce qu’il n’a laissé subsister que ceux qui étaient réfractaires à toute prédication, à tout exemple, à tout châtiment, en vertu d’une disposition innée tellement spéciale qu’elle répugne plus aux autres hommes (encore qu’elle puisse s’accompagner de hautes qualités morales) que de certains vices qui y contredisent comme le vol, la cruauté, la mauvaise foi, mieux compris, donc plus excusés du commun des hommes ; formant une franc-maçonnerie bien plus étendue, plus efficace et moins soupçonnée que celle des loges, car elle repose sur une identité de goûts, de besoins, d’habitudes, de dangers, d’apprentissage, de savoir, de trafic, de glossaire, et dans laquelle les membres mêmes, qui souhaitent de ne pas se connaître, aussitôt se reconnaissent à des signes naturels ou de convention, involontaires ou voulus, qui signalent un de ses semblables au mendiant dans le grand seigneur à qui il ferme la portière de sa voiture, au père dans le fiancé de sa fille, à celui qui avait voulu se guérir, se confesser, qui avait à se défendre, dans le médecin, dans le prêtre, dans l’avocat qu’il est allé trouver; tous obligés à protéger leur secret, mais ayant leur part d’un secret des autres que le reste de l’humanité ne soupçonne pas et qui fait qu’à eux les romans d’aventure les plus invraisemblables semblent vrais, car dans cette vie romanesque, anachronique, l’ambassadeur est ami du forçat : le prince, avec une certaine liberté d’allures que donne l’éducation aristocratique et qu’un petit bourgeois tremblant n’aurait pas en sortant de chez la duchesse, s’en va conférer avec l’apache ; partie réprouvée de la collectivité humaine, mais partie importante, soupçonnée là où elle n’est pas, étalée, insolente, impunie là où elle n’est pas devinée; comptant des adhérents partout, dans le peuple, dans l’armée, dans le temple, au bagne, sur le trône; vivant enfin, du moins un grand nombre, dans l’intimité caressante et dangereuse avec les hommes de l’autre race, les provoquant, jouant avec eux à parler de son vice comme s’il n’était pas sien, jeu qui est rendu facile par l’aveuglement ou la fausseté des autres, jeu qui peut se prolonger des années jusqu’au jour du scandale où ces dompteurs sont dévorés ; jusque-là obligés de cacher leur vie, de détourner leurs regards d’où ils voudraient se fixer, de les fixer sur ce dont ils voudraient se détourner, de changer le genre de bien des adjectifs dans leur vocabulaire, contrainte sociale, légère auprès de la contrainte intérieure que leur vice, ou ce qu’on nomme improprement ainsi, leur impose non plus à l’égard des autres mais d’eux-mêmes, et de façon qu’à eux-mêmes il ne leur paraisse pas un vice. (SG 614/16 )\n\nA noter que la phrase, peut-être la plus connue de l’œuvre de Proust, la première phrase de son œuvre majeure « A la recherche du temps perdu » est une des plus courtes, elle ne compte que 8 mots :\n\n Longtemps je me suis couché de bonne heure.\n\nMais la phrase la plus courte, et inutile de chercher plus court, se trouve dans « Un amour de Swann » : « Il regarda. » (merci au visiteur du site qui me l’a signalée).\n\n77 RÉFLEXIONS SUR « LA PHRASE LA PLUS LONGUE »', 5);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `etat_commande` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `numero_commande` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `client_id`, `date_commande`, `etat_commande`, `total`, `numero_commande`) VALUES
(129, 11, '2024-04-12', 'En Attente', 5.93, 'CMD6618f9456f2d6');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id`, `quantite`, `produit_id`, `commande_id`) VALUES
(199, 1, 11, 129);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `produit_id`, `image_name`) VALUES
(1, 1, 'strelitzia2.jpg'),
(2, 2, 'fatsia-japonica2.jpg'),
(6, 3, 'monstera2.avif'),
(7, 4, 'calathea2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` longtext NOT NULL,
  `prix_produit` double NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `caracteristiques` longtext NOT NULL,
  `entretien` longtext NOT NULL,
  `categorie` int(11) NOT NULL,
  `lot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `description_produit`, `prix_produit`, `stock`, `image`, `caracteristiques`, `entretien`, `categorie`, `lot`) VALUES
(1, 'Strelitzia Nicolaï', 'Le Strelitzia Nicolaï, également connu sous le nom de \"Oiseau de Paradis\", est une plante majestueuse originaire d\'Afrique du Sud. Appartenant à la famille des Strelitziaceae, cette plante tropicale est appréciée pour sa grande taille et sa beauté exotique. Le nom latin de cette plante, Strelitzia Nicolaï, honore à la fois la reine Charlotte de Mecklenburg-Strelitz et le Grand Duc Nicolas de Russie. Son nom commun, \"Oiseau de Paradis\", provient de la ressemblance de ses fleurs avec un oiseau en vol, donnant une touche d\'exotisme et de singularité à votre espace de vie. En somme, le Strelitzia Nicolaï est une plante d\'intérieur impressionnante et attrayante qui apporte une touche de nature sauvage et d\'exotisme à tout espace.', 49.99, 155, 'acheter-plante-strelitzia-nicolai-xl-786215.webp', 'Physiquement, le Strelitzia Nicolaï se caractérise par de grandes feuilles persistantes, vert foncé, qui peuvent atteindre jusqu\'à 2 mètres de longueur sur un tronc robuste et droit. La plante peut atteindre une hauteur de 6 mètres en pleine croissance, donnant une véritable impression de jungle tropicale. Comme caractéristiques phares du Strelitzia Nicolaï, notez que cette plante peut atteindre 1,5 m à 2 m si elle est cultivée dans un pot. De plus, le Strelitzia Nicolaï est une plante qui se démarque des autres plantes par le biais de la couleur de ses fleurs. Dotées d’une couleur blanche, les fleurs du Strelitzia Nicolaï fleurissent en ayant un feuillage persistant du mois de juin au mois de septembre.', 'Exposition : Lumineuse.\r\nArrosage : Régulier.\r\nTempérature : min(10°c) max(30°c).\r\nCroissance : Rapide.\r\nRempotage : Tous les 2 à 3 ans au printemps.\r\nFloraison : Mai à Septembre.\r\nFeuillage : Persistant Vert Brillant.\r\nTaille Adulte : Entre 1,5 et 2 mètres.', 1, 1),
(2, 'Aralia du japon', 'Fatsia japonica\r\nLe Fatsia japonica, ou aralia du Japon, est une des plantes d\'intérieur les plus courantes en appartements, il est très facile de se le procurer dans les jardineries et même en grandes surfaces. Moins connu pour cet usage, il formera pourtant un bel arbuste dans les jardins des régions les plus chaudes de notre pays.', 14.99, 177, 'aralia-sieboldii-600x450.jpg', 'Fatsia japonica : feuille vert brillant de 40 cm de longueur découpées en 7 à 11 lobes bien marqués. Jusqu\'à 4 m de hauteur ;', 'Exposition : Soleil - Mi- ombre.\r\nArrosage : 1 fois / semaine (été).\r\nTempérature : jusqu\'à -10°c.\r\nRempotage : Printemps.\r\nFeuillage : Vert Brillant.\r\nTaille Adulte : 3 mètres.', 1, 1),
(3, 'Monstera Deliciosa', 'La discrétion, très peu pour lui ! Comme son nom l’indique, le Monstera sait imposer sa loi, notamment dans son milieu naturel où il se transforme en véritable liane grimpant le long des troncs des arbres. Il est à coup sûr un compagnon malin : il a su développer des grandes feuilles supérieures dentelées pour permettre à celles inférieures de capter la lumière du soleil.', 22.49, 43, 'monstera.jpg', 'Merveilleuse plante d’intérieur, le monstera, parfois appelé faux-philodendron est l’une des plantes d’intérieur les plus vendues mais aussi l’une des plus résistantes et faciles à cultiver.\r\n\r\nElle fait notre bonheur grâce à son grand pouvoir décoratif et son feuillage unique.', 'Exposition : Lumineux - Sans soleil direct.\r\nArrosage : Régulier. Brumiser feuilles.\r\nTempérature : 20°c.\r\nRempotage : Printemps.\r\nFeuillage : Vert Brillant.\r\nTaille Adulte : 3 mètres.', 1, 1),
(4, 'Calathea Ornata', 'La plante porte de grandes feuilles oblongues vert foncé, rouge pourpre au revers, marquées de façon saisissante de rayures contrastantes de chaque côté de la nervure centrale. Elles sont roses sur les jeunes feuilles, mais deviennent blanches avec le temps.', 21.99, 180, 'Calathea.webp', 'Le somptueux Calathea Ornata ! Il est parfait pour décorer une grande pièce à vivre. On est fan de son feuillage panaché, particulièrement des rayures rose pâle sur la partie supérieure qui viennent contraster avec le vert foncé de la plante.', 'Exposition : Mi- ombre, Ombre.\r\nArrosage : Surface sèche.\r\nTempérature : min(10°c), 18°min recommandé.\r\nCroissance : Rapide.\r\nRempotage : Tous les 2 à 3 ans au printemps.\r\nFeuillage : Persistant .\r\nTaille Adulte : ~1 mètre.', 1, 1),
(5, 'Pink Princess', 'Jolie en rose, c\'est évidemment le code vestimentaire de notre Aglanomea Pink Princess. Elle a de superbes feuilles rose vif avec des bords jaunes/verts et les nervures ressortent vraiment car la nervure centrale est vert clair alors que les autres nervures sont blanches. Elle se distingue par ses couleurs gaies et, en plus, elle est même une star de la purification de l\'air ! Que demander de plus ?', 22.95, 127, 'aglanomea.avif', 'Elle peut atteindre 1 m de hauteur et 0,60 m d’étalement formant ainsi un petit arbuste d’intérieur, mais les sujets moyens font généralement 0,40 à 0,50 m de hauteur pour 0,25 à 0,40 m de large. Ses feuilles persistantes et brillantes varient selon les espèces du vert pâle, moyen, foncé ou olive au vert-jaune, vert-bleu ou vert-argent. Beaucoup sont appréciées pour leurs marbrures, leurs rainures ou leurs pointillés gris, ivoire, jaunes ou blancs. La plante fleurit l’été et au début de l’automne, offrant des fleurs ou spathes jaunes ou blanches qui ressemblent à des arums. Celles-ci sont suivies de baies rouges et orange. La floraison reste toutefois peu fréquente et sans beaucoup d’intérêt.', 'Exposition : Mi- ombre.\r\nArrosage : 1 fois / 1 ou 2 semaines.\r\nTempérature : min: 10°C - id: 16°C - max: 20°C\r\nRempotage : Printemps.\r\nFeuillage : Persistant.\r\nTaille Adulte : 0.15cm à 1 mètre.', 1, 1),
(6, 'Palmier Areca', 'L’Aréca est l’une des plantes vertes les plus en vogue depuis de nombreuses années grâce à son feuillage luxuriant qui donne l’impression d’avoir une forêt miniature au salon !. Ce palmier pousse en touffes en produisant des stipes fins et annelés. Ses longues palmes restent vertes toute l’année et persistent.', 30.99, 175, 'palmier-areca-istock.jpg', 'Cultivé en pot, l’Aréca culmine à 2 m tout au plus, mais développe de nombreux stipes et forme un palmier d’intérieur de belle allure si la température ne descend pas en dessous de 15 °C. Mais ce palmier d’intérieur ne fleurit pas, à moins d’être cultivé en serre chaude et humide.', 'Exposition : Lumineux - Sans soleil direct.\r\nArrosage : Régulier. 3/4 jours.\r\nTempérature : 20°c.\r\nRempotage : Printemps.\r\nFeuillage : Vert Souple.\r\nTaille Adulte : 2 mètres.', 1, 1),
(7, 'Pommier Nain', 'La définition la plus exacte d\'un arbre fruitier nain est : \"variété dont le développement par rapport à la variété standard est de 30 à 40%\".', 22.99, 0, 'pommier_nain.jpg', 'Également appelé le Malus domestica \'Gala\', le « Mini-pommier ‘Gala’ » est un arbre fruitier qui apporte un ornement original et attractif aux balcons et aux terrasses. Les couleurs des pommes sont d’un magnifique rouge orangé flamboyant avec un soupçon de jaune, rehaussé par le vert profond des feuilles. Ce trait spécifique lui permet d’être un élément attrayant dans le jardin. Originaire de Nouvelle-Zélande, le Mini-pommier ‘Gala’, issu du croisement des deux variétés Kidd’s Orange Red et Golden Delicious, est un fruitier nain largement cultivé à travers le monde. Son nom, ‘Gala’, lui a été attribué notamment en raison de l\'éclat de ses fruits qui n’ont rien à envier à la parure d’une star de cinéma sur un tapis rouge ! Il est considéré comme une variété robuste et rapidement productive. Ces différents atouts ont fait de cette variété une espèce que recommande l’équipe Willemse de planter dans votre espace vert.', 'Exposition : Ensoleillée.\r\nArrosage : Régulier.\r\nTempérature : Jusqu\'à -20°C.\r\nCroissance : Normale.\r\nTaillage: Leger Hiver ou Tôt Printemps.\r\nRécolte : Octobre - Novembre.\r\nTaille Adulte : Entre 1,4 et 1,6 mètres.', 1, 1),
(8, 'Poirier Nain', 'La définition la plus exacte d\'un arbre fruitier nain est : \"variété dont le développement par rapport à la variété standard est de 30 à 40%\".', 37.59, 52, 'poirier_nain.jpg', 'Le Poirier nain Garden Pearl® Pyvert est un petit arbre à très faible vigueur qui s\'adapte aussi bien en pleine terre qu\'à la culture en pot. Etonnement, il produit de nombreux fruits, aussi gros que les arbres de vigueur normale. Ils sont verts, un peu arrondis. Leur chair est fondante, sucrée et douceâtre. La récolte a lieu de fin septembre à octobre. Le Poirier nain Garden Pearl® Pyvert est auto fertile.', 'Exposition : Ensoleillée.\r\nArrosage : Régulier.\r\nTempérature : Jusqu\'à -20°C.\r\nCroissance : Normale.\r\nTaillage: Leger Hiver ou Tôt Printemps.\r\nRécolte : Septembre - Octobre.\r\nTaille Adulte : ~ 1,5 mètres.', 1, 1),
(9, 'Cerisier Nain', 'Le mini-cerisier ou Prunus Dwarf sour cherry, est un arbre fruitier de la famille des rosacées. Plus petit que les autres arbres fruitiers de sa famille, il mesure au maximum 2 m. Le cerisier nain propose de longues branches feuillues qui, au fil des saisons, s’équipent de fleurs puis de fruits. Il donne des cerises à la chair rouge, sucrées et parfumées.', 34.49, 120, 'cerisier_nain.jpg', 'Le cerisier nain est originaire d’un croisement entre plusieurs arbres fruitiers. Ainsi, les parents végétaux de l’arbuste sont le cerisier de Mongolie amélioré et le cerisier acide. Le cerisier de Mongolie amélioré est lui-même issu d’un croisement entre le cerisier de Mongolie et le cerisier acide.', 'Exposition : Ensoleillée.\r\nArrosage : Régulier.\r\nTempérature : Jusqu\'à -20°C.\r\nCroissance : Normale.\r\nTaillage: Octobre à Novembre.\r\nRécolte : Juin - Juillet.\r\nTaille Adulte : ~ 1,8 mètres.', 1, 1),
(10, 'Abricotier Nain', 'L\'Abricotier Nain Garden Aprigold est une variété auto fertile. De petite taille, il prend moins de place, demande moins d\'entretien et fournit pourtant d\'aussi gros fruits ! De bonne qualité gustative, ses fruits mesurent environ 5 cm de diamètre et sont de forme arrondie. Leur peau jaune doré est orange au soleil. La récolte a lieu en juillet.', 51.99, 0, 'abricotier_nain.jpg', 'L\'Abricotier Nain Garden Aprigold est une variété robuste, résistante au froid grâce à sa floraison tardive. Cette variété a un port demi-érigé et demi-étalé, ce qui traduit un arbre fin et en hauteur avec des branches à croissance verticale et d\'autres à croissance horizontale, à silhouette très élégante, arrondie. Les feuilles sont dentées, en forme de cœur, et ont un pétiole long. Il atteint jusqu\'à 1 m de hauteur pour un diamètre de 60 cm. Il se cultive très bien en pots sur vos terrasses et balcons.', 'Exposition : Ensoleillée.\r\nArrosage : Régulier.\r\nTempérature : Jusqu\'à -15°C.\r\nCroissance : Normale.\r\nTaillage: Janvier - Février.\r\nRécolte : Juillet.\r\nTaille Adulte : ~ 1 mètre.', 1, 1),
(11, 'Fraises', 'Délicieuses fraises sucrées et savoureuses', 5.62, 795, 'fraises.jpg', 'Calibre moyen', 'à manger dans les plus bref délais', 4, 50),
(12, 'Butternut', 'La courge Butternut, aussi appelée courge Noix de Beurre ou courge Doubeurre est une variété tardive et coureuse.', 25.99, 700, 'butternut.jpg', 'Elle produit 4 à 7 fruits par pied, de 8 à 12 cm de diamètre pour la partie cylindrique, de 10 à 14 cm pour la partie renflée sur 15 à 25 cm de haut, le poids varie entre 1,5 et 3 kg.', 'La courge butternut est une coriace et se conserve sans mal plusieurs semaines. Théoriquement, elle peut même se garder plusieurs mois ! Conservez les courges butternut comme des pommes de terre, entières, à l\'ombre, dans un endroit frais et sec.', 3, 10),
(13, 'Laitue', 'Salade', 2.99, 1468, 'laitue.jpg', 'La Laitue cultivée est une plante annuelle, glabre et lisse, de 60 cm à 1, 20 m de haut. La tige, rameuse et dressée, contient un latex blanc (caractéristique du genre) et porte de nombreuses feuilles glabres.', 'Enveloppez dans un linge à vaisselle propre pour contrôler l\'humidité et déposez-le dans un sac de plastique ou un contenant hermétique. La plupart des laitues vont se conserver jusqu\'à une semaine au frigo. Les mescluns et les bébés épinards prélavés se conservent seulement quelques jours.', 3, 1),
(14, 'Graines Laitues', 'Graines de laitues prêtes à l\'emploi ! Lot de 50 graines / achat.', 25.99, 980, 'graine-de-laitues.jpg', 'Laitue Pommée D\'Été et d\'Automne Grosse Blonde Paresseuse\r\nCette très ancienne variété française, résistante à la chaleur, produit des feuilles ondulées et cloquées, de couleur vert pâle. Elles forment une pomme volumineuse, d\'environ 30 cm de diamètre, plutôt ronde et aplatie.', 'Les graines de salades peuvent être conservées entre 4 à 5 ans selon les conditions de stockage. À noter que la germination de vos graines peut diminuer avec le temps.', 2, 50),
(15, 'Graines de concombres', 'En Lot de 70 graines / achat', 15.45, 1494, 'graines-de-concombre.jpg', 'Le concombre blanc hâtif est une variété à fruit allongé, presque cylindrique d\'abord vert pâle et prenant une couleur bien blanche à maturité.', 'Lavez soigneusement les graines et laissez-les à sécher plusieurs jours dans un endroit sec et aéré. Lorsqu\'elles sont bien sèches, stocker les graines dans un endroit frais et à l\'abri de la lumière. Correctement séchées et stockées, les graines de concombres restent fécondes jusqu\'à 8-10 ans après la récolte !', 2, 70);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `roles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_de_naissance`, `telephone`, `roles`) VALUES
(6, 'dubreuil', 'nathan', 'nathan@mail.fr', '$2y$13$JcP/KAxRK0BDcKRl/BjYq.1/wv6w4SUvyo9thdqetZChTdlpANVOK', '1992-03-10', '102030102', 'ROLE_USER'),
(8, 'user', 'user', 'user@mail.fr', '$2y$13$bRPpWzLxPMce7KBUhtA6EOLtVURuXJx0l8pQRnLlCux9xI9WUvDoe', '1992-08-11', '102030102', 'ROLE_USER'),
(11, 'dubrulle', 'jeremy', 'jeremy@mail.fr', '$2y$10$5HVoWzVyTBPSZXgGuPS0/eWS61lCRkDKiKB053ypn7Wk4.NehrjOa', '1992-05-11', '0768004586', 'ROLE_ADMIN'),
(12, 'test', 'test', 'jeremy.dubrulle@lepoles.org', '$2y$10$bR.Q7MTdvwX2hT7bNJJbruX6Va0Nk3tkYOCPY7dD.PxQxlu3D8znu', '1748-05-11', '0613451200', 'ROLE_USER');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C35F081619EB6921` (`client_id`),
  ADD KEY `IDX_C35F081682EA2E54` (`commande_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D19EB6921` (`client_id`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4BCD5F682EA2E54` (`commande_id`),
  ADD KEY `IDX_4BCD5F6F347EFB` (`produit_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E01FBE6AF347EFB` (`produit_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F081619EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_C35F081682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `FK_4BCD5F682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_4BCD5F6F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6AF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
