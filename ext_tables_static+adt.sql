#world regions
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1, 0, '', 'Europe');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (2, 0, '', 'Asia');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (3, 0, '', 'Africa');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (4, 0, '', 'Oceania');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (5, 0, '', 'America');

#countries
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1, 5, 'tx_trees_examples_regions', 'Ecuador');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (2, 5, 'tx_trees_examples_regions', 'Panama');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (3, 2, 'tx_trees_examples_regions', 'Yemen');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (4, 4, 'tx_trees_examples_regions', 'Papua New Guinea');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (5, 5, 'tx_trees_examples_regions', 'Cuba');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (6, 1, 'tx_trees_examples_regions', 'Swiss');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (7, 1, 'tx_trees_examples_regions', 'Spain');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (8, 2, 'tx_trees_examples_regions', 'China');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (9, 2, 'tx_trees_examples_regions', 'India');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (10, 3, 'tx_trees_examples_regions', 'Egypt ');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (11, 3, 'tx_trees_examples_regions', 'Congo ');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (12, 4, 'tx_trees_examples_regions', 'Australia');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (13, 5, 'tx_trees_examples_regions', 'Mexico');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (14, 5, 'tx_trees_examples_regions', 'Canada');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (15, 1, 'tx_trees_examples_regions', 'Germany');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (16, 1, 'tx_trees_examples_regions', 'Denmark');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (17, 1, 'tx_trees_examples_regions', 'Greece');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (18, 1, 'tx_trees_examples_regions', 'France');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (19, 1, 'tx_trees_examples_regions', 'Italy');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (20, 2, 'tx_trees_examples_regions', 'Japan');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (21, 2, 'tx_trees_examples_regions', 'Iraq');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (22, 2, 'tx_trees_examples_regions', 'Uzbekistan');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (23, 3, 'tx_trees_examples_regions', 'Eritrea');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (24, 3, 'tx_trees_examples_regions', 'Botswana');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (25, 3, 'tx_trees_examples_regions', 'Togo');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (26, 4, 'tx_trees_examples_regions', 'New Zealand');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (27, 5, 'tx_trees_examples_regions', 'Brazil');

#cities
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (500, 6, 'tx_trees_examples_entities', 'Bern');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (501, 7, 'tx_trees_examples_entities', 'Madrid');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (502, 15, 'tx_trees_examples_entities', 'Berlin');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (503, 9, 'tx_trees_examples_entities', 'Delhi');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (504, 11, 'tx_trees_examples_entities', 'Brazzaville');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (505, 13, 'tx_trees_examples_entities', 'Mexico City');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (506, 17, 'tx_trees_examples_entities', 'Athens');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (507, 19, 'tx_trees_examples_entities', 'Rome');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (508, 21, 'tx_trees_examples_entities', 'Baghdad');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (509, 23, 'tx_trees_examples_entities', 'Asmara');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (510, 25, 'tx_trees_examples_entities', 'Lome');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (511, 27, 'tx_trees_examples_entities', 'Brasilia');
REPLACE INTO `tx_trees_examples_entities` (`uid`, `parentid`, `parenttable`, `title`) VALUES (512, 5, 'tx_trees_examples_entities', 'Havana');

#city regions
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1001, 502, 'tx_trees_examples_entities', 'Mitte');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1002, 502, 'tx_trees_examples_entities', 'Pankow');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1003, 512, 'tx_trees_examples_entities', 'Centro Habana');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1004, 512, 'tx_trees_examples_entities', 'La Habana Vieja');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1005, 507, 'tx_trees_examples_entities', 'Monti');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1006, 507, 'tx_trees_examples_entities', 'Trevi');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1007, 503, 'tx_trees_examples_entities', 'Daryaganj');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1008, 503, 'tx_trees_examples_entities', 'Paharganj');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1009, 509, 'tx_trees_examples_entities', 'Seghen');
REPLACE INTO `tx_trees_examples_regions` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1010, 509, 'tx_trees_examples_entities', 'Acria');

#products
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (1, 6, 'tx_trees_examples_entities', 'Watches');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (2, 7, 'tx_trees_examples_entities', 'Oranges');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (3, 23, 'tx_trees_examples_entities', 'Coffee');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (4, 23, 'tx_trees_examples_entities', 'Cotton');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (5, 15, 'tx_trees_examples_entities', 'Machines');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (6, 15, 'tx_trees_examples_entities', 'Beer');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (7, 16, 'tx_trees_examples_entities', 'TYPO3');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (8, 18, 'tx_trees_examples_entities', 'Cheese');
REPLACE INTO `tx_trees_examples_products` (`uid`, `parentid`, `parenttable`, `header`) VALUES (9, 18, 'tx_trees_examples_entities', 'Wine');

#buildings
REPLACE INTO `tx_trees_examples_buildings` (`uid`, `parentid`, `parenttable`, `header`) VALUES (1, 1001, 'tx_trees_examples_regions', 'New Synagogue');
REPLACE INTO `tx_trees_examples_buildings` (`uid`, `parentid`, `parenttable`, `header`) VALUES (2, 1002, 'tx_trees_examples_regions', 'Kulturbrauerei');
REPLACE INTO `tx_trees_examples_buildings` (`uid`, `parentid`, `parenttable`, `header`) VALUES (3, 1006, 'tx_trees_examples_regions', 'Trevi Fountain');
REPLACE INTO `tx_trees_examples_buildings` (`uid`, `parentid`, `parenttable`, `header`) VALUES (4, 1005, 'tx_trees_examples_regions', 'Colosseum');
REPLACE INTO `tx_trees_examples_buildings` (`uid`, `parentid`, `parenttable`, `header`) VALUES (5, 1005, 'tx_trees_examples_regions', 'Forum Romanum');

