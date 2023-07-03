-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2023 a las 05:29:02
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombres` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombres`) VALUES
(1, 'Historia'),
(3, 'Aventura'),
(4, 'Accion'),
(5, 'Fantasia'),
(6, 'Documental'),
(7, 'Comedia'),
(8, 'Romance'),
(10, 'Terror'),
(15, 'Musica'),
(21, 'Videojuegos'),
(23, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `papelera` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `descripcion`, `fecha`, `imagen`, `papelera`) VALUES
(3, 7, 1, 'Alejandro de Macedonia', 'Una obra del gran viaje del conquistador. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2023-06-16', '1686880637_alejandro.jpg', b'0'),
(4, 4, 1, 'Xica da Silva', 'Articulo sobre una novela brasilera de epoca. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2013-02-07', NULL, b'0'),
(7, 6, 7, 'Reseña de Carnival Phantasm', 'Resumen y opinion de una serie humoristica y parodica. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-06-16', '1686880833_Carnival.jpg', b'0'),
(9, 3, 6, 'Nayib Bukele', 'Articulo sobre el presidente de El Salvador Bukele. \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-16', '1686882311_NAYIB-CORRECTA-684x1024.jpg', b'0'),
(10, 3, 4, 'Fate/Stay night', 'Sobre la novela visual de Typemoon escrita por Kinoko Nasu. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-18', '1686954877_Avalon.jpg', b'0'),
(25, 1, 5, 'Fate/Camelot', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-06-17', '1686879872_ArtoriaMordred.jpg', b'0'),
(39, 1, 1, 'El hombre mas rico de Babilonia', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-06-18', '1686880528_ishtar_Puerta.png', b'0'),
(43, 10, 6, 'Donald J. Trump', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem ipsum. \r\n\r\nAt enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur amae ni pax.', '2023-06-30', '1687051805_trump.jpeg', b'0'),
(60, 3, 5, 'Inuyasha: La espada que domina al mundo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-26', '1687753694_InuYasha_the_Movie_3-_Swords_of_an_Honorable_Ruler.webp', b'0'),
(61, 12, 21, 'El nuevo juego de la saga Avatar: Frontiers of Pandora', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-06-16', 'Avatar.webp', b'0'),
(82, 10, 1, 'Biografia de Isabel I de castilla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-28', '1687934170_isabel-la-catolica.jpg', b'0'),
(84, 10, 10, 'Titulo', 'zzzz', '2023-06-28', NULL, b'1'),
(88, 10, 1, 'Legado de Felipe II el prudente', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ornare massa eget egestas purus viverra accumsan in nisl. Turpis egestas pretium aenean pharetra magna. Volutpat diam ut venenatis tellus in metus vulputate eu. Ultricies mi quis hendrerit dolor magna eget est. Viverra nam libero justo laoreet sit amet cursus sit amet. Habitant morbi tristique senectus et netus et malesuada. Nunc aliquet bibendum enim facilisis gravida neque convallis a cras. Auctor eu augue ut lectus arcu bibendum at. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Sollicitudin nibh sit amet commodo nulla facilisi nullam vehicula ipsum. Purus ut faucibus pulvinar elementum integer enim neque volutpat. Commodo viverra maecenas accumsan lacus vel facilisis volutpat est. Nec ullamcorper sit amet risus. Id velit ut tortor pretium viverra suspendisse potenti. Viverra tellus in hac habitasse platea dictumst. Convallis a cras semper auctor neque vitae tempus quam. Urna porttitor rhoncus dolor purus. Senectus et netus et malesuada fames ac turpis egestas. Sit amet tellus cras adipiscing enim eu.', '2023-06-29', '1688069835_felipe-ii-rey-inglaterra.jpg', b'0'),
(89, 1, 1, 'Papel de los Magnates Industriales', 'Donec ultrices tincidunt arcu non. Mauris augue neque gravida in fermentum. Tellus in metus vulputate eu scelerisque felis imperdiet. Consectetur a erat nam at lectus urna. Bibendum est ultricies integer quis auctor elit sed. Turpis nunc eget lorem dolor sed viverra ipsum nunc. Egestas integer eget aliquet nibh praesent tristique magna sit ametis.', '2023-06-29', '1688070370_vlcsnap-2023-06-19-22h23m52s116.png', b'0'),
(90, 1, 23, 'SpaceX: El futuro de la industria espacial', 'Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Commodo odio aenean sed adipiscing. Cursus turpis massa tincidunt dui ut ornare lectus. Platea dictumst vestibulum rhoncus est pellentesque. Nunc sed augue lacus viverra vitae congue. Mi in nulla posuere sollicitudin aliquam. Ultrices gravida dictum fusce ut placerat. Quis eleifend quam adipiscing vitae. Diam in arcu cursus euismod quis viverra. Elementum curabitur vitae nunc sed velit dignissim sodales ut. Purus semper eget duis at tellus at urna condimentum mattis. Aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices. Aliquam id diam maecenas ultricies mi eget mauris. Amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor. Risus in hendrerit gravida rutrum quisque non tellus.', '2023-06-29', '1688069945_starship-super-heavy.jpeg', b'0'),
(92, 1, 23, 'Tesla Motors: Gigante del coche electrico', 'At erat pellentesque adipiscing commodo elit at imperdiet. In est ante in nibh mauris cursus mattis molestie a. Rhoncus mattis rhoncus urna neque viverra justo. Lorem donec massa sapien faucibus et molestie ac. Faucibus in ornare quam viverra. Lectus arcu bibendum ad varius. Aenean et tortor at risus viverra. Enim sed faucibus turpis in eu mi bibendum neque. Pulvinar pellentesque habitant morbi tristique senectus et netus et malesuada. Egestas congue quisque egestas diam in arcu cursus euismod. Vulputate sapien nec sagittis aliquam malesuada bibendum arcu vitae elementum.', '2023-06-29', '1688070010_tesla.jpg', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `contrasenya`) VALUES
(1, 'Victor', 'Robles', 'VictorRobles@gmail.com', 'VictorMaster12'),
(2, 'Mauricio', 'Hernandez', 'MariHernandez@gmail.com', 'HHHH1421_a'),
(3, 'Sofia', 'Rosales', 'RosalesSofia@outlook.com', 'Mariasofia1998'),
(4, 'Flora', 'Maciel', 'FloraLiam@gmail.com', '12345zyx'),
(6, 'Antonio', 'Puentes', 'Antonio2022@gmail.com', '5zyxAZ'),
(7, 'Liam', 'Curiel', 'Liam_GXD@gmail.com', 'GXD951'),
(10, 'Admin', 'Esperanza', 'admin@admin.com', '54321'),
(11, 'Arya', 'Stark', 'xxxxHeroe@gmail.com', 'AryakratS'),
(12, 'Prisila', 'Contreras', 'Prisla_C@gmail.com', 'Prisila1'),
(14, 'Mauricio', 'Macri', 'MacriMauricio@outlook.com', 'Mauricio1'),
(21, 'Ariana', 'Uribe', 'uribeatencio2021@gmail.com', '1234'),
(24, 'Carlos', 'Saavedra', 'CAJSA1974@gmail.com', '123456'),
(27, 'Mario', 'Ferrer', 'Ferrer15@gmail.com', '1111111'),
(32, 'Anonimo', 'El sin nombre', 'Elqueno_existe@gmail.com', 'Anonimo123'),
(34, 'Paco', 'Rodriguez', 'PacoRz@gmail.com', '54321Rp'),
(35, 'Lidya', 'Flores', 'Flores@hotmail.com', '12345Fl'),
(38, 'Solomon', 'Golchmight', 'Golchmight@gmail.com', '789Gs123'),
(39, 'Fabiana', 'Martinez', 'Fabiana_M@outlook.com', 'Fabiana1'),
(40, 'Leonardo', 'Uribe', 'LeonardoJose@gmail.com', 'Leo123'),
(42, 'Alfredo', 'Rios', 'RiosAlfred@gmail.com', 'AlfredR1'),
(43, 'Melissa', 'Sanchez', 'SanchezMelissa@gmail.com', 'Melissa2'),
(44, 'Maribel', 'Atencio', 'AtencioCarmen@gmail.com', '12345Aa'),
(49, 'Francis', 'Drake', 'DrakeFrancis@gmail.com', '11111Fran'),
(50, 'Elissa', 'O\"Brian', 'Obrian@outlook.com', 'Obrian1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Entradas_usuario` (`usuario_id`),
  ADD KEY `fk_Entradas_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_Entradas_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_Entradas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
