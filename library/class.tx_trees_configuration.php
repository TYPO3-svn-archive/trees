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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_configurationAbstract.php');

class tx_trees_configuration extends tx_trees_configurationAbstract {

	var $focusCounter = 0;
	var $currentFocusMethod = null;
	var $localConfiguration = array();
	var $currentConfiguration = array();
	var $isConfigured = false;
	
	//--------------------------------------------------------------------------
	// Public functions
	//--------------------------------------------------------------------------

	function get($key){
		$method = $this->currentFocusMethod;
		if(method_exists($this, $method)){
			return $this->$method($key);			
		}else{
			tx_trees_div::end('get', 'Please set a valid focus with the setFocus(...) method first.');
		}		
	}
	
	function setFocus($focusKey, $localConfiguration = array()){
		$method = '_' . $focusKey . 'Get';
		if(method_exists($this, $method)){
			$this->currentConfiguration = array(); // clear it
			$this->currentFocusMethod = $method;
			$this->localConfiguration = $localConfiguration;
		} else{
			tx_trees_div::end('setFocus', 'No valid focus: ' . $method);
		}
	}
	
	function tx_trees_configuration(){}
	
	//--------------------------------------------------------------------------
	// Protected functions
	//--------------------------------------------------------------------------

	function _tx_trees__selectFunctionGet($key){
		return $this->_tx_trees__groupWizardGet($key);
	}
		
	function _tx_trees__groupWizardGet($key){
		if(!$this->isConfigured) {
			$this->isConfigured = true;

			// load classes
			require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
			require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForTables.php');
			require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewForSelects.php');
			require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSelects.php');	
			
			// set defaults
			$defaultsList = '
					nodeModelClass 		= tx_trees_nodeModelForTables 
					treeModelClass 		= tx_trees_treeModelForTables
					nodeViewClass 		= tx_trees_nodeViewForSelects 
					treeViewClass 		= tx_trees_treeViewForSelects 
					cssLevel			= few
					listClassAttribute  = 
					rowClassAttribute	= 
					indentMargin		= .&nbsp;
					indentCharacter		= .&nbsp;
					indentPadding  		= &nbsp; 
					onChange			=
					onClick				=
					orderBy				=
					style				= 
			';
			$defaults = tx_trees_div::list2array($defaultsList);
			$defaults = t3lib_div::array_merge(
				$defaults,
				array(
					'inputSize'			=> 10,
					'selectedValues'    => array(),
					'limit'				=> 1000,
				)
			);
			
			// for the table pages we preset more values
			if($this->localConfiguration['nodeType'] == 'pages'){			
				$pagesList = '
					listClassAttribute	= pageTree
					rootNodeType 		= pages
					nodeType			= pages
					fields				= title
					idField				= uid
					titleField			= title
					parentTable			= pages
					parentIdField		= pid
					parentTableField 	=
				';
				$defaults = t3lib_div::array_merge(	$defaults, tx_trees_div::list2array($pagesList));
				$defaults = t3lib_div::array_merge(
					$defaults,
					array(
						'rootId'			=> 0,
					)
				);
			} 
			
 			// merge with give local configuration
			$results = t3lib_div::array_merge((array) $defaults, (array) $this->localConfiguration);
	
			// evaluate the rest
			$results['inputId'] = $results['inputName'] = 'sourceSelect_' . rand();

			// store to current configuration 
			$this->currentConfiguration =  t3lib_div::array_merge((array) $this->currentConfiguration, $results);
		}
		return $this->currentConfiguration[$key];
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_configuration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_configuration.php']);
}

?>