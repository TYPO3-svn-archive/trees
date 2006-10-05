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

class tx_trees_treeModelAbstract  extends tx_trees_commonAbstract{
		
	var $requiredSettings = 'rootNodeType, rootId';
	var $treeArray = array();
	var $listArray = array();
	var $singleton = array();
	var $nodeModels = array();
	var $nestedTreeModel = 'Nested Tree by Elmar Hinz';
	var $nestedTreeVersion = '1.0';
	var $linearizedTreeModel = 'Linearized Tree by Elmar Hinz';
	var $linearizedTreeVersion = '1.0';
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------

	function addNodeModel(&$nodeModel){
		$nodeModel->setTree(&$this);
		$this->nodeModels[] =& $nodeModel;
	}
	
	function build(){
		$this->_buildTree();
		return $this->treeArray;
	}
	
	function current(){
		$this->_buildList();
		return current($this->listArray);
	}
	
	function countListNodes(){
		$this->_buildList();
		return count($this->listArray);
	}
	
	function dumpTree(){
		$this->_buildTree();
		return $this->_dump($this->treeArray);
	}
	
	function dumpList(){
		$this->_buildList();
		return $this->_dump($this->listArray);
	}
	
	function loadFromSingleton($type){
		return $this->singleton[$type];
	}
	
	function next(){
		$this->_buildList();
		return next($this->listArray);
	}
	
	function rewind(){		
		$this->_buildList();
		reset($this->listArray);
	}
	
	function storeAsSingleton($type, &$data){
		$this->singleton[$type] =& $data;
	}
	
	function tx_trees_treeModelAbstract(){
			$this->_end('tx_trees_treeModelAbstract', ' This is an abstract class. Please use a derived class.');
	}
	
	function valid(){
		return ((bool) current($this->listArray));
	}
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------

	function _buildList(){
		if(!empty($this->listArray)){
			return;
		} else {
			$this->_buildTree();
			$this->_tt('Pre linearization');
			$this->_linearizeTreeArray($this->treeArray, $this->listArray);
			$this->_prependLinearizedHeader($this->listArray);
			$this->_tt('Post linearization');
		}
	}
	
	function _buildTree(){
		$this->_initialize();
		$this->treeArray = $this->_recur($this->get('rootNodeType'), $this->get('rootId'));
		$this->_prependNestedHeader($this->treeArray);
	}

	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		if(empty($this->nodeModels)){
			$this->_end('_initialize', 'Please set at least one nodeModel.');			
		} 
		parent::_initialize();
	}			
	
	function _linearizeTreeArray(&$treeArray, &$listArray, $level = 0){
		$position = 0;
		array_push($listArray, array('.nodeType' => '.LEVEL_BEGIN', '.level' =>	$level));
		for($key = 0; $key < count($treeArray); $key++){ // foreach would make  copies in PHP4
			if(isset($treeArray[$key])){
				$entry = $treeArray[$key];
				$tmp['.level'] = $level;
				$tmp['.position'] = $position++;
				$tmp['.numberOfChildren'] = count($treeArray[$key . '.']);
				$entry = t3lib_div::array_merge((array) $entry, (array) $tmp);
				array_push($listArray, $entry);
				$last = count($listArray) - 1;
				if($tmp['.numberOfChildren'] > 0) {
					$this->_linearizeTreeArray(&$treeArray[$key . '.'], &$listArray, ($level + 1));
				}
			}
		}
		if(!empty($last)){
			$listArray[$last] = t3lib_div::array_merge((array) $listArray[$last], array('.isLastSibling' => true));
		}
		array_push($listArray, array('.nodeType' => '.LEVEL_END', '.level' => $level));
	}
	
	function _prependLinearizedHeader(&$array){
		$head['HEADER']['.nodeType'] = '.HEADER';
		$head['HEADER']['.dataModelName'] = $this->linearizedTreeModel;
		$head['HEADER']['.dataModelVersion'] = $this->linearizedTreeVersion;
		$array = t3lib_div::array_merge($array, $head);
	}
	
	function _prependNestedHeader(&$array){
		$head['HEADER']['.nodeType'] = '.HEADER';
		$head['HEADER']['.dataModelName'] = $this->nestedTreeModel;
		$head['HEADER']['.dataModelVersion'] = $this->nestedTreeVersion;
		$array = t3lib_div::array_merge($array, $head);		
	}
	
	function _recur($parentNodeType, $parentId){
		$return  = array();
		$counter = 0;
		for($i = 0; $i < count($this->nodeModels); $i++){  // foreach would make copies in PHP4
			$nodeModel =& $this->nodeModels[$i];
			$siblings = $nodeModel->findAsChildren($parentNodeType, $parentId);
			foreach($siblings as $sibling){
				$return[$counter] =  $sibling;
				$children = $this->_recur($sibling['.nodeType'], $sibling[$sibling['.idField']]);
				if(is_array($children) && !empty($children)) {
					$return[$counter . '.'] = $children;
				}
				$counter++;
			}
		}
		return $return;
	}
	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_treeModelAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_treeModelAbstract.php']);
}

?>