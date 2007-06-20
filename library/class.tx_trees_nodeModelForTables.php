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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_nodeModelAbstract.php');

class tx_trees_nodeModelForTables extends tx_trees_nodeModelAbstract {
	
	// Order matters: fields MUST come after parentIdField, parentTableField 
	// to include them automatically in the set function
	var $requiredSettings = 'nodeType, idField, parentIdField, parentTable, 
		parentTableField, fields, limit, orderBy';  
	
	function tx_trees_nodeModelForTables(){}
	
	//---------------------------------------------------------------------------
	// getters
	//---------------------------------------------------------------------------

	function findAsChildren($parentNodeType, $parentId){
		$this->_initialize();
		/*
		if(empty($parentNodeType)) {
			$this->_end('findAsChildren', 'Empty parentNodeType.');
		}
		*/
		$return = array();
		$this->_findTableArray(&$tableArray);
		$nodeType = $this->get('nodeType');
		$idField = $this->get('idField');		
		if(is_array($array = $tableArray['.parentIndex'][$parentNodeType][$parentId])){
			foreach($array as $id){
				$current['.nodeType'] = $nodeType;
				$current['.idField'] = $idField;
				$return[] = t3lib_div::array_merge((array) $tableArray[$id], (array) $current);
			}
		}
		return $return;
	}

	function findById($id){
		$this->_initialize();
		$return = array(); 
		$this->_findTableArray(&$tableArray);
		if(!empty($tableArray[$id])){   // Root ID => 0 is empty
			$current['.nodeType'] = $this->get('nodeType');
			$current['.idField'] = $this->get('idField');
			$return = t3lib_div::array_merge((array) $tableArray[$id],  (array) $current);
		}
		return $return;
	}
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------
	
	function _buildQuery(){
		require_once(PATH_t3lib . 'class.t3lib_befunc.php');
		$deleteClause = ' ' . t3lib_BEfunc::deleteClause($this->settings['nodeType']) . ' ';
		$fields = join(',', $this->settings['fields']);
		$table = $this->settings['nodeType'];
		$where = '1=1 ' . $deleteClause;
		$groupBy;
		$orderBy = $this->settings['orderBy'];
		$limit = $this->settings['limit'];
		$query = $GLOBALS['TYPO3_DB']->SELECTquery($fields, $table, $where, $groupBy, $orderBy, $limit);
		return $query;
	}

	function _findTableArray(&$array){
		$array = $this->tree->loadFromSingleton($this->settings['nodeType']);
		if($array === null){
			$array = array();
			$this->_loadFromDatabase($array);
			$this->tree->storeAsSingleton($this->settings['nodeType'], $array);
		}
	}
	
	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		if(!is_integer($this->settings['limit'])){
				$this->_end('_initialize', 'The limit must be integer.');
		}
		// evaluate the fields array for the query
		$fields = $this->settings['fields'];
		if($fields == '*'){
			$fields = array('*');
		} else {
			if(!is_array($fields)) {
				$fields =  t3lib_div::trimExplode(',',$fields);
			}
			foreach(array('idField', 'parentTableField', 'parentIdField') as $field){
				if($this->settings[$field]){
					$fields[] = $this->settings[$field];
				}
			}
			$fields = array_unique($fields);
		} 
		$this->settings['fields'] = $fields;
		parent::_initialize();
	}
		
	function _loadFromDatabase(&$array){
		$idField = $this->settings['idField'];
		$parentTable = $this->settings['parentTable'];
		$parentIdField = $this->settings['parentIdField'];
		$parentTableField = $this->settings['parentTableField'];
		$query = $this->_buildQuery();
		$result = $GLOBALS['TYPO3_DB']->sql(TYPO3_db, $query);
		$this->_tt('Pre query "' . $this->settings['nodeType'] .'"');
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
			$tempParentTable = $parentTable	? $parentTable : $row[$parentTableField];
			$array['.parentIndex'][$tempParentTable][$row[$parentIdField]][$row[$idField]] = $row[$idField];
			$array[$row[$idField]] = $row;
		}
		$this->_tt('Post query "' . $this->settings['nodeType'] .'"');
	}	
	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelForTables.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelForTables.php']);
}


?>
