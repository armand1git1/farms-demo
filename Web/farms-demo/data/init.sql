SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `note` int(1) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `cost_price` int(10) DEFAULT NULL,
  `url_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `note`, `description`, `cost_price`, `url_image`) VALUES
(1, 4, 'Burger aux produits frais de saison', 5500, 'http://lorempixel.com/output/food-q-c-400-300-9.jpg'),
(2, 3, 'Un sauté de concombre, poivron, et oignon confits.', 4500, 'http://lorempixel.com/output/food-q-c-400-300-6.jpg'),
(3, 4, 'Boeuf cuit aux herbes de provences', 5500, 'http://lorempixel.com/output/food-q-c-400-300-1.jpg'),
(4, 3, 'Agneau accompagné d\'une salade du jardin', 5000, 'http://lorempixel.com/output/food-q-c-400-300-2.jpg'),
(5, 2, 'Filets de saumon à la sauce barbecue', 3000, 'http://lorempixel.com/output/food-q-c-400-300-3.jpg'),
(6, 5, 'Yakitori sur son coulis de tomate', 4000, 'http://lorempixel.com/output/food-q-c-400-300-4.jpg'),
(7, 3, 'Salade composée des produits de saison', 2000, 'http://lorempixel.com/output/food-q-c-400-300-5.jpg'),
(8, 5, 'Pain façon sud-ouest version mini', 2000, 'http://lorempixel.com/output/food-q-c-400-300-7.jpg');

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
