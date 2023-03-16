

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `info` varchar(11) NOT NULL,
  `cardnumber` int(8) NOT NULL,
  `cardvalue` int(11) NOT NULL,
  `state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `info`, `cardnumber`, `cardvalue`, `state`) VALUES
(1, '100 banana', 12345678, 100, 1),
(2, '200 banana', 12345679, 200, 0),
(3, '500 banana', 45671234, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`,`price`, `image`, `amount`) VALUES
('1', 'Combo đầy đủ', 'SAMUEL0','300', '/product-img/1.jpg', '10'), 
('2', 'Thịt thêm', 'SAMUEL1','150', '/product-img/2.jpg', '10'), 
('3', 'Dồi thêm', 'SAMUEL2','150', '/product-img/3.jpg', '10'), 
('4', 'Rau thơm thêm', 'SAMUEL3','15', '/product-img/4.jpg', '10'), 
('5', 'Mắm tôm thêm', 'SAMUEL4','5', '/product-img/5.jpg', '10'), 
('6', 'Bún thêm', 'SAMUEL5','20', '/product-img/6.jpg', '10'), 
('7', 'Siro cay táo mèo', 'SAMUEL6','50', '/product-img/7.jpg', '10'), 
('8', 'Nước ngọt các loại', 'SAMUEL7','15', '/product-img/8.jpg', '10');;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `balance`) VALUES
(18, 'dat2', 'dat2@vip.pro', '$2y$10$86jRoPMrlYkXYzEfX08sQuSJb3EOCnEy4XDnGyQuYAad6fnsR4gG6', 'vip', 1127507),
(19, 'dat3', 'dat3@vip.pro', '$2y$10$Mw2SZArMBsbcZrVv/Yyia.13KuSnc6ZSlDbNEeTMWQvaDxP1Nqiyy', 'user', 7098),
(48, '123', '123@123.123', '$2y$10$2GwUEzPXuka9tV/U/KAR..5LJHeUXwAJ5ig6RNXiIcTA8lazUea1S', 'user', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
