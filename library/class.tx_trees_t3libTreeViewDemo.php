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

require_once(PATH_t3lib.'class.t3lib_treeview.php');

class tx_trees_t3libTreeViewDemo extends t3lib_treeview{

	function tx_trees_t3libTreeViewDemo(){
		$this->init();		
	}
	
	function init(){
		$this->table = 'pages';
		parent::init();		
	}
	
	function getResult(){
		return $this->getBrowsableTree();
	}

	function example($webmounts = 0, $thisScript = 'index.php'){
		$object = t3lib_div::makeInstance('tx_trees_t3libTreeViewDemo');
		$object->thisScript = $thisScript;
		$object->expandAll = 1;
		$object->MOUNTS = $webmounts;
		return $object->getResult();
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_t3libTreeViewDemo.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_t3libTreeViewDemo.php']);
}

?>