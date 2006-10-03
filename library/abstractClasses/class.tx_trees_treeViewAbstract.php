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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_commonAbstract.php');

class tx_trees_treeViewAbstract extends tx_trees_commonAbstract{
	
	var $treeModel = null;
	var $nodeViews = array();
	var $dataModelName = 'Linearized Tree by Elmar Hinz';
	var $dataModelVersion = '1.0';
	var $headerChecked = false;

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

	function tx_trees_treeViewAbstract(){
		$this->_end('tx_trees_treeViewAbstract', ' This is an abstract class. Please use a derived class.');
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
	
	function _renderEntry($entry) {
		$nodeType = $entry['.nodeType'];
		if(	$nodeType == '.HEADER'
		&& $entry['.dataModelName'] == $this->dataModelName
		&& $entry['.dataModelVersion'] == $this->dataModelVersion) {
			$this->headerChecked = true;
		}
		if(!$this->headerChecked){
			$this->_view($entry);
			$this->_end('_renderEntry', 'Invalid header of data model.');
		}
		switch($nodeType){
			case '.HEADER':
				break;
			case '.LEVEL_BEGIN':
				$row = $this->_renderLevelBegin($entry);
				break;
			case '.LEVEL_END':
				$row = $this->_renderLevelEnd($entry);
				break;
			case '':
				$this->_view($entry);
				$this->_end('render', 'Empty nodeType');
				break;
			default:
				if(!in_array($nodeType, array_keys($this->nodeViews))){
					$this->_end('render', 'No nodeView for nodeType' . $nodeType);
				} else {
					$row = $this->nodeViews[$nodeType]->render($entry);
				}
				break;
		}
		return $row;
	}

	function _renderLevelBegin($current){
		$this->_end('_renderLevelBegin', 'This is an abstract class. Please overwrite this function in a derived class.');
	}
	
	function _renderLevelEnd($current){
		$this->_end('_renderLevelEnd', 'This is an abstract class. Please overwrite this function in a derived class.');
	}
	
	function _renderList($rows){
		return join('', $rows);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_treeViewAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_treeViewAbstract.php']);
}

?>