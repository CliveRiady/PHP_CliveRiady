-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 06:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` char(4) NOT NULL,
  `adminNAMA` varchar(30) NOT NULL,
  `adminEMAIL` varchar(60) NOT NULL,
  `adminPASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminNAMA`, `adminEMAIL`, `adminPASSWORD`) VALUES
('A001', 'Jone', 'jone@yahoo.com', '1234'),
('A002', 'Alex', 'alex@yahoo.com', 'd93591bdf7860e1e4ee2fca799911215');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `areaID` char(4) NOT NULL,
  `areanama` char(35) NOT NULL,
  `areawilayah` char(35) NOT NULL,
  `areaketerangan` varchar(500) NOT NULL,
  `kabupatenKODE` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areaID`, `areanama`, `areawilayah`, `areaketerangan`, `kabupatenKODE`) VALUES
('AR01', 'Ubud', 'Kota Ubud', 'Ubud is a popular art village in the center of Bali. It\'s popular of its cultural sites.', 'K002'),
('AR02', 'Seminyak', 'Bali, Seminyak', 'Seminyak is a beach resort area at the southern end of Bali, Indonesia, with many luxury hotels, villas and spas, as well as high-end shopping and restaurants.', 'K002'),
('AR03', 'Ancol', 'North Jakarta', 'Seaside destination Ancol has a popular beach for water sports, and a waterfront complex which features rollercoasters and rides at Dunia Fantasi and Atlantis Water Adventure park. Families also enjoy SeaWorld aquarium with its sharks and turtles, and Ocean Dream Samudra for dolphin and sea lion shows. Ancol Art Market showcases emerging local artists and hosts weekend dance performances.', 'K001'),
('AR04', 'Pantai Indah Kapuk', 'Penjaringan, North Jakarta', 'In the past five years, Pantai Indah Kapuk (PIK) in North Jakarta has evolved to become a hip culinary district. However, PIK is much more than just a culinary hub as it offers a plethora of activities, such as a water park, a mangrove forest, co-working space and more.', 'K001'),
('AR05', 'Senopati', 'South Jakarta', 'Senopati, located in South Jakarta is a great area for those who wants to eat and have a great night out at the most happening street in South Jakarta. With new restaurants and bars popping up every season, this place is lit.', 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `beritaID` char(4) NOT NULL,
  `beritajudul` varchar(60) NOT NULL,
  `beritainti` varchar(116) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `tanggalterbit` date NOT NULL,
  `destinasiID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`beritaID`, `beritajudul`, `beritainti`, `penulis`, `penerbit`, `tanggalterbit`, `destinasiID`) VALUES
('B001', 'Pura Tirta Empul', 'Bali, the famed Island of the Gods, with its varied landscape of hills and mountains, rugged coastlines...', 'Alex', 'Travel ID', '2022-11-30', 'D001'),
('B002', 'Happy Life in The Paradise: Bali', 'A part of the local experience is that you may drive down one wide avenue one minute, then suddenly find yourself...', 'Mary', 'Travel ID', '2022-11-25', 'D002'),
('B003', 'The Amazing Beach in Bali', 'Petitenget Beach is the main beach of Seminyak. It\'s named after a temple of the same name, which you can find ab...', 'Mary', 'Travel ID', '2022-09-13', 'D003'),
('B004', 'Have Fun in Dufan: The Fun Theme Park', 'Like other theme parks, Dufan has many rides and fun sites. That means the guests can explore it wholeheartedly...', 'Alex', 'Travel ID', '2022-11-09', 'D004'),
('B005', 'Wonders of the Streets: Cove at Batavia', 'It\'s no secret that the Pantai Indah Kapuk area , or better known as PIK North Jakarta, is a destination with a...', 'Mary', 'Travel ID', '2022-11-23', 'D005'),
('B006', 'Top Spots to Stop in the Senopati Area', 'If you\'re visiting Jakarta or the Senopati neighbourhood for the very first time it\'s always good to learn a bit...', 'Alex', 'Travel ID', '2022-11-24', 'D006');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `destinasiID` char(5) NOT NULL,
  `destinasinama` varchar(35) NOT NULL,
  `destinasialamat` varchar(255) NOT NULL,
  `kategoriID` char(4) NOT NULL,
  `areaID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`destinasiID`, `destinasinama`, `destinasialamat`, `kategoriID`, `areaID`) VALUES
