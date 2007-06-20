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

require_once(t3lib_extMgm::extPath('trees', 'library/abstractClasses/') . 'class.tx_trees_nodeViewAbstract.php');

class tx_trees_nodeViewForSimpleLists extends tx_trees_nodeViewAbstract {
	
	var $requiredSettings = 'cssLevel, nodeType, titleField, rowClassAttribute, emptyTitle';
	var $cssLevels = array('few', 'normal', 'many');
	var $tree = null;

	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------

	function renderRow(){
		$current = $this->tree->getCurrentValues();
		switch ($this->get('cssLevel')) {
			case 'many':
				$classes[] = 'pos_' . $current['.position'];
				if($current['.mountType']){
					$classes[] = $current['.mountType'];
				}
			case 'normal':
				if($current['.position'] == 0){
					$classes[] = 'first';
				}
				if($current['.isLastSibling']){
					$classes[] = 'last';
				}
		}
		if($rowClass = $this->get('rowClassAttribute')){
			$classes[] = $rowClass;
		}
		if(!empty($classes)){
			$classes = ' class="' . join(' ', $classes) . '"';
		}
		$title = $current[$this->get('titleField')];
		$title = $title == '' ? $this->get('emptyTitle') : $title;
		$row = '<li' . $classes . '>' . $title . '</li>' . chr(10);
		return $row;
	}
	
	function tx_trees_nodeViewForSimpleLists(){}
	
	//---------------------------------------------------------------------------
	// protected functions
	//---------------------------------------------------------------------------
	
	function _initialize(){
		if($this->isInitialized){
			return;
		}
		if(!$this->isConfigured) {
			$this->_end('_initialize', 'Please configure the object first.');
		}
		if(!in_array($this->get('cssLevel'), $this->cssLevels)){
			$this->_end('_initialize', 'Set one of cssLevels: ' . join(', ', $this->cssLevels));
		}
		parent::_initialize();
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeViewForSimpleLists.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeViewForSimpleLists.php']);
}

?>
