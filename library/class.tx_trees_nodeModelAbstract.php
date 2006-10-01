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

class tx_trees_nodeModelAbstract extends tx_trees_common{
	
	// use setters to set this
	var $tree = null;
	var $isInitialized = false;
	var $settings = array('type' => null);	
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------
	function findAsChildren($parentNodeType, $parentId){ }

	function findById($id){	}

	function setTree(&$object){
		$this->tree =& $object;
	}
	
	function tx_trees_nodeModelAbstract(){
			tx_trees_div::end('Constructur', ' This is an abstract class. Please use derived classes.');
	}	
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------
	
	function _init(){				
		if($this->isInitialized){
			tx_trees_div::view($this->isInitialized);
			return;
		}
		if(empty($this->settings['type'])){
			tx_trees_div::end('_init', 'No type has been set.');
		}
		if(empty($this->tree)){
			tx_trees_div::end('_init', 'The parent object $tree is not set.');
		}
		$this->isInitialized = true;
	}
	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeModelAbstract.php']);
}

?>