('D001', 'Pura Tirta Empul', 'Tirta St, Manukaya, Kec. Tampaksiring, Kabupaten Gianyar, Bali 80552', 'KT02', 'AR01'),
('D002', 'Potato Head Beach Club', 'Petitenget St No.51B, Seminyak, Kuta Utara, Badung Regency, Bali 80361', 'KT04', 'AR02'),
('D003', 'Petitenget Beach', 'Seminyak, Badung, Bali, Indonesia', 'KT01', 'AR02'),
('D004', 'Dufan', 'Lodan Timur St No.7, RW.10, Ancol, Kec. Pademangan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14430', 'KT04', 'AR03'),
('D005', 'Cove at Batavia', 'Pantai Golf Island, Jl. Pantai Indah Kapuk No.1, RT.7/RW.2, Kamal Muara, Kec. Penjaringan, 14460', 'KT04', 'AR04'),
('D006', 'Senopati Street', 'Jl. Senopati, Selong, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12110', 'KT05', 'AR05');

-- --------------------------------------------------------

--
-- Table structure for table `detildestinasi`
--

CREATE TABLE `detildestinasi` (
  `destinasiID` varchar(4) NOT NULL,
  `detildestinasidesc` varchar(250) NOT NULL,
  `detildestinasiteks` text NOT NULL,
  `detildestinasitanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detildestinasi`
--

INSERT INTO `detildestinasi` (`destinasiID`, `detildestinasidesc`, `detildestinasiteks`, `detildestinasitanggal`) VALUES
('D001', 'One of the busiest water temples in Indonesia, Tirta Empul is a temple considered sacred by Balinese Hindu community. The temple has several holy springs which are said to have been created by The God Indra and believed to be blessed water that could', 'One of the busiest water temples in Indonesia, Tirta Empul is a temple considered sacred by Balinese Hindu community. The temple has several holy springs which are said to have been created by The God Indra and believed to be blessed water that could purify those who bathe there. \nTirta Empul is dedicated to Vishnu, the Hindu God of water. In the Balinese language, Tirta Empul loosely translated means water gushing from the earth, which for this reason Tirta Empul is regarded as a holy spring. The Tirta Empul Temple includes shrines to Shiva, Vishnu, Brahma, as well as one for Indra and Mount Batur. It is considered one of the five most holy temples in all of Bali and is considered one of the holiest water sources in Bali. You can also find other holy water temples in Bali such as Pura Ulun Danu at Lake Beratan, Pura Tirta Tawar at Gianyar, Pura Tirta Harum at Bangli, Pura Tirta Taman Mumbul at Badung, and many more.', '2022-11-10'),
('D002', 'Whether it’s in our infinity pool, on a daybed, under the shade of swaying palms, or at one of our restaurants, you are invited to swim, eat, sip and relax any way you like.\r\n\r\nSoak in the vibrant atmosphere as you enjoy an extensive offering of inte', 'Whether it’s in our infinity pool, on a daybed, under the shade of swaying palms, or at one of our restaurants, you are invited to swim, eat, sip and relax any way you like.\r\n\r\nSoak in the vibrant atmosphere as you enjoy an extensive offering of international comfort foods and cocktails charged with local spirits, fruits and spices.', '2022-11-11'),
('D003', 'Petitenget Beach is the main beach of Seminyak. It’s named after a temple of the same name, which you can find about 100 metres from the coast. This grey sand beach usually isn’t as crowded as its neighbours, Kuta and Legian. The beach also has large', 'Petitenget Beach is the main beach of Seminyak. It’s named after a temple of the same name, which you can find about 100 metres from the coast. This grey sand beach usually isn’t as crowded as its neighbours, Kuta and Legian. The beach also has large waves most of the time, along with strong undercurrents. \r\n\r\nThe wide stretch of sand with vast flat surfaces make Petitenget Beach one of the most beautiful coasts. With a few dining spots along its coast, it’s an excellent go-to for enjoying Bali’s magical sunsets.\r\nPetitenget Beach\'s halfway position in Seminyak makes it easily accessible. A large parking space adjoins Petitenget Temple, along with a separate communal hall where local youths practice traditional dances. You can swim at low tides, sunbathe, jog, meditate or amble along the seaside at sunset. \r\n\r\nExcellent dining spots line the coast, such as La Lucciola and Mano Beach Club. Or, you can chill out at some of Bali’s best beach clubs that call the beach home, including Ku De Ta, Potato Head Beach Club, and WooBar.', '2022-12-12'),
('D004', 'While you are in Jakarta and need something fun to refresh your mind, Ancol Dreamland is the righ...', 'Fantasy World, well known as Dufan, Jakarta’s own theme park complete with over 40 rides and attractions. It is considered as Jakarta’s largest and most interesting recreation park, and located reclaimed land at the Bay of Jakarta. Among its most popular attractions are Halilintar (roller coaster), Niagara flume ride, Istana Boneka, and Balada Kera Theater Show. In the district of Ancol where Dufan is located, it is a common getaway for tourist and locals alike, away from the hustle and bustle of the City.', '2022-12-12'),
('D005', 'The Pantai Indah Kapuk area or PIK in northern Jakarta is now increasingly popular as a place for various interesting activities. Starting from sports along the jogging track by the canal to culinary tours while looking at the ocean.\r\n\r\nThis public s', 'The Pantai Indah Kapuk area or PIK in northern Jakarta is now increasingly popular as a place for various interesting activities. Starting from sports along the jogging track by the canal to culinary tours while looking at the ocean.\n\nThis public space for various activities is an attraction for the people of Jakarta and its surroundings to visit there. One of the relaxing places that just opened at the end of September 2021 in the Pantai Indah Kapuk area is Cove at Batavia PIK. This place carries the retail design concept in an open space in the Golf Island area.\n\nChief Executive Officer (CEO) of Hotels and Malls Division 2 Agung Sedayu Group, Natalia Kusumo said Cove at Batavia PIK occupies an outdoor area of ​​4,555 square meters. \"This place is a solution for people who want to experience an open space destination in Jakarta with seaside views,\" he said in a written statement. \"Cove is part of Batavia PIK which is a melting pot of urbanites and millennials from various backgrounds, cultures and lifestyles.\" \n\nThrough Cove at Batavia PIK, visitors can dine at Talassa by GIOI, a restaurant that provides dishes onboard Phinisi while enjoying sea views and feeling the sea breeze. At Cove at Batavia PIK there are also various culinary delights, such as Sushi Hiro, Cosmic Dog, Gelato Secrets, Hiyoten, Hot Stuff, La Brezza, Living Stone, Light Jakarta, Oyster Dealer, Okayu No Ohsho. There\'s also Pancious Go, This Earth, 3 Mongkis, and others.', '2022-12-01'),
('D006', 'If you\'re visiting Jakarta or the Senopati neighbourhood for the very first time it\'s always good to learn a bit of history in order to understand what makes a neighbourhood tick. Here’s a few interesting facts to get you started: \n\nThe Senopati neig', 'If you\'re visiting Jakarta or the Senopati neighbourhood for the very first time it\'s always good to learn a bit of history in order to understand what makes a neighbourhood tick. Here’s a few interesting facts to get you started: \n\nThe Senopati neighbourhood is located in Kebayoran Baru, a subdistrict of South Jakarta and was established in 1948 as a satellite town to accommodate the growing population of Jakarta. It was the last residential area to be developed by the Dutch colonial administration.\n\nThe Kebayoran Baru precinct was established solely as a residential area, but the district is now home to many commercial ventures and lifestyle businesses. Today we focus on Jalan Gunawarman, Senopati and Suryo.\n\nKebayoran Baru is one of the most affluent areas of Jakarta.', '2022-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `detilhotel`
--

CREATE TABLE `detilhotel` (
  `hotelID` varchar(4) NOT NULL,
  `hotelharga` varchar(20) NOT NULL,
  `hotelsarapan` text NOT NULL,
  `hotelpeta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detilhotel`
--

INSERT INTO `detilhotel` (`hotelID`, `hotelharga`, `hotelsarapan`, `hotelpeta`) VALUES
('H001', '11,071,500', 'Vegetarian, Vegan, Halal, Gluten-free, Kosher, Asian, American, Buffet', '-'),
('H002', '5,156,863', 'Continental, Vegetarian, Vegan, Gluten-free, Asian, American, Buffet', '-'),
('H003', '4,961,000', 'Continental, Full English/Irish, Vegetarian, Vegan, Halal, Gluten-free, Asian, American, Buffet', '-'),
('H004', '10,956,988', 'Continental, Vegetarian, Vegan, Halal, Gluten-free, Asian, American', '-');

-- --------------------------------------------------------

--
-- Table structure for table `fotodestinasi`
--

CREATE TABLE `fotodestinasi` (
  `fotoID` char(5) NOT NULL,
  `fotonama` char(60) NOT NULL,
  `destinasiID` char(4) NOT NULL,
  `fotofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fotodestinasi`
--

INSERT INTO `fotodestinasi` (`fotoID`, `fotonama`, `destinasiID`, `fotofile`) VALUES
('F001', 'Pura Tirta Empul', 'D001', 'PuraTirtaEmpul.jpg'),
('F002', 'Petitenget Beach', 'D003', 'Petitenget.jpg'),
('F003', 'Potato Head Beach Club', 'D002', 'Potatohead.jpg'),
('F004', 'Dufan', 'D004', 'Dufan.jpg'),
('F005', 'Cove at Batavia', 'D005', 'Cove.jpg'),
('F006', 'Senopati Street', 'D006', 'Senopati.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotelID` char(4) NOT NULL,
  `hotelnama` varchar(60) NOT NULL,
  `hotelalamat` varchar(255) NOT NULL,
  `hotelketerangan` varchar(300) NOT NULL,
  `hotelfoto` text NOT NULL,
  `areaID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotelID`, `hotelnama`, `hotelalamat`, `hotelketerangan`, `hotelfoto`, `areaID`) VALUES
('H001', 'W Bali', 'Kerobokan, Petitenget St, Seminyak, Bali 8061', 'Situated on its own stretch of extraordinary beach where the world\'s jetsetters come to play and featuring 79 hotel residences.', 'W.jpg', 'AR02'),
('H002', 'Blue Karma Djiwa', 'Jl. Suweta Tegalalang, 80561 Ubud, Indonesia', 'Welcoming guests with an outdoor swimming pool, Blue Karma dijiwa Ubud is situated in central Ubud. It houses a 24-hour front desk, a tropical garden and a restaurant. Free WiFi is available throughout.\r\n\r\nFeaturing a blend of traditional and modern designs, the air-conditioned rooms here are fitted', 'Bluekarma.jpg', 'AR01'),
('H003', 'The Westin Resort and Spa', 'Jalan Lod Tunduh, Br. Kengetan, Desa Singakerta, 80571 Ubud, Indonesia', 'Located in Ubud, 3.6 km from Monkey Forest Ubud, The Westin Resort & Spa Ubud, Bali provides accommodation with 2 restaurants and a lobby bar, free private parking, an outdoor swimming pool, spa and a 24-hour fitness centre. 5 km from Ubud Market and 6.1 km from Ubud Palace, the property features a ', 'Westinubud.jpg', 'AR01'),
('H004', 'The Kayon Jungle Resort', 'Br. Bresela, Payangan, Ubud, Gianyar, Bali, 80572 Ubud, Indonesia ', 'Surrounded by tropical greenery, The Kayon Jungle Resort offers accommodation with an outdoor pool in Ubud. Inspired by Balinese traditional architecture, the resort houses a spa centre and fitness facilities. Free bicycles are available for guests who wish to explore the area.', 'Kayon.jpg', 'AR02');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `kabupatenKODE` char(4) NOT NULL,
  `kabupatenNAMA` char(60) NOT NULL,
  `kabupatenALAMAT` varchar(255) NOT NULL,
  `kabupatenKET` text NOT NULL,
  `kabupatenFOTOICON` varchar(255) NOT NULL,
  `kabupatenFOTOICONKET` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`kabupatenKODE`, `kabupatenNAMA`, `kabupatenALAMAT`, `kabupatenKET`, `kabupatenFOTOICON`, `kabupatenFOTOICONKET`) VALUES
('K001', 'Jakarta', 'Indonesia, Java Island', 'Jakarta, a huge, sprawling metropolis, home to over 10 million people with diverse ethnic group backgrounds from all over Indonesia. During the day, the number increases with commuters making their way to work in the city and flock out again in the evenings.', 'Jakarta.jpg', '-'),
('K002', 'Bali', 'Indonesia, Bali Province', 'Bali Indonesia. Also known as the Land of the Gods, Bali appeals through its sheer natural beauty of looming volcanoes and lush terraced rice fields that exude peace and serenity. It is also famous for surfers\' paradise!', 'Bali.jpg', '-'),
('K003', 'Belitung', 'Indonesia, Bangka Belitung', 'Although not as popular as Bali or Lombok, Belitung is blessed with some of the best beaches of the country. The sand is soft and as white as palm sugar, and some even argue that the sand here is even whiter than that in Bali. Belitung is also surrounded by more than 100 small islands. ', 'Belitung.jpg', '-'),
('K004', 'Manado', 'Indonesia, North Sulawesi', 'Manado is the capital city of North Sulawesi province, and become an interesting city to be visit for its tourism destination, while the location itself is located at the Bay of Manado, and is surrounded by a mountainous area.', 'Manado.jpg', '-'),
('K005', 'Ambon', 'Indonesia, Maluku Islands', 'Ambon was well known for producing spices, particularly nutmeg. That is why it was nicknamed The Island of Spices. Ambon\'s remains charming. Tucked away far in the east of Indonesia, Ambon is the capital of the Maluku Islands.', 'Ambon.jpg', '-'),
('K006', 'Sorong', 'Indonesia, Southwest Papua', 'The word \'Sorong\' is said to originate from the local Soreri language meaning \'deep and turbulent seas\'. Mountains, hills, lowlands, and protected forests securely surround the town.', 'Sorong.jpg', '-'),
('K007', 'Malang', 'Indonesia, East Java', 'Malang together with its neighbouring city called Batu, has become the main destination for holiday in East Java. From the range of mountains surrounding this city, world-class theme parks that built here, pristine beaches on the south, and yummy cullinary, bring families and friends to spend their weekends in this heart-warming city.', 'Malang.jpg', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` char(4) NOT NULL,
  `kategorinama` char(30) NOT NULL,
  `kategoriketerangan` varchar(500) NOT NULL,
  `kategorireferensi` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `kategorinama`, `kategoriketerangan`, `kategorireferensi`) VALUES
('KT01', 'Nature', 'Indonesia has more than 17,000 islands make up a star-studded landscape home to volcanoes, jungles, lakes, grasslands, mangroves, exquisite coral gardens and even snow-capped mountains. With such a spellbinding variety of flora and fauna, Indonesia is an Eden of natural wonders just waiting to be explored. ', '-'),
('KT02', 'Cultures & Beliefs', 'The fourth most populated country in the world, spanning more than 17 thousand islands, Indonesia is a cultural phenomenon like no other. The isles and ocean that make up this country contain eight UNESCO World Heritage sites as well as many other cultural attractions, making it the perfect destination for travelers. Discover 10 must-see destinations in this travel guide to the alluring Indonesian archipelago.', '-'),
('KT03', 'History', 'Visiting tourist sites that have high historical value can always provide different sensations and also new things that can be learned from the past. Interestingly, in Indonesia there are a lot of historical places that are not less interesting than modern tourist destinations as today, which are now increasing in number. History, of course, has its own charm that can also amaze visitors.', '-'),
('KT04', 'Entertainment', 'Most people who know about Indonesia have natures such as mounts and beaches in mind, and that\'s understandable because Indonesia has been famous fot it. However, you can also enjoy fun activities and exciting games.', '-'),
('KT05', 'Culinary', 'Indonesian culinary is bestowed with a very unique profile and covers a wide spectrum. There is no other country in the world with such culinary resplendence. From Sabang to Merauke, from Talaud to Rote Island, Indonesian culinary is innumerable. Judging from its vast variety, it would be unfitting to claim any dish as purely Indonesian. ', '-');

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `makananID` varchar(4) NOT NULL,
  `makanannama` varchar(30) NOT NULL,
  `makanandesc` text NOT NULL,
  `makananfoto` text NOT NULL,
  `makananharga` varchar(30) NOT NULL,
  `kabupatenKODE` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`makananID`, `makanannama`, `makanandesc`, `makananfoto`, `makananharga`, `kabupatenKODE`) VALUES
('M001', 'Nasi Goreng', 'The most popular food of Jakarta is found in every nook and corner of the city. It is a lot more than just fried rice, to which loads of goat meat and vegetables are added. It is loaded with spices and butter making it a sumptuous meal. Traditionally, shrimp paste is added to make it all the more delicious.', 'Nasigoreng.jpg', '15,000', 'K001'),
('M002', 'Satay', 'Chicken is one of the most versatile meats on the planet, and satay is an almost emblematic food of Jakarta, and Indonesia. Satay is a dish where chicken marinated with sweet soy sauce is put on skewers and barbequed until it is grilled to perfection. It is served with peanut sauce topped with garlic flakes and serves as a good appetizer.', 'Satay.jpg', '20,000', 'K001'),
('M003', 'Bubur Ayam', 'This is the epitome of all porridges present on the face of this earth! It is a porridge loaded with fried crackers, fried soybeans, tofu and finely shredded chicken. Adding chicken broth takes it to a whole new level in terms of flavour. Talk about an insatiable appetite!', 'Buburayam.jpg', '10,000', 'K001'),
('M004', 'Martabak', 'Martabak is the Indonesian version of a pancake stuffed with a ton of toppings like Toblerone, peanuts, Nutella, chocolate sprinkles, butter, cheese and condensed milk. The pancake is folded in half and cut through evenly such that the toppings remain in the middle, causing the flavours to explode and leaving you in a state of contentment making you savour every bite of this dessert. This food in Jakarta was originally brought around by the immigrant Muslim population from the Indian subcontinent and has taken over the food scene in Indonesia by storm. ', 'Martabak.jpg', '130,000', 'K001'),
('M005', 'Kerak Telor', 'Kerak telor is a spicy omelette dish. It’s made with glutinous rice that’s cooked with egg and seasoned with ginger, salt, sugar, and aromatic ginger. It’s typically served with dried shrimp, fried shallots, and serundeng (fried shredded coconut) on top. Back in the colonial era, kerak telor was considered a privileged food that was only served to the colonial government and upper-class Betawi. Now, it’s considered a cheap snack and can be purchased from street-food vendors.', 'Keraktelor.jpg', '25,000', 'K001'),
('M006', 'Soto Betawi', 'Soto Betawi is a soup made with beef, offals, fried potato, and tomato that’s cooked in a cow’s milk or coconut milk broth. It’s served with fried shallots, emping (fried chips made of Gnetum gnemon fruit), lime, cucumber pickles, and chili on the side. White rice normally accompanies the dish.', 'Sotobetawi.jpg', '50,000', 'K001'),
('M007', 'Nasi Uduk', 'Popularly consumed for breakfast or dinner, nasi uduk (which translates to mixed rice) is rice cooked with coconut milk that’s seasoned with cinnamon, ginger, pepper, nutmeg, and lemongrass. This rice is commonly served alongside fried tofu, fried egg, chicken, dried tempe (fermented soybean cake), but it’s also served pre-packed in a banana leaf. Don’t forget to add chili, the must-have in almost every Indonesian dish.', 'Nasiuduk.jpg', '25,000', 'K001'),
('M008', 'Mie Kangkung', 'Mie kangkung is a chicken and noodle soup made with kangkung (water spinach), shredded chicken, and yellow egg noodles. It’s served in a thick sauce made with tapioca and either chicken or beef broth that’s seasoned with garlic and sweet soy sauce. It’s typically served with a sprinkling of fried shallots on top and chili on the side, although some places add bean sprouts, meatballs, and mushrooms as well.', 'Miekangkung.jpg', '35,000', 'K001'),
('M009', 'Kue Ape', 'Kue ape is made with flour, rice flour, vanilla, coconut milk, sugar, and pandan, which gives the treat its aroma and green color. It’s cooked a frying pan to give it a round shape with crispy edges and a thick and soft middle. Kue ape are colloquially and famously known as booby cake because of the shape. You can typically find street stalls serving up kue ape in front of schools.\r\n\r\n', 'Kueape.jpg', '2,000', 'K001'),
('M010', 'Kue Cubit', 'One of the most popular snacks in Jakarta, kue cubit is made with milk and flour as the main ingredients. The most popular version has chocolate sprinkles on top. The batter is baked on a steel molding that’s somewhat like a shallow cupcake tin, and it only takes a couple of minutes to cook. Kue cubits are similar to Dutch poffertjes in shape and color. They’re a popular small and quick snack (cubit means pinch, and refers to the small pinchable size).', 'Kuecubit.jpg', '15,000', 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `provinsiKODE` char(4) NOT NULL,
  `provinsiNAMA` char(60) NOT NULL,
  `provinsiKET` text NOT NULL,
  `provinsiFOTOICON` varchar(255) NOT NULL,
  `provinsiFOTOICONKET` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsiKODE`, `provinsiNAMA`, `provinsiKET`, `provinsiFOTOICON`, `provinsiFOTOICONKET`) VALUES
('K001', 'DKI Jakarta', 'DKI Jakarta, a huge, sprawling metropolis, home to over 10 million people with diverse ethnic group backgrounds from all over Indonesia. During the day, the number increases with commuters making their way to work in the city and flock out again in the evenings.', 'Jakarta.jpg', '-'),
('K002', 'Bali', 'Bali Indonesia. Also known as the Land of the Gods, Bali appeals through its sheer natural beauty of looming volcanoes and lush terraced rice fields that exude peace and serenity. It is also famous for surfers\' paradise!', 'Bali.jpg', '-'),
('K003', 'Belitung', 'Although not as popular as Bali or Lombok, Belitung is blessed with some of the best beaches of the country. The sand is soft and as white as palm sugar, and some even argue that the sand here is even whiter than that in Bali. Belitung is also surrounded by more than 100 small islands. ', 'Belitung.jpg', '-'),
('K004', 'Sulawesi Utara', 'Manado is the capital city of North Sulawesi province, and become an interesting city to be visit for its tourism destination, while the location itself is located at the Bay of Manado, and is surrounded by a mountainous area.', 'Manado.jpg', '-'),
('K005', 'Maluku Utara', 'Maluku Utara was well known for producing spices, particularly nutmeg. That is why it was nicknamed The Island of Spices. Ambon\'s remains charming. Tucked away far in the east of Indonesia, Ambon is the capital of the Maluku Islands.', 'Ambon.jpg', '-'),
('K006', 'Papua Barat', 'The word \'Sorong\' is said to originate from the local Soreri language meaning \'deep and turbulent seas\'. Mountains, hills, lowlands, and protected forests securely surround the town.', 'Sorong.jpg', '-'),
('K007', 'Jawa Timur', 'Malang together with its neighbouring city called Batu, has become the main destination for holiday in East Java. From the range of mountains surrounding this city, world-class theme parks that built here, pristine beaches on the south, and yummy cullinary, bring families and friends to spend their weekends in this heart-warming city.', 'Malang.jpg', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaID`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`beritaID`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`destinasiID`);

--
-- Indexes for table `detildestinasi`
--
ALTER TABLE `detildestinasi`
  ADD PRIMARY KEY (`destinasiID`);

--
-- Indexes for table `detilhotel`
--
ALTER TABLE `detilhotel`
  ADD PRIMARY KEY (`hotelID`);

--
-- Indexes for table `fotodestinasi`
--
ALTER TABLE `fotodestinasi`
  ADD PRIMARY KEY (`fotoID`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotelID`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`kabupatenKODE`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`makananID`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`provinsiKODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
