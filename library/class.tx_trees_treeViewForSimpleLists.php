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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_treeViewAbstract.php');

class tx_trees_treeViewForSimpleLists extends tx_trees_treeViewAbstract {
	
	var $requiredSettings = 'cssLevel, listClassAttribute';
	var $cssLevels = array('few', 'normal', 'many');
	
	function usageExampleMultiTypes($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_genericConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewForSimpleLists.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSimpleLists.php');
		$treeModelConfiguration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$treeViewConfiguration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$nodeModelConfiguration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$nodeViewConfiguration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForTables');
		$treeView = t3lib_div::makeInstance('tx_trees_treeViewForSimpleLists');
		$nodeModel1 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView1 = t3lib_div::makeInstance('tx_trees_nodeViewForSimpleLists');
		$nodeModel2 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView2 = t3lib_div::makeInstance('tx_trees_nodeViewForSimpleLists');
		$nodeModel3 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView3 = t3lib_div::makeInstance('tx_trees_nodeViewForSimpleLists');
		$nodeModel4 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView4 = t3lib_div::makeInstance('tx_trees_nodeViewForSimpleLists');		
		$treeView->setTreeModel($treeModel);

		// tree model configuration
		
		$treeModelConfiguration->set('rootNodeType', '');
		$treeModelConfiguration->set('rootId', 0);
		$treeModel->configure($treeModelConfiguration);
		
		// tree view configuration
		
		$treeViewConfiguration->set('cssLevel', 'few');		
		$treeViewConfiguration->set('listClassAttribute', 'multiList');		
		$treeView->configure($treeViewConfiguration);		
		
		// node model configuration
		
		$nodeModelConfiguration->set('parentTable', false);
		$nodeModelConfiguration->set('limit', 1000);
		$nodeModelConfiguration->set('orderBy', '');
		$nodeModelConfiguration->set('nodeType', 'tx_trees_examples_regions');
		$nodeModelConfiguration->set('idField', 'uid');
		$nodeModelConfiguration->set('parentTableField', 'parenttable');
		$nodeModelConfiguration->set('parentIdField', 'parentid');
		$nodeModelConfiguration->set('fields', 'title');		
		$nodeModel1->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('nodeType', 'tx_trees_examples_entities');
		$nodeModel2->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('nodeType', 'tx_trees_examples_products');
		$nodeModelConfiguration->set('fields', 'header');		
		$nodeModel3->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('nodeType', 'tx_trees_examples_buildings');
		$nodeModel4->configure($nodeModelConfiguration);
		
		// node view configuration

		$nodeViewConfiguration->set('emptyTitle', '[no title]');		
		$nodeViewConfiguration->set('nodeType', 'tx_trees_examples_regions');
		$nodeViewConfiguration->set('cssLevel', 'few');		
		$nodeViewConfiguration->set('titleField', 'title');
		$nodeViewConfiguration->set('rowClassAttribute', 'region');
		$nodeView1->configure($nodeViewConfiguration); 		

		$nodeViewConfiguration->set('nodeType', 'tx_trees_examples_entities');
		$nodeViewConfiguration->set('rowClassAttribute', 'entity');
		$nodeView2->configure($nodeViewConfiguration); 		

		$nodeViewConfiguration->set('nodeType', 'tx_trees_examples_products');
		$nodeViewConfiguration->set('titleField', 'header');
		$nodeViewConfiguration->set('rowClassAttribute', 'product');
		$nodeView3->configure($nodeViewConfiguration); 		
		
		$nodeViewConfiguration->set('nodeType', 'tx_trees_examples_buildings');
		$nodeViewConfiguration->set('rowClassAttribute', 'building');
		$nodeView4->configure($nodeViewConfiguration); 		
		
		// now we can add the configured nodes
		$treeModel->addNodeModel($nodeModel1);
		$treeModel->addNodeModel($nodeModel2);
		$treeModel->addNodeModel($nodeModel3);
		$treeModel->addNodeModel($nodeModel4);
		$treeView->addNodeView($nodeView1);
		$treeView->addNodeView($nodeView2);
		$treeView->addNodeView($nodeView3);
		$treeView->addNodeView($nodeView4);
		
		$styles .= '<style type="text/css" >' . chr(10);
		$styles .= '/*<![CDATA[*/' . chr(10);
		$styles .= '.region{color:#555;}' . chr(10);
		$styles .= '.entity{font-weight:bold;color:#555;}' . chr(10);
		$styles .= '.product{color:darkblue;}' . chr(10);
		$styles .= '.building{color:darkred;}' . chr(10);
		$styles .= '/*]]>*/' . chr(10);
		$styles .= '</style>' . chr(10);
		if($treeView->treeModel->countListNodes() < 5){
			$return = '<h3>To use this example please install the 
								data from examples.sql</h3>';
		} else {
			$return = $styles . $treeView->render();
		}
		return $return;
	}

	function usageExampleNestedList($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_defaultPageTreeConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewForSimpleLists.php');
		$configuration = t3lib_div::makeInstance('tx_trees_defaultPageTreeConfiguration');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$treeView = t3lib_div::makeInstance('tx_trees_treeViewForSimpleLists');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView = t3lib_div::makeInstance('tx_trees_nodeViewForSimpleLists');
		$treeModel->configure($configuration);
		$treeView->configure($configuration);
		$nodeModel->configure($configuration);
		$nodeView->configure($configuration);

		// now we can add the configured nodes
		$treeView->setTreeModel($treeModel);
		$treeModel->addNodeModel($nodeModel);
		$treeView->addNodeView($nodeView);

		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeView->render();
	}

	function tx_trees_treeViewForSimpleLists(){}	

	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------
	
	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		if(!in_array($this->get('cssLevel'), $this->cssLevels)){
			$this->_end('_initialize', 'Set one of cssLevels: ' . join(', ', $this->cssLevels));
		}
		parent::_initialize();
	}
	
	function _renderLevelBegin(){
		$current = $this->currentValues;
		if($this->cssLevel == 'many'){
			$classes[] = 'level_' . $current['.level'];
		} 
		if($current['.level'] === 0 && !$this->_empty('listClassAttribute')){
			$classes[] = $this->get('listClassAttribute');
		}
		if(!empty($classes)){
			$classes = ' class="' . join(' ', $classes) . '"';
		}
		$out = '<ul' . $classes . '>' . chr(10);
		return $out;
	}
	
	function _renderLevelEnd(){
		$out .= '</ul>' . chr(10);
		return $out;	
	}	
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSimpleLists.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSimpleLists.php']);
}

?>
