<?php

########################################################################
# Extension Manager/Repository config file for ext: "trees"
#
# Auto generated 30-09-2006 22:15
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Better Trees',
	'description' => 'Navigation, TCE selects, tutor and tree library',
	'category' => 'misc',
	'author' => 'Elmar Hinz',
	'author_email' => 'elmar.hinz@team-red.net',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'experimental',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'be_users, be_groups, be_groups_tx_trees_mounts_mm, be_users_tx_trees_mounts_mm',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.2',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:38:{s:8:".project";s:4:"cabe";s:15:".projectOptions";s:4:"f831";s:9:"ChangeLog";s:4:"8bd2";s:10:"README.txt";s:4:"9fa9";s:18:"class.tx_trees.php";s:4:"48de";s:12:"examples.sql";s:4:"db2f";s:12:"ext_icon.gif";s:4:"4aa7";s:17:"ext_localconf.php";s:4:"dcc3";s:14:"ext_tables.php";s:4:"b148";s:14:"ext_tables.sql";s:4:"e131";s:23:"icon_tx_trees_leaf1.gif";s:4:"475a";s:23:"icon_tx_trees_leaf2.gif";s:4:"475a";s:24:"icon_tx_trees_trunk1.gif";s:4:"475a";s:24:"icon_tx_trees_trunk2.gif";s:4:"475a";s:16:"locallang_db.xml";s:4:"e929";s:7:"tca.php";s:4:"254c";s:17:".cache/.dataModel";s:4:"1bbd";s:14:"doc/manual.rst";s:4:"729d";s:19:"doc/wizard_form.dat";s:4:"1568";s:20:"doc/wizard_form.html";s:4:"f1a0";s:33:"library/class.tx_trees_common.php";s:4:"ca1e";s:40:"library/class.tx_trees_configuration.php";s:4:"3e8e";s:30:"library/class.tx_trees_div.php";s:4:"380d";s:44:"library/class.tx_trees_nodeModelAbstract.php";s:4:"048c";s:45:"library/class.tx_trees_nodeModelForTables.php";s:4:"a2a5";s:43:"library/class.tx_trees_nodeViewAbstract.php";s:4:"5d1d";s:44:"library/class.tx_trees_treeModelAbstract.php";s:4:"c9a6";s:47:"library/class.tx_trees_treeModelForPageTree.php";s:4:"6658";s:43:"library/class.tx_trees_treeViewAbstract.php";s:4:"70cf";s:45:"library/class.tx_trees_treeViewForSelects.php";s:4:"d3fb";s:59:"demos/trees/class.tx_trees_demos_trees_t3lib_browsetree.php";s:4:"6224";s:57:"demos/trees/class.tx_trees_demos_trees_t3lib_treeview.php";s:4:"d2f7";s:21:"demos/trees/clear.gif";s:4:"cc11";s:20:"demos/trees/conf.php";s:4:"f350";s:21:"demos/trees/index.php";s:4:"39db";s:25:"demos/trees/locallang.xml";s:4:"1a86";s:29:"demos/trees/locallang_mod.xml";s:4:"a575";s:26:"demos/trees/moduleicon.gif";s:4:"5ca5";}',
	'suggests' => array(
	),
);

?>