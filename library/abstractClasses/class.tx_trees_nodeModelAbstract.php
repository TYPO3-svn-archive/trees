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

class tx_trees_nodeModelAbstract extends tx_trees_commonAbstract{
	
	var $tree = null;
	var $requiredSettings = 'nodeType';
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------
	function findAsChildren($parentNodeType, $parentId){ }

	function findById($id){	}

	function setTree(&$object){
		$this->tree =& $object;
	}
	
	function tx_trees_nodeModelAbstract(){
			$this->_end('tx_trees_nodeModelAbstract', ' This is an abstract class. Please use a derived class.');
	}	
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------

	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->tree){
			$this->_end('_initialize', 'Please set the tree for the node.');			
		}
		parent::_initialize();
	}	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_nodeModelAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_nodeModelAbstract.php']);
}

?>