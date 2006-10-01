<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_trees_trunk1=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_trees_trunk2=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_trees_leaf1=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_trees_leaf2=1
');
?>