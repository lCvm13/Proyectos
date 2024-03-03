-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2023 a las 12:16:37
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo_blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`) VALUES
(12, 'Curiosidad'),
(13, 'Información'),
(25, 'Novedad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_usuario`, `id_entrada`, `contenido`, `fecha`) VALUES
(7, 1, 72, 'uisdfsdaoifsdafijasdf', '2023-12-13 12:47:52'),
(8, 1, 72, 'adasdsad', '2023-12-13 13:52:12'),
(9, 2, 72, 'assadad', '2023-12-15 11:32:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` varchar(2000) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `titulo`, `contenido`, `fecha_creacion`, `categoria_id`) VALUES
(57, ' Explorando el Paraíso: Descubre las Playas de Bora Bora', 'Sumérgete en la serenidad y la belleza sin igual de las playas de Bora Bora, una isla paradisíaca que parece haber sido esculpida por los propios dioses del océano Pacífico. Este rincón del Edén ofrece mucho más que simplemente aguas cristalinas y arenas blancas; es una experiencia sensorial que despierta todos los sentidos. Las aguas turquesas, suaves como caricias, bordean la costa, mientras que los bungalows sobre el agua, icónicos de la isla, se erigen como símbolos de lujo y privacidad.\r\n\r\nMás allá de la postal perfecta, Bora Bora invita a sumergirse en su rica cultura. Desde las danzas tradicionales polinesias que narran historias ancestrales hasta la deliciosa gastronomía local que deleita los paladares más exigentes, cada rincón de la isla es una invitación a explorar la exuberante naturaleza y sumergirse en la autenticidad de la vida isleña. Descubre los secretos de la pesca perlera, aprende sobre las antiguas leyendas que envuelven la isla y encuentra tu propio rincón de paz en este paraíso terrenal.', '2023-12-13 09:12:34', 25),
(58, 'Entre Montañas y Nubes: La Magia de los Alpes Suizos', 'Deja que la majestuosidad de los Alpes Suizos te envuelva en un abrazo celestial, donde las montañas parecen tocar el cielo y los lagos serenos reflejan la belleza natural circundante. Explora pintorescos pueblos alpinos, donde la arquitectura tradicional se fusiona armoniosamente con el entorno, creando un paisaje que parece salido de un cuento de hadas. Cada rincón de esta región es una obra maestra de la naturaleza y la creatividad humana.\r\n\r\nLa magia de los Alpes no solo radica en sus paisajes imponentes, sino también en las actividades que ofrecen en cada estación del año. Desde emocionantes deportes de invierno que desafían la gravedad hasta suaves paseos por prados florecientes durante la primavera, los Alpes son un lienzo en constante cambio. Sumérgete en la rica historia y cultura de esta región montañosa, donde las leyendas se entrelazan con la realidad y cada cumbre cuenta una historia única.\r\n\r\nEstas son solo pinceladas de las maravillas que aguardan en los Alpes Suizos. Prepara tus sentidos para un viaje que va más allá de lo visual y te sumerge en la esencia misma de la majestuosidad natural.', '2023-12-13 09:13:04', 13),
(59, 'El Esplendor de Santorini: Más Allá de las Postales', 'Santorini, una isla joya en el mar Egeo, va más allá de las postales perfectas que la han inmortalizado en la imaginación de viajeros de todo el mundo. Descubre los secretos detrás de las icónicas casas blancas con techos azules que se aferran a los acantilados, creando un paisaje único y cautivador. Más que un destino fotogénico, Santorini es un testimonio de la historia y la cultura griega que se entrelaza con sus calles empedradas y sus antiguos yacimientos arqueológicos.\r\n\r\nExplora la autenticidad de la isla, alejándote de las multitudes turísticas para descubrir pequeñas tabernas tradicionales y experiencias locales que te sumergirán en la verdadera vida de las islas griegas. Desde las puestas de sol inolvidables en Oia hasta las playas de arenas negras en Perissa, cada rincón de Santorini ofrece una nueva perspectiva de esta joya del Egeo.', '2023-12-13 09:13:25', 12),
(60, 'Aventuras en la Amazonia: La Selva Tropical en su Máxima Expresión ', 'Embárcate en una aventura sin igual en la Amazonia, la selva tropical que alberga una diversidad única de flora y fauna. Sumérgete en la exuberancia de la selva, donde cada rincón parece latir con vida. Desde las majestuosas copas de los árboles hasta el bullicioso suelo del bosque, la Amazonia te envuelve en una sinfonía de sonidos, colores y fragancias.\r\n\r\nDescubre las experiencias auténticas con las comunidades locales, aprendiendo sobre sus tradiciones y modos de vida sostenibles. Conviértete en testigo de la importancia de la conservación y la preservación de esta maravilla natural, entendiendo cómo la selva tropical desempeña un papel crucial en el equilibrio ecológico del planeta.\r\n\r\nCada paso en la Amazonia es una lección de humildad frente a la grandiosidad de la naturaleza. Desde la majestuosidad de los ríos hasta el misterio de la densa vegetación, esta aventura te dejará con recuerdos imborrables de un ecosistema único y vital.', '2023-12-13 09:14:07', 13),
(61, ' Sinfonía de Colores: El Otoño en Nueva Inglaterra', 'Cuando el verano cede su paso y las temperaturas descienden, Nueva Inglaterra se viste con una sinfonía de colores otoñales que cautivan los sentidos. Este viaje a través de los estados de Vermont, Nueva Hampshire y Massachusetts te llevará a un mundo donde los paisajes se transforman en una explosión de tonos cálidos. Bosques de arces, robles y abedules pintan las montañas y valles con tonalidades que van desde el dorado suave hasta el rojo intenso.\r\n\r\nExplora pintorescos pueblos, donde las casas coloniales se armonizan con la paleta natural que la temporada ofrece. Participa en la tradición de la cosecha de manzanas en los huertos locales y siente la crujiente brisa otoñal mientras paseas por senderos bordeados de hojas caídas. Cada rincón de Nueva Inglaterra cuenta una historia de la transición de estaciones, y el otoño es su capítulo más vibrante.\r\n\r\nEste viaje otoñal no solo se trata de colores; es una experiencia sensorial completa. Desde el aroma a tierra húmeda hasta el sonido de las hojas crujientes bajo tus pies, Nueva Inglaterra en otoño es una invitación a perderse en la magia efímera de la naturaleza.', '2023-12-13 09:25:07', 12),
(62, 'Maravillas Naturales en Islandia: Cascadas, Glaciares y Auroras Boreales', 'Islandia, la isla de fuego y hielo, es un festín visual donde la naturaleza despliega sus maravillas de manera deslumbrante. Desde majestuosas cascadas hasta imponentes glaciares, cada rincón de esta tierra nórdica es un testimonio de la belleza cruda y prístina. Pero la magia de Islandia va más allá de su paisaje diurno; cuando la noche cae, las auroras boreales danzan en el cielo, pintando un cuadro celestial.\r\n\r\nExplora las cataratas como Skógafoss y Gullfoss que desafían la gravedad, adéntrate en cuevas de hielo que parecen salidas de un cuento de hadas y camina sobre la cresta de un volcán dormido. Descubre la cultura rica y única del país, desde sus sagas vikingas hasta la moderna escena artística y musical. Islandia es una tierra de contrastes que despierta la imaginación y deja una impresión duradera.\r\n\r\nCada rincón de Islandia parece esculpido por los elementos, creando un paisaje que te transporta a otro mundo. Prepárate para un viaje donde la naturaleza te envuelve en su abrazo y las maravillas se despliegan ante tus ojos en cada esquina de esta tierra de maravillas naturales.', '2023-12-13 09:25:24', 12),
(63, 'Safari en Serengeti: Testigo de la Gran Migración', 'Embárcate en un safari visual a través del Parque Nacional del Serengeti en África, donde la naturaleza se despliega en su máxima expresión. La Gran Migración, uno de los espectáculos más impresionantes de la vida salvaje, te sumergirá en la majestuosidad y la cruda realidad de la vida en la sabana. Manadas de ñus y cebras cruzan las llanuras en una danza de la supervivencia, mientras los depredadores acechan en busca de la oportunidad perfecta.\r\n\r\nDescubre la rica biodiversidad que habita en esta vasta extensión de la tierra africana, desde los majestuosos leones hasta los elegantes elefantes. Las extensas llanuras te ofrecen una visión panorámica que parece no tener fin, y cada amanecer y atardecer pinta el cielo con colores que desafían la descripción.\r\n\r\nEste safari no es solo un viaje para presenciar la vida salvaje; es una oportunidad para sumergirse en la esencia misma de la naturaleza, para comprender los ciclos de la vida en la sabana y para apreciar la delicada interconexión de todas las criaturas que llaman hogar a este asombroso paisaje.', '2023-12-13 09:26:17', 13),
(64, 'Magia Invernal: El Lago Baikal en Siberia', 'Sumérgete en la magia invernal del lago Baikal en Siberia, un lugar donde el invierno transforma el paisaje en un reino de hielo y asombro. Cuando las temperaturas descienden, el lago se convierte en un vasto campo de hielo transparente que revela las profundidades cristalinas debajo. Los imponentes picos de las montañas Baikal se cubren de nieve, creando una estampa de pureza y tranquilidad.\r\n\r\nExplora la tradición local de caminar sobre el hielo, participa en festivales de invierno que celebran la belleza fría de la temporada y sumérgete en las aguas termales naturales que bordean el lago. La hospitalidad de las comunidades locales te envuelve en un abrazo cálido, contrastando con el entorno gélido que lo rodea.\r\n\r\nCada crujido del hielo bajo tus pies y cada ráfaga de viento te recordarán que estás en un lugar único, donde la naturaleza domina con su esplendor invernal. La magia del lago Baikal en invierno es una experiencia que va más allá de lo visual, conectándote con la fuerza y la serenidad de la estación más fría.', '2023-12-13 09:26:30', 25),
(65, 'Rutas Escénicas: La Carretera de la Costa Amalfitana en Italia', 'Embárcate en un viaje pintoresco a lo largo de la Carretera de la Costa Amalfitana en Italia, donde los acantilados escarpados se encuentran con el azul intenso del mar Tirreno. Cada curva de esta ruta serpenteante ofrece vistas panorámicas de ensueño, con pueblos coloridos que se aferran a los acantilados y una brisa salina que acaricia tu rostro. Descubre la arquitectura mediterránea única de lugares como Positano, donde las casas de colores parecen apilarse una encima de la otra en un juego de equilibrio.\r\n\r\nSumérgete en la autenticidad de la vida costera, donde los habitantes locales te reciben con calidez y los aromas de la cocina italiana flotan en el aire. Deléitate con los sabores locales, desde limones cultivados en la región hasta deliciosos frutos del mar frescos. Explora playas escondidas y descubre la rica historia que se entreteje en cada rincón de esta costa.\r\n\r\nLa Carretera de la Costa Amalfitana no es solo un viaje en automóvil; es una experiencia sensorial que te conecta con la esencia de la vida mediterránea. Cada parada revela una nueva postal, y cada momento en esta costa es una celebración de la belleza atemporal.', '2023-12-13 09:26:48', 13),
(66, 'Encanto Histórico: Explorando Kyoto en Primavera', 'Viaja en el tiempo mientras exploras Kyoto durante la primavera, cuando los cerezos están en flor y la ciudad se viste con un manto de colores pastel. Esta antigua capital de Japón te envuelve en su encanto histórico, con templos antiguos que se alzan majestuosos entre los pétalos de sakura que caen lentamente. Pasea por los jardines tradicionales donde la serenidad se mezcla con la explosión de vida que la primavera trae consigo.\r\n\r\nParticipa en festivales de hanami, donde los lugareños y visitantes se reúnen para contemplar la belleza efímera de las flores de cerezo. Descubre la tradición del té en antiguas casas de té y déjate llevar por la calma de la ceremonia del té japonés. Cada rincón de Kyoto cuenta una historia de la rica historia cultural de Japón, desde el famoso Pabellón Dorado hasta el distrito de Gion, donde las geishas pasean por las calles empedradas.\r\n\r\nKyoto en primavera es una experiencia poética, donde la naturaleza y la cultura se entrelazan de manera armoniosa. Cada suspiro de viento lleva consigo la fragancia de las flores, creando un ambiente que te transporta a un mundo de belleza etérea.', '2023-12-13 09:27:05', 13),
(67, 'Estilo de Vida Saludable: Embracing Wellness en la Selva Tropical de Costa Rica', 'Adéntrate en la selva tropical de Costa Rica, un santuario de biodiversidad donde la exuberante vegetación y la abundante fauna crean un escenario natural para abrazar un estilo de vida saludable. Descubre cómo la conexión con la naturaleza, la práctica de yoga en entornos serenos y la alimentación basada en productos locales pueden nutrir no solo tu cuerpo, sino también tu espíritu. Explora las opciones de ecoturismo y aventuras al aire libre, desde caminatas por la selva hasta recorridos en canopy, que te invitan a moverte y conectarte con la energía vital de la naturaleza.', '2023-12-13 09:27:20', 13),
(68, 'Ciencia y Tecnología: Innovaciones Futuristas en Silicon Valley', 'Sumérgete en el corazón de la innovación en Silicon Valley, donde las mentes brillantes y las empresas tecnológicas líderes del mundo dan forma al futuro. Explora los últimos avances en inteligencia artificial, realidad virtual, vehículos autónomos y más. Con entrevistas a visionarios tecnológicos y visitas a laboratorios de vanguardia, descubre cómo la ciencia y la tecnología están transformando radicalmente la forma en que vivimos, trabajamos y nos comunicamos. Desde la incubación de startups hasta los gigantes tecnológicos, este viaje te lleva a la vanguardia de la revolución tecnológica.', '2023-12-13 09:27:35', 25),
(69, 'Cocina y Recetas: Un Viaje Gastronómico por la Ruta del Vino en la Toscana, Italia', 'Embárcate en un viaje culinario a través de la Ruta del Vino en la pintoresca Toscana, Italia. Descubre la magia que se produce cuando la tradición se encuentra con la creatividad en la cocina italiana. Desde antiguas bodegas familiares hasta restaurantes galardonados, explora los secretos detrás de las recetas locales y la producción de vinos de clase mundial. Aprende a preparar platos auténticos toscanos con chefs locales y sumérgete en la cultura que gira en torno a la comida y el vino en esta región icónica.', '2023-12-13 09:27:48', 25),
(70, 'Tecnología del Futuro: Un Vistazo a la Colonización Espacial', 'Adéntrate en el futuro emocionante de la colonización espacial, explorando proyectos ambiciosos que buscan llevar a la humanidad más allá de la Tierra. Desde la planificación de misiones a Marte hasta la construcción de hábitats en la Luna, descubre cómo la tecnología y la innovación están allanando el camino para que los seres humanos se conviertan en una especie multiplanetaria. Conversa con expertos en la industria espacial y visionarios que están dando forma al próximo capítulo de la exploración cósmica.', '2023-12-13 09:28:02', 25),
(71, 'Cine y Televisión: Tras Bastidores en el Mundo del Cine Independiente', 'Sumérgete en el fascinante mundo del cine independiente, donde la creatividad y la originalidad son las estrellas principales. Entrevista a directores, productores y actores que trabajan en proyectos fuera del circuito convencional de Hollywood. Descubre las historias detrás de la creación de películas independientes, desde la concepción de la idea hasta la pantalla grande, explorando la pasión y la dedicación que impulsa a aquellos que eligen un camino menos transitado en la industria del entretenimiento.', '2023-12-13 09:28:17', 12),
(72, 'Deportes Extremos: Travesía por los Parajes Más Desafiantes del Mundo', 'Embárcate en una aventura llena de adrenalina mientras exploras algunos de los parajes más desafiantes del mundo para los amantes de los deportes extremos. Desde escalar picos imponentes hasta descender rápidos turbulentos, sigue a deportistas intrépidos que desafían sus límites y conquistan entornos naturales impresionantes. A través de entrevistas exclusivas y experiencias en primera persona, descubre cómo estos atletas se preparan física y mentalmente para enfrentar los desafíos extremos que la naturaleza les presenta.', '2023-12-13 09:28:32', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `password`, `admin`) VALUES
(1, 'administrador', 'soyeladmin', 1),
(2, 'Cosmin', '1234', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_entrada` (`id_entrada`),
  ADD KEY `comentario_usuario` (`id_usuario`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrada_id` (`categoria_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentario_entrada` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id`),
  ADD CONSTRAINT `comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_id` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
