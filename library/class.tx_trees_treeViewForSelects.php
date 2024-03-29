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

class tx_trees_treeViewForSelects extends tx_trees_treeViewAbstract {	

	var $requiredSettings = 'cssLevel, listClassAttribute, selectedValues,
			inputName, 	inputId, inputSize, onChange ';
	var $titleStack = array();
	var $lastTitle = '';
	var $entries;
	var $labelArray = array();

	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------
	
	function getBreadcrumbById($id){
		if(empty($this->entries)){
			$this->render();
		}
		return $this->entries[$id]['.breadcrumb'];
	}

	function getCurrentBreadcrumb(){
		return join(' > ', $this->titleStack) . ' > ' . $this->currentNode->getTitle();
	}
	
	function getLabelArray(){
		return $this->labelArray;
	}

	function getRowClassAttributeById($id){
		if(empty($this->entries)){
			$this->render();
		}
		return $this->entries[$id]['.rowClassAttribute'];
	}

	function getStyles($superId = ''){
		$superId = $superId ? $superId : $this->get('inputId');
		foreach($this->nodeViews as $nodeView){
			$styles .= $nodeView->getStyle($superId);
		}
		$out = '<style type="text/css">' . chr(10);
		$out .= $styles;
		$out .= '</style>' . chr(10);
		return $out;		
	}
	
	function presetLabelArray($array){
		$this->labelArray = $array;
	}

	function render(){
		$this->_initialize();
		for($this->treeModel->rewind(); $this->treeModel->valid(); $this->treeModel->next()){
			$this->currentValues = $this->treeModel->current();
			$rows[] =  $this->currentValues['.row'] = $this->_renderRow();
			if($this->currentNode){
				$this->lastTitle = $this->currentNode->getTitle();
				$this->currentValues['.breadcrumb'] = $this->getCurrentBreadcrumb();
				$this->currentValues['.rowClassAttribute'] = $this->currentNode->get('rowClassAttribute');
				$this->entries[$this->currentValues['.nodeType'] . '_' 
					. $this->currentValues[$this->currentValues['.idField']]] = $this->currentValues;
				$this->labelArray[] = $this->currentNode->getLabelArray();
			}
		}
		return $this->_renderList($rows);
	}

	
	function usageExample($mounts = array(0)){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_genericConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewForSelects.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSelects.php');
		$configuration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$configurationList = '
			cssLevel			= few
			listClassAttribute	= pageTree
			rowClassAttribute	=
			rootNodeType 		= pages
			indentMargin		= .&nbsp;
			indentCharacter		= .&nbsp;
			indentPadding  		= &nbsp;&nbsp;
			onChange			=
			onClick				=
			nodeType			= pages
			fields				= title
			idField				= uid
			titleField			= title
			parentTable			= pages
			parentIdField		= pid
			parentTableField 	=
			orderBy				=
			setValue			= 
			style				= 
		';
		$configuration->setByList($configurationList);
		$configuration->set('inputSize', 10);
		$configuration->set('limit', 1000);
		$configuration->set('selectedValues', array());	
		foreach($mounts as $mount){
			$configuration->set('inputId', 'tx_trees_example' . $mount);
			$configuration->set('inputName', 'tx_trees_example' . $mount);
			$configuration->set('rootId', $mount);
			$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
			$nodeModel->configure($configuration);
			$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForTables');
			$treeModel->configure($configuration);
			$nodeView = t3lib_div::makeInstance('tx_trees_nodeViewForSelects');
			$nodeView->configure($configuration);
			$treeView = t3lib_div::makeInstance('tx_trees_treeViewForSelects');
			$treeView->configure($configuration);
			$treeView->setTreeModel($treeModel);
			$treeModel->addNodeModel($nodeModel);
			$treeView->addNodeView($nodeView);			
			$out .= '<p>' . $treeView->render() . '</p>';
		}
		return $out;
	}
	
	function tx_trees_treeViewForSelects(){}
	
	//---------------------------------------------------------------------------
	// protected functions to overwrite in inherited classes
	//---------------------------------------------------------------------------
	
	
	function _renderLevelBegin(){
		array_push($this->titleStack, $this->lastTitle);
	}
	function _renderLevelEnd(){
		array_pop($this->titleStack);		
	}

	function _renderList($rows){
		$break = chr(10);
		$rows = join('', $rows);
		$id = ' id="' . $this->get('inputId') . '"';
		$name = ' name="' . $this->get('inputName') . '"';			
		if($this->get('inputSize') > 1){
			$size =' size="' . (int) $this->get('inputSize') . '" multiple="multiple"';	
		}else{
		}
		$onChange = $this->get('onChange') ? ' onChange="' . $this->get('onChange') .'"'  : '';
		$out = sprintf(
			'%s %s<select%s%s%s%s>%s %s</select> %s',
			$break, $break, $name, $id, $size, $onChange, $rows, $break, $break
		 );
		return $out;
	}
	
	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		if(!is_integer($this->settings['inputSize'])){
			$this->_end('_initialize', 'The inputSize must be integer.');
		}
		if(!is_array($this->settings['selectedValues'])){
			$this->_end('_initialize', 'selectedValues must be an array.');
		}		
		parent::_initialize();
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSelects.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSelects.php']);
}

?>