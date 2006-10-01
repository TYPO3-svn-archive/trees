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

class tx_trees_treeViewAbstract extends tx_trees_common{
	
	// no direct use, use setters and getters
	
	var $settings = array(
		'classLevel' => 'normal',  // few, normal, many
		'listClass' => null,
	);
	
	// private variables
	var $treeModel = null;
	var $nodeViews = array();
	var $isInitialized = false;
	var $classLevels = array('few', 'normal', 'many');
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------
		
	function addNodeView(&$nodeView){
		$nodeView->setTree(&$this);
		$this->nodeViews[] =& $nodeView;
	}
	
	function render(){
		$this->_init();
		$rows = array();
		$rendered = array();
		for($this->treeModel->rewind(); $this->treeModel->valid(); $this->treeModel->next()){
			$rows[] = $this->_renderEntry($this->treeModel->current());
		}
		return $this->_renderList($rows);
	}
	
	function set($key, $value){
		switch ($key){
			case 'classLevel': 
				if(!in_array($value, $this->classLevels)){
					$this->end('set(ClassesLevel, ...)', 'Set one of: ' . join(', ', $this->classLevels));						
				}  
			break;
		}
		parent::set($key, $value);
	}

	function setTreeModel(&$treeModel){
		$this->treeModel =& $treeModel;
	}

	function usageExampleNestedList($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewAbstract.php');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$treeView = t3lib_div::makeInstance('tx_trees_treeViewAbstract');
		$nodeModel1 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeView1 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
		$treeView->setTreeModel($treeModel);
		$treeModel->addNodeModel($nodeModel1);
		$treeView->addNodeView($nodeView1);
		$treeView->set('classLevel', 'few');
		$treeView->set('listClass', 'pageTree');
		$nodeModel1->set('table', 'pages');
		$nodeModel1->set('parentTable', 'pages');
		$nodeModel1->set('idField', 'uid');
		$nodeModel1->set('parentIdField', 'pid');
		$nodeModel1->set('fields', 'title');		
		$nodeView1->set('type', 'pages');
		$nodeView1->set('titleField', 'title');
		$nodeView1->set('classAttribute', 'page');
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeView->render();
	}

	function usageExampleMultiTypes($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewAbstract.php');
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
		$treeView->set('classLevel', 'few');
		$treeView->set('listClass', 'multiTree');
		
		$nodeModel1->set('table', 'tx_trees_trunk1');
		$nodeModel1->set('idField', 'uid');
		$nodeModel1->set('parentTableField', 'parenttable');
		$nodeModel1->set('parentIdField', 'parentid');
		$nodeModel1->set('fields', 'title');		
		
		$nodeModel2->set('table', 'tx_trees_leaf1');
		$nodeModel2->set('idField', 'uid');
		$nodeModel2->set('parentTableField', 'parenttable');
		$nodeModel2->set('parentIdField', 'parentid');
		$nodeModel2->set('fields', 'header');		
		
		$nodeModel3->set('table', 'tx_trees_trunk2');
		$nodeModel3->set('idField', 'uid');
		$nodeModel3->set('parentTableField', 'parenttable');
		$nodeModel3->set('parentIdField', 'parentid');
		$nodeModel3->set('fields', 'title');		
		
		$nodeModel4->set('table', 'tx_trees_leaf2');
		$nodeModel4->set('idField', 'uid');
		$nodeModel4->set('parentTableField', 'parenttable');
		$nodeModel4->set('parentIdField', 'parentid');
		$nodeModel4->set('fields', 'header');		
		
		$nodeView1->set('type', 'tx_trees_trunk1');
		$nodeView1->set('titleField', 'title');
		$nodeView1->set('classAttribute', 'trunk1');

		$nodeView2->set('type', 'tx_trees_leaf1');
		$nodeView2->set('titleField', 'header');
		$nodeView2->set('classAttribute', 'leaf1');

		$nodeView3->set('type','tx_trees_trunk2');
		$nodeView3->set('titleField', 'title');
		$nodeView3->set('classAttribute', 'trunk2');

		$nodeView4->set('type', 'tx_trees_leaf2');
		$nodeView4->set('titleField', 'header');
		$nodeView4->set('classAttribute', 'leaf2');

		$treeModel->set('rootNodeType', 'tx_trees_trunk1');
		$treeModel->set('rootId', 0);
		
		$styles .= '<style type="text/css" >' . chr(10);
		$styles .= '/*<![CDATA[*/' . chr(10);
		$styles .= '.trunk1{color:#555;}' . chr(10);
		$styles .= '.trunk2{font-weight:bold;color:#555;}' . chr(10);
		$styles .= '.leaf1{color:darkblue;}' . chr(10);
		$styles .= '.leaf2{color:darkred;}' . chr(10);
		$styles .= '/*]]>*/' . chr(10);
		$styles .= '</style>' . chr(10);
				
		return $styles . $treeView->render();
	}

	//---------------------------------------------------------------------------
	// protected functions to overwrite in inherited classes
	//---------------------------------------------------------------------------
	
	function _init(){
		if($this->isInitialized){
			return;
		}
		if(empty($this->treeModel)){
			$this->end('_init', 'Please set the $treeModel');		
		}
		if(empty($this->nodeViews)){
			$this->end('_init', 'Please set at least one of $nodeViews.');		
		}
		// index the nodeViews by type
		foreach($this->nodeViews as $nodeView){
			$this->nodeViews[$nodeView->get('type')] = $nodeView;
		}
		$this->isInitialized = true;
	}
	
	function _renderEntry($entry){
		$nodeType = $entry['.nodeType'];
		if($nodeType == '.LEVEL_BEGIN') {
			$row = $this->_renderLevelBegin($entry);
		}elseif($nodeType == '.LEVEL_END') {
			$row = $this->_renderLevelEnd($entry);
		}elseif(empty($nodeType)){
			$this->view($entry);
			$this->end('render', 'Empty nodeType');
		}elseif(!in_array($nodeType, array_keys($this->nodeViews))){
			$this->end('render', 'No nodeView for nodeType' . $nodeType);
		} else {
			$components['text'] = $this->nodeViews[$nodeType]->renderText($entry);
			$components['text'] = $components['text'] ? $components['text'] 
				: ($entry['.mountType'] ? ucfirst($entry['.mountType']) : '[no title]');
			$components['class'] = $this->nodeViews[$nodeType]->get('classAttribute');
			$row = $this->_renderRow($entry, $components);
		}
		return $row;
	}
	
	function _renderLevelBegin($current){
		if($this->classLevel == 'many'){
			$classes[] = 'level_' . $current['.level'];
		} 
		if($current['.level'] === 0 && !$this->isEmpty('listClass')){
			$classes[] = $this->get('listClass');
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
		switch ($this->get('classLevel')) {
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