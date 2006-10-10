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

class tx_trees_nodeViewForSelects extends tx_trees_nodeViewAbstract {

	var $requiredSettings = 'nodeType, titleField, indentMargin, indentCharacter, indentPadding, setValue, rowClassAttribute, style';
	
	function getLabelArray(){
		$current = $this->tree->getCurrentValues();
		if($this->get('setValue')){
			$id = ($this->get('setValue')) ?  $current['.nodeType'] . '_' . $current[$current['.idField']] : '';
		} else {
			$id = '--div--';
		}
		$title = $this->tree->getCurrentBreadcrumb();
		$class = $this->get('rowClassAttribute') ? ' class="' . $this->get('rowClassAttribute') . '"' : '';
		return array($title, $id, '', array('class' => $class, 'setValue' => $this->get('setValue')));
	}
	
	function getStyle($superId){
		$style = 
			($this->get('style') && $this->get('rowClassAttribute') && $this->tree->get('inputId')) 
			? '#' . $superId . ' .' . $this->get('rowClassAttribute') 
			. ' {' . $this->get('style') . '}' . chr(10) 
			: '';
		return $style;
	}	
	
	function getTitle(){
		$values = $this->tree->getCurrentValues();
		return $values[$this->get('titleField')];
	}
	
	function renderRow(){
		$current = $this->tree->getCurrentValues();
		$break = chr(10) . '    ';
		$id = ($this->get('setValue')) ?  $current['.nodeType'] . '_' . $current[$current['.idField']] : '';
		$value = ' value="' . $id . '" ';
		$selected = in_array($id, (array) $this->tree->get('selectedValues')) ? ' selected="1" ' : '';
		$prefix = $this->get('indentMargin');
		for($i=0; $i < $current['.level']; $i++){
			$prefix .= $this->get('indentCharacter');
		}
		$prefix .= $this->get('indentPadding');
		$class = $this->get('rowClassAttribute') ? ' class="' . $this->get('rowClassAttribute') . '"' : '';
		
		$label = $current[$this->get('titleField')];
		$title = ' title="' . htmlspecialchars($this->tree->getCurrentBreadcrumb())  . '" ';
		$out = sprintf(
			'%s<option%s%s%s%s>%s%s</option>',
			 $break, $value, $selected, $title, $class, $prefix, $label
		 );
		 return $out;		
	}

	function tx_trees_nodeViewForSelects(){}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeViewForSelects.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_nodeViewForSelects.php']);
}

?>