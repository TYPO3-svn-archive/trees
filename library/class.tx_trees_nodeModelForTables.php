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

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelAbstract.php');

class tx_trees_nodeModelForTables extends tx_trees_nodeModelAbstract {
	
	// don't set this directly, use setter functions
	var $settings = array(
		'fields' => array(),
		'idField' => null,
		'limit' => 10000,
		'orderBy' => '',
		'parentIdField' => null,
		'parentTable' => null,		// if unique parent table
		'parentTableField' => null,	// if not unique parent table
		'sorting' => '',
		'type' => null,
		'table' => null,
	);
	
	function tx_trees_nodeModelForTables(){}
	
	//---------------------------------------------------------------------------
	// setters
	//---------------------------------------------------------------------------
	
	function set($key, $value){
		switch($key){
			case 'fields': 
				if(!is_array($value)) {
					$value =  array_unique(t3lib_div::trimExplode(',',$value));
				}				
			break;
		}		
		parent::set($key, $value);
	}
	
	//---------------------------------------------------------------------------
	// getters
	//---------------------------------------------------------------------------

	function findAsChildren($parentNodeType, $parentId){
		if(empty($parentNodeType)) {
			$this->end('findAsChildren', 'Empty parentNodeType.');
		}
		$this->_init();
		$return = array();
		$this->_findTableArray(&$tableArray);
		if(is_array($tableArray['.parentIndex'][$parentNodeType][$parentId])){
			foreach($tableArray['.parentIndex'][$parentNodeType][$parentId] as $id){
				$current['.nodeType'] = $this->get('table');
				$current['.idField'] = $this->get('idField');
				$return[] = t3lib_div::array_merge((array) $tableArray[$id], (array) $current);
			}
		}
		return $return;
	}

	function findById($id){
		$this->_init();
		$return = array(); 
		$this->_findTableArray(&$tableArray);
		if(!empty($tableArray[$id])){   // Root ID => 0 is empty
			$current['.nodeType'] = $this->get('table');
			$current['.idField'] = $this->get('idField');
			$return = t3lib_div::array_merge((array) $tableArray[$id],  (array) $current);
		}
		return $return;
	}
	
	function getType(){
		return $this->get('table');
	}
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------
	
	function _findTableArray(&$array){
		$array =& $this->tree->loadFromSingleton($this->get('table'));
		if($array === null){
			$array = array();
			$this->_loadFromDatabase($array);
			$this->tree->storeAsSingleton($this->get('table'), $array);
		}
	}
	
	function _buildQuery(){
		$deleteClause = ' ' . t3lib_BEfunc::deleteClause($this->get('table')) . ' ';
		$fields = join(',', $this->get('fields'));
		$table = $this->get('table');
		$where = '1=1 ' . $deleteClause;
		$groupBy;
		$orderBy = $this->get('orderBy');
		$limit = $this->get('limit');
		$query = $GLOBALS['TYPO3_DB']->SELECTquery($fields, $table, $where, $groupBy, $orderBy, $limit);
		return $query;
	}
	
	function _init(){
		if($this->isInitialized){
			return;
		}
		if($this->isEmpty('table')){
			$this->end('_init', 'Table is not set');
		}
		if($this->isEmpty('parentTable') && $this->isEmpty('parentTableField')){
			$this->end('_init', 'Set either the parent table (if unique) or the the parent table field.');
		}
		if(!$this->isEmpty('parentTable') && !$this->isEmpty('parentTableField')){
			$this->end('_init', 'Do not set parentTable and parantTableField at the same time.');
		}
		if($this->isEmpty('parentIdField')){
			$this->end('_init', 'parentIdField is not set');
		}
		if($this->isEmpty('idField')){
			$this->end('_init', 'idField is not set');
		}
		if(count($this->get('fields')) == 0) {
			$this->set('fields', array('*'));
		} else {
			if($this->get('parentTableField')){
				array_unshift($this->get('fields'), $this->get('parentTableField'));
			}
			array_unshift($this->get('fields'), $this->get('idField'), $this->get('parentIdField'));
		}
		$this->set('fields', array_unique($this->get('fields')));
		$this->set('type',  'Just a dummy to satisfy the checks of parent::_init(). We use $this->settings[table] instead.');
		parent::_init();
	}
	
	function _loadFromDatabase(&$array){
		$idField = $this->get('idField');
		$parentIdField = $this->get('parentIdField');
		$parentTable = $this->get('parentTable');
		$parentTableField = $this->get('parentTableField');
		$query = $this->_buildQuery();
//		$this->view($query);
		$result = $GLOBALS['TYPO3_DB']->sql(TYPO3_db, $query);
		$this->tt('PreLoad');
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
			$parentTable = $parentTable	? $parentTable : $row[$parentTableField];
			$array['.parentIndex'][$parentTable][$row[$parentIdField]][$row[$idField]] = $row[$idField];
			$array[$row[$idField]] = $row;
		}
		$this->tt('PostLoad');
	}
	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelForTables.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelForTables.php']);
}


?>