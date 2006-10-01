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

class tx_trees_common{
	
	var $settings = array();
	
	function configure($configurationObject){
		foreach(array_keys($this->settings) as $key){
			$value = $configurationObject->get($key);
			if(isset($value)) {
				$this->set($key, $value);
			}
		}
	}
	
	function get($key){
		if(in_array($key, array_keys($this->settings))){
			return $this->settings[$key];
		} else {
			$this->end('set', 'Invalid key ' . $key);
		}
	}

	function dump($par){
		return	tx_trees_div::dump($par);
	}
	
	function isEmpty($key){				
		return empty($this->settings[$key]);
	}
	
	function end($function, $message){
		tx_trees_div::end($function, $message);
	}

	function set($key, $value){
		if(in_array($key, array_keys($this->settings))){
			$this->settings[$key] = $value;
		} else {
			$this->end('set', 'Invalid key ' . $key);
		}
	}

	function tt($marker = 'Timestamp', $display=false){
		return tx_trees_div::tt($marker, $display);
	}
	
	function view($par){
		tx_trees_div::view($par);
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_common.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_common.php']);
}

?>