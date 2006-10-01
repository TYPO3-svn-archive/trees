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

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelAbstract.php');

class tx_trees_treeModelForPageTree extends tx_trees_treeModelAbstract{
	
	var $mounts = array();
	var $mountTypes = array('webMount', 'categoryMount', 'fileMount');
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------

	function addMount($mountType, $nodeType, $id){
		if(!in_array($mountType,$this->mountTypes)){
			$this->end('addMount', 'Set one of mountTypes  '. join(',', $this->mountTypes));
		}
		$this->mounts[] = array('mountType' => $mountType, 'nodeType' => $nodeType, 'id' => $id);
	}
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------

	function _buildTree(){
		$this->_init();
		$array = array();
		$counter = 0;
		foreach($this->mounts as $mount){
			$id = $mount['id'];
			$nodeType = $mount['nodeType'];
			$array[$counter]['.mountType'] = $mount['mountType'];
			$array[$counter]['.nodeType'] = $nodeType;
			for($i = 0; $i < count($this->nodeModels); $i++){
				$nodeModel =& $this->nodeModels[$i];			
				if($nodeModel->get('type') === $nodeType){
					$current = $nodeModel->findById($id);
					$array[$counter] = t3lib_div::array_merge((array)$current, (array)$array[$counter]);
				}					
			}
			$this->tt('Pre recur (' . $id .')');
			$children =  $this->_recur($nodeType, $id);
			$this->tt('Post recur(' . $id .')');			
			if(is_array($children) && !empty($children)){
				$array[$counter . '.'] = $children;
			}
			$counter++;
		}
		$this->treeArray =& $array;
	}

	function _init(){
		if($this->isInitialized){
			return;
		}
		if(empty($this->nodeModels)){
			$this->end('_init', 'Please set at least one node object to read the data.');
		}
		if(empty($this->mounts)){
			foreach($GLOBALS['WEBMOUNTS'] as $id){
				$this->addMount('webMount', 'pages', $id);
			}
		}
		$this->isInitialized = true;
	}

	//---------------------------------------------------------------------------
	// usage examples
	//---------------------------------------------------------------------------
	
	function usageExampleDumpPageTree($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$treeModel->addNodeModel($nodeModel);
		$nodeModel->set('table', 'pages');
		$nodeModel->set('parentTable', 'pages');
		$nodeModel->set('idField', 'uid');
		$nodeModel->set('parentIdField', 'pid');
		$nodeModel->set('fields', 'title');
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}
		return $treeModel->dumpTree();
	}	
	
	function usageExampleDumpTree($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeModel2 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$treeModel->addNodeModel($nodeModel);
		$treeModel->addNodeModel($nodeModel2);
		$nodeModel->set('table', 'pages');
		$nodeModel->set('parentTable', 'pages');
		$nodeModel->set('idField', 'uid');
		$nodeModel->set('parentIdField', 'pid');
		$nodeModel->set('fields', 'title');
		$nodeModel2->set ('table', 'tt_content');
		$nodeModel2->set('parentTable', 'pages');
		$nodeModel2->set('idField', 'uid');
		$nodeModel2->set('parentIdField', 'pid');
		$nodeModel2->set('fields', 'header');
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeModel->dumpTree();
	}	
	
	function usageExampleDumpList($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeModel2 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$treeModel->addNodeModel($nodeModel);
		$treeModel->addNodeModel($nodeModel2);
		$nodeModel->set('table', 'pages');
		$nodeModel->set('parentTable', 'pages');
		$nodeModel->set('idField', 'uid');
		$nodeModel->set('parentIdField', 'pid');
		$nodeModel->set('fields', 'title');
		$nodeModel2->set ('table', 'tt_content');
		$nodeModel2->set('parentTable', 'pages');
		$nodeModel2->set('idField', 'uid');
		$nodeModel2->set('parentIdField', 'pid');
		$nodeModel2->set('fields', 'header');
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeModel->dumpList();
	}	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeModelForPageTree.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeModelForPageTree.php']);
}

?>