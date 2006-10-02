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

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_common.php');

class tx_trees_treeViewAbstract extends tx_trees_common{
	
	var $requiredSettings = 'cssLevel, listClassAttribute';
	var $treeModel = null;
	var $nodeViews = array();
	var $cssLevels = array('few', 'normal', 'many');
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------
		
	function addNodeView(&$nodeView){
		$nodeView->setTree(&$this);
		$this->nodeViews[] =& $nodeView;
	}
	
	function render(){
		$this->_initialize();
		$rows = array();
		$rendered = array();
		for($this->treeModel->rewind(); $this->treeModel->valid(); $this->treeModel->next()){
			$rows[] = $this->_renderEntry($this->treeModel->current());
		}			
		return $this->_renderList($rows);
	}
	
	function setTreeModel(&$treeModel){
		$this->treeModel =& $treeModel;
	}

	function usageExampleNestedList($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_defaultPageTreeConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewAbstract.php');
		$configuration = t3lib_div::makeInstance('tx_trees_defaultPageTreeConfiguration');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$treeView = t3lib_div::makeInstance('tx_trees_treeViewAbstract');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
		$treeView->setTreeModel($treeModel);
		$treeModel->addNodeModel($nodeModel);
		$treeView->addNodeView($nodeView);
		$treeModel->configure($configuration);
		$treeView->configure($configuration);
		$nodeModel->configure($configuration);
		$nodeView->configure($configuration);
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeView->render();
	}

	function usageExampleMultiTypes($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_configurationAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewAbstract.php');
		$treeModelConfiguration = t3lib_div::makeInstance('tx_trees_configurationAbstract');
		$treeViewConfiguration = t3lib_div::makeInstance('tx_trees_configurationAbstract');
		$nodeModelConfiguration = t3lib_div::makeInstance('tx_trees_configurationAbstract');
		$nodeViewConfiguration = t3lib_div::makeInstance('tx_trees_configurationAbstract');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelAbstract');
		$treeView = t3lib_div::makeInstance('tx_trees_treeViewAbstract');
		$nodeModel1 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView1 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
		$nodeModel2 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView2 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
		$nodeModel3 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView3 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
		$nodeModel4 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView4 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');		
		$treeView->setTreeModel($treeModel);
		$treeModel->addNodeModel($nodeModel1);
		$treeModel->addNodeModel($nodeModel2);
		$treeModel->addNodeModel($nodeModel3);
		$treeModel->addNodeModel($nodeModel4);
		$treeView->addNodeView($nodeView1);
		$treeView->addNodeView($nodeView2);
		$treeView->addNodeView($nodeView3);
		$treeView->addNodeView($nodeView4);

		// tree model configuration
		
		$treeModelConfiguration->set('rootNodeType', 'tx_trees_trunk1');
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
		$nodeModelConfiguration->set('table', 'tx_trees_trunk1');
		$nodeModelConfiguration->set('idField', 'uid');
		$nodeModelConfiguration->set('parentTableField', 'parenttable');
		$nodeModelConfiguration->set('parentIdField', 'parentid');
		$nodeModelConfiguration->set('fields', 'title');		
		$nodeModel1->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('table', 'tx_trees_trunk2');
		$nodeModel2->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('table', 'tx_trees_leaf1');
		$nodeModelConfiguration->set('fields', 'header');		
		$nodeModel3->configure($nodeModelConfiguration);
		
		$nodeModelConfiguration->set('table', 'tx_trees_leaf2');
		$nodeModel4->configure($nodeModelConfiguration);
		
		// node view configuration

		$nodeViewConfiguration->set('type', 'tx_trees_trunk1');
		$nodeViewConfiguration->set('titleField', 'title');
		$nodeViewConfiguration->set('rowClassAttribute', 'trunk1');
		$nodeView1->configure($nodeViewConfiguration); 		

		$nodeViewConfiguration->set('type', 'tx_trees_trunk2');
		$nodeViewConfiguration->set('rowClassAttribute', 'trunk2');
		$nodeView2->configure($nodeViewConfiguration); 		

		$nodeViewConfiguration->set('type', 'tx_trees_leaf1');
		$nodeViewConfiguration->set('titleField', 'header');
		$nodeViewConfiguration->set('rowClassAttribute', 'leaf1');
		$nodeView3->configure($nodeViewConfiguration); 		
		
		$nodeViewConfiguration->set('type', 'tx_trees_leaf2');
		$nodeViewConfiguration->set('rowClassAttribute', 'leaf2');
		$nodeView4->configure($nodeViewConfiguration); 		
		
		$styles .= '<style type="text/css" >' . chr(10);
		$styles .= '/*<![CDATA[*/' . chr(10);
		$styles .= '.trunk1{color:#555;}' . chr(10);
		$styles .= '.trunk2{font-weight:bold;color:#555;}' . chr(10);
		$styles .= '.leaf1{color:darkblue;}' . chr(10);
		$styles .= '.leaf2{color:darkred;}' . chr(10);
		$styles .= '/*]]>*/' . chr(10);
		$styles .= '</style>' . chr(10);
		if($treeView->treeModel->countListNodes() < 3){
			$return = '<h3>To use this example please install the 
								data from examples.sql</h3>';
		} else {
			$return = $styles . $treeView->render();
		}
		return $return;
	}

