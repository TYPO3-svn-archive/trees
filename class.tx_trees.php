<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 Elmar Hinz <elmar.hinz@team-red.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class tx_trees{	
	
	function selectWizard(&$input){
		// local configuration
		$localConfiguration = $input['parameters'];
		
		// load most often used classes
		// other requiered classes must be loaded external 
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_configuration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_treeModelAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_nodeViewAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSelects.php');
		
		// clean item
		$rows = array();
		foreach( split(chr(10), $input['item']) as $row){
			if(!strpos ($row, 'setFormValueOpenBrowser')){
				array_push($rows, $row);
			}
		}
		$input['item'] = join(chr(10), $rows);

		// construct
		$localConfiguration['onClick'] = 'setFormValueFromBrowseWin(\'' . $input['itemName'] . 
			'\', this.getAttribute(\'value\'), this.firstChild.data); return false;';

		$configuration  = t3lib_div::makeInstance('tx_trees_configuration');
		$configuration->setFocus('tx_trees->selectWizard', $localConfiguration);
		$treeModel 	= t3lib_div::makeInstance($configuration->get('treeModelClass'));
		$treeView 	= t3lib_div::makeInstance($configuration->get('treeViewClass'));
		$nodeModel 	= t3lib_div::makeInstance($configuration->get('nodeModelClass'));
		$nodeView 	= t3lib_div::makeInstance($configuration->get('nodeViewClass'));
		$treeView->addNodeView($nodeView);
		$treeView->setTreeModel($treeModel);
		$treeModel->addNodeModel($nodeModel);
		
		// configure
		$treeView->configure($configuration);
		$treeModel->configure($configuration);
		$nodeModel->configure($configuration);
		$nodeView->configure($configuration);
		
		// render
		$out .= $treeView->render();
		
		return $out;
	}	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/class.tx_trees.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/class.tx_trees.php']);
}

?>