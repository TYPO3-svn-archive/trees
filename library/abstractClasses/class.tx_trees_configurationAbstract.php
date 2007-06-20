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


class tx_trees_configurationAbstract{
	
	var $currentConfiguration = array();
	
	function get($key){
		if(empty($key)){
			tx_trees_div::end('get', 'Please give a valid key. '); 			
		}
		return $this->currentConfiguration[$key];
	}
	
	function set($key, $value){
		if(empty($key)){
			tx_trees_div::end('set', 'Please give a key.'); 			
		}
		if($value === null){
			tx_trees_div::end('set', 'Please give a value that is not null. 0, false and empty arrays are valid values.'); 
		}
		$this->currentConfiguration[$key] = $value;
	}

	function setByArray($array){
		foreach($array as $key => $value){
			$this->set($key, $value);
		}
	}
	
	function setByList($string){
			return $this->setByArray(tx_trees_div::list2array($string));
	}
	
	function tx_trees_configurationAbstract(){
		tx_trees_div::end('tx_trees_configurationAbstract', 'This is an abstract class. Please use a derived class, i.e. tx_trees_genericConfiguration.');
	}
		
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_configurationAbstract.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/abstractClasses/class.tx_trees_configurationAbstract.php']);
}

?>
