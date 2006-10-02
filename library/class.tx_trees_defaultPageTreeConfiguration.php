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

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_configurationAbstract.php');

class tx_trees_defaultPageTreeConfiguration extends tx_trees_configurationAbstract{
	
	var $isInitialized = false;
	
	function get($key){
		if(!$this->isInitialized){
			$this->_initialize();
		}
		return $this->currentConfiguration[$key];
	}
	
	function _initialize(){
		$configurationList = '
			cssLevel 			= few
			listClassAttribute	= pageTree
			rowClassAttribute	= 
			titleField			= title
			rootNodeType 		= pages
			rootId				= 0
			type				= pages
			table				= pages		
			fields				= title	
			idField				= uid
			parentIdField		= pid
			parentTable			= pages
			parentTableField	=
			orderBy				=	
		';
		$this->setByList($configurationList);
		$this->set('limit', 1000);
		$this->isInitialized = true;
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_defaultPageTreeConfiguration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_defaultPageTreeConfiguration.php']);
}
?>