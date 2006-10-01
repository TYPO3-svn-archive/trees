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

class tx_trees_configuration{

	var $currentFocus = null;
	var $validFoci = array('tx_trees__selectWizard');
	var $localConfiguration = array();
	
	function setFocus($classMethod, $localConfiguration = array()){
			$focus = str_replace('->', '__', $classMethod);
			if(!in_array($focus, $this->validFoci)){
				tx_trees_div::end('setFocus', 'No valid focus.' . $classMethod);
			} else{
				$this->currentFocus = $focus;
				$this->localConfiguration = $localConfiguration;
			}
	}
	
	function get($key){
		$function = $this->currentFocus . 'Get';
		if(method_exists($this, $function)){
			return $this->$function($key);
		}else{
			tx_trees_div::end('get', 'No function ' . $function);
		}		
	}
	
	function tx_trees__selectWizardGet($key){
		// get defaults
		$defaults = array(
			'table' 			=> 'pages',
			'idField' 			=> 'uid',
			'titleField'		=> 'title',
			'parentIdField' 	=> 'pid',
			'parentTableField'	=> '',
			'nodeModelClass' 	=> 'tx_trees_nodeModelForTables',
			'nodeViewClass' 	=> 'tx_trees_nodeViewAbstract',
			'treeModelClass' 	=> 'tx_trees_treeModelAbstract',
			'treeViewClass' 	=> 'tx_trees_treeViewForSelects',
			'inputSize'				=> 10,
		);
		// get locals
		$local = $this->localConfiguration['params'];
		
		// merge it
		$result = $defaults[$key];
		$result = isset($local[$key]) ?  $local[$key] : $result;

		// evaluate some specials 
		switch($key){
			case 'inputName':
			case 'inputId':
				$result = rand();
			break;
			case 'rootNodeType':
			case 'parentTable':
			case 'type':
				$result = isset($local['table']) ? $local['table'] : $defaults['table'];
				break; 
			case 'fields':
				$result = isset($local['titleField']) ? $local['titleField'] : $defaults['titleField'];
				break; 
		}
		return $result;		
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_configuration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_configuration.php']);
}

?>