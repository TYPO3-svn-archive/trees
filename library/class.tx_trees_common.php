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
	
	var $requiredSettings; // comma separated list of keys as a string
	var $settings = array();
	var $isConfigured = false;
	var $isInitialized = false;
	
	//--------------------------------------------------------
	// public functions
	//--------------------------------------------------------

	function configure($configurationObject){
		$required = t3lib_div::trimExplode(',', $this->requiredSettings);
		foreach($required as $key){
			$value = $configurationObject->get($key);
			if(isset($value)) {
				$this->settings[$key] = $value;  // no checks and evaluations here, do them all in _initialize()
			} else {
				$this->_end('configure', 'Missing configuration for ' . $key);				
			}
		}
		$this->isConfigured = true;
	}
	
	function get($key){
		if(in_array($key, array_keys($this->settings))){
			return $this->settings[$key];
		} else {
			$this->_end('get', 'Invalid key ' . $key);
		}
	}

	//--------------------------------------------------------
	// protected functions
	//--------------------------------------------------------

	function _dump($par){
		return	tx_trees_div::dump($par);
	}
	
	function _empty($key){				
		return empty($this->settings[$key]);
	}
	
	function _end($function, $message){
		tx_trees_div::end($function, $message);
	}
	
	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		// do initilizations here in derived classes
		$this->isInitialized = true;
	}
	
	function _tt($marker = 'Timestamp', $display=false){
		return tx_trees_div::tt($marker, $display);
	}
	
	function _view($par){
		tx_trees_div::view($par);
	}	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_common.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_common.php']);
}

?>