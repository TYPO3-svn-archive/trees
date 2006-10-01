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

require_once(PATH_t3lib.'class.t3lib_browsetree.php');

class tx_trees_demos_trees_t3lib_browsetree extends t3lib_browsetree{

	function tx_trees_demos_trees_t3lib_browsetree() {
		$this->init();
	}
	
	function init(){
		parent::init();
	}

	/*************************************************
	* Example (embedded teaching function)
	*
	* simply call
	* $out = tx_tutor_t3lib_browsetree::staticExample('index.php');
	*
	* This static function creates an instance of
	* the class itself and runs a possible usage.
	*
	* @return string
	*/
	
	function example($thisScript, $webmounts = 0){
		$object = t3lib_div::makeInstance('tx_trees_demos_trees_t3lib_browsetree');
		$object->thisScript = $thisScript;
		$object->MOUNTS = $webmounts;
		return $object->getBrowsableTree();
	}

	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/demos/trees/class.tx_trees_demos_trees_t3lib_browsetree.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/demos/trees/class.tx_trees_demos_trees_t3lib_browsetree.php']);
}


?>