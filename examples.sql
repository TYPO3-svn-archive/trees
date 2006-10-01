
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1, 0, 'tx_trees_trunk1', 'Europe');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (2, 0, 'tx_trees_trunk1', 'Asia');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (3, 0, 'tx_trees_trunk1', 'Africa');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (4, 0, 'tx_trees_trunk1', 'Australia');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (5, 0, 'tx_trees_trunk1', 'America');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (6, 1, 'tx_trees_trunk1', 'Swiss');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (7, 1, 'tx_trees_trunk1', 'Spain');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (8, 2, 'tx_trees_trunk1', 'China');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (9, 2, 'tx_trees_trunk1', 'India');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (10, 3, 'tx_trees_trunk1', 'Egypt ');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (11, 3, 'tx_trees_trunk1', 'Congo ');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (12, 4, 'tx_trees_trunk1', 'Australia');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (13, 5, 'tx_trees_trunk1', 'Mexico');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (14, 5, 'tx_trees_trunk1', 'Canada');
REPLACE INTO `tx_trees_trunk1` (`uid`, `parentid`, `parenttable`, `title`) VALUES (15, 1, 'tx_trees_trunk1', 'Germany');

REPLACE INTO `tx_trees_trunk2` (`uid`, `parentid`, `parenttable`, `title`) VALUES (1, 6, 'tx_trees_trunk1', 'Bern');
REPLACE INTO `tx_trees_trunk2` (`uid`, `parentid`, `parenttable`, `title`) VALUES (2, 7, 'tx_trees_trunk1', 'Madrid');
REPLACE INTO `tx_trees_trunk2` (`uid`, `parentid`, `parenttable`, `title`) VALUES (3, 15, 'tx_trees_trunk1', 'Berlin');
REPLACE INTO `tx_trees_trunk2` (`uid`, `parentid`, `parenttable`, `title`) VALUES (4, 3, 'tx_trees_trunk2', 'Mitte');
REPLACE INTO `tx_trees_trunk2` (`uid`, `parentid`, `parenttable`, `title`) VALUES (5, 3, 'tx_trees_trunk2', 'Pankow');

REPLACE INTO `tx_trees_leaf1` (`uid`, `parentid`, `parenttable`, `header`) VALUES (1, 6, 'tx_trees_trunk1', 'Watch');
REPLACE INTO `tx_trees_leaf1` (`uid`, `parentid`, `parenttable`, `header`) VALUES (2, 7, 'tx_trees_trunk1', 'Sangria');

REPLACE INTO `tx_trees_leaf2` (`uid`, `parentid`, `parenttable`, `header`) VALUES (1, 4, 'tx_trees_trunk2', 'Rotes Rathaus');
REPLACE INTO `tx_trees_leaf2` (`uid`, `parentid`, `parenttable`, `header`) VALUES (2, 5, 'tx_trees_trunk2', 'Kulturbrauerei');