	//---------------------------------------------------------------------------
	// protected functions to overwrite in inherited classes
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
		if(empty($this->treeModel)){
			$this->_end('_initialize', 'Please set the treeModel before configuration');
		}
		if(empty($this->nodeViews)){
			$this->end('_initialize', 'Please set at least one of nodeViews (before configuration).');		
		}
		// index the nodeViews by type
		foreach($this->nodeViews as $nodeView){
			$this->nodeViews[$nodeView->get('type')] = $nodeView;
		}
		parent::_initialize();
	}
	
	function _renderEntry($entry){
		$nodeType = $entry['.nodeType'];
		if($nodeType == '.LEVEL_BEGIN') {
			$row = $this->_renderLevelBegin($entry);
		}elseif($nodeType == '.LEVEL_END') {
			$row = $this->_renderLevelEnd($entry);
		}elseif(empty($nodeType)){
			$this->_view($entry);
			$this->_end('render', 'Empty nodeType');
		}elseif(!in_array($nodeType, array_keys($this->nodeViews))){
			$this->_end('render', 'No nodeView for nodeType' . $nodeType);
		} else {
			$components['text'] = $this->nodeViews[$nodeType]->renderText($entry);
			$components['text'] = $components['text'] ? $components['text'] 
				: ($entry['.mountType'] ? ucfirst($entry['.mountType']) : '[no title]');
			$components['class'] = $this->nodeViews[$nodeType]->get('rowClassAttribute');
			$row = $this->_renderRow($entry, $components);
		}
		return $row;
	}
	
	function _renderLevelBegin($current){
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
	
	function _renderLevelEnd($current){
		$out .= '</ul>' . chr(10);
		return $out;	
	}	
	
	function _renderList($rows){
		return $out = chr(10) . chr(10) . join('', $rows) . chr(10);
	}	
	
	function _renderRow($current, $components){
		switch ($this->get('cssLevel')) {
			case 'many': 
				$classes[] = 'pos_' . $current['.position'];
				if($current['.mountType']){
					$classes[] = $current['.mountType'];
				}
				case 'normal': 
				if($current['.position'] == 0){
					$classes[] = 'first';
				}
				if($current['.isLastSibling']){
					$classes[] = 'last';
				}
		}
		if(!empty($components['class'])){
			$classes[] = $components['class'];
		}
		if(!empty($classes)){
			$classes = ' class="' . join(' ', $classes) . '"';
		}
		$out = '<li' . $classes . '>' . $components['text'] . '</li>' . chr(10);
		return $out;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewAbstract.php']);
}

?>