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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_treeModelAbstract.php');

class tx_trees_treeModelForPageTree extends tx_trees_treeModelAbstract{
	
	var $mounts = array();
	var $mountTypes = array('webMount', 'categoryMount', 'fileMount');
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------

	function addMount($mountType, $nodeType, $id){
		if(!in_array($mountType,$this->mountTypes)){
			$this->_end('addMount', 'Set one of mountTypes  '. join(',', $this->mountTypes));
		}
		$this->mounts[] = array('mountType' => $mountType, 'nodeType' => $nodeType, 'id' => $id);
	}
	
	function tx_trees_treeModelForPageTree(){}
	
	//---------------------------------------------------------------------------
	// usage examples
	//---------------------------------------------------------------------------
	
	function usageExampleDumpPageTree($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_defaultPageTreeConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		$configuration = t3lib_div::makeInstance('tx_trees_defaultPageTreeConfiguration');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$treeModel->configure($configuration);
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}
		$nodeModel->configure($configuration);
		$treeModel->addNodeModel($nodeModel);
		return $treeModel->dumpTree();
	}	
	
	function usageExampleDumpList($mounts){
		$treeModel = tx_trees_treeModelForPageTree::usageExampleDumpWithTt_content($mounts);
		return $treeModel->dumpList();
	}	

	function usageExampleDumpTree($mounts){
		$treeModel = tx_trees_treeModelForPageTree::usageExampleDumpWithTt_content($mounts);
		return $treeModel->dumpTree();
	}	

	function usageExampleDumpWithTt_content($mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_genericConfiguration.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		$configuration = t3lib_div::makeInstance('tx_trees_genericConfiguration');
		$treeModel = t3lib_div::makeInstance('tx_trees_treeModelForPageTree');
		$nodeModel = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$nodeModel2 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
		$configurationList = '
			rootNodeType 		= pages
			rootId				= 0
			nodeType			= pages		
			fields				= title	
			idField				= uid
			parentIdField		= pid
			parentTable			= pages
			parentTableField	=
			orderBy				=	
		';
		$configuration->set('limit', 1000);
		$configuration->setByList($configurationList);
		$treeModel->configure($configuration);
		$nodeModel->configure($configuration);		
		$treeModel->addNodeModel($nodeModel);
		
		//overwrite some values for the second tables configuration
		$configuration->set('nodeType', 'tt_content');
		$configuration->set('fields', 'header');
		$nodeModel2->configure($configuration);		
		$treeModel->addNodeModel($nodeModel2);
		foreach($mounts as $mount){
			$treeModel->addMount('webMount', 'pages', $mount);
		}		
		return $treeModel;
	}	

	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------

	function _buildTree(){
		$this->_initialize();
		$array = array();
		$counter = 0;
		foreach($this->mounts as $mount){
			$id = $mount['id'];
			$nodeType = $mount['nodeType'];
			$array[$counter]['.mountType'] = $mount['mountType'];
			$array[$counter]['.nodeType'] = $nodeType;
			for($i = 0; $i < count($this->nodeModels); $i++){
				$nodeModel =& $this->nodeModels[$i];			
				if($nodeModel->get('nodeType') === $nodeType){
					$current = $nodeModel->findById($id);
					$array[$counter] = t3lib_div::array_merge((array)$current, (array)$array[$counter]);
				}					
			}
			$this->_tt('Pre recur (' . $id .')');
			$children =  $this->_recur($nodeType, $id);
			$this->_tt('Post recur(' . $id .')');			
			if(is_array($children) && !empty($children)){
				$array[$counter . '.'] = $children;
			}
			$counter++;
		}
		$this->treeArray =& $array;
		$this->_prependNestedHeader($this->treeArray);
	}

	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		parent::_initialize();
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeModelForPageTree.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeModelForPageTree.php']);
}

?